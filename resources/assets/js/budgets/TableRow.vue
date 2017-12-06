<template>
    <tr @click="clicked">
        <td>{{number}}.</td>
        <td>{{item.name}}</td>
        <td>{{item.qty|currency}}</td>
        <td>{{item.unitCost|currency}}</td>
        <td>{{item.total|currency}}</td>
        <td>{{item.isCovered?'Covered':'-------------'}}</td>
        <ItemDetail v-if="showDetail" @closed="showDetail=false" :item="item">
            
        </ItemDetail>
    </tr>
</template>
<script>
import ItemDetail from "./ItemDetail";

    export default{
        components:{ItemDetail},
        data(){
            return {
                showDetail:false
            }
        },
        props:["item","index"],
        methods:{
            clicked(){
                this.showDetail=true;
            }
        },
        computed:{
            number(){
                return this.index+1;
            }
        }
    }
</script>

<style scoped lang="scss">
@import "resources/assets/sass/variables";
    .table-hover {
      tbody tr {
        &:hover{
            color:theme-color('primary');
            cursor:pointer;
        }
      }
    }
</style>