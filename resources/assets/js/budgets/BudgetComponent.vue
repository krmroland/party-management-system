<template>	
	<div class="row root">
		<div class="col-md-3">
			<Categories></Categories>
		</div>
		<div class="col-md-9">
			<BudgetTable></BudgetTable>
		</div>
		<modal :show="isShowingItem" @closed="closeAllItems">
			<span slot="title">{{ activeItem.name|capitalize }}</span>
		    <ItemDetail></ItemDetail>
		</modal>
	</div>
</template>

<script>
import Categories from "./Categories";
import BudgetTable from "./BudgetTable";
import ItemDetail from "./ItemDetail";

	export default{
		props:['data'],
		components:{Categories,BudgetTable,ItemDetail},
		mounted(){
			this.$store.commit("budget/load",this.data);
		},
		computed:{
			isShowingItem(){
				return this.$store.getters['budget/isShowingItem'];
			},
			activeItem(){
				return this.$store.getters['budget/activeItem']
			}
		},
		methods:{
			closeAllItems(){
				this.$store.commit("budget/activateItem",-1)
			}
		},

	
	}
</script>

<style scoped>
.root{
		position: relative;
}
</style>