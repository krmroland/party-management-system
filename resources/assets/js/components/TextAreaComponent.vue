<template>
  <textarea 
    class="form-control" 
    @input="$emit('update:value',$event.target.value)" 
    rows="1">
  </textarea>
</template>

<script>
  export default{
    mounted(){
        autosize(this.$el)
      
  }  
    }
</script>

<style>

</style>