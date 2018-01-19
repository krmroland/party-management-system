<template>
  <div>
    <DashboardSection>
     <h4> 
       Expenditure
     </h4>
     <h5>
      ( Total):<strong>{{ data.total|currency }}</strong> /= 
    </h5>

    <div>
      <a href="/expenditures" class="btn btn-primary">
        <i class="fa fa-info"></i>
        Details
      </a>
    </div>
  </DashboardSection>
  <div class="card-deck container-fluid">
   <data-table 
   :data="data.tableData"
   title="Expenditure distribution Table" >
   <table-col 
   data-key="label" 
   label="Section"
   ></table-col>
   <table-col 
   data-key="total" 
   label="Total"
   data-type="currency"
   ></table-col>
   <table-col 
   data-key="item_count" 
   label="Item Count"
   data-type="currency"
   ></table-col>
 </data-table>
 <div class="card">
   <div class="card-body">
     <PieChart :series="data.charts.pie" title="Expenditure Distribution"></PieChart>
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
