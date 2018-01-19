<template>
      <form method="POST" @submit.prevent="submit">
          <div class="form-group" v-if="bioData">
              <label for="">Persons Details</label>
              <div class="input-group">
                  <input type="text" class="form-control" v-model="name" placeholder="Name">
                  <input type="text" class="form-control" v-model="contact" placeholder="Contact">
              </div>
          </div>
          <div class="form-group">
              <label for="">Pledged {{ type }}</label>
              <div class="input-group" >
                  <input 
                      :type="inputType" 
                      class="form-control" 
                      v-model="rawValue" 
                      :Placeholder="pledgePlaceHolder"
                  > 
                  <input 
                    :type="inputType" 
                     class="form-control"
                     v-model="paid" 
                     :Placeholder="paidPlaceHolder"
                  > 
                  <input
                   type="number" 
                   class="form-control" 
                   placeholder="The unit cost for each item" 
                   v-if="!isCash"
                   v-model="unitCost"
                   >
               </div>
           </div>

           <div class="form-group">
               <button class="btn btn-primary">
                  <span class="fa fa-save"></span>
                  Save Pledge
               </button>
           </div>

   </form>
</template>

<script>
export default {
  props: { isCash: { default: false }, bioData: { default: true } },
  data() {
    return {
      name: "",
      contact: "",
      rawValue: "",
      paid: "",
      unitCost: ""
    };
  },
  methods: {
    submit() {
      this.$emit("submitting", this.submitData());
    },
    submitData() {
      let data = {
        isCash: this.isCash,
        units: this.units,
        ...this.$data
      };
      data["qty"] = Number.parseInt(this.rawValue);
      data["unitCost"] = this.isCash ? 1 : this.unitCost;
      return data;
    }
  },
  computed: {
    inputType() {
      return this.isCash ? "number" : "text";
    },
    pledgePlaceHolder() {
      return this.isCash
        ? "Ammount Pledged"
        : "Items Pledged with units eg 2 cows";
    },
    paidPlaceHolder() {
      return this.isCash ? "Cash Paid Instantly" : "Items brought on spot";
    },
    units() {
      return this.isCash ? "shs" : this.rawValue.replace(/^\d+/, "").trim();
    },
    type() {
      return this.isChecked ? "Cash" : "Items";
    }
  }
};
</script>

<style>

</style>