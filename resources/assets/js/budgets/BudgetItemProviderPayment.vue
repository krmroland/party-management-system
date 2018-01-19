<template>
    <div class="card mt-2">
        <div class="card-body">
            <h5 class="card-title">Make  A New Payment</h5>
            <form action="#" method="post" @submit.prevent="submit" v-if="shouldPay">
                <div class="form-group">
                    <div class="input-group">
                        <DateComponent :value.sync="date"></DateComponent>
                        <input type="text" class="form-control" 
                         :value="amount" 
                         @input="updateAmount($event.target.value)"
                         ref="amount"
                         placeholder="Amount Paid"
                         >
                        <button class="btn btn-primary">
                            <i class="fa fa-paypal"></i>
                            Proceed
                        </button>
                    </div>
                </div>
            </form>
            <div class="alert alert-danger" v-else>
                All the money has been paid

                <a class="close" href="#" @click="$emit('done')">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    props: [ "provider"],
    data() {
        return {
            date: "",
            amount: this.provider.balance * -1
        };
    },
    computed: {
        url() {
            return `/providers/${this.provider.id}/payments`;
        },
        shouldPay(){
            return this.provider.balance<0;
        },
        maximumPay(){
            return Math.abs(this.provider.balance);
        }
    },
    methods: {
        updateAmount(amount){
            amount=Number(amount)
            if (+amount>this.maximumPay) {
                this.amount=this.maximumPay;
                this.$refs.amount.value=this.amount
                return ;
            }
            this.amount=amount;
        },
        submit() {
            let data=this.$data
             data['budget_item_id']=this.$store.state.budget.activeItemId

             console.dir({data})
            
            axios
                .post(this.url,data)
                .then(({ data }) => {
                    this.$store.commit("budget/load", data);
                    flash.success("Payment was successful");
                    this.$emit("done")
                })
                .catch(errors => {
                    flash.errors(errors.response.data.errors);
                });
        }
    }
};
</script>

<style>

</style>