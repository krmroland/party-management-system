<template>
    <div class="shadowed">
        <h4 class="text-center">Add A Provider</h4>
        <form action="#" method="post" @submit.prevent="submit">
            <div class="form-group">
                <label for="">Provider Details</label>
                <div class="input-group">
                    <input 
                      type="text" 
                      class="form-control" 
                      placeholder="Name"
                      v-model="name"
                    >
                    <input 
                      type="text" 
                      class="form-control" 
                      placeholder="Contact"
                      v-model="contact"
                    >
                    <button class="btn btn-primary">
                        <i class="fa fa-user-plus"></i>
                        Add Provider
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ["item"],
    data() {
        return {
            name: "",
            contact: ""
        };
    },
    computed: {
        url() {
            return `/budgetItems/${this.activeItem.id}/providers`;
        },
        activeItem(){
            return this.$store.getters["budget/activeItem"]
        }
    },
    methods: {
        submit() {
            axios
                .post(this.url,this.$data)
                .then(({ data }) => {
                    this.$store.commit("budget/load", data);
                    flash.success("Provider was added successfully");
                    this.$emit("done")
                })
                .catch(errors => {
                    flash.errors(errors.response.data.errors);
                });
        }
    }
};
</script>

<style>

</style>