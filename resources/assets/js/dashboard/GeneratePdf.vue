<template>
    <div>
      <a href="/statement" 
            class="btn btn-primary" 
            @click.prevent="generate"
            download>
        <i class="fa fa-file-pdf-o"></i>
        Generate Pdf
      </a>
      <div class="overlay" v-if="isLoading">
         <icon-spinner></icon-spinner>
         <span class="ml-2"> Generating pdf ....</span>
      </div>
    </div>
</template>

<script>
export default {
    props: [],
    data() {
        return {
            isLoading: false
        };
    },
    methods: {
        generate() {
            this.isLoading = true;

            axios({
                method: "post",
                url: "/summary",
                responseType: "arraybuffer"
            })
                .then(({ data }) => {
                    let blob = new Blob([data], {
                        type: "application/pdf"
                    });
                    let link = document.createElement("a");
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Dickson Weds Florence.pdf";
                    link.click();
                    this.isLoading = false;
                })
                .catch(errors => {
                    this.isLoading = false;
                    flash.error("Something went wronf");
                });
        }
    }
};
</script>

