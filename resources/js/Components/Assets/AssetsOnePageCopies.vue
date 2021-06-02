<template>

<div class="full-page-canvas full-page-canvas w-full sm:max-w-6xl bg-white shadow-md overflow-hidden min-h-full">
    <title-update title="1-Pager Copy"></title-update>
    <div class="blue-left-line"></div>

    <div class="layout-left-part pl-28 pr-20 pt-20 pb-20">
        <div class="app-logo-container">
            <breeze-application-logo mod="FullPage"></breeze-application-logo>
        </div>
        <div class="layout-intro-text mt-10 pr-20 mb-10">
            <div>Please <b>select the copy for your 1-Pager</b> from the dropdown menus below. Once you have selected your text options, you may use the edit button to make minor changes to the copy directly in the selection box. Pressing Cancel will reset the text to your original choice. Please keep in mind that font size and colors are not editable and there are character limits in place. Also, please <b>provide details</b> around the number of certified professionals and project successes you have had in the text fields below.</div>
        </div>

        <div class="selects pb-16">
            <div class="mb-4">
                <h1 class="section-title">Choose your 1-Pager Copy</h1>
                <div class="headline-selector mb-4 mt-4" v-show="!headlineEditable">
                    <breeze-label for="headline_select" class="select-label" value="Headline"></breeze-label>
                    <breeze-select id="headline_select" class="inline-block w-9/12 mb-2" v-model="headline" :options="headlineSelect" required />
                    <breeze-button type="button" class="ml-2 edit-button" @click="editHeadLine" :disabled="!headline">Edit</breeze-button>
                </div>

                <div class="headline-edit mb-4 mt-1" v-show="headlineEditable">
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
                    <breeze-input id="cta_override" type="text" class="w-9/12 mb-2" rows="6" v-model="ctaOverride" maxlength="40"></breeze-input>
                    <breeze-button type="button" class="ml-2 edit-button" @click="cancelEditCta">Cancel</breeze-button>
                </div>

                <div class="professionals-edit mb-4 mt-1">
                    <breeze-label for="professionals" class="select-label" value="Number of Certified Professionals *"></breeze-label>
                    <breeze-input id="professionals" type="text" class="w-9/12 mb-2" rows="6" v-model="professionals" required placeholder="Number of Certified Professionals *"></breeze-input>
                </div>

                <div class="projects-edit mb-4 mt-1">
                    <breeze-label for="projects" class="select-label" value="Number of Project Successes *"></breeze-label>
                    <breeze-input id="projects" type="text" class="w-9/12 mb-2" rows="6" v-model="projects" required placeholder="Number of Project Successes *"></breeze-input>
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
            <back-button @link-clicked="$emit('backClicked', 'op_copies')"></back-button>
            <nav-steps :step="2"></nav-steps>
            <div class="mr-6" v-if="layout">
                <div class="landing-example mt-16">
                    <h1><b>1-PAGER PREVIEW</b></h1>
                </div>

                <assets-one-page-preview
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

                    :professionals="professionals"
                    :projects="projects"
                ></assets-one-page-preview>



                <div class="flex items-center start mt-8">
                    <!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
                    <!--                Forgot your password?-->
                    <!--            </inertia-link>-->

                    <breeze-button type="button" class="ml-2" :class="{ 'opacity-25': !formOk }" :disabled="!formOk" @click="$emit('nextClicked', 'op_copies')">
                        Next
                    </breeze-button>
                </div>
            </div>
        </div>
    </div>

</div>


</template>

<script>
import BreezeButton from '@/Components/Button'
import BreezeInput from '@/Components/Input'
import BreezeSelect from '@/Components/Select'
import BreezeLabel from '@/Components/Label'
import BreezeTextarea from '@/Components/InputTextArea'
import BannerPreview from "./BannerPreview";
import NavSteps from "./NavSteps";
import BreezeApplicationLogo from '@/Components/ApplicationLogo'
import AssetsOnePagePreview from "./AssetsOnePagePreview";
import BackButton from "../BackButton";
import TitleUpdate from "../TitleUpdate";

