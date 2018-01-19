<template>
    <OverFlow :show="isLoading" ></OverFlow>
</template>

<script>
  export default{
    mounted(){
      window.addEventListener("load", ()=>{
        this.isLoading=false;
      })
      window.addEventListener("beforeunload", (e)=>{
        this.isLoading=true;
      })
    },

       data(){
          return {
              isLoading:true
          }
      }
  }  
</script>

<style>

</style>