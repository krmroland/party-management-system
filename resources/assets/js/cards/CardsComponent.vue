<template>
    <div>
        <div class="d-flex justify-content-end mb-2">
            <a class="btn btn-outline-primary" href="#" @click.prevent="isCreating=true">
                <i class="fa fa-plus"></i>
                Give New Card
            </a>
        </div>
       <dataTable :data="cards" title="Cards That Have Been distrubuted so far">\
         <table-col dataKey="issued_on" label="Issued On" ></table-col>
         <table-col dataKey="fullName" label="Name" ></table-col>
         <table-col dataKey="issued_by" label="Issued By" ></table-col>
         <table-col label="Remove" >
              <template slot-scope="row">
                  <a href="#" @click.prevent='deleteCard(row)'>
                      Delete
                  </a>
              </template>
         </table-col>
        </dataTable>
       <modal :show="isCreating" @closed="isCreating=false;">
        <span slot="title">Issue A new Card</span>
           <CardCreate @created="cardCreated" :data="data"></CardCreate>
       </modal>
       
    </div>
</template>

<script>
import CardCreate from "./CardCreate";

export default {
    props: ["data"],
    components: { CardCreate },
    data() {
        return {
            cards: this.data.cards,
            issuers: this.data.issuers,
            initials: this.data.initials,
            isCreating: false
        };
    },
    methods: {
        cardCreated(card) {
            this.cards.push(card);
            this.isCreating = false;
            flash.success("Card was created successful");
        },
        deleteCard(card) {
            flash.confirm("This Card will be deleted ").then(confirmed => {
                axios
                    .delete(`/cards/${card.id}`)
                    .then(({data}) => {
                        flash.success("Card was erased successfully");
                        this.cards = data;
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