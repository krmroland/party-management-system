<template>
    <div class="shadowed">
      <h5 class="card-title text-center">Item Details</h5>
       <table class="table table-bordered table-sm"  >
           <thead>
               <tr>
                   <th>Name</th>
                   <th>Qty</th>
                   <th>Unit Cost</th>
                   <th>Total</th>
                   <th>Covered</th>
               </tr>
           </thead>
           <tbody>
               <td>{{ activeItem.name }}</td>
               <td>{{activeItem.qty|currency}} {{ activeItem.qtyUnits }}</td>
               <td>{{ activeItem.unitCost|currency }}</td>
               <td>{{ activeItem.total|currency }}</td>
               <td class="text-center">
                 {{ activeItem.isCovered?'Yes':'No' }}
               </td>
           </tbody>
       </table>
       <Reviews></Reviews>
  </div>
</template>

<script>
import Reviews from "./Reviews";
export default {
    components:{Reviews},

    computed: {
        activeItem(){
          return this.$store.getters['budget/activeItem']
        }
    }
};
</script>

<style>

</style>