<template>
    <div class="shadowed">
        <h5 class="text-primary text-center">Revise Budget</h5>
        <div class="form-group">
            <label>Description for Review</label>
            <TextAreaComponent :value.sync="description"></TextAreaComponent>
        </div>
        <BudgetForm  
            @submitting="review"
            :fields="activeItem" 
            buttonText="Revise" 
            icon="fa-edit" 
            :appendToInput="false"
            :disableNameField="true"
        >
            <DateComponent name="reviewed_at" :value.sync="reviewed_at"></DateComponent>
        </BudgetForm> 

       
        
    </div>
</template>

<script>
import BudgetForm from "./BudgetForm";
export default {
    components: { BudgetForm },
    data() {
        return {
            description: "",
            reviewed_at: ""
        };
    },
    computed: {
        url() {
            return `/budget-items/${this.activeItem.id}/reviews`;
        },
        activeItem(){
          return this.$store.getters['budget/activeItem']
        }
    },
    methods: {
        payload(item) {
            return {
                description: this.description,
                reviewed_at: this.reviewed_at,
                ...item
            };
        },
        review(item) {
            this.errors = false;
            axios
                .post(this.url, this.payload(item))
                .then(({ data }) => {
                    this.$store.commit("budget/load",data);
                    flash.success("The review was successful");
                    this.$emit("done");
                })
                .catch(errors => {
                    console.log(errors)
                    flash.errors(errors.response.data.errors)
                });
        }
    }
};
</script>

