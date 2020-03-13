<template>
  <div>
    <!-- DD-MM  H:m -->
    {{ time ? time.unixFmt("dd-MM  h:mm a") : "" }}
  </div>
</template>

<script>
import spacetime from "spacetime";

export default {
  name: "CurrentTime",
  data() {
    return {
      time: ""
    };
  },
  methods: {
    getCurrentTime() {
      this.time = spacetime.now();
    }
  },
  created() {
    this.$intervalID = setInterval(this.getCurrentTime, 1000);
  },
  mounted() {
    this.getCurrentTime();
    this.$emit("timezone", spacetime.now().timezone().name);
  },
  beforeDestroy() {
    clearInterval(this.$intervalID);
  }
};
</script>
