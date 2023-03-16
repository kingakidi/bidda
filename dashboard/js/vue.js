const { createApp } = Vue;

createApp({
  data() {
    return {
      message: "Hello Vue!",
    };
  },

  methods: {
    testVue() {
      console.log("working");
    },
  },

  mounted() {
    this.testVue();
  },
}).mount("#wrapper");
