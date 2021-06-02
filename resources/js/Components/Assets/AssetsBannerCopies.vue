<template>
<div class="assets-banner-copies mt-16 ml-12">
    <title-update title="Banner Copy"></title-update>
    <back-button @link-clicked="$emit('backClicked', 'banner_copies')"></back-button>
    <nav-steps :step="4"></nav-steps>
    <div class="mr-6">
        <div class="mb-4">
            <h1 class="section-title">Choose Your Copy</h1>

            <div class="headline-selector mb-4 mt-4" v-show="!headlineEditable">
                <breeze-label for="headline_select" class="select-label" value="Headline"></breeze-label>
                <breeze-select id="headline_select" class="inline-block w-9/12 mb-2" v-model="headline" :options="headlineSelect" required />
                <breeze-button type="button" class="ml-2 edit-button" @click="editHeadLine" :disabled="!headline">Edit</breeze-button>
            </div>

            <div class="headline-edit mb-4 mt-1" v-show="headlineEditable">
                <breeze-label for="headline_override" class="select-label" value="Headline"></breeze-label>
                <breeze-input type="text" id="headline_override" class="w-9/12 mb-2" v-model="headlineOverride"></breeze-input>
                <breeze-button type="button" class="ml-2 edit-button" @click="cancelEditHeadLine">Cancel</breeze-button>
            </div>

            <div class="body-text-selector mb-4 mt-1" v-show="!bodyTextEditable">
                <breeze-label for="bodyText_select" class="select-label" value="Body"></breeze-label>
                <breeze-select id="bodyText_select" class="inline-block w-9/12 mb-2" v-model="bodyText" :options="bodyTextSelect" required />
                <breeze-button type="button" class="ml-2 edit-button" @click="editBodyText" :disabled="!bodyText">Edit</breeze-button>
            </div>

            <div class="body-text-edit mb-4 mt-1" v-show="bodyTextEditable">
                <breeze-label for="bodyText_override" class="select-label" value="Body"></breeze-label>
                <breeze-textarea id="bodyText_override" class="w-9/12 mb-2" rows="6" v-model="bodyTextOverride"></breeze-textarea>
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

<!--        <hr />-->

        <div class="asset-example mt-16">
            <h1>BANNER PREVIEW</h1>
            <banner-preview
                ref="preview"
                width="250"
                height="500"
                :layout="$parent.extendedLayout"
                :logo="$parent.previewImage"
                :overlay="$parent.previewOverlay"
                :color="$parent.color"
                :headline="headlinePreview"
                :body-text="bodyTextPreview"
                :cta="ctaPreview"
            ></banner-preview>
        </div>

<!--        <assets-banner-list></assets-banner-list>-->


        <div class="flex items-center start mt-8">
            <!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
            <!--                Forgot your password?-->
            <!--            </inertia-link>-->

            <breeze-button type="button" class="ml-2" :class="{ 'opacity-25': !formOk }" :disabled="!formOk" @click="$emit('nextClicked', 'banner_copies')">
                Next
            </breeze-button>
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
import BackButton from "../BackButton";
import TitleUpdate from "../TitleUpdate";

export default {
    name: "AssetsBannerCopies",
    emits: [
        "nextClicked", "backClicked", "headlineUpdated", "bodyTextUpdated", "ctaUpdated",
    ],
    components: {
        TitleUpdate,
        BackButton,
        NavSteps,
        BannerPreview,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeSelect,
        BreezeTextarea,
    },
    data() {
        return {
            layout: null,
            headlineDemo: null,
            bodyTextDemo: null,
            headline: "",
            cta: "",
            bodyText: "",

            headlineEditable: false,
            ctaEditable: false,
            bodyTextEditable: false,

            headlineOverride: null,
            ctaOverride: null,
            bodyTextOverride: null,
        }
    },

    mounted() {
        document.getElementById('layout_intro_text').innerHTML = "<div>Please <b>select the copy for your Banner Image from the dropdown menus to the right</b>. Once you have selected your text options, you may use the edit button to make minor changes to the copy directly in the selection box. Pressing Cancel will reset the text to your original choice. Please keep in mind that font size and colors are not editable and there are character limits in place.</div>";

        // console.log(this.$parent.preSelected);

        const ps = this.$parent.preSelected;

        ['headline', 'bodyText', 'cta'].forEach(x => {
            if(this.$parent.banner[x]) {
                const override = this.$parent.banner[x].override;
                this[x] = this.$parent.banner[x].original;
                this.$nextTick(() => {
                    if(override) {
                        this[x + "Editable"] = true;
                        this[x + "Override"] = override;
                    }
                });
            } else if(ps && ps.banner && ps.banner[x]) {
                this[x] = ps.banner[x].original;
                this.$nextTick(() => {
                    if(ps.banner[x].override) {
                        this[x + "Editable"] = true;
                        this[x + "Override"] = ps.banner[x].override;
                    }
                })
            }
        });

        if(!this.headline || !this.sCloud.banner_headline.includes(this.headline)) {
            this.headline = this.sCloud.banner_headline[0];
        }

        if(!this.bodyText || !this.sCloud.banner_body.includes(this.bodyText)) {
            this.bodyText = this.sCloud.banner_body[0];
        }

        if(!this.cta || !this.$parent.copies.cta.includes(this.cta)) {
            this.cta = this.$parent.copies.cta[0];
        }

        // this.loadLayoutInfo();
    },

    watch: {

        headline(v) {
            this.headlineEditable = false;
            this.$emit("headlineUpdated", {original: v, override: null,});
        },

        headlineOverride(v) {
            this.$emit("headlineUpdated", {original: this.headline, override: v,});

        },

        bodyText(v) {
            this.bodyTextEditable = false;
            this.$emit("bodyTextUpdated", {original:v, override: null,});
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

            for(let k in this.sCloud.banner_headline) {
                list.push({
                    value: this.sCloud.banner_headline[k],
                    label: this.sCloud.banner_headline[k].strip,
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

            for(let k in this.sCloud.banner_body) {
                list.push({
                    value: this.sCloud.banner_body[k],
                    label: this.sCloud.banner_body[k],
                });
            }
            return list;
        },

        ctaSelect() {

            // let list = [{value: "", label: "Please Select ..."}];
            let list = []
            for(let k in this.$parent.copies.cta) {
                list.push({
                    value: this.$parent.copies.cta[k],
                    label: this.$parent.copies.cta[k],
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
