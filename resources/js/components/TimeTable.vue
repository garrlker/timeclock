<template>
  <div>
    <div class="box">
      <div class="entry-table">
        <b-table
          :data="reversePunchcardList"
          sticky-header
          :loading="tableIsBusy"
        >
          <template slot-scope="props">
            <b-table-column field="time_in" label="Time In" centered>
              {{ adjustTimezone(props.row.time_in) }}
            </b-table-column>

            <b-table-column field="time_out" label="Time Out" centered>
              {{ adjustTimezone(props.row.time_out) }}
            </b-table-column>
          </template>
          <template slot="empty">
            <div class="content has-text-grey has-text-centered">
              <p>Nothing here.</p>
            </div>
          </template>
        </b-table>
      </div>
    </div>
    <b-button
      :class="{
        'is-block is-large is-fullwidth': true,
        'is-primary': !isClockedIn,
        'is-warning': isClockedIn
      }"
      @click="punchTimecard"
      :loading="buttonIsBusy"
    >
      {{ isClockedIn ? "Clock Out" : "Clock In" }}
    </b-button>
  </div>
</template>

<script>
import spacetime from "spacetime";

export default {
  name: "TimeTable",
  model: {
    prop: "isClockedIn",
    event: "updateCard"
  },
  props: {
    user: {
      type: Object
    },
    isClockedIn: {
      type: [Number, Boolean]
    }
  },
  data() {
    return {
      columns: [
        {
          field: "time_in",
          label: "Time In",
          centered: true
        },
        {
          field: "time_out",
          label: "Time Out",
          centered: true
        }
      ],
      punchcard: [],
      tableIsBusy: false,
      buttonIsBusy: false,
      clockedIn: false
    };
  },
  computed: {
    reversePunchcardList() {
      return this.punchcard.slice().reverse();
    }
  },
  methods: {
    /**
     * Adjust an ISO 8601 datetime string to the user's timezone
     *
     * @param {String} time
     *
     * @return {String} - User's Local Time
     */
    adjustTimezone(time) {
      if (time) {
        var d = spacetime(time);

        if (this.user) {
          return d.goto(this.user.timezone).unixFmt("dd-MM  h:mm a");
        }
      }

      return;
    },
    /**
     * Fire a Clock In request to the backend
     *
     * @return {void}
     */
    async clockIn() {
      return await axios
        .post("/api/timeclock/clockin")
        .then(res => {
          // If we return a good response, but our api kicked out a request, throw it's error message
          if (res.data.error) {
            throw res.data.error;
          }

          this.punchcard.push(res.data);
        })
        .catch(err => {
          throw err;
        })
        .then(() => console.log("Clocked In"));
    },
    /**
     * Fire a Clock Out request to the backend
     *
     * @return {void}
     */
    async clockOut() {
      return await axios
        .post("/api/timeclock/clockout")
        .then(res => {
          /*
           * If we return a good response
           * but our api kicked out an error
           * throw the responses error message
           */
          if (res.data.error) {
            throw res.data.error;
          }

          // Set time_out from the response
          this.punchcard[this.punchcard.length - 1].time_out =
            res.data.time_out;
        })
        .catch(err => {
          throw err;
        })
        .then(() => console.log("Clocked Out"));
    },
    async getPunchcard() {
      this.buttonIsBusy = true;
      this.tableIsBusy = true;
      axios
        .get("/api/timeclock")
        .then(res => (this.punchcard = res.data))
        .catch(err => console.log(err))
        .then(() => {
          this.buttonIsBusy = false;
          this.tableIsBusy = false;
        });
    },
    /**
     * Attempt to clock the user in/out and handle any errors
     * in the process
     *
     * @return {void}
     */
    async punchTimecard() {
      // Enable loading spinner
      this.buttonIsBusy = true;

      // Clock In/Out based on user state
      // Catch and display warnings in a snackbar
      try {
        if (this.isClockedIn) {
          await this.clockOut();
        } else {
          await this.clockIn();
        }

        this.$emit("updateCard", !this.isClockedIn);
      } catch (err) {
        this.$buefy.snackbar.open({
          message: err,
          type: "is-warning",
          position: "is-bottom-right",
          queue: true
        });
        console.error(err);
      }

      // Disable loading spinner
      this.buttonIsBusy = false;
    }
  },
  async mounted() {
    await this.getPunchcard();
  }
};
</script>
