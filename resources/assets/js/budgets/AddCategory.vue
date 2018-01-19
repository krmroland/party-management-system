<template>
    <div class="mb-2 p-1">
        <div v-if="isAdding">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Category name" v-model="name">
                <div class="btn-group">
                    <button class="btn btn-primary" 
                            :disabled="!name" @click.stop="save">
                        <i class="fa fa-save"></i>
                    </button>
                    <a href="#" class="btn btn-outline-secondary" @click.stop="cancel">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
        </div>
        <button class="btn btn-primary btn-block" v-else @click="isAdding=true">
            <i class="fa fa-plus"></i> New Category
        </button>
    </div>
</template>
<script>
export default {
    data() {
        return {
            isAdding: false,
            name: "",
            error:{}
        };
    },
    methods: {
        cancel() {
            this.name = "";
            this.isAdding = false;
        },

        save() {
            axios
                .post("/budget-categories", {
                    name: this.name.toLowerCase()
                })
                .then(({ data }) => {
                    this.cancel();
                    this.$store.commit("budget/load",data);
                    flash.info("Category was added successfully");
                }).catch(({response})=>{
                    this.handleErrors(response.data);
                })
        },
        handleErrors({errors}){
            console.log(errors)
            if (errors.hasOwnProperty("name")) {
                flash.error(errors["name"][0]);
            }

        }
    }
};
</script>
