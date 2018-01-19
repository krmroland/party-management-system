<template>
  <div class="card" v-else>
    <div class="card-body">
        <h5 class="card-title">Add A payment to Pledge</h5>
        <form method="post" @submit.prevent="submit">
            <div class="input-group">
               <DateComponent :value.sync="date"></DateComponent>
               <input type="text"
                :placeholder="placeholder" class="form-control" v-model="paid">
                <button class="btn btn-primary">
                    <i class="fa fa-check"></i>
                    Save Contribution
                </button>
               
            </div>
           
        </form>
    </div>
  </div>
</template>

<script>


export default {
    props:['pledge'],
     data(){
        return {
            date:'',
            paid:""
        }
    },
    computed:{
        placeholder(){
           return `Remaining Balance (${this.pledge.balanceDescription})`;
        },
        url(){
            return `/pledges/${this.pledge.id}/contributions`
        }
    },
    methods:{
        submit(){
           let data={date:this.date,paid:this.paid}
            axios.post(this.url,data).then(({data})=>{
                this.$emit("added",data)
            }).catch(error=>{
                flash.errors(error.response.data.errors)
            })
        }
    }

};
</script>

<style>

</style>