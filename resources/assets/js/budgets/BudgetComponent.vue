<template>	
	<div class="row root">
		<div class="col-md-3">
			<Categories></Categories>
		</div>
		<div class="col-md-9">
			<BudgetTable></BudgetTable>
		</div>
		
	</div>
</template>

<script>
import Categories from "./Categories";
import BudgetTable from "./BudgetTable";

	export default{
		
		components:{Categories,BudgetTable},
		mounted(){
			this.$store.commit("budget/load",this.data);
		},

		props:['data']
	}
</script>

<style scoped>
	.root{
		position: relative;
			}
</style>