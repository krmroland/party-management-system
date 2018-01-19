<template>
   <form action="#" method="post" @submit.prevent="submit">
       <div class="input-group">
        <DateComponent :value.sync="issued_on"></DateComponent>
       
         <select v-model="initials" class="form-control col-1">
             <option value="">Initials</option>
             <option v-for="initial in data.initials"
                 :value="initial"
                  v-text="initial"
            ></option>
         </select>
         <input type="text" class="form-control" placeholder="Name" v-model="name">
         <select v-model="issued_by" class="form-control">
             <option value="">Who issued .....</option>
             <option 
                v-for="issuer in data.issuers" 
                :value="issuer"
                 v-text="issuer">
                 
             </option>
         </select>

         <button class="btn btn-primary">
             <i class="fa fa-user-plus"></i>
             Issue
         </button>
       </div>
   </form>
</template>

<script>
  export default{
      props:["data"],
       data(){
          return {
              issued_on:'',
              issued_by:'',
              initials:'',
              name:''
          }
      },
      methods:{
        submit(){
            axios.post('/cards',this.$data).then(({data})=>{
                this.$emit('created',data);
            }).catch(errors=>{
                console.log(errors)
                flash.errors(errors.response.data.errors);
            })
        }
      }
  }  
</script>

<style>

</style>