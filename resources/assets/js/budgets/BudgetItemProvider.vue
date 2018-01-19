<template>
   <div class="card">
    <h3 class="text-center text-primary mt-2" v-text="providerTitle"></h3>
    <div 
        class="alert alert-secondary m-0 d-flex justify-content-between align-items-center " 
        v-if="!hasProvider && !isAddingProvider">
        No {{ providerTitle }} is associated to this item
        <button 
            class="btn btn-outline-secondary btn-sm"
            @click.prevent="isAddingProvider=true;isPaying=false"
        >
            <i class="fa fa-user-plus"></i>
            New {{ providerTitle }}
        </button>
    </div>
  <div v-if="hasProvider" class="shadowed">
   <div class=" d-flex justify-content-between align-items-center provider" >
        <icon-boy></icon-boy>
        <h3>{{ provider.name }}</h3>
        <h5>
            <i class="fa fa-phone text-muted"></i>
            {{ provider.contact }}
        </h5>
        <h5>
             <em class="smal h6">(Expected)</em>
            {{ provider.exactAmount|currency }}
        </h5>
        <h5>
             <em class="smal h6">(Paid)</em>
            {{ provider.paid |currency}}
        </h5>
        <h5>
             <em class="smal h6">(Bal)</em>
            {{ provider.balance|currency }}
        </h5>
      

        <div class="btn-group">
          <a
             href="#" @click.prevent="isPaying=true; isAddingProvider=false"
             class="btn btn-outline-secondary"
             title="Make A payment">
            <i class="fa fa-paypal"></i>
            Make A Payment
          </a>
        </div>
   </div>
   <table class="table table-bordered table-sm" v-if="hasPayments">
     <thead>
       <tr>
        <th></th>
         <th>Date</th>
         <th>Amount</th>
         <th>Description</th>
       </tr>
     </thead>
     <tbody>
       <tr v-for="payment,index in provider.payments">
        <td>{{ index+1 }}.</td>
         <td>{{ payment.date }}</td>
         <td>{{ payment.amount|currency }}</td>
         <td>{{ payment.description }}</td>
       </tr>
     </tbody>
   </table>
   <div class="alert alert-info" v-else>
     No Payments for this {{ providerTitle }} have been made yet !
   </div>
 </div>
   <BudgetItemProviderPayment 
    v-if="isPaying"
    :provider="provider"
    @done="reset"
   >
     
   </BudgetItemProviderPayment>
   <BudgetItemAddProvider 
    v-if="isAddingProvider"
    @done="reset"
   >
   </BudgetItemAddProvider>
       <p class="h4 small p-2 mt-2">
            Note: Its not a must for all items to have providers
       </p>
   </div>
</template>

<script>
import BudgetItemAddProvider from "./BudgetItemAddProvider";
import BudgetItemProviderPayment from "./BudgetItemProviderPayment";

export default {
  components: { BudgetItemAddProvider, BudgetItemProviderPayment },
  props: ["providerTitle"],

  data() {
    return {
      isAddingProvider: false,
      isPaying: false
    };
  },
  computed: {
    hasPayments() {
      const payments = this.provider.payments;
      return payments && payments.length > 0;
    },
    provider() {
      return this.activeItem.provider;
    },
    hasProvider() {
      return !!(this.provider && this.provider instanceof Object);
    },
    activeItem() {
      return this.$store.getters["budget/activeItem"];
    },
    profileUrl() {
      return `/providers/${this.providerId}`;
    },
    providerId() {
      return this.hasProvider ? this.provider.id : null;
    }
  },
  methods: {
    reset() {
      this.isPaying = false;
      this.isAddingProvider = false;
    }
  }
};
</script>

<style scoped lang="scss">
@import "resources/assets/sass/variables";
    .provider{
        border-left:6px solid theme-color('primary');
    }
</style>