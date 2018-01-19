<template>
 <form action="#" method="post" @submit.prevent="submit">
     <div class="form-group">
         <label> Expenditure Details </label>
         <div class="input-group">
             <DateComponent :value.sync="date"></DateComponent>
             <input type="text" class="form-control" v-model="amount" 
             placeholder="Amount Spent">
         </div>
    </div>

     <div class="form-group">
        <label for="">Description for expenditure</label>
         <TextAreaComponent :value.sync="description"></TextAreaComponent>
     </div>
     <div class="form-group">
        <button class="btn-primary btn">
            <i class="fa fa-save"></i>
            Make Expenditure
        </button>
      
     </div>

 </form>
</template>

<script>
export default {
    data() {
        return {
            date: "",
            amount: "",
            description:""
        };
    },
    methods: {
        submit() {
            axios
                .post("/expenditures", this.$data)
                .then(({ data }) => {
                    flash.success("Expenditure was created successfully");
                    this.$emit("created", data);
                })
                .catch(errors => {
                    console.log(errors);
                    flash.errors(errors.response.data.errors);
                });
        }
    }
};
</script>

<style>

</style>