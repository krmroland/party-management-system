<template>
    <div class="row">
        <div class="col-md-4 shadowed d-flex align-items-center">
         <div class="form-group mt-2">
             <label >Date</label>
             <DateComponent :value.sync="date"></DateComponent> 
             <div class="mt-5 d-flex align-items-center">
                 <span class="h5 mr-3">Items</span>
                 <switch-component :isChecked="isChecked" @changed="modeChanged">
                 </switch-component>
                 <span class="h5 ml-3">Cash</span>
             </div>

         </div>
     </div>
     <div class="col-md-8 shadowed">
      <PledgeForm :isCash="isCash" @submitting="submit"></PledgeForm>
 </div>

</div>
</template>

<script>
import PledgeForm from "./PledgeForm";
export default {
    components:{PledgeForm},
    data() {
        return {
            isChecked: true,
            date: ""
        };
    },
    methods: {
        submit(data) {
            data.date=this.date;
            axios
                .post("/pledges", data)
                .then(({ data }) => {
                    this.$emit('created',data);
                })
                .catch(error => {
                    console.log(error);
                    flash.errors(error.response.data.errors);
                });
        },
        modeChanged(newMode) {
            this.isChecked = newMode;
        }
    },
    computed: {
    
        isCash() {
            return this.isChecked;
        }
    }
};
</script>
