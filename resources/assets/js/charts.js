import Vue from "vue";
window.Highcharts = require("highcharts");

Highcharts.setOptions({
    chart: {
        spacingBottom: 0,
        spacingTop: 0,
        spacingLeft: 0,
        spacingRight: 0
    },
    colors: [
        "#fa0083",

        "#3F0091",
        "#F39C12",
        "#9B59B6",
        "#3498DB",
        "#E74C3C",
        "#E74C3C",
        "#1ABC9C",
        "#34495E"
    ],
    credits: {
        enabled: false
    }
});

Vue.component("PieChart", require("./charts/PieChart"));
Vue.component("StackedColumn", require("./charts/StackedColumn"));
