<template>
	<div class="p-1 root">
			<AddBudgetItem :inAllMode="inAllMode">
				
			</AddBudgetItem>
		<table class="table table-bordered  table-sm">
			<thead>
				<tr>
					<th>No</th>
					<th>ITEM</th>
					<th>QTY</th>
					<th>UNIT COST</th>
					<th>TOTAL</th>
					<th>REMARKS</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="category,index in categories">
					<tr class="header">
						<th class="text-center">{{String.fromCharCode(index+65)}}.</th>
						<th colspan="5">{{category.name}}</th>
					</tr>
					<tr v-for="item,index in category.items">
						<td>{{index++}}</td>
						<td>{{item.name}}</td>
						<td>{{item.qty}}</td>
						<td>{{item.unitCost}}</td>
						<td>{{item.total}}</td>
						<td>{{item.isCovered?'Covered':''}}</td>
					</tr>
				</template>
			
			</tbody>
		</table>
	</div>

</template>

<script>
import AddBudgetItem from "./AddBudgetItem";

	export default
	{
		components:{AddBudgetItem},

		computed:{
			categories(){
				
				return this.$store.getters.budgetCategories;

			},
			inAllMode(){
				return this.$store.state.activeBudgetCategogryId===-1;
			}
		}
	}
</script>

<style lang="scss" scoped>
@import "resources/assets/sass/variables";
	tr.header{
		 background-color: $table-accent-bg;
	}
	.root{
		display: fixed;
		height:80vh;
		overflow-y: scroll;

		

	}
</style>