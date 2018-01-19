<template>
    <input type="text" class="form-control" :name="name">
</template>

<script>
import flatpickr from "flatpickr";

export default {
    props: {
        value: {},
        format:{default:'Y-m-d'},
        name: { default: "date" }
    },
    mounted() {
   
        flatpickr(this.$el, {
            maxDate: new Date(),
            dateFormat: this.format,
            defaultDate:this.value?this.value:'today',
            onChange: (selectedDates, dateStr, instance) => {
                 this.$emit("update:value", dateStr)
            },
            //we will make the initial dispatch to update the default value
            onReady:(selectedDates,dateStr,instance)=>{
                 this.$emit("update:value",dateStr);
            }
        });
    }
};
</script>

<style lang='stylus'>
$primary=#2a2652;
$calendarBackground = #fff
$calendarBorderColor = alpha(#484848, 0.2)

$monthForeground = #fff
$monthBackground =$primary

$weekdaysBackground =$primary

$dayForeground = #484848
$dayHoverBackground = #e2e2e2

$todayColor = #bbb

$selectedDayBackground =$primary
$selectedDayForeground = #fff

$noCalendarBorder = true

@require "~flatpickr/src/style/flatpickr";
</style>