<template>
    <div class="card">
        <div class="card-body">
            <div class="btn-group d-flex justify-content-end mb-2">
                <button class="btn btn-outline-primary"
                   @click="isCreating=!isCreating">
                    <i class="fa fa-plus"></i>
                </button>
                <button class="btn btn-outline-primary" @click.prevent="deletePledge">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
            <data-table :data="pledge.contributions" title="Contributions" v-if="!isCreating">
                <table-col dataKey="date" label="Date"></table-col>
                <table-col dataKey="rawValue" label="Paid" ></table-col>
                <template slot="foot">
                    <tr>
                        <th colspan="2" class="text-right">Totals</th>
                        <th>{{ pledge.rawPaid }}</th>
                    </tr>
                </template>

            </data-table>
           <AddContribution 
                v-if="isCreating" 
                :pledge="pledge"
                 @added="contributionAdded">
            </AddContribution>
        </div>
       
        
     
    </div>
</template>

<script>
import AddContribution from "./AddContribution";
export default {
    components:{AddContribution},
    props: ["data"],
     data(){
        return {
            isCreating:false,
            pledge:this.data
        }
    },
    computed:{
        url(){
            return `/pledges/${this.pledge.id}`;
        }
    },
    methods: {
        deletePledge() {

            flash.confirm("The Pledge and all related payments will be removed")
                .then(done=>this.proceedToDelete())

        },
        proceedToDelete() {
            axios
                .delete(this.url)
                .then(done => this.$emit("deleted", this.pledge))
                .catch(error=>{
                    flash.error("SOmething went wrong")
                });;
        },
        contributionAdded(data){
            this.isCreating=false;
            this.$emit('contributionAdded',data);
            
        }
    }
}; 
</script>
