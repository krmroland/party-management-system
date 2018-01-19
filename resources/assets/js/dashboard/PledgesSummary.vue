<template>
    <div>
        <DashboardSection>
            <h4>
                Contributions
            </h4>
            <h5>
                (Total) :
                <strong>{{ summary.pledged|currency }}</strong>
            </h5>
            <h5>
               ( Paid ):
                <strong>{{ summary.paid|currency }}</strong>
            </h5>
            <h5>
              ( Balance):
                <strong>{{ summary.balance|currency }}</strong>
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
             <data-table :data="data.tableData">
                 <table-col data-key="units" label="Category"></table-col>
                 <table-col 
                 data-key="pledged" 
                 label="Pledged"
                 data-type="currency"
                 >
             </table-col>
             <table-col 
             data-key="paid" 
             label="Paid"
             data-type="currency"
             >
         </table-col>
         <table-col 
         data-key="balance" 
         label="Balance"
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
    title="Percentage Pledge Contributions">
</PieChart>
</div>
</div>
</div>
<div class="card">
 <div class="card-body">
     <StackedColumn
     title="Pledge Contributions"
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