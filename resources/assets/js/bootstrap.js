import axios from "axios";

import vue from "vue";

import { Flash } from "./Flash";

import autosize from "autosize";

window.Vue = vue;

window.axios = axios;
window.autosize = autosize;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
}

window.flash = new Flash();
