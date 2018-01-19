import "./bootstrap";
import store from "./store";

import helpers from "./helpers";
import "./charts";

import "./components";

import "./icons";

new Vue({
    el: "#app",
    store,
    mixins: [helpers]
});

autosize(document.querySelectorAll("textarea"));

const links = document.querySelectorAll(".navbar .nav-link");

const cleanLink = function cleanLinkFunction(link) {
    return link.replace(/^\//, "");
};
const href = cleanLink(location.pathname);

links.forEach(link => {
    href.includes(cleanLink(link.pathname))
        ? link.classList.add("active")
        : null;
});
