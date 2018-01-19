<template>
 <div class="dashboard">
   <OverFlow :show="!isReady" text="Compiling Data"></OverFlow>
   <div v-if="isReady">
    <div class="d-flex justify-content-between container-fluid">
      <h1 class="text-center display-4 text-primary">
        Statistical Summaries</h1>
        <GeneratePdf></GeneratePdf>
       
    </div>
   
      <BudgetSummary
        :data="data.budget"
      ></BudgetSummary>

       <PledgesSummary 
        :data="data.pledges">  
       </PledgesSummary>
       <!-- providers summary -->
       <ProvidersSummary
        :data="data.providers"
       >
       </ProvidersSummary>
       <ExpendituresSummary
        :data="data.expenditures"
        ></ExpendituresSummary>
        <CardsSummary :data="data.cards"></CardsSummary>
   </div>
 </div>
</template>

<script>
import ExpendituresSummary from "./ExpendituresSummary";
import PledgesSummary from "./PledgesSummary";
import BudgetSummary from "./BudgetSummary";
import ProvidersSummary from "./ProvidersSummary";
import CardsSummary from "./CardsSummary";
import GeneratePdf from "./GeneratePdf";
export default {
  components: {
    ExpendituresSummary,
    PledgesSummary,
    BudgetSummary,
    ProvidersSummary,
    CardsSummary,
    GeneratePdf
  },
  mounted() {
    axios
      .get("/api/dashboard")
      .then(({ data }) => {
        this.data = data;
        this.isReady = true;
      })
      .catch(errros => {
        this.isReady = true;
        flash.error(" Something went wrong");
        console.log(errors);
      });
  },
  data() {
    return {
      isReady: false,
      data: {}
    };
  }
};
</script>

<style>
  body{
    background-color: #F4F7FA !important;
  }
</style>