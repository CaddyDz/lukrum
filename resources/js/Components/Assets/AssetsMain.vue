<template>
<div class="assets-main">
    <assets-layout v-if="currentStep === 'layout'"
       @layout-selected="layoutChanged"
       @next-clicked="nextClicked"
       @back-clicked="backClicked"
    ></assets-layout>
    <assets-logo v-else-if="currentStep === 'logo'"
        @layout-updated="extendedLayoutUpdated"
        @logo-updated="logoUpdated"
        @logo-preview-updated="logoPreviewUpdated"

        @overlay-updated="overlayUpdated"
        @overlay-preview-updated="overlayPreviewUpdated"

        @color-updated="colorUpdated"

        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></assets-logo>
    <assets-cloud v-else-if="currentStep === 'cloud'"
        @cloud-updated="cloudUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></assets-cloud>
    <assets-banner-copies v-else-if="currentStep === 'banner_copies'"
        @cta-updated="bannerCtaUpdated"
        @headline-updated="bannerHeadlineUpdated"
        @body-text-updated="bannerBodyTextUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></assets-banner-copies>
    <assets-sm-copies v-else-if="currentStep === 'sm_copies'"
        @cta-updated="smCtaUpdated"
        @headline-updated="smHeadlineUpdated"
        @body-text-updated="smBodyTextUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></assets-sm-copies>
    <assets-landing-copies v-else-if="currentStep === 'landing_copies'"
        @cta-updated="landingCtaUpdated"
        @headline-updated="landingHeadlineUpdated"
        @subhead-updated="landingSubheadUpdated"
        @body-text-updated="landingBodyTextUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></assets-landing-copies>
    <assets-one-page-copies v-else-if="currentStep === 'op_copies'"
        @cta-updated="opCtaUpdated"
        @headline-updated="opHeadlineUpdated"
        @subhead-updated="opSubheadUpdated"
        @body-text-updated="opBodyTextUpdated"
        @professionals-updated="opProfessionalsUpdated"
        @projects-updated="opProjectsUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></assets-one-page-copies>
    <assets-comments v-else-if="currentStep === 'comments'"
        @comments-updated="commentsUpdated"
        @launch-date-updated="launchDateUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></assets-comments>
<!--    <assets-banner-list v-else-if="currentStep === 'banner_list'"></assets-banner-list>-->
    <div v-else><h1>Something Went Wrong</h1></div>
</div>
</template>

<script>
import AssetsLayout from "./AssetsLayout";
import AssetsLogo from "./AssetsLogo";
import AssetsCloud from "./AssetsCloud";
import AssetsBannerCopies from "./AssetsBannerCopies";
import AssetsComments from "./AssetsComments";
import AssetsSmCopies from "./AssetsSmCopies";
import AssetsLandingCopies from "./AssetsLandingCopies";
import AssetsOnePageCopies from "./AssetsOnePageCopies";

import imageUploader from "../../tools/imageUploader";

export default {
    name: "AssetsMain",
    components: {
        AssetsOnePageCopies,
        AssetsLandingCopies,
        AssetsSmCopies,
        AssetsComments,
        AssetsBannerCopies,
        AssetsCloud,
        AssetsLogo,
        AssetsLayout,
    },
    props: ["preSelected", "hash", ],
    emits: ["dataCollected"],
    data() {
        return {
            currentStep: "layout",
            steps: [
                "layout",
                "logo",
                "cloud",
                "banner_copies",
                "sm_copies",
                "landing_copies",
                "op_copies",
                "comments",
            ],
            layout: null,
            extendedLayout: null,

            logoFile: null,
            previewImage: null,

            overlayFile: null,
            previewOverlay: null,

            color: null,
            cloud: null,

            banner: {
                cta: null,
                headline: null,
                bodyText: null,
            },

            sm: {
                cta: null,
                headline: null,
                bodyText: null,
            },

            landing: {
                cta: null,
                headline: null,
                subhead: null,
                bodyText: null,
            },

            op: {
                cta: null,
                headline: null,
                subhead: null,
                bodyText: null,
                professionals: null,
                projects: null,
            },

            copies: [],

            comments: null,
            launchDate: null,

            uploading: 0,
        }
    },

    async mounted() {
        this.copies = (await axios.get("/pmc/api/copies?hash=" + this.hash)).data;
    },

    computed: {
        formToSend() {
            return {
                path: "cc",
                layout: this.layout.code,
                color: this.color,
                // logo: this.logoFile,
                // overlay: this.overlayFile,
                cloud: this.cloud,
                banner: this.banner,
                sm: this.sm,
                landing: this.landing,
                op: this.op,
                comments: this.comments,
                launchDate: this.launchDate,
            }
        },

        bannerPreview() {
            return {
                headline: this.banner.headline.override
                    ? this.banner.headline.override
                    : (
                        this.banner.headline.original
                        ? this.banner.headline.original
                        : this.copies.clouds.analytics.banner_headline[0]
                    ),
                bodyText: this.banner.bodyText.override
                    ? this.banner.bodyText.override
                    : (
                        this.banner.bodyText.original
                        ? this.banner.bodyText.original
                        : this.copies.clouds.analytics.banner_body[0]
                    ),
                cta: this.banner.cta.override
                    ? this.banner.cta.override
                    : (
                        this.banner.cta.original
                        ? this.banner.cta.original
                        : this.copies.cta[0]
                    ),
            }
        },
        smPreview() {
            return {
                headline: this.sm.headline.override
                    ? this.sm.headline.override
                    : (
                        this.sm.headline.original
                            ? this.sm.headline.original
                            : this.copies.clouds.analytics.sm_headline[0]
                    ),
                bodyText: this.sm.bodyText.override
                    ? this.sm.bodyText.override
                    : (
                        this.sm.bodyText.original
                            ? this.sm.bodyText.original
                            : this.copies.clouds.analytics.sm_body[0]
                    ),
                cta: this.sm.cta.override
                    ? this.sm.cta.override
                    : (
                        this.sm.cta.original
                            ? this.sm.cta.original
                            : this.copies.cta[0]
                    ),
            }
        },

    },

    methods: {

        initUpload(imageType, f) {

            const form = new FormData();
            form.append("image", f);
            form.append("imageType", imageType);
            form.append("hash", this.hash);

            imageUploader.add(imageType, form);
        },

        layoutChanged(layout) {
            this.layout = layout;
            if(!this.preSelected.color) {
                this.color = layout.default_color;
            }
        },

        extendedLayoutUpdated(l) {
            this.extendedLayout = l;
        },

        logoUpdated(logoFile) {
            this.logoFile = logoFile;
            this.initUpload("logo", logoFile);
        },

        overlayUpdated(overlayFile) {
            this.overlayFile = overlayFile
            this.initUpload("overlay", overlayFile);
        },

        logoPreviewUpdated(logoPreview) {
            this.previewImage = logoPreview
        },

        overlayPreviewUpdated(overlayPreview) {
            this.previewOverlay = overlayPreview
        },

        colorUpdated(color) {
            this.color = color;
        },

        cloudUpdated(cloud) {
            this.cloud = cloud;
        },

        bannerCtaUpdated(cta) {
            this.banner.cta = cta;
        },

        bannerHeadlineUpdated(headline) {
            this.banner.headline = headline;
        },

        bannerBodyTextUpdated(bodyText) {
            this.banner.bodyText = bodyText;
        },

        smCtaUpdated(cta) {
            this.sm.cta = cta;
        },

        smHeadlineUpdated(headline) {
            this.sm.headline = headline;
        },

        smBodyTextUpdated(bodyText) {
            this.sm.bodyText = bodyText;
        },

        landingCtaUpdated(v) {
            this.landing.cta = v;
        },

        landingHeadlineUpdated(v) {
            this.landing.headline = v;
        },

        landingSubheadUpdated(v) {
            this.landing.subhead = v;
        },

        landingBodyTextUpdated(v) {
            this.landing.bodyText = v;
        },

        opCtaUpdated(v) {
            this.op.cta = v;
        },

        opHeadlineUpdated(v) {
            this.op.headline = v;
        },

        opSubheadUpdated(v) {
            this.op.subhead = v;
        },

        opBodyTextUpdated(v) {
            this.op.bodyText = v;
        },

        opProfessionalsUpdated(v) {
            this.op.professionals = v;
        },

        opProjectsUpdated(v) {
            this.op.projects = v;
        },

        commentsUpdated(v) {
            this.comments = v;
        },

        launchDateUpdated(v) {
            this.launchDate = v;
        },


        nextClicked(step) {

            const idx = this.steps.indexOf(step);
            if(this.steps.length - 1 > idx) {
                this.currentStep = this.steps[idx + 1];
                window.scrollTo(0, 0);
            } else {
                imageUploader.done().then(x => {
                    this.$emit("dataCollected", this.formToSend);
                })
                // alert("It's time to submit data and go on for Calendly");
            }
        },

        backClicked(step) {
            const idx = this.steps.indexOf(step);
            if(idx > 0) {
                this.currentStep = this.steps[idx - 1];
                window.scrollTo(0, 0);
            } else {
                history.back();
//                 this.$inertia.get(this.route('pmc.contact') + '/' + this.hash, {}, {replace: true, preserveState: true, });
                // this.$emit("dataCollected", this.formToSend);
                // alert("It's time to submit data and go on for Calendly");
            }
        },
    }
}
</script>

<style scoped>

</style>
