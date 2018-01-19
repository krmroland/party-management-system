<template>
    <div>
        <div class="d-flex justify-content-end mb-2">
            <a class="btn btn-outline-primary" href="#" @click.prevent="isCreating=true">
                <i class="fa fa-plus"></i>
              Record New Expenditure
            </a>
        </div>
       <dataTable :data="expenditures" title="Expenditures That Have Been Made So Far">
         <table-col dataKey="date" label="Date" ></table-col>
         <table-col dataKey="amount" label="amount" data-type="currency">
         </table-col>
         <table-col dataKey="description" label="description"></table-col>

         <table-col label="Remove" >
              <template slot-scope="row">
                  <a href="#" @click.prevent='deleteExpenditure(row)'>
                      Delete
                  </a>
              </template>
         </table-col>
         <template slot="foot">
           <tr>
             <th colspan="2" class="text-right">Totals</th>
             <th colspan="3">{{ totalExpenditure|currency }}</th>
           </tr>
         </template>
        </dataTable>
       <modal :show="isCreating" @closed="isCreating=false;">
        <span slot="title">Record A new Expenditure</span>
           <ExpenditureCreate @created="expenditureCreated" :data="data">
             <PieChart></PieChart>
           </ExpenditureCreate>
       </modal>
       
    </div>
</template>

<script>
import ExpenditureCreate from "./ExpenditureCreate";

export default {
  props: ["data"],
  components: { ExpenditureCreate },
  data() {
    return {
      expenditures: this.data,
      isCreating: false
    };
  },
  computed: {
    totalExpenditure() {
      return this.expenditures.reduce((prev, next) => {
        return prev + Number(next.amount);
      }, 0);
    }
  },
  methods: {
    expenditureCreated(expenditure) {
      this.expenditures.push(expenditure);
      this.isCreating = false;
      flash.success("expenditures was created successful");
    },
    deleteExpenditure(expenditure) {
      flash.confirm("This expenditure will be deleted ").then(confirmed => {
        axios
          .delete(`/expenditures/${expenditure.id}`)
          .then(({ data }) => {
            flash.success("expenditure was erased successfully");
            const index = this.expenditures.findIndex(
              item => item.id == expenditure.id
            );
            index != -1 ? this.expenditures.splice(index, 1) : null;
          })
          .catch(errors => {
            console.log(errors);
            flash.errors(errors.response.data.errors);
          });
      });
    }
  }
};
</script>

<style>

</style>