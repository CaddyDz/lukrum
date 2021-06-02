<template>
    <div class="full-page-canvas full-page-canvas w-full sm:max-w-6xl bg-white shadow-md overflow-hidden min-h-full">

        <title-update :title="chooseTitle + ' Email Copy'"></title-update>
        <div class="blue-left-line"></div>

        <div class="layout-left-part pl-28 pr-20 pt-20 pb-20">
            <div class="app-logo-container">
                <breeze-application-logo mod="FullPage"></breeze-application-logo>
            </div>
            <div class="layout-intro-text mt-10 pr-20 mb-10">
                <div>Please <b>select the copy for your {{chooseTitle}} Email Copy from the dropdown menus below</b>. Once you have selected your text options, you may use the edit button to make minor changes to the copy directly in the selection box. Pressing Cancel will reset the text to your original choice. Please keep in mind that font size and colors are not editable and there are character limits in place.</div>
            </div>

            <div class="selects pb-16">
                <div class="mb-4">
                    <h1 class="section-title">Choose Your {{chooseTitle}} Email Copy</h1>

                    <div class="intro-selector mb-4 mt-1" v-show="!introEditable">
                        <breeze-label for="intro_select" class="select-label" value="Subheading"></breeze-label>
                        <breeze-select id="intro_select" class="inline-block w-9/12 mb-2" v-model="intro" :options="introSelect" required />
                        <breeze-button type="button" class="ml-2 edit-button" @click="editIntro" :disabled="!intro">Edit</breeze-button>
                    </div>

                    <div class="intro mb-4 mt-1" v-show="introEditable">
                        <breeze-label for="intro_override" class="select-label" value="Subheading"></breeze-label>
                        <breeze-input id="intro_override" type="text" class="w-9/12 mb-2" v-model="introOverride"></breeze-input>
                        <breeze-button type="button" class="ml-2 edit-button" @click="cancelEditIntro">Cancel</breeze-button>
                    </div>

                    <div class="body mb-4 mt-1" v-show="!bodyTextEditable">
                        <breeze-label for="body_select" class="select-label" value="Body"></breeze-label>
                        <breeze-select id="body_select" class="inline-block w-9/12 mb-2" v-model="bodyText" :options="bodyTextSelect" required />
                        <breeze-button type="button" class="ml-2 edit-button" @click="editBodyText" :disabled="!bodyText">Edit</breeze-button>
                    </div>

                    <div class="body mb-4 mt-1" v-show="bodyTextEditable">
                        <breeze-label for="body_override" class="select-label" value="Body"></breeze-label>
                        <breeze-textarea id="body_override" rows="8" class="w-9/12 mb-2" v-model="bodyTextOverride"></breeze-textarea>
                        <breeze-button type="button" class="ml-2 edit-button" @click="cancelEditBodyText">Cancel</breeze-button>
                    </div>

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
                <back-button @link-clicked="$emit('backClicked', step)"></back-button>
                <nav-steps :step="2"></nav-steps>
                <div class="mr-6">
                    <div class="landing-example mt-16">
                        <h1><b>EMAIL PREVIEW</b></h1>
                    </div>

                        <cib-page-email-preview
                            ref="preview"
                            width="550"
                            height="600"
                            :layout="$parent.layoutEmail"
                            :logo="$parent.previewImage"
                            :headline="headPreview"
                            :intro="introPreview"
                            :body-text="bodyTextPreview"
                            :cta="ctaPreview"

                            :footer="$parent.extraData.emailAddressLine"
                        ></cib-page-email-preview>

                        <!-- <cib-page-preview
                            ref="preview"
                            width="550"
                            height="600"
                            :layout="$parent.layoutEmail"
                            :logo="$parent.previewImage"
                            :headline="headPreview"
                            :intro="introPreview"
                            :body-text="bodyTextPreview"
                            :cta="ctaPreview"

                            :footer="$parent.extraData.emailAddressLine"
                        ></cib-page-preview> -->



                    <div class="flex items-center start mt-8">
                        <!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
                        <!--                Forgot your password?-->
                        <!--            </inertia-link>-->

                        <breeze-button type="button" class="ml-2" :class="{ 'opacity-25': !formOk }" :disabled="!formOk" @click="$emit('nextClicked', step)">
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
// import BannerPreview from "./BannerPreview";
import NavSteps from "./NavSteps";
// import CibPreview from "./CibPreview";

// import AssetsBannerList from "./AssetsBannerList";
import BreezeApplicationLogo from '@/Components/ApplicationLogo'
import CibPagePreview from "./CibPagePreview";
import CibPageEmailPreview from "./CibPageEmailPreview";
import BackButton from "../BackButton";
import TitleUpdate from "../TitleUpdate";

