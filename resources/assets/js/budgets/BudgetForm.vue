<template>
    <form @submit.prevent="submit" method="POST">
        <div class="input-group">
            <slot></slot>
            <!-- name -->
            <input type="text" class="form-control col-md-4" placeholder="Item Name" v-model="name" :disabled="disableNameField">

            <!-- type -->
            <select  class="form-control" v-model="type" placeholder="Type of item">
                <option value="">Type of item ..</option>
                <option value="good">Good</option>
                <option value="service">Service</option>
            </select>

            <!-- quantity -->
            <input type="text" class="form-control col" 
            placeholder="Quantity" :value="rawQty" 
            @change="setQty($event.target.value)">
            <!-- unitCost -->
            <input type="text" class="form-control col" 
            placeholder="Unit Cost" :value="unitCost" 
            @change="setUnitCost($event.target.value)">
            <!-- total -->
            <input type="text" class="form-control col" 
            placeholder="Total" :value="total"
             @change="setTotal($event.target.value)">
            <SaveButton
                 :icon="icon" 
                 :buttonText="buttonText" 
                 v-if="appendToInput">
            </SaveButton>
             
        </div>
        <div class="mt-3">
            <SaveButton 
                :icon="icon" 
                :buttonText="buttonText" 
                v-if="!appendToInput">
            </SaveButton>
        </div>
       
    </form>
</template>

<script>
import SaveButton from "./SaveButton";
export default {
    components:{SaveButton},
    props: {
        fields: {
            default: () => ({
                name: "",
                qty: 0,
                unitCost: "",
                qtyUnits: "",
                total: "",
                type:""
            })
        },

        errors: {
            default: false
        },
        appendToInput:{default:true},
        icon:{default:'fa-save'},
        buttonText:{default:'Save'},
        disableNameField:{default:false}
    },
    computed: {
        rawQty() {
            return [this.qty, this.qtyUnits].filter(el => el).join(" ");
        }
    },

    data() {
        return this.fields;
    },
    methods: {
        submit() {
            this.$emit("submitting", this.$data);
        },
        handleErros({ errors }) {
           flash.errors(errors);
        },
        parseQuantity(qty) {
            const matched = qty.match(/(^\d+)([\w,\s].+$)/);
            if (matched && matched.length) {
                const parts = [...matched];
                this.qtyUnits = parts[2].trim();
                return Number(parts[1]);
            }
            return 0;
        },
        setQty(qty) {
            this.qty = +qty ? qty : this.parseQuantity(qty);

            if (this.unitCost) {
                this.total = this.qty * this.unitCost;
                return;
            }

            if (this.total && qty > 0) {
                this.unitCost = this.total / this.qty;
            }
        },

        setUnitCost(unitCost) {
            this.unitCost = +unitCost ? Number(unitCost) : 0;
            if (this.qty) {
                this.total = this.qty * this.unitCost;
                return;
            }

            if (this.total && this.unitCost > 0) {
                this.qty = this.total / this.unitCost;
            }
        },

        setTotal(total) {
            this.total = +total ? Number(total) : 0;
            if (this.qty) {
                this.unitCost = this.total / this.qty;
            }

            if (this.unitCost && this.qty > 0) {
                this.qty = this.total / this.qty;
            }
        }
    },
    watch: {
        errors(errors) {
            if (errors) {
                this.handleErros(errors);
            }
        }
    }
};
</script>

<style>

</style>