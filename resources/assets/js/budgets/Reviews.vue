<template>
    <div class="mt-2 shadowed">
        <h4 class="text-center text-primary">
            Reviews
        </h4>
        <div class="table-responsive" v-if="showReviews">
          <table class="table table-bordered table-sm mt-1 table-hover">
             <thead>
                 <tr>
                    <th rowspan="2">#</th>
                     <th rowspan="2" >Date</th>
                     <th colspan="3" class="text-center">Before</th>
                     <th colspan="3" class="text-center right-side">After</th>
                     <th rowspan="2" class="text-center">Description</th>
                     <th rowspan="2" class="text-center"></th>
                 </tr>
                 <tr class="text-primary">
                   <td>Quantity</td>
                   <td>Unit Cost</td>
                   <td>Total</td>
                   <td class="right-side">Quantity</td>
                   <td>Unit Cost</td>
                   <td>Total</td>
                 </tr>
             </thead>
              <tbody>
                <template v-for="review,index in reviews">
                   <ReviewRow :review="review" :key="index" :index="index"></ReviewRow>
                </template>
           
              </tbody>
          </table>
        </div>
        <div class="alert alert-info" v-else>
          No Reviews Have been made to this item
        </div>
        
    </div>
</template>

<script>
import ReviewRow from "./ReviewRow";
  export default{

      components:{ReviewRow},
      computed: {
          reviews(){
            return this.$store.getters['budget/activeItem'].reviews
          },
          showReviews(){
             return this.reviews && this.reviews.length;

          }
      }
  }  
</script>

<style scoped lang='scss' children>
@import "resources/assets/sass/variables";
table tr th{
  vertical-align: middle;
}
.right-side{
  border-left:4px solid theme-color('primary');
}

</style>