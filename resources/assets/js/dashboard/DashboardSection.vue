<template>
   <section  class="header bg-info px-5 my-3">
     <div class="containder-fluid contents">
         <slot></slot>
     </div>
  </section>
</template>

<script>
export default{

}  
</script>


<style lang="scss">
@import "resources/assets/sass/variables";
.header{
    width:100%;
   
    .contents{
        width:100%;
        display:flex;
        justify-content:space-between;
        align-items:center;
        height:auto;
        // padding:10px;
        color:white;
        height:60px;
    }
    

    // background-color:theme-color('primary');
}
</style>