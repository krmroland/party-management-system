<template>
    <div>
        <DashboardSection>
            <h4>Cards</h4>
            <h5>
                Total:
                <strong>{{ data.summary.total|currency }}</strong>
            </h5>
            <div>
                <a class="btn btn-primary" href="/cards">
                    <i class="fa fa-info"></i>
                    Details
                </a>
            </div>
            
        </DashboardSection>
        <div class="card containder-fluid">
            <div class="card-body">
                <PieChart
                    :series="data.charts.pie.series"
                    title="Cards Distribution"
                >
                    
                </PieChart>
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