<template>
<div class="banner-list m-4">
    <h1 class="section-title">Step 2: Partner Assets</h1>

    <div v-if="layoutsLoaded">
        <div>
                    <banner-preview
                        :layout="layouts.large_rectangle"
                        :logo="$parent.$parent.previewImage"
                        :color="$parent.$parent.color"
                        :headline="$parent.$parent.bannerPreview.headline"
                        :body-text="$parent.$parent.bannerPreview.bodyText"
                        :cta="$parent.$parent.bannerPreview.cta"
                        :overlay="$parent.$parent.previewOverlay"
                        width="400"
                        height="400"
                    ></banner-preview>
                    <banner-preview
                        :layout="layouts.sky_scrapper"
                        :logo="$parent.$parent.previewImage"
                        :color="$parent.$parent.color"
                        :headline="$parent.$parent.bannerPreview.headline"
                        :body-text="$parent.$parent.bannerPreview.bodyText"
                        :cta="$parent.$parent.bannerPreview.cta"
                        :overlay="$parent.$parent.previewOverlay"
                        width="400"
                        height="400"
                    ></banner-preview>
                    <banner-preview
                        :layout="layouts.medium_rectangle"
                        :logo="$parent.$parent.previewImage"
                        :color="$parent.$parent.color"
                        :headline="$parent.$parent.bannerPreview.headline"
                        :body-text="$parent.$parent.bannerPreview.bodyText"
                        :cta="$parent.$parent.bannerPreview.cta"
                        :overlay="$parent.$parent.previewOverlay"
                        width="400"
                        height="400"
                    ></banner-preview>
                    <banner-preview
                        :layout="layouts.mobile"
                        :logo="$parent.$parent.previewImage"
                        :color="$parent.$parent.color"
                        :headline="$parent.$parent.bannerPreview.headline"
                        :body-text="$parent.$parent.bannerPreview.bodyText"
                        :cta="$parent.$parent.bannerPreview.cta"
                        :overlay="$parent.$parent.previewOverlay"
                        width="320"
                        height="50"
                    ></banner-preview>
                    <banner-preview
                        :layout="layouts.leader_board"
                        :logo="$parent.$parent.previewImage"
                        :color="$parent.$parent.color"
                        :headline="$parent.$parent.bannerPreview.headline"
                        :body-text="$parent.$parent.bannerPreview.bodyText"
                        :cta="$parent.$parent.bannerPreview.cta"
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
    name: "AssetsBannerList",
    components: {BannerPreview},
    data() {
        return {
            sizes: [
                "large_rectangle",
                "sky_scrapper",
                "medium_rectangle",
                "mobile",
                "leader_board",
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
    }
}
</script>

<style scoped>

</style>
