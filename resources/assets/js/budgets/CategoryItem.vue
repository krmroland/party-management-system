<template>
	<a href="#" class="list-group-item list-group-item-action"
	:class="{'is-active':isActive}"
	@click.stop="activate"

	>
	{{category.name}}
</a>
</template>

<script>
export default{
	computed:{

		isActive(){
			return this.$store.state.budget.activeCategoryId === this.id;
		}
	},
	props:["category","id"],
	methods:{
		activate(){

			this.$store.commit("budget/activateCategory",this.id);

		}
	}
}
</script>

<style lang="scss" scoped>
@import "resources/assets/sass/variables";
.is-active{
	border-right:6px solid theme-color('primary');
	color:theme-color('primary');
	font-weight:bold;
}
</style>