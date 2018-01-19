<template>
    <div>
        <DashboardSection>
            <h4>
                Providers
            </h4>
            <h5 v-for="count,provider in summary.count">
                {{ provider }}:
                <strong>{{count|currency }}</strong>
            </h5>
            <h5>
               ( Paid ):
                <strong>{{ summary.paid|currency }}</strong>
            </h5>
            <h5>
              ( Debt):
                <strong>{{ summary.debt|currency }}</strong>
            </h5>

            <div>
                <a href="/pledges" class="btn btn-primary">
                    <i class="fa fa-info"></i>
                    Details
                </a>
            </div>

        </DashboardSection>
        <div class="container-fluid">
            <div class="card-deck mb-2">
             <data-table :data="data.tableData" title="Providers">
                 <table-col data-key="provider_name" label="Name"></table-col>
                 <table-col 
                 data-key="total_paid" 
                 label="Paid"
                 data-type="currency"
                 >
             </table-col>
             <table-col 
             data-key="debt" 
             label="Debt"
             data-type="currency"
             >
         </table-col>
         <table-col 
         data-key="total_amount" 
         label="Total"
         data-type="currency"
         >
     </table-col>
     <template slot="foot">
         <tr>
             <th colspan="2">Totals</th>
             <th>{{ summary.pledged|currency }}</th>
             <th>{{ summary.paid|currency }}</th>
             <th>{{ summary.balance|currency }}</th>
         </tr>
     </template>
 </data-table>
 <div class="card">
   <div class="card-body">
    <PieChart
    :series="data.charts.pie" 
    title="Percentage Provider Payments">
</PieChart>
</div>
</div>
</div>
<div class="card">
 <div class="card-body">
     <StackedColumn
     title="Provider Payments Bar Graph"
     :series="column.series"
     :categories="column.categories"
     :yAxis="column.yAxis"
     >
 </StackedColumn> 
</div>
</div> 
</div>

</div>
</template>

<script>
export default{
  props:["data"],
  computed:{
    column(){
        return this.data.charts.column;
    },
    summary(){
        return this.data.summary;
    }
}
}  
</script>

<style>

</style>