export default {
    name: "CibEmailCopies",
    emits: [
        "nextClicked",
        "backClicked",
        "ctaUpdated",
        "introUpdated",
        "bodyTextUpdated",
    ],
    props: [
        "chooseTitle", "selector", "step",
    ],

    components: {
        TitleUpdate,
        BackButton,
        CibPagePreview,
        // CibPreview,
        NavSteps,
        // AssetsBannerList,
        // BannerPreview,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeSelect,
        BreezeTextarea,
        BreezeApplicationLogo,
        CibPageEmailPreview
    },
    data() {
        return {
            layout: null,

            cta: "",
            ctaEditable: false,
            ctaOverride: null,

            intro: "",
            introEditable: false,
            introOverride: null,

            bodyText: "",
            bodyTextEditable: false,
            bodyTextOverride: null,

        }
    },

    mounted() {
        document.getElementById('layout_intro_text').innerHTML = "<div>Please <b>select the copy for your " + this.chooseTitle + " Email Copy from the dropdown menus below</b>. Once you have selected your text options, you may use the edit button to make minor changes to the copy directly in the selection box. Pressing Cancel will reset the text to your original choice. Please keep in mind that font size and colors are not editable and there are character limits in place.</div>";

        const ps = this.$parent.preSelected;

        [{v:"intro", p:"email_intro"}, {v:"bodyText", p:"email_body"}, {v:"cta", p: "email_cta"}].forEach(x => {

            if(this.$parent[this.selector][x.p]) {

                const override = this.$parent[this.selector][x.p].override;
                this[x.v] = this.$parent[this.selector][x.p].original;
                this.$nextTick(() => {
                    if(override) {
                        this[x.v + "Editable"] = true;
                        this[x.v + "Override"] = override;
                    }
                });
            } else if(ps && ps[this.selector] && ps[this.selector][x.p]) {
                const override = ps[this.selector][x.p].override;
                this[x.v] = ps[this.selector][x.p].original;
                this.$nextTick(() => {
                    if(override) {
                        this[x.v + "Editable"] = true;
                        this[x.v + "Override"] = override;
                    }
                });
            }
        });

        const a = this.$parent.copies.common[this.selector];

        if(!this.intro || !a.email_intro.includes(this.intro)) {
            this.intro = a.email_intro[0];
        }

        if(!this.bodyText || !a.email_body.includes(this.bodyText)) {
            this.bodyText = a.email_body[0];
        }

        if(!this.cta || !a.email_cta.includes(this.cta)) {
            this.cta = a.email_cta[0];
        }
    },

    watch: {

        cta(v) {
            this.ctaEditable = false;
            this.$emit("ctaUpdated", {original:v, override: null,});
        },

        ctaOverride(v) {
            this.$emit("ctaUpdated", {original: this.cta, override: v,});
        },

        intro(v) {
            this.introEditable = false;
            this.$emit("introUpdated", {original: v, override: null,});
        },

        introOverride(v) {
            this.$emit("introUpdated", {original: this.intro, override: v,});

        },

        bodyText(v) {
            this.bodyTextEditable = false;
            this.$emit("bodyTextUpdated", {original:v, override: null,});
        },

        bodyTextOverride(v) {
            this.$emit("bodyTextUpdated", {original: this.bodyText, override: v,});
        },
    },

    computed: {
        formOk() {
            return this.cta && this.intro && this.bodyText;
        },

        // sCloud() {
        //     return this.$parent.copies.clouds[this.$parent.focus][this.selector];
        // },

        // bannerSubheadPreview() {
        //     return this.editableBannerSubhead ? this.bannerSubheadOverride : this.bannerSubhead;
        // },

        // bannerCtaPreview() {
        //     return this.editableBannerCta ? this.bannerCtaOverride : this.bannerCta;
        // },


        ctaSelect() {

            // let list = [{value: "", label: "Please Select ..."}];
            let list = [];
            const a = this.$parent.copies.common[this.selector].email_cta;
            for(let k in a) {
                list.push({
                    value: a[k],
                    label: a[k],
                });
            }
            return list;
        },

        introSelect() {
            // return [];
            let list = [];

            const a = this.$parent.copies.common[this.selector].email_intro;
            for(let k in a) {
                list.push({
                    value: a[k],
                    label: a[k],//.strip,
                });
            }
            return list;
        },

        bodyTextSelect() {

            // let list = [{value: "", label: "Please Select ..."}];
            let list = [];
            const a = this.$parent.copies.common[this.selector].email_body;
            for(let k in a) {
                list.push({
                    value: a[k],
                    label: a[k].substr(0, 50) + " ...",
                });
            }
            return list;
        },

        headPreview() {
            return "";//this.editableSubhead ? this.subheadOverride : this.subhead;
        },
        introPreview() {
            return this.introEditable ? this.introOverride : this.intro;
        },
        bodyTextPreview() {
            return this.bodyTextEditable ? this.bodyTextOverride : this.bodyText;
        },
        ctaPreview() {
            return this.ctaEditable ? this.ctaOverride : this.cta;
        },
    },

    methods: {

        editCta() {
            this.ctaOverride = this.cta;
            this.ctaEditable = true;
        },

        cancelEditCta() {
            this.ctaOverride = null;
            this.ctaEditable = false;
        },

        editIntro() {
            this.introOverride = this.intro;
            this.introEditable = true;
        },

        cancelEditIntro() {
            this.introOverride = null;
            this.introEditable = false;
        },

        editBodyText() {
            this.bodyTextOverride = this.bodyText;
            this.bodyTextEditable = true;
        },

        cancelEditBodyText() {
            this.bodyTextOverride = null;
            this.bodyTextEditable = false;
        },

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
