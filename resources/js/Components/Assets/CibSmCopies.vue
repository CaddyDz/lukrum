<template>
<div class="assets-banner-copies mt-16 ml-12">
    <title-update :title="chooseTitle + ' Social Media Copy'"></title-update>
    <back-button @link-clicked="$emit('backClicked', step)"></back-button>
    <nav-steps :step="2"></nav-steps>
    <div class="mr-6">
        <div class="mb-4">
            <h1 class="section-title">Choose Your {{chooseTitle}} Social Media Copy</h1>

<!--            <h1 class="section-title my-4">Social Media</h1>-->
            <div class="headline-selector mb-4 mt-1" v-show="!subheadEditable">
                <breeze-label for="sm_headline_select" class="select-label" value="Subheading"></breeze-label>
                <breeze-select id="sm_headline_select" class="inline-block w-9/12 mb-2" v-model="subhead" :options="subheadSelect" required />
                <breeze-button type="button" class="ml-2 edit-button" @click="editSubhead" :disabled="!subhead">Edit</breeze-button>
            </div>

            <div class="headline-edit mb-4 mt-1" v-show="subheadEditable">
                <breeze-label for="sm_headline_override" class="select-label" value="Subheading"></breeze-label>
                <breeze-input id="sm_headline_override" type="text" class="w-9/12 mb-2" v-model="subheadOverride"></breeze-input>
                <breeze-button type="button" class="ml-2 edit-button" @click="cancelEditSubhead">Cancel</breeze-button>
            </div>

            <div class="cta-selector mb-4 mt-1" v-show="!ctaEditable">
                <breeze-label for="sm_cta_select" class="select-label" value="Call to Action"></breeze-label>
                <breeze-select id="sm_cta_select" class="inline-block w-9/12 mb-2" v-model="cta" :options="ctaSelect" required />
                <breeze-button type="button" class="ml-2 edit-button" @click="editCta" :disabled="!cta">Edit</breeze-button>
            </div>

            <div class="body-text-edit mb-4 mt-1" v-show="ctaEditable">
                <breeze-label for="sm_cta_override" class="select-label" value="Call to Action"></breeze-label>
                <breeze-input id="sm_cta_override" type="text" class="w-9/12 mb-2" rows="6" v-model="ctaOverride" maxlength="26"></breeze-input>
                <breeze-button type="button" class="ml-2 edit-button" @click="cancelEditCta">Cancel</breeze-button>
            </div>

        </div>

<!--        <hr />-->

        <div class="asset-example mt-16">
            <h1>SOCIAL MEDIA PREVIEW</h1>
            <cib-preview
                ref="preview"
                width="400"
                height="195"
                :layout="$parent.layoutSm"
                :logo="$parent.previewImage"
                headline=""
                :body-text="subheadPreview"
                :cta="ctaPreview"
            ></cib-preview>
        </div>

        <!--                :overlay="$parent.previewOverlay"-->
        <!--                :color="$parent.color"-->
<!--        <assets-banner-list></assets-banner-list>-->


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
</template>

<script>
import BreezeButton from '@/Components/Button'
import BreezeInput from '@/Components/Input'
import BreezeSelect from '@/Components/Select'
import BreezeLabel from '@/Components/Label'
import BreezeTextarea from '@/Components/InputTextArea'
import BannerPreview from "./BannerPreview";
import NavSteps from "./NavSteps";
import CibPreview from "./CibPreview";
import BackButton from "../BackButton";
import TitleUpdate from "../TitleUpdate";

// import AssetsBannerList from "./AssetsBannerList";

export default {
    name: "CibSmCopies",
    emits: [
        "nextClicked", "backClicked",
        "subheadUpdated", "ctaUpdated",
    ],
    props: [
        "chooseTitle", "selector", "step",
    ],

    components: {
        TitleUpdate,
        BackButton,
        CibPreview,
        NavSteps,
        // AssetsBannerList,
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

            subhead: "",
            subheadEditable: false,
            subheadOverride: null,
            cta: "",
            ctaEditable: false,
            ctaOverride: null,
        }
    },

    mounted() {
        document.getElementById('layout_intro_text').innerHTML = "<div>Please <b>select the copy for your " + this.chooseTitle + " Social Media Image from the dropdown menus to the right</b>. Once you have selected your text options, you may use the edit button to make minor changes to the copy directly in the selection box. Pressing Cancel will reset the text to your original choice. Please keep in mind that font size and colors are not editable and there are character limits in place.</div>";

        const ps = this.$parent.preSelected;

        [{v:"subhead", p:"sm_body"}, {v:"cta", p: "sm_cta"}].forEach(x => {
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

        if(!this.subhead || !this.sCloud.sm_subhead.includes(this.subhead)) {
            this.subhead = this.sCloud.sm_subhead[0];
        }

        if(!this.cta || !this.$parent.copies.common[this.selector].sm_cta.includes(this.cta)) {
            this.cta = this.$parent.copies.common[this.selector].sm_cta[0];
        }
    },

    watch: {

        subhead(v) {
            this.subheadEditable = false;
            this.$emit("subheadUpdated", {original: v, override: null,});
        },

        subheadOverride(v) {
            this.$emit("subheadUpdated", {original: this.subhead, override: v,});

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
            return this.subhead && this.cta;
        },

        sCloud() {
            return this.$parent.copies.clouds[this.$parent.focus][this.selector];
        },

        subheadPreview() {
            return this.subheadEditable ? this.subheadOverride : this.subhead;
        },

        ctaPreview() {
            return this.ctaEditable ? this.ctaOverride : this.cta;
        },


        subheadSelect() {
            // return [];
            let list = [];
            if(!this.sCloud) {
                list.push({
                    value: "",
                    label: "Select Focus",
                })
                return list;
            }

            const a = this.sCloud.sm_subhead;
            for(let k in a) {
                list.push({
                    value: a[k],
                    label: a[k],//.strip,
                });
            }
            return list;
        },

        ctaSelect() {

            // let list = [{value: "", label: "Please Select ..."}];
            let list = [];
            const a = this.$parent.copies.common[this.selector].sm_cta;
            for(let k in a) {
                list.push({
                    value: a[k],
                    label: a[k],
                });
            }
            return list;
        },


    },

    methods: {
        editSubhead() {
            this.subheadOverride = this.subhead;
            this.subheadEditable = true;
        },

        cancelEditSubhead() {
            this.subheadOverride = null;
            this.subheadEditable = false;
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
