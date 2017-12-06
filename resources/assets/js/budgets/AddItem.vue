<template>
	<div>
		<div class="d-flex justify-content-between p-2 align-items-center">
			<h4 class="text-center text-primary p-4">{{ heading }}</h4>
			<div v-if="!allIsSelected">
				<button class="btn btn-primary" 
					v-if="!isAdding"
					@click="isAdding=true">
					<i class="fa fa-plus"></i>
					Add Item to category
				</button>
			</div>
		</div>
		
		<div v-if="!allIsSelected" class="">
			<div class="card mb-2 adding-card" v-if="isAdding">
				<a class="close" href="#" @click.stop="isAdding=false">
					<i class="fa fa-times fl-lg text-secondary"></i>
				</a>
				<div class="card-body">
					<h4 class="text-center">Add A New Item To The Budget</h4>
					<form>
						<div class="input-group">
							<!-- name -->
							<input type="text" class="form-control col-md-4" placeholder="Item Name" v-model="name">
							<!-- quantity -->
							<input type="text" class="form-control col-md-2" 
							placeholder="Quantity" :value="rawQty" 
							@change="setQty($event.target.value)">
							<!-- unitCost -->
							<input type="text" class="form-control col-md-2" 
							placeholder="Unit Cost" :value="unitCost" 
							@change="setUnitCost($event.target.value)">
							<!-- total -->
							<input type="text" class="form-control col-md-2" 
							placeholder="Total" :value="total"
							 @change="setTotal($event.target.value)">
							<!-- save button -->
							<button class="btn btn-primary col-md-2 btn-block"
									@click.stop="save">
								<i class="fa fa-save"></i>
								Save
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	
</template>

<script>
export default {
	props: ["allIsSelected"],
	data() {
		return {
			name: "",
			qty: 0,
			unitCost: "",
			qtyUnits: "",
			total: "",
			isAdding: false
		};
	},
	computed: {
		rawQty() {
			return [this.qty, this.qtyUnits].filter(el => el).join(" ");
		},
		activeId() {
			return this.$store.state.budget.activeId;
		},

		heading() {
			return this.$store.getters["budget/heading"];
		}
	},
	watch: {
		activeId() {
			this.reset();
		}
	},

	methods: {
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
		},
		save() {
			let data = this.$data;
			data.name = data.name.toLowerCase();
			data.budget_category_id = this.$store.getters[
				"budget/activeCategoryId"
			];

			axios
				.post("/budget-items", data)
				.then(({ data }) => {
					flash.success("item added successfully");
					this.reset();
					this.$store.commit("budget/addItem", data);
				})
				.catch(error => {
					this.handleErros(error.response.data);
				});
		},
		reset() {
			for (let name in this.$data) {
				this[name] = "";
			}
		},
		handleErros({ errors }) {
			let message = "<ul class='list-group'>";
			for (let name in errors) {
				errors[name].forEach(error => {
					message += `<li class='list-group-item'>${error}</li>`;
				});
			}
			message += "</ul>";

			flash.html(message, "Opps", "error");
		}
	}
};
</script>

<style lang="scss" scoped>
	.adding-card{
		position:relative;
		a.close{
			display:flex;
			justify-content:flex-end;
			padding-right:10px;
		}
	}
</style>