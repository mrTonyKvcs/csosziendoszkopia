window.Vue = require("vue");

Vue.component(
    "appointment-component",
    require("./components/AppointmentComponent.vue").default
);

const app = new Vue({
    el: "#admin"
});
