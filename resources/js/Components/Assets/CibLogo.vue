<template>
<div class="assets-logo mt-16 ml-12">
    <title-update title="Choose Your Logo & Campaign Focus"></title-update>
    <back-button @link-clicked="$emit('backClicked', 'logo')"></back-button>
    <nav-steps :step="1"></nav-steps>
    <div class="mr-6">
        <div class="mb-4">
            <h1 class="section-title">Upload Your Logo*</h1>

            <div class="logo-selector-outer mt-6">
                <div class="m-2">
<!--                    <breeze-label for="logo_upload" value="*Upload File" />-->
                    <breeze-input id="logo_upload" type="file" class="mt-1 block w-full" ref="file_input" v-model="logoInput" :required="!hasFile" autofocus />


                    <div class="logo-preview my-6 flex justify-center">
                        <div class="logo-preview-outer ">
<!--                                        w-6/12-->
                            <div class="logo-preview-inner mr-4" v-show="!logoError">
                                <img :src="previewImage" alt="If you see this message, something wrong with your logo" />
                            </div>
                            <div class="logo-error" v-show="logoError">
                                <div v-text="logoError"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- <div class="mb-8 ">

            <h1 class="section-title">Campaign Focus*</h1>
            <div class="focus-selector mb-4">
                <breeze-select id="focus_select" class="mt-1 block w-full" v-model="focus" :options="focusesSelect" required />
            </div>
        </div> -->

        <!-- <div class="mb-4">
            <b>Campaign Focuses</b>:<br />
            <div v-for="f in $parent.copies.clouds">
                <b v-text="f.title"></b>: {{f.description}}<br /><br />
            </div>
        </div> -->


<!--        <hr />-->

<!--
        <div class="asset-example">
            <h1>BANNER PREVIEW</h1>

            <cib-preview
                ref="preview"
                width="250"
                height="500"
                :layout="$parent.layout"
                :logo="previewImage"
                :headline="headlineDemo"
                :body-text="bodyTextDemo"
                :cta="ctaDemo"
            ></cib-preview>
        </div>
-->

        <div class="flex items-center start mt-8">
            <!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
            <!--                Forgot your password?-->
            <!--            </inertia-link>-->

            <breeze-button type="button" class="ml-2" :class="{ 'opacity-25': !formOk }" :disabled="!formOk" @click="$emit('nextClicked', 'logo')">
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
import BannerPreview from "./BannerPreview";
import NavSteps from "./NavSteps";
import CibPreview from "./CibPreview";
import BackButton from "../BackButton";
import TitleUpdate from "../TitleUpdate";

export default {
    name: "CibLogo",
    emits: [
        "nextClicked", "backClicked",
        "logoUpdated", "logoPreviewUpdated", "layoutUpdated",
        "focusUpdated",
    ],
    components: {
        TitleUpdate,
        BackButton,
        CibPreview,
        NavSteps,
        BannerPreview,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeSelect,
    },
    data() {
        return {
            logoInput:null,
            hasFile: false,
            logoError: "Please choose an image",
            previewImage: null,

            focus: null,

            layout: null,
            headlineDemo: null,
            bodyTextDemo: "",
            ctaDemo: "",
        }
    },

    mounted() {

        document.getElementById('layout_intro_text').innerHTML = "<div><b>Customize your design.</b> Upload your company logo and select your campaign focus. Your logo should be a single color, transparent image file (png or svg) that's less than 5 MB in size.</div>";

        const ps = this.$parent.preSelected;

        if (this.$parent.previewImage) {
            this.hasFile = true;
            this.logoError = null;
            this.previewImage = this.$parent.previewImage;
        } else if (ps && ps.logo_url) {
            this.hasFile = true;
            this.logoError = null;
            this.previewImage = ps.logo_url;

            this.$emit("logoPreviewUpdated", ps.logo_url);
        }

        this.focus = "connect";
        // if(this.$parent.focus) {
        //     this.focus = this.$parent.focus;
        // } else if(ps && ps.focus) {
        //     this.focus = ps.focus;
        // }

        if(!this.focus) {
            this.focus = "_empty_";
        }


        this.$parent.$watch("copies", x => {
            this.ctaDemo = x.common.tp1.banner_cta[0];
        });
        // this.loadLayoutInfo();
    },

    watch: {
        logoInput: function(val) {
            if(!this.$refs.file_input) return;

            let input = this.$refs.file_input.$refs.input;
            let file = input.files;

            const _error = message => {
                this.logoError = message;
                this.$emit("logoUpdated", null);
                this.previewImage = "";
                this.hasFile = false;
                return false;
            }

            if (file && file[0]) {

                const f = file[0];

                if(f.size > 9437184) {
                    return _error("File too large, please reduce size to less than 5MB.");
                }

                if(!f.type.includes('image')) {
                    return _error("The selected file is not an image");
                }


                let reader = new FileReader();
                this.logoError = "Loading ... ";
                reader.onload = e => {
                    this.$emit("logoUpdated", f);
                    this.$emit("logoPreviewUpdated", e.target.result);

                    this.logoError = null;
                    this.previewImage = e.target.result;
                    this.hasFile = true;
                };
                reader.readAsDataURL(f);
            } else {
                return _error("Please choose an image file");
            }
        },

        focus(v) {
console.log("Focus", v);
            this.$emit("focusUpdated", v);

            if(!v || v === "_empty_") {
                this.bodyTextDemo = "";
            } else {
                this.bodyTextDemo = this.$parent.copies.clouds[v].tp1.banner_subhead[0];
            }
        }
    },

    computed: {
        formOk() {
            // this.focus = "inform";
            return this.focus && this.hasFile && this.focus !== "_empty_";
            // return this.hasFile;
        },

        focusesSelect() {

            let list = [{value: "_empty_", label: "Please Select ..."}];
            for(let k in this.$parent.copies.clouds) {
                list.push({
                    value: k,
                    label: this.$parent.copies.clouds[k].title,
                });
            }
            return list;
        },

    },

    methods: {
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

.images-consent {
    font-size: 0.8em;
}
</style>
