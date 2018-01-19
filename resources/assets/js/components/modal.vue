<template>
    <div class="modal" v-if="shouldShow">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title text-primary">
              <slot name='title'></slot>
          </p>
          <button class="delete" aria-label="close" @click="close">
              &times;
          </button>
        </header>
        <section class="modal-card-body">
          <slot></slot>
        </section>
        <footer class="modal-card-foot">
          <button class="btn btn-secondary" @click="close">Cancel</button>
        </footer>
      </div>
    </div> 
</template>

<script>
export default{
  props:{
    show:{default:false}
  },
    data(){
      return {
        shouldShow:this.show
      }
    },
    methods:{
        close(){
            this.$emit('closed')
            
        }
    },
    watch:{
      show(shouldShow){
        this.shouldShow=shouldShow;
      }
    }
}  
</script>

<style scoped lang="scss">
@import "resources/assets/sass/variables";
.modal {
  bottom: 0;
  left: 0;
  position: absolute;
  right: 0;
  top: 20px;
  align-items: center;
  display: flex;
  justify-content: center;
  overflow: hidden;
  position: fixed;
  z-index: $zindex-modal;
}

.modal-background {
  bottom: 0;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  background-color: rgba(10, 10, 10, 0.86);
}

.modal-content,
.modal-card {
  margin: 0 20px;
  padding:20px;
  max-height: calc(100vh - 160px);
  overflow: auto;
  position: relative;
  min-width: 100%;
}


.modal-card {
  display: flex;
  flex-direction: column;
  max-height: calc(100vh - 40px);
  overflow: hidden;
}

.modal-card-head,
.modal-card-foot {

  align-items: center;
  background-color: whitesmoke;
  display: flex;
  flex-shrink: 0;


justify-content: flex-start;
  padding: 20px;
  position: relative;
}

.modal-card-head {
  border-bottom: $modal-header-border-width solid $modal-header-border-color;

}

.modal-card-title {
  color: #363636;
  flex-grow: 1;
  flex-shrink: 0;
  font-size: 1.5rem;
  line-height: 1;
}

.modal-card-foot {
  border-top: 1px solid #dbdbdb;
}

.modal-card-foot .button:not(:last-child) {
  margin-right: 10px;
}

.modal-card-body {
  -webkit-overflow-scrolling: touch;
  background-color: white;
 flex-grow: 1;
 flex-shrink: 1;
  overflow: auto;
  padding: 20px;
}
</style>