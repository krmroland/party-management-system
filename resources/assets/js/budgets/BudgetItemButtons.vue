<template>
    <div class="d-flex justify-content-between mb-2">
        <div class="d-flex justify-content-center align-items-center">
            <switch-component :isChecked="activeItem.isCovered" @changed="toggleIsCovered">
            </switch-component>
            <span class="ml-4">Is Covered</span>
        </div>
       
       <div>
           <div class="btn-group">
            <button 
                v-if="homeButton"
                title="home"
                class="btn btn-outline-primary"
                @click.prevent="$emit('changed','home')">
                <i class="fa fa-home"></i>
            </button>
            <button 
               class="btn btn-outline-primary" 
               title="Provider" 
               @click="$emit('changed','serviceProvider')"
               
               >
                <i class="fa fa-user"></i>
                <span v-text="providerTitle"></span>
            </button>
            <button 
               class="btn btn-outline-primary" 
               title="Revise activeItem" 
               @click="$emit('changed','revise')">
               <i class="fa fa-pencil"></i>
                Revise
            </button>
               <button 
                  class="btn btn-outline-primary" 
                  title="edit" 
                  @click="$emit('changed','edit')">
                   <i class="fa fa-edit"></i>
               </button>
               <button class="btn btn-outline-secondary" title="delete" 
                 @click="deleteItem">
                   <i class="fa fa-trash"></i>
               </button>
           </div>
       </div>
</div>
</template>

<script>
export default {
    props: ["url","homeButton","providerTitle"],
    computed:{
      activeItem(){
        return this.$store.getters['budget/activeItem']
      }
    },
    methods: {
        toggleIsCovered(isCovered) {
            let payload = this.activeItem;
            payload.isCovered = isCovered;
            axios
                .put(this.url, payload)
                .then(({ data }) => {
                    this.$store.commit("budget/load", data);
                   // this.$set(this.activeItem, "isCovered", isCovered);
                    flash.success("Done");
                })
                .catch(error => {
                    flash.error("something went wrong");
                    this.$set(this.item, "isCovered", !isCovered);
                });
        },
        deleteItem() {
            flash
                .confirm("The budget Item and all its reviews will be deleted")
                .then(done => this.deleteRequest());
        },
        deleteRequest() {
            axios.delete(this.url).then(({ data }) => {
                this.$store.commit("budget/load", data);
                flash.success("Item removed successfully");
                this.$store.commit("budget/activateItem",-1);
            });
        }
    }
};
</script>

<style>

</style>