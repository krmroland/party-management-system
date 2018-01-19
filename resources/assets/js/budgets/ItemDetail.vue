<template>
<div>
      <BudgetItemButtons 
        :url="url"
        :homeButton="!isHome"
        @changed="activeButton=$event"
        :providerTitle="providerTitle"
      ></BudgetItemButtons>
      <hr>

      <Revise 
        v-if="isRevising" 
        @done="resetButton"
      ></Revise>
      <BudgetForm 
          v-if="isEditing" 
          :fields="activeItem" 
          buttonText="Edit" 
          icon="fa-edit" 
          @submitting="updateItem"
      ></BudgetForm>
      <BudgetItemProvider 
        v-if="isShowingProvider"
        :providerTitle="providerTitle">
      </BudgetItemProvider>

       <SingleBudgetItem 
         v-if="isHome"
        ></SingleBudgetItem>
</div>

</template>

<script>
import BudgetForm from "./BudgetForm";
import Revise from "./Revise";
import BudgetItemProvider from "./BudgetItemProvider";
import SingleBudgetItem from "./SingleBudgetItem";
import BudgetItemButtons from "./BudgetItemButtons";
export default {
  components: {
    BudgetForm,
    Revise,
    SingleBudgetItem,
    BudgetItemButtons,
    BudgetItemProvider
  },
  data() {
    return {
      errors: false,
      activeButton: "home"
    };
  },
  computed: {
    activeItem(){
      return this.$store.getters['budget/activeItem']
    },
    providerTitle() {
        return this.activeItem.type === "good" ? "Supplier" : "Service Provider";
    },
    isHome() {
      return this.buttonIs("home");
    },
    isShowingProvider(){
      return this.buttonIs("serviceProvider")
    },


    isReviewing() {
      return this.buttonIs("review");
    },
    isRevising() {
      return this.buttonIs("revise");
    },
    isEditing() {
      return this.buttonIs("edit");
    },

    icon() {
      return this.activeItem.isCovered ? "fa-check" : "fa-times";
    },
    url() {
      return `/budget-items/${this.activeItem.id}`;
    }
  },
  methods: {
    buttonIs(name) {
      return this.activeButton === name;
    },
    resetButton() {
      this.activeButton = "home";
    },

    updateItem(item) {
      axios
        .put(this.url, item)
        .then(({ data }) => {
          this.resetButton();
          this.$store.commit("budget/load", data);
          flash.success("Update was successful");
        })
        .catch(errors => flash.errors(errors.response.data.errors));
    }
  }
};
</script>
<style lang="scss" scoped>
@import "resources/assets/sass/variables";
.icon{
    // width:100px;
    color:theme-color('primary');

}
</style>