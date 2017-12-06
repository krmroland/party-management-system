import "./bootstrap";
import store from "./store";
window.Vue = require("vue");
import helpers from "./helpers";
Vue.component("Budget", require("./budgets/BudgetComponent"));
Vue.component("modal", require("./components/modal"));
new Vue({
    el: "#app",
    store,
    mixins: [helpers]
});