export default {
    name: "AssetsOnePageCopies",
    emits: [
        "nextClicked", "backClicked", "headlineUpdated", "subheadUpdated", "bodyTextUpdated", "ctaUpdated", "professionalsUpdated", "projectsUpdated",
    ],
    components: {
        TitleUpdate,
        BackButton,
        AssetsOnePagePreview,
        NavSteps,
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
            // bodyText: '',
            bodyText: this.$parent?.op['bodyText']?.override != undefined? this.$parent?.op['bodyText']?.override :'',
            cta: "",

            headlineEditable: false,
            subheadEditable: false,
            ctaEditable: false,
            bodyTextEditable: false,

            headlineOverride: null,
            subheadOverride: null,
            ctaOverride: null,
            bodyTextOverride: null,

            professionals: "",
            projects: "",
        }
    },

    mounted() {
        document.getElementById('layout_intro_text').innerHTML = "<div>Please <b>select the copy for your 1-Pager</b> from the dropdown menus below. Once you have selected your text options, you may use the edit button to make minor changes to the copy directly in the selection box. Pressing Cancel will reset the text to your original choice. Please keep in mind that font size and colors are not editable and there are character limits in place. Also, please <b>provide details</b> around the number of certified professionals and project successes you have had in the text fields to the right.</div>";

        const ps = this.$parent.preSelected;

        ['headline', 'subhead', 'bodyText', 'cta'].forEach(x => {
            if(this.$parent.op[x]) {

                const override = this.$parent.op[x].override;
                this[x] = this.$parent.op[x].original;
                this.$nextTick(() => {
                    if(override) {
                        this[x + "Editable"] = true;
                        this[x + "Override"] = override;
                    }
                });
            } else if(ps && ps.op && ps.op[x]) {
                this[x] = ps.op[x].original;
                this.$nextTick(() => {
                    if(ps.op[x].override) {
                        this[x + "Editable"] = true;
                        this[x + "Override"] = ps.op[x].override;
                    }
                })
            }
        });

        if(this.$parent.op.professionals) {
            this.professionals = this.$parent.op.professionals;
        } else if(ps && ps.op && ps.op.professionals) {
            this.professionals = ps.op.professionals;
        }

        if(this.$parent.op.projects) {
            this.projects = this.$parent.op.projects;
        } else if(ps && ps.op && ps.op.projects) {
            this.projects = ps.op.projects;
        }


        if(!this.headline || !this.sCloud.op_headline.includes(this.headline)) {
            this.headline = this.sCloud.op_headline[0];
        }

        if(!this.subhead || !this.sCloud.op_subhead.includes(this.subhead)) {
            this.subhead = this.sCloud.op_subhead[0];
        }

        if(!this.bodyText || !this.sCloud.op_body.includes(this.bodyText)) {
            this.bodyText = this.sCloud.op_body[0];
        }

        if(!this.cta || !this.sCloud.op_cta.includes(this.cta)) {
            this.cta = this.sCloud.op_cta[0];
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
            // this.$emit("bodyTextUpdated", {original:v, override: null,});
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

        professionals(v) {
            this.$emit("professionalsUpdated", v);
        },

        projects(v) {
            this.$emit("projectsUpdated", v);
        },
    },

    computed: {
        formOk() {
            return this.headline && this.bodyText && this.cta && this.professionals && this.projects;
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

            for(let k in this.sCloud.op_headline) {
                list.push({
                    value: this.sCloud.op_headline[k],
                    label: this.sCloud.op_headline[k],
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

            for(let k in this.sCloud.op_body) {
                list.push({
                    value: this.sCloud.op_body[k],
                    label: this.sCloud.op_body[k],
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

            for(let k in this.sCloud.op_subhead) {
                list.push({
                    value: this.sCloud.op_subhead[k],
                    label: this.sCloud.op_subhead[k],
                });
            }
            return list;
        },

        ctaSelect() {

            // let list = [{value: "", label: "Please Select ..."}];
            let list = []
            for(let k in this.sCloud.op_cta) {
                list.push({
                    value: this.sCloud.op_cta[k],
                    label: this.sCloud.op_cta[k],
                });
            }
            return list;
        },


    },

    methods: {
        editHeadLine() {
            this.headlineOverride = this.headline;//.strip;
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
            this.layout = (await axios.get("/pmc/api/layouts/" + this.$parent.layout.code + "/image/one_page")).data;
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
