<template>
   <tr>
    <td v-text="numbering"></td>
     <td>{{ review.reviewed_at }}</td>
     <td>{{ retriveKey('before.qty')}}</td>
     <td>{{ retriveKey('before.unitCost')}}</td>
     <td>{{ retriveKey('before.total')}}</td>
     <td class="right-side">{{ retriveKey('after.qty')}}</td>
     <td>{{ retriveKey('after.unitCost')}}</td>
     <td>{{ retriveKey('after.total')}}</td>
     <td class="small">{{ review.description}}</td>
     <td class="p-0 m-0">
       <button 
            class="btn btn-outline-secondary btn-sm m-0 btn-block"
            title="Delete Review"
           @click.prevent="deleteReview"
        >
          <i class="fa fa-trash"></i>
       </button>
     </td>

   </tr>
</template>

<script>
import get from "lodash/get";

export default {
    props: ["review","index"],
    computed: {
        url() {
            return `/budget-items/${this.review.budget_item_id}/reviews/${this.review.id}`;
        },
        numbering(){
          return this.index+1+'.';
        }
    },
    methods: {
      retriveKey(key){
        const value= get(this.review,key,"--")
        if (+value) {
          return this.$options.filters.currency(value)
        }
        return value;
      },
        deleteReview() {
            flash
                .confirm("The review will be removed")
                .then(confirmed => this.proceedToDelete());
        },
        proceedToDelete() {
         
            axios
                .delete(this.url)
                .then(({ data }) => {
                    this.$store.commit("budget/load",data);
                    flash.success("Review was done");
                })
                .catch(error => {
                    console.log(error)
                    flash.error("SOmething went wrong")
                });
        }
    }
};
</script>

<style scoped lang="scss">
//todo: learn how to pass scoped css to children and delete this code
@import "resources/assets/sass/variables";
.right-side{
  border-left:4px solid theme-color('primary');
}

</style>