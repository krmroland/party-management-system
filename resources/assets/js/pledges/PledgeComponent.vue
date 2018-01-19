<template>
    <div>
        <div class="d-flex justify-content-end mb-2">
            <a class="btn btn-outline-primary" href="#" @click.prevent="newPledge">
                <i class="fa fa-plus"></i>
                New Pledge
            </a>
        </div>
       <dataTable :data="pledges" title="Pledges">
           <table-col dataKey="name" label="Name" ></table-col>
           <table-col dataKey="rawPledged" label="Pledged">
           </table-col> 
           <table-col dataKey="rawPaid" label="Paid">
           </table-col> 
           <table-col dataKey="rawBalance" label="Balance" >
           </table-col> 
           <table-col label="Edit" >
                <template slot-scope="row">
                    <a href="#" @click.prevent='showDetail(row)'>
                        Details
                    </a>
                </template>
           </table-col> 
           <template slot="foot">
              <tr class="bg-primary text-white">
                <th colspan="2">Totals</th>
                <th>{{ data.pledgedTotal|currency }} /=</th>
                <th>{{ data.paidTotal|currency }} /=</th>
                <th colspan="2">
                  {{ data.balanceTotal|currency }} /=
                </th>
              </tr>
           </template>
       </dataTable>
       <modal :show="isShowingDetail" @closed="closed">
           <span slot="title" v-text="pledge.name"></span>
           <PledgeDetails 
            :data="pledge" 
            @deleted="removePledge"
            @contributionAdded="loadFreshData"
           >
           </PledgeDetails>
       </modal>
       <modal :show="isCreating" @closed="isCreating=false;">
        <span slot="title">Create A new Pledge</span>
           <CreatePledge @created="pledgeAdded"></CreatePledge>
       </modal>
       
    </div>
</template>

<script>
import PledgeDetails from "./Details";
import CreatePledge from "./CreatePledge";
export default {
  components: { PledgeDetails, CreatePledge },
  props: ["data"],
  data() {
    return {
      pledge: {},
      isShowingDetail: false,
      isCreating: false,
      pledges: this.data.items
    };
  },
  methods: {
   loadFreshData(data){
          this.pledges=data
   },
    removePledge(pledge) {
      this.isShowingDetail=false;
      this.pledge = {};
      const index = this.pledges.findIndex(item => item.id == pledge.id);
      index != -1 ? this.pledges.splice(index,1): null;
    },
    showDetail(pledge) {
      this.isShowingDetail = true;
      this.pledge = pledge;
      this.isCreating = false;
    },
    closed() {
      this.isShowingDetail = false;
      this.pledge = {};
    },
    newPledge() {
      this.isCreating = true;
      this.isShowingDetail = false;
    },
    pledgeAdded(pledge) {
      this.isCreating = false;
      this.isShowingDetail = false;
      this.pledges.push(pledge);
      flash.success("Pledge was added success fully");
    }
  }
};
</script>

<style>

</style>