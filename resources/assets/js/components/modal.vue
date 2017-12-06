<template>
    <div class="modal modal-open" itabindex="-1" v-if="show"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title text-primary">
                <slot name="title"></slot>
            </h4>
            <button type="button" class="close" @click.stop="close">
              <span>&times;</span>
          </button>
      </div>
      <div class="modal-body">
       <slot></slot>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-secondary" @click.stop="close">Close</button>
    <slot name="footer"></slot>
</div>
</div>
</div>
</div>
</template>

<script>
export default{
    data(){
        return {
            show:true
        }
    },
    methods:{
        close(){
            this.show=false
            this.$emit('closed')
        }
    }
}  
</script>

<style scoped lang="scss">
.modal{
    height: 100%;
    margin-top:auto;
    display: flex;
    align-items:center;
    justify-content:center;
    width: 100%;
    background: rgba(0,0,0,0.5);


    .close{
        cursor:pointer;
        padding:15px;
    }
    .modal-dialog{
        width:100%;
        max-width:90%;
        padding:20px;
    }

}
</style>