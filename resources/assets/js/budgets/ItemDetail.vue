<template>
    <modal @closed="$emit('closed')">
      <span slot="title">{{ item.name|capitalize }}</span>
    </modal>
</template>

<script>
    export default{
        props:['item']
    }
</script>
<style lang="scss" scoped>

</style>