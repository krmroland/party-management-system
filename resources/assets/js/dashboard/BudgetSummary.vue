<template>
    <div>
        <DashboardSection>
            <h4>Budget</h4>
            <h5>
                (Total): 
                <strong>{{ data.summary.total|currency }}</strong>
            </h5>
            <div>
                <a class="btn btn-primary" href="/budgets">
                    <i class="fa fa-info"></i>
                    Details
                </a>
            </div>
        </DashboardSection>
        <div class="container-fluid">
            <div class="card-deck">
                <data-table :data="data.tableData">
                    <table-col data-key="category" label="Category"></table-col>
                    <table-col 
                        data-key="total" 
                        label="Total"
                        data-type="currency"
                    ></table-col>
                    <template slot="foot">
                        <tr>
                            <th colspan="2" class="text-right">Total</th>
                            <th>{{ data.summary.total|currency }}</th>
                        </tr>
                    </template>
                </data-table>
                <div class="card">
                    <div class="card-body">
                        <PieChart :series="data.charts.pie.series"></PieChart>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</template>

<script>
  export default{
      props:['data']
  }  
</script>

<style>

</style>