<template>
<div class="banner-list m-4">
    <div v-if="layoutsLoaded">
        <div>
<!--
                    <banner-preview
                        :layout="layouts.facebook"
                        :logo="$parent.$parent.previewImage"
                        :color="$parent.$parent.color"
                        :headline="$parent.$parent.smPreview.headline"
                        :body-text="$parent.$parent.smPreview.bodyText"
                        :cta="$parent.$parent.smPreview.cta"
                        :overlay="$parent.$parent.previewOverlay"
                        width="400"
                        height="400"
                    ></banner-preview>
-->

                    <banner-preview
                        :layout="layouts.twitter"
                        :logo="$parent.$parent.previewImage"
                        :color="$parent.$parent.color"
                        :headline="$parent.$parent.smPreview.headline"
                        :body-text="$parent.$parent.smPreview.bodyText"
                        :cta="$parent.$parent.smPreview.cta"
                        :overlay="$parent.$parent.previewOverlay"
                        width="400"
                        height="400"
                    ></banner-preview>

                    <banner-preview
                        :layout="layouts.instagram"
                        :logo="$parent.$parent.previewImage"
                        :color="$parent.$parent.color"
                        :headline="$parent.$parent.smPreview.headline"
                        :body-text="$parent.$parent.smPreview.bodyText"
                        :cta="$parent.$parent.smPreview.cta"
                        :overlay="$parent.$parent.previewOverlay"
                        width="400"
                        height="400"
                    ></banner-preview>
                    <banner-preview
                        :layout="layouts.linkedin"
                        :logo="$parent.$parent.previewImage"
                        :color="$parent.$parent.color"
                        :headline="$parent.$parent.smPreview.headline"
                        :body-text="$parent.$parent.smPreview.bodyText"
                        :cta="$parent.$parent.smPreview.cta"
                        :overlay="$parent.$parent.previewOverlay"
                        width="400"
                        height="400"
                    ></banner-preview>
        </div>
    </div>
</div>
</template>

<script>
import BannerPreview from "./BannerPreview";
export default {
    name: "AssetsSmList",
    components: {BannerPreview},
    data() {
        return {
            sizes: [
                "facebook",
                "twitter",
                "instagram",
                "linkedin",
            ],
            layouts: {},
            layoutsLoaded: false,
        }
    },

    mounted() {
        Promise.all(this.sizes.map(x => {
            return axios.get("/pmc/api/layouts/" + this.$parent.$parent.layout.code + "/image/" + x);
        })).then(result => {
            for(let idx in result) {
                this.layouts[this.sizes[idx]] = result[idx].data;
            }
            this.layoutsLoaded = true;
        })
        // this.layout = (await axios.get("/pmc/api/layouts/" + this.$parent.layout.code + "/image/large_rectangle")).data;

    }
}
</script>

<style scoped>

</style>
