require('./bootstrap');

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
      data: [
        {
          clockedIn: "2016-10-15 13:43:27",
          clockedOut: "2016-10-15 18:43:27"
        },
        {
          clockedIn: "2016-10-15 18:43:27",
          clockedOut: "2016-04-26 06:26:28"
        },
        {
          clockedIn: "2016-04-26 06:26:28",
          clockedOut: "2016-04-26 019:26:28"
        },
        {
          clockedIn: "2016-04-26 019:26:28",
          clockedOut: "2016-12-06 14:38:38"
        },
        {
          clockedIn: "2016-12-06 14:38:38",
          clockedOut: "2016-12-06 14:38:38"
        }
      ],
      columns: [
        {
          field: "clockedIn",
          label: "In",
          centered: true
        },
        {
          field: "clockedOut",
          label: "Out",
          centered: true
        }
      ]
    };
  }
});
