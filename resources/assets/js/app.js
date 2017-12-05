import "./bootstrap";
import store from "./store";
window.Vue = require("vue");

Vue.component("Budget", require("./components/BudgetComponent"));

new Vue({
	el: "#app",
	store
});
