<template>	
	<div class="row root">
		<div class="col-md-3">
			<BudgetCategories></BudgetCategories>
		</div>
		<div class="col-md-9">
			<BudgetTable></BudgetTable>
		</div>
		
	</div>
</template>

<script>
import BudgetCategories from "./BudgetCategories";
import BudgetTable from "./BudgetTable";

	export default{
		
		components:{BudgetCategories,BudgetTable},
		mounted(){
			this.$store.commit("loadBudget",this.data);
		},

		props:['data']
	}
</script>

<style scoped>
	.root{
		position: relative;
	}
</style>