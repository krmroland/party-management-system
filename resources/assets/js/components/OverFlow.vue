<template>
    <div v-if="show">
      <div class="overlay">
        <icon-spinner></icon-spinner>
        <span class="h4 ml-2">{{ text }}</span>
      </div>
    </div>
</template>

<script>
  export default{
      props:['text','show'],
      mounted(){
        document.addEventListener('keydown', (event)=>{
            if (event.keyCode===27) {
                this.$emit("escaped")
                this.$emit("update:show",false);
            }
        })
      }
  }  
</script>
<style scoped>
