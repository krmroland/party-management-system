<template>
    <div class="img-fluid"></div>
</template>

<script>
export default {
    props: {
        title: {},
        series: {
            default: ()=>[]
        }
    },
    mounted() {
        Highcharts.chart(this.$el, {
            chart: {
                type: "pie"
            },
            title: {
                text: this.title
            },
            tooltip: {
                pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>"
            },
            plotOptions: {
                series: {
                    shadow: true
                },
                pie: {
                    allowPointSelect: true,
                    cursor: "pointer",
                    dataLabels: {
                        enabled: true,
                        format: "<b>{point.name}</b>: {point.percentage:.1f} %",
                        style: {
                            color: "blue"
                        }
                    }
                }
            },
            series: [
                {
                    name: "Brands",
                    colorByPoint: true,
                    data: this.series
                }
            ]
        });
    }
};
</script>
