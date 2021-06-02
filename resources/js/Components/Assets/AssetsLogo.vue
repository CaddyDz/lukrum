<template>
<div class="assets-logo mt-16 ml-12">
    <title-update title="Upload Your Logo"></title-update>
    <div class="mr-6">
        <div class="mb-4">
            <back-button @link-clicked="$emit('backClicked', 'logo')"></back-button>
            <nav-steps :step="2"></nav-steps>

            <h1 class="section-title" v-text="'Upload Your Logo' + (hasOverlay ? ' and Image' : '')"></h1>


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

            <div v-if="hasOverlay" class="mt-6">
                <div class="logo-selector-outer mt-6">
                    <div class="m-2">
                        <!--                    <breeze-label for="logo_upload" value="*Upload File" />-->
                        <breeze-input id="overlay_upload" type="file" class="mt-1 block w-full" ref="overlay_input" v-model="overlayInput" />


                        <div class="logo-preview my-6 flex justify-center">
                            <div class="logo-preview-outer ">
                                <!--                                        w-6/12-->
<!--                                <div class="logo-preview-inner mr-4" v-show="!logoError">-->
<!--                                    <img :src="previewImage" alt="If you see this message, something wrong with your logo" />-->
<!--                                </div>-->
                                <div class="logo-error" v-show="overlayError">
                                    <div v-text="overlayError"></div>
                                </div>
                                <div class="images-consent" v-if="hasFileOverlay && !overlayError">
                                    By uploading this image, I certify that I have obtained all necessary usage rights.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div v-if="$parent.layout.color_changeable && color">
                <h1 class="section-title mt-8">Enter Your Primary Color</h1>
                <div class="color-selector-outer mt-2 mb-6">
                    <color-picker v-model="color"></color-picker>
                </div>
            </div>

        </div>

        <hr />

        <div class="asset-example">
            <h1>BANNER PREVIEW</h1>
            <banner-preview
                ref="preview"
                width="250"
                height="500"
                :layout="layout"
                :logo="previewImage"
                :color="color"
                :headline="headlineDemo"
                :body-text="bodyTextDemo"
                :overlay="previewOverlay"
                cta="Find Out How"
            ></banner-preview>
        </div>

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
import BackButton from "../BackButton";
import TitleUpdate from "../TitleUpdate";
import ColorPicker from "../ColorPicker";

export default {
    name: "AssetsLogo",
    emits: [
        "nextClicked", "backClicked",
        "logoUpdated", "logoPreviewUpdated", "overlayUpdated", "overlayPreviewUpdated",
        "colorUpdated", "layoutUpdated",
    ],
    components: {
        ColorPicker,
        TitleUpdate,
        BackButton,
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

            color: null,
            layout: null,
            headlineDemo: null,
            bodyTextDemo: null,

            hasOverlay: false,
            overlayInput: null,
            hasFileOverlay: false,
            overlayError: "Please choose an image",
            previewOverlay: null,
        }
    },

    mounted() {

        this.hasOverlay = this.$parent.layout.has_overlay;

        if (this.hasOverlay) {
            if (this.$parent.layout.code === "Blue") {
                document.getElementById('layout_intro_text').innerHTML = "<div>Customize your design. <b>Upload your company logo (required) and decorative icon (optional)</b>. Your logo should be a single color, transparent image file (png or svg). If you choose to replace the decorative icon, please upload a single color, transparent image file (png or svg) that has a 1:4 height:width ratio. Both image files should be less than 5 MB in size.</div>";
            } else {
                document.getElementById('layout_intro_text').innerHTML = "<div>Customize your design. <b>Upload your company logo, your image and select your primary branding color</b>. Your logo/image should be an image file (png, jpg, svg) that's less than 5 MB in size.</div>";
            }
        } else {
            document.getElementById('layout_intro_text').innerHTML = "<div>Customize your design. <b>Upload your company logo and select your primary branding color</b>. Your logo should be an image file (png, jpg, svg) that's less than 5 MB in size.</div>";
        }

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

        if (this.hasOverlay) {
            if (this.$parent.previewOverlay) {
                this.hasFileOverlay = true;
                this.overlayError = null;
                this.previewOverlay = this.$parent.previewOverlay;
            } else if (ps && ps.overlay_url) {
                this.hasFileOverlay = true;
                this.overlayError = null;
                this.previewOverlay = ps.overlay_url;

                this.$emit("overlayPreviewUpdated", ps.overlay_url);
            }
        }

        if (this.$parent.layout.color_changeable) {
            if (this.$parent.color) {
console.log("a",this.$parent.color);
                this.color = this.$parent.color;
            } else if(ps && ps.color) {
console.log("b",ps.color);
                this.color = ps.color;
            }

        }

        if(!this.color) {
            this.color = this.$parent.layout.default_color;
        }
        this.loadLayoutInfo();
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

        overlayInput(f) {
            if(!this.$refs.overlay_input) return;

            let input = this.$refs.overlay_input.$refs.input;
            let file = input.files;

            const _error = message => {
                this.overlayError = message;
                this.$emit("overlayUpdated", null);
                this.previewOverlay = "";
                this.hasFileOverlay = false;
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
                this.overlayError = "Loading ... ";
                reader.onload = e => {
                    this.$emit("overlayUpdated", f);
                    this.$emit("overlayPreviewUpdated", e.target.result);

                    this.overlayError = null;
                    this.previewOverlay = e.target.result;
                    this.hasFileOverlay = true;
                };
                reader.readAsDataURL(f);
            } else {
                return _error("Please choose an image file");
            }


        },

        color(v) {
            if(/^#[0-9a-f]{6}$/i.test(v)) {
                this.$emit("colorUpdated", v);
            }
        },
    },

    computed: {
        formOk() {
            return this.color && this.hasFile;
        },
    },

    methods: {
        async loadLayoutInfo() {
            this.layout = (await axios.get("/pmc/api/layouts/" + this.$parent.layout.code + "/image/large_rectangle")).data;
            // this.layout = (await axios.get("/pmc/api/layouts/" + this.$parent.layout.code + "/image/sky_scrapper")).data;

            this.$emit("layoutUpdated", this.layout);

            if(this.hasOverlay) {
                if(!this.previewOverlay) {
                    this.previewOverlay = "default";
                    this.$emit("overlayPreviewUpdated", this.previewOverlay);
                }
            }


            this.headlineDemo = this.$parent.copies.clouds.analytics.banner_headline[0];
            await this.$nextTick(() => {
               this.bodyTextDemo =  this.$parent.copies.clouds.analytics.banner_body[0];
            });
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

.images-consent {
    font-size: 0.8em;
}
</style>
