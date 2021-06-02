<template>
<div class="assets-logo mt-16 ml-12">
    <title-update title="Profile Picture"></title-update>
    <back-button @link-clicked="$emit('backClicked', 'profile')"></back-button>
    <nav-steps :step="5"></nav-steps>
    <div class="mr-6">
        <div class="mb-4">
            <h1 class="section-title">Expert's Profile Picture</h1>

            <div class="logo-selector-outer mt-6">
                <div class="m-2">
<!--                    <breeze-label for="logo_upload" value="*Upload File" />-->
                    <breeze-input id="profile_upload" type="file" class="mt-1 block w-full" ref="file_input" v-model="profileInput" :required="!hasFile" autofocus />


                    <div class="logo-preview my-6 flex justify-center">
                        <div class="logo-preview-outer ">
<!--                                        w-6/12-->
                            <div class="logo-preview-inner mr-4" v-show="!profileError">
                                <img :src="previewImage" alt="If you see this message, something wrong with your logo" />
                            </div>
                            <div class="logo-error" v-show="profileError">
                                <div v-text="profileError"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="expert-name-edit mb-4 mt-1">
                    <breeze-label for="expert_name" class="select-label" value="Expert's Name"></breeze-label>
                    <breeze-input id="expert_name" type="text" class="w-9/12 mb-2" rows="6" v-model="expertName" placeholder="Expert's Name"></breeze-input>
                </div>

                <div class="expert-title-edit mb-4 mt-1">
                    <breeze-label for="expert_title" class="select-label" value="Expert's Title"></breeze-label>
                    <breeze-input id="expert_title" type="text" class="w-9/12 mb-2" rows="6" v-model="expertTitle" placeholder="Expert's Title"></breeze-input>
                </div>


            </div>

        </div>

        <div class="flex items-center start mt-8">
            <!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
            <!--                Forgot your password?-->
            <!--            </inertia-link>-->

            <breeze-button type="button" class="ml-2" :class="{ 'opacity-25': !formOk }" :disabled="!formOk" @click="$emit('nextClicked', 'profile')">
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
import NavSteps from "./NavSteps";
import BackButton from "../BackButton";
import TitleUpdate from "../TitleUpdate";

export default {
    name: "CibProfile",
    emits: ["nextClicked", "backClicked", "profileUpdated", "profilePreviewUpdated", "expertNameUpdated", "expertTitleUpdated", ],
    components: {
        TitleUpdate,
        BackButton,
        NavSteps,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeSelect,
    },
    data() {
        return {
            profileInput:null,
            hasFile: false,
            profileError: "Please choose an image",
            previewImage: null,
            expertName: null,
            expertTitle: null,
        }
    },

    mounted() {

        document.getElementById('layout_intro_text').innerHTML = "<div>Please provide your <b>expert's name, title, and profile photo</b>. Your image should be file (png, jpg, svg) that's less than 5 MB in size.</div>";

        const ps = this.$parent.preSelected;

        if (this.$parent.previewProfile) {
            this.hasFile = true;
            this.profileError = null;
            this.previewImage = this.$parent.previewProfile;
        } else if (ps && ps.profile_url) {
            this.hasFile = true;
            this.profileError = null;
            this.previewImage = ps.profile_url;

            this.$emit("profilePreviewUpdated", ps.profile_url);
        }

        if(this.$parent.expertName) {
            this.expertName = this.$parent.expertName;
        } else if(ps && ps.expertName) {
            this.expertName = ps.expertName;
        }

        if(this.$parent.expertTitle) {
            this.expertTitle = this.$parent.expertTitle;
        } else if(ps && ps.expertTitle) {
            this.expertTitle = ps.expertTitle;
        }

    },

    watch: {
        profileInput: function(val) {
            if(!this.$refs.file_input) return;

            let input = this.$refs.file_input.$refs.input;
            let file = input.files;

            const _error = message => {
                this.profileError = message;
                this.$emit("profileUpdated", null);
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
                    this.$emit("profileUpdated", f);
                    this.$emit("profilePreviewUpdated", e.target.result);

                    this.profileError = null;
                    this.previewImage = e.target.result;
                    this.hasFile = true;
                };
                reader.readAsDataURL(f);
            } else {
                return _error("Please choose an image file");
            }
        },

        expertName(v) {
            this.$emit("expertNameUpdated", v);
        },

        expertTitle(v) {
            this.$emit("expertTitleUpdated", v);
        },
    },

    computed: {
        formOk() {
            return this.hasFile && this.expertName && this.expertTitle;
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
