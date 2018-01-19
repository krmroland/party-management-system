<template>
    <button type="submit" class="btn btn-primary col-2">
       <i class="fa" :class="icon"></i>
       {{buttonText}}
    </button>
</template>

<script>
  export default{
        props:['buttonText','icon']
  }  
</script>

<style>

</style>