<template>

    <div class="full-page-canvas full-page-canvas w-full sm:max-w-6xl bg-white shadow-md overflow-hidden min-h-full">
        <title-update title="Landing Page Copy"></title-update>
        <div class="blue-left-line"></div>

        <div class="layout-left-part pl-28 pr-20 pt-20 pb-20">
            <div class="app-logo-container">
                <breeze-application-logo mod="FullPage"></breeze-application-logo>
            </div>
            <div class="layout-intro-text mt-10 pr-20 mb-10">
                <div>Please <b>select the copy for your Landing Page from the dropdown menus below</b>. Once you have selected your text options, you may use the edit button to make minor changes to the copy directly in the selection box. Pressing Cancel will reset the text to your original choice. Please keep in mind that font size and colors are not editable and there are character limits in place.</div>
            </div>

            <div class="selects pb-16">
                <div class="mb-4">
                    <h1 class="section-title">Choose Your Landing Page Copy</h1>
                    <div class="headline-selector mb-4 mt-4" v-show="!headlineEditable">
                        <breeze-label for="headline_select" class="select-label" value="Headline"></breeze-label>
                        <breeze-select id="headline_select" class="inline-block w-9/12 mb-2" v-model="headline" :options="headlineSelect" required />
                        <breeze-button type="button" class="ml-2 edit-button" @click="editHeadLine" :disabled="!headline">Edit</breeze-button>
                    </div>

                    <div class="headline-edit mb-4 mt-4" v-show="headlineEditable">
                        <breeze-label for="headline_override" class="select-label" value="Headline"></breeze-label>
                        <breeze-input id="headline_override" type="text" class="w-9/12 mb-2" v-model="headlineOverride"></breeze-input>
                        <breeze-button type="button" class="ml-2 edit-button" @click="cancelEditHeadLine">Cancel</breeze-button>
                    </div>
                    <div class="subhead-selector mb-4 mt-1" v-show="!subheadEditable">
                        <breeze-label for="subhead_select" class="select-label" value="Subheading"></breeze-label>
                        <breeze-select id="subhead_select" class="inline-block w-9/12 mb-2" v-model="subhead" :options="subheadSelect" required />
                        <breeze-button type="button" class="ml-2 edit-button" @click="editSubHead" :disabled="!subhead">Edit</breeze-button>
                    </div>

                    <div class="subhead-edit mb-4 mt-1" v-show="subheadEditable">
                        <breeze-label for="subhead_override" class="select-label" value="Subheading"></breeze-label>
                        <breeze-input id="subhead_override" type="text" class="w-9/12 mb-2" v-model="subheadOverride"></breeze-input>
                        <breeze-button type="button" class="ml-2 edit-button" @click="cancelEditSubHead">Cancel</breeze-button>
                    </div>

                    <div class="body-text-selector mb-4 mt-1">
                        <breeze-label for="bodyText_select" class="select-label mb-2" value="Body"></breeze-label>
                        <!-- <breeze-select id="bodyText_select" class="inline-block w-9/12 mb-2" v-model="bodyText" :options="bodyTextSelect" required /> -->
                        <!-- <breeze-button type="button" class="ml-2 edit-button" @click="editBodyText" :disabled="!bodyText">Edit</breeze-button> -->
                        <div style="width: 350px;">
                            <QuillEditor theme="snow" v-model:content="bodyText"  :toolbar="['bold', 'italic', 'underline']" contentType="html" style="height: 200px;" />
                        </div>
                    </div>

                    <!-- <div class="body-text-edit mb-4 mt-1" v-show="bodyTextEditable">
                        <breeze-label for="bodyText_override" class="select-label" value="Body"></breeze-label>
                        <breeze-textarea id="bodyText_override" class="w-9/12 mb-2" rows="6" v-model="bodyTextOverride"></breeze-textarea>
                        <breeze-button type="button" class="ml-2 edit-button" @click="cancelEditBodyText">Cancel</breeze-button>
                    </div> -->

                    <div class="cta-selector mb-4 mt-1" v-show="!ctaEditable">
                        <breeze-label for="cta_select" class="select-label" value="Call to Action"></breeze-label>
                        <breeze-select id="cta_select" class="inline-block w-9/12 mb-2" v-model="cta" :options="ctaSelect" required />
                        <breeze-button type="button" class="ml-2 edit-button" @click="editCta" :disabled="!cta">Edit</breeze-button>
                    </div>

                    <div class="body-text-edit mb-4 mt-1" v-show="ctaEditable">
                        <breeze-label for="cta_override" class="select-label" value="Call to Action"></breeze-label>
                        <breeze-input id="cta_override" type="text" class="w-9/12 mb-2" rows="6" v-model="ctaOverride" maxlength="26"></breeze-input>
                        <breeze-button type="button" class="ml-2 edit-button" @click="cancelEditCta">Cancel</breeze-button>
                    </div>

                </div>
            </div>

            <div class="left-part-footer">
                © 2021 Pierry Inc. All rights reserved.
                <br />
                For help, email <a href="mailto:help@lukrum.com">help@lukrum.com</a>.
                &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                <a target="_blank" href="/static/DMS.Partners-Ts&Cs.pdf">Terms and Conditions</a>
            </div>
        </div>
        <div class="layout-right-part p-2">
            <div class="assets-banner-copies mt-16">
                <back-button @link-clicked="$emit('backClicked', 'landing_copies')"></back-button>
                <nav-steps :step="2"></nav-steps>
                <div class="mr-6" v-if="layout">
                    <div class="landing-example mt-16">
                        <h1><b>LANDING PAGE PREVIEW</b></h1>
                    </div>

                    <assets-page-preview
                        ref="preview"
                        width="550"
                        height="600"
                        :layout="layout"
                        :logo="$parent.previewImage"
                        :overlay="$parent.previewOverlay"
                        :color="$parent.color"

                        :headline="headlinePreview"
                        :intro="introPreview"
                        :body-text="bodyTextPreview"
                        :cta="ctaPreview"
                    ></assets-page-preview>



                    <div class="flex items-center start mt-8">
                        <!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
                        <!--                Forgot your password?-->
                        <!--            </inertia-link>-->

                        <breeze-button type="button" class="ml-2" :class="{ 'opacity-25': !formOk }" :disabled="!formOk" @click="$emit('nextClicked', 'landing_copies')">
                            Next
                        </breeze-button>
                    </div>
                </div>
            </div>
        </div>

    </div>


