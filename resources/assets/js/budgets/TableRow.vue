<template>
    <tr @click="$emit('clicked',item)">
        <td>{{number}}.</td>
        <td>{{item.name}}</td>
        <td>{{item.qty|currency}} {{ item.qtyUnits }}</td>
        <td>{{item.unitCost|currency}}</td>
        <td>{{item.total|currency}}</td>
        <td>{{item.isCovered?'Covered':'-------------'}}</td>
    </tr>
</template>
<script>
    export default{
        props:["item","index"],
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