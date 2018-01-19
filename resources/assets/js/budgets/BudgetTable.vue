<template>
	<div class="pt-2 root">
		<AddItem :allIsSelected="allIsSelected"></AddItem>
		<div class="table-responsive">
			<table class="table table-bordered  table-sm table-hover">
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
							<th class="text-center">{{letter(index)}}.</th>
							<th colspan="5">{{category.name}}</th>
						</tr>
						<template v-for="item,index in category.items">
							<TableRow 
								:item="item" 
								:index="index" 
								@clicked="activateItem">
							</TableRow>
						</template>
						
					</template>

				</tbody>
				<tfoot>
					<tr>
						<th class="text-right" colspan="4">Total</th>
						<th colspan="2">{{ total|currency }}</th>
					</tr>
				</tfoot>
			</table>
		
		</div>

	</div>

</template>

<script>
import AddItem from "./AddItem";
import TableRow from "./TableRow";

export default
{
	components:{AddItem,TableRow},

	methods:{
		activateItem(item){
			this.$store.commit("budget/activateItem",item.id)
		},
		itemDeleted(){	
			this.item={};
			this.isShowingDetail=false;
		},
		letter(index){
			if (index>0 && index<26) {
				return String.fromCharCode(Number(index)+64);
			}
			return index;
			
		}
	},

	computed:{
		categories(){
			return this.$store.getters["budget/selectedCategories"];
		},
		allIsSelected(){
			return this.$store.getters["budget/allIsSelected"]
		},
		total(){
			return this.$store.getters["budget/total"]
		}
	}
}
</script>

<style lang="scss" scoped>
@import "resources/assets/sass/variables";
tr.header,tfoot{
	background-color: $table-accent-bg;
}
.root{
	display: fixed;
	height:80vh;
	overflow-y: scroll;

}
</style>