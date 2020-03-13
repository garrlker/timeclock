require("./bootstrap");

var Vue = require("vue");

const files = require.context("./", true, /\.vue$/i);
files.keys().map(key =>
  Vue.component(
    key
      .split("/")
      .pop()
      .split(".")[0],
    files(key).default
  )
);

import Buefy from "buefy";
Vue.use(Buefy);

const app = new Vue({
  el: "#app",
  data() {
    return {
      user: {
        clocked_in: false
      }
    };
  },
  methods: {
    async getUser() {
      await axios
        .get("/api/user")
        .then(res => {
          this.user = res.data;
        })
        .catch(err => {
          throw err;
        })
        .then(() => console.log("Fetched User"));
    },
    async setTimezone(timezone) {
      await axios
        .post("/api/user/updateTimezone", {
          timezone
        })
        .then(res => {
          this.user = res.data;
        })
        .catch(err => {
          throw err;
        })
        .then(() => console.log("Updated Timezone"));
    }
  },
  async mounted() {
    this.getUser();
  }
});
