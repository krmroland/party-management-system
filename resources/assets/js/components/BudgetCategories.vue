<template>
    <div class="root">
        <h5 class="text-center">Available Categories</h5>
        <AddCategory></AddCategory>
        <div class="list-group">
            <CategoryItem :category="{isActive:false, name:'All'}" :id="-1">
            </CategoryItem>
            <CategoryItem v-for="category ,index in categories" 
            :key="index" :category="category" :id="index">
                
            </CategoryItem>
        </div>
    </div>
</template>
<script>
import AddCategory from "./AddCategory";
import CategoryItem from "./CategoryItem";
export default {
    components:{AddCategory,CategoryItem},

    computed:{
        categories(){
            return this.$store.state.budgetCategories
        }
    }

}
</script>
<style lang="scss" scoped>
.root {
    box-sizing: content-box;
    position: fixed;
    height: 100vh;
    overflow-y: scroll;
    overflow-x: none;	
    width: 300px;
}
</style>
