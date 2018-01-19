<template>
	<div>
		<div class="d-flex justify-content-between p-2 align-items-center">
			<h4 class="text-center text-primary p-4">{{ heading }}</h4>
			<div v-if="!allIsSelected" class="btn-group">
				<button class="btn btn-outline-primary" 
					v-if="!isAdding"
					@click="isAdding=true">
					<i class="fa fa-plus"></i>
					Add Item to category
				</button>
				<button 
					class="btn btn-outline-secondary"
					@click.prevent="removeCategory"
					>
					<i class="fa fa-trash"></i>
				</button>
			</div>
		</div>
		
		<div v-if="!allIsSelected" class="">
			<modal :show="isAdding" @closed="isAdding=false">
				<span slot="title">
					Add A New Item To the 
						<strong class="text-primary h3">
							{{ activeCategory.name|capitalize}}
					    </strong>
					category
				</span>
				<div class="shadowed">
					<BudgetForm @submitting="save"></BudgetForm>
				</div>
				
			</modal>
		</div>
	</div>

	
</template>

<script>
import BudgetForm from "./BudgetForm";
export default {
	components: { BudgetForm },
	props: ["allIsSelected"],
	data() {
		return {
			isAdding: false
		};
	},
	computed: {
		activeId() {
			return this.$store.state.budget.activeCategoryId;
		},

		heading() {
			return this.$store.getters["budget/heading"];
		},
		activeCategory(){
			return this.$store.getters['budget/activeCategory'];
		}
	},
	methods: {
		removeCategory() {
			flash
				.confirm("The category with all its data will be erased")
				.then(confirmed => {
					axios
						.delete(`/budget-categories/${this.activeId}`)
						.then(({ data }) => {
							this.$store.commit("budget/activateCategory", -1);
							this.$store.commit("budget/load", data);
							flash.success("category was removed");
						});
				});
		},
		save(data) {
			data.budget_category_id = this.$store.getters[
				"budget/activeCategoryId"
			];

			axios
				.post("/budget-items", data)
				.then(({ data }) => {
					flash.success("item added successfully");
					this.isAdding = false;
					this.$store.commit("budget/addItem", data);
				})
				.catch(error => {
					flash.errors(error.response.data.errors);
				});
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