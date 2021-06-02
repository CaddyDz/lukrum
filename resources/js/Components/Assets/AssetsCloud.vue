<template>
<div class="assets-logo mt-16 ml-12">
    <title-update title="Choose Your Cloud"></title-update>
    <back-button @link-clicked="$emit('backClicked', 'cloud')"></back-button>
    <nav-steps :step="3"></nav-steps>

    <div class="mr-6">
        <div class="mb-4">
            <h1 class="section-title">Choose Your Cloud</h1>

            <div class="cloud-selector mb-4">
<!--                <breeze-label for="cloud_select" value="Choose your cloud" />-->
                <breeze-select id="cloud_select" class="mt-1 block w-full" v-model="cloud" :options="cloudsSelect" required />
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
                :headline="headlineDemo"
                :body-text="bodyTextDemo"
                cta="Find Out How"
            ></banner-preview>
        </div>

        <div class="flex items-center start mt-8">
            <!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
            <!--                Forgot your password?-->
            <!--            </inertia-link>-->

            <breeze-button type="button" class="ml-2" :class="{ 'opacity-25': !formOk }" :disabled="!formOk" @click="$emit('nextClicked', 'cloud')">
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

export default {
    name: "AssetsCloud",
    emits: [
        "nextClicked", "backClicked", "cloudUpdated",
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
    },
    data() {
        return {
            layout: null,
            headlineDemo: null,
            bodyTextDemo: null,
            cloud: null,
        }
    },

    mounted() {
        document.getElementById('layout_intro_text').innerHTML = "<div>Please <b>Choose your cloud</b>. Your choice here will determine the focus of your available copy on the pages following.</div>";

        // console.log(this.$parent.preSelected);

        if(this.$parent.cloud) {
            this.cloud = this.$parent.cloud;
        } else if(this.$parent.preSelected) {
            const ps = this.$parent.preSelected;

            if(ps.cloud) {
                this.cloud = ps.cloud;
            }
        }

        if(!this.cloud) {
            this.cloud = "_empty_";
        }
    },

    watch: {

        cloud(v) {
            this.$emit("cloudUpdated", v);

            if(this.formOk) {
                this.headlineDemo = this.$parent.copies.clouds[v].banner_headline[0];
                this.$nextTick(() => {
                    this.bodyTextDemo =  this.$parent.copies.clouds[v].banner_body[0];
                });
            } else {
                this.headlineDemo = this.$parent.copies.clouds.analytics.banner_headline[0];
                this.$nextTick(() => {
                    this.bodyTextDemo =  this.$parent.copies.clouds.analytics.banner_body[0];
                });
            }

        },
    },

    computed: {
        formOk() {
            return this.cloud && '_empty_' !== this.cloud;
        },

        cloudsSelect() {

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
</style>
