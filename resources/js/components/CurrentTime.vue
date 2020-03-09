<template>
  <div>
    <!-- DD-MM  H:m -->
    {{
      paddedDay +
        currentTime.format("-{iso-month} {hour}:{minute-pad}")
    }}
  </div>
</template>

<script>
import spacetime from "spacetime";

export default {
  name: "CurrentTime",
  data() {
    return {
      currentTime: ""
    };
  },
  computed: {
    paddedDay() {
      var len = String(this.currentTime.date()).length;
      var date = this.currentTime.date();
      return len === 2 ? date : "0" + date;
    }
  },
  beforeDestroy() {
    clearInterval(this.$intervalID);
  },
  created() {
    var getTime = () => (this.currentTime = spacetime.now());
    this.$intervalID = setInterval(getTime, 1000);
    getTime();
  }
};
</script>

<style scoped lang="scss"></style>
