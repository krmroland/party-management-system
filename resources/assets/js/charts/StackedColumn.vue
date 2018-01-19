<template>
    <div class="img-fluid">
        
    </div>
</template>

<script>
export default {
    props: {
        title: {default:''},
        series: { default: () => [] },
        categories: { default: () => [] },
        yAxis:{}
    },
    mounted() {
        Highcharts.chart(this.$el, {
            chart: {
                type: "column"
            },
            title: {
                text: this.title
            },
            xAxis: {
                categories: this.categories
            },
            yAxis: {
                min: 0,
                title: {
                    text:this.yAxis
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: "bold",
                        color:
                            (Highcharts.theme && Highcharts.theme.textColor) ||
                            "gray"
                    }
                }
            },
            legend: {
                align: "right",
                x: -30,
                verticalAlign: "top",
                y: 25,
                floating: true,
                backgroundColor:
                    (Highcharts.theme && Highcharts.theme.background2) ||
                    "white",
                borderColor: "#CCC",
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                headerFormat: "<b>{point.x}</b><br/>",
                pointFormat:
                    "{series.name}: {point.y}<br/>Total: {point.stackTotal}"
            },
            plotOptions: {
                column: {
                    stacking: "normal",
                    dataLabels: {
                        enabled: true,
                        color:
                            (Highcharts.theme &&
                                Highcharts.theme.dataLabelsColor) ||
                            "white"
                    }
                }
            },
            series: this.series
        });
    }
};
</script>