<!--
<div class="assets-banner-copies mt-16 ml-12">
    <nav-steps :step="4"></nav-steps>
    <div class="mr-6">
        <div class="mb-4">
            <h1 class="section-title">Choose Your Copy</h1>


        </div>

</div>
-->
</template>

<script>
import BreezeButton from '@/Components/Button'
import BreezeInput from '@/Components/Input'
import BreezeSelect from '@/Components/Select'
import BreezeLabel from '@/Components/Label'
import BreezeTextarea from '@/Components/InputTextArea'
import BannerPreview from "./BannerPreview";
import NavSteps from "./NavSteps";
import AssetsPagePreview from "./AssetsPagePreview";
import BreezeApplicationLogo from '@/Components/ApplicationLogo'
import BackButton from "../BackButton";
import TitleUpdate from "../TitleUpdate";

// import AssetsSmList from "./AssetsSmList";

export default {
    name: "AssetsLandingCopies",
    emits: [
        "nextClicked", "backClicked", "headlineUpdated", "subheadUpdated", "bodyTextUpdated", "ctaUpdated",
    ],
    components: {
        TitleUpdate,
        BackButton,
        AssetsPagePreview,
        NavSteps,
        // AssetsSmList,
        BannerPreview,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeSelect,
        BreezeTextarea,
        BreezeApplicationLogo,
    },
    data() {
        return {
            layout: null,
            // headlineDemo: null,
            // bodyTextDemo: null,
            headline: "",
            subhead: "",
            bodyText: this.$parent?.landing['bodyText']?.override != undefined? this.$parent?.landing['bodyText']?.override :'',
            cta: "",

            headlineEditable: false,
            subheadEditable: false,
            ctaEditable: false,
            bodyTextEditable: false,

            headlineOverride: null,
            subheadOverride: null,
            ctaOverride: null,
            bodyTextOverride: null
        }
    },

    mounted() {
        document.getElementById('layout_intro_text').innerHTML = "<div>Please <b>select the copy for your Landing Page from the dropdown menus below</b>. Once you have selected your text options, you may use the edit button to make minor changes to the copy directly in the selection box. Pressing Cancel will reset the text to your original choice. Please keep in mind that font size and colors are not editable and there are character limits in place.</div>";

        // console.log(this.$parent.preSelected);

        const ps = this.$parent.preSelected;

        ['headline', 'subhead', 'bodyText', 'cta'].forEach(x => {
            if(this.$parent.landing[x]) {
                const override = this.$parent.landing[x].override;
                this[x] = this.$parent.landing[x].original;
                this.$nextTick(() => {
                    if(override) {
                        this[x + "Editable"] = true;
                        this[x + "Override"] = override;
                    }
                });
            } else if(ps && ps.landing && ps.landing[x]) {
                this[x] = ps.landing[x].original;
                this.$nextTick(() => {
                    if(ps.landing[x].override) {
                        this[x + "Editable"] = true;
                        this[x + "Override"] = ps.landing[x].override;
                    }
                })
            }
        });


        if(this.$parent.preSelected) {
            const ps = this.$parent.preSelected;

            if(ps.headline) {
                this.headline = ps.headline;
            }
            if(ps.bodyText) {
                this.bodyText = ps.bodyText;
            }
            if(ps.cta) {
                this.cta = ps.cta;
            }
        }

        if(!this.headline || !this.sCloud.sm_headline.includes(this.headline)) {
            this.headline = this.sCloud.sm_headline[0];
        }

        if(!this.subhead || !this.sCloud.landing_subhead.includes(this.subhead)) {
            this.subhead = this.sCloud.landing_subhead[0];
        }

        if(!this.bodyText || !this.sCloud.sm_body.includes(this.bodyText)) {
            this.bodyText = this.sCloud.sm_body[0];
        }

        if(!this.cta || !this.$parent.copies.lCta.includes(this.cta)) {
            this.cta = this.$parent.copies.lCta[0];
        }

        this.loadLayoutInfo();
    },

    watch: {

        headline(v) {
            this.headlineEditable = false;
            this.$emit("headlineUpdated", {original: v, override: null,});
        },

        headlineOverride(v) {
            this.$emit("headlineUpdated", {original: this.headline, override: v,});

        },

        subhead(v) {
            this.subheadEditable = false;
            this.$emit("subheadUpdated", {original: v, override: null,});
        },

        subheadOverride(v) {
            this.$emit("subheadUpdated", {original: this.subhead, override: v,});

        },

        bodyText(v) {
            this.bodyTextEditable = false;
            this.$emit("bodyTextUpdated", {original:this.bodyText, override: v,});
        },

        bodyTextOverride(v) {
            this.$emit("bodyTextUpdated", {original: this.bodyText, override: v,});
        },

        cta(v) {
            this.ctaEditable = false;
            this.$emit("ctaUpdated", {original:v, override: null,});
        },

        ctaOverride(v) {
            this.$emit("ctaUpdated", {original: this.cta, override: v,});
        },
    },

    computed: {
        formOk() {
            return this.headline && this.bodyText && this.cta;
        },

        sCloud() {
            return this.$parent.copies.clouds[this.$parent.cloud];
        },

        headlinePreview() {
            return this.headlineEditable ? this.headlineOverride : this.headline;
        },

        introPreview() {
            return this.subheadEditable ? this.subheadOverride : this.subhead;
        },

        bodyTextPreview() {
            return this.bodyTextEditable ? this.bodyTextOverride : this.bodyText;
        },

        ctaPreview() {
            return this.ctaEditable ? this.ctaOverride : this.cta;
        },

        headlineSelect() {
            // return [];
            let list = [];
            if(!this.sCloud) {
                list.push({
                    value: "",
                    label: "Select Cloud",
                })
                return list;
            }

            for(let k in this.sCloud.sm_headline) {
                list.push({
                    value: this.sCloud.sm_headline[k],
                    label: this.sCloud.sm_headline[k].strip,
                });
            }
            return list;
        },

        bodyTextSelect() {
            // return [];

            let list = [];
            if(!this.sCloud) {
                list.push({
                    value: "",
                    label: "Select Cloud",
                })
                return list;
            }

            for(let k in this.sCloud.sm_body) {
                list.push({
                    value: this.sCloud.sm_body[k],
                    label: this.sCloud.sm_body[k].substr(0, 50) + " ...",
                });
            }
            return list;
        },

        subheadSelect() {
            // return [];

            let list = [];
            if(!this.sCloud) {
                list.push({
                    value: "",
                    label: "Select Cloud",
                })
                return list;
            }

            for(let k in this.sCloud.landing_subhead) {
                list.push({
                    value: this.sCloud.landing_subhead[k],
                    label: this.sCloud.landing_subhead[k],
                });
            }
            return list;
        },

        ctaSelect() {

            // let list = [{value: "", label: "Please Select ..."}];
            let list = []
            for(let k in this.$parent.copies.lCta) {
                list.push({
                    value: this.$parent.copies.lCta[k],
                    label: this.$parent.copies.lCta[k],
                });
            }
            return list;
        },


    },

    methods: {
        editHeadLine() {
            this.headlineOverride = this.headline.strip;
            this.headlineEditable = true;
        },

        cancelEditHeadLine() {
            this.headlineOverride = null;
            this.headlineEditable = false;
        },

        editSubHead() {
            this.subheadOverride = this.subhead;
            this.subheadEditable = true;
        },

        cancelEditSubHead() {
            this.subheadOverride = null;
            this.subheadEditable = false;
        },


        editBodyText() {
            this.bodyTextOverride = this.bodyText;
            this.bodyTextEditable = true;
        },

        cancelEditBodyText() {
            this.bodyTextOverride = null;
            this.bodyTextEditable = false;
        },

        editCta() {
            this.ctaOverride = this.cta;
            this.ctaEditable = true;
        },

        cancelEditCta() {
            this.ctaOverride = null;
            this.ctaEditable = false;
        },


        async loadLayoutInfo() {
            this.layout = (await axios.get("/pmc/api/layouts/" + this.$parent.layout.code + "/image/landing")).data;
            // this.layout = (await axios.get("/pmc/api/layouts/" + this.$parent.layout.code + "/image/sky_scrapper")).data;


            // this.headlineDemo = this.$parent.copies.clouds.analytics.banner_headline[0];
            // await this.$nextTick(() => {
            //     this.bodyTextDemo =  this.$parent.copies.clouds.analytics.banner_body[0];
            // });
        }

    }

}
</script>

<style scoped>
.logo-limits {
    font-size: 88%;
    /*margin-left: 14px;*/
}


.asset-example {
    background-color: rgb(217, 217, 217);
    padding: 20px 28px;
}

.asset-example h1 {
    text-align: center;
    font-weight: bold;
}

.color-preview {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: inline-block;
    margin-right: 35px;
    vertical-align:middle;
}

.color-inner {
    display:inline-block;
    vertical-align:middle;
}

.edit-button {
    padding: 2px 10px;
    text-align: center;
}
</style>
