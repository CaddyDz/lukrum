<template>
    <form @submit.prevent="submit">
        <keep-session-alive :hash="hash"></keep-session-alive>

        <cib-main v-if="inputData.path === 'cib'" :pre-selected="inputData" :hash="hash" @data-collected="dataCollected"></cib-main>
        <assets-main v-else :pre-selected="inputData" :hash="hash" @data-collected="dataCollected"></assets-main>

<!--        <div class="flex items-center justify-end mt-4">-->
            <!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
            <!--                Forgot your password?-->
            <!--            </inertia-link>-->

<!--            <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">-->
<!--                Next &gt;&gt;-->
<!--            </breeze-button>-->
<!--        </div>-->

    </form>


</template>

<script>
    import PmcLayout from "@/Layouts/Pmc2"

    import AssetsMain from "../../Components/Assets/AssetsMain";
    import CibMain from "../../Components/Assets/CibMain";
    import KeepSessionAlive from "../../Components/KeepSessionAlive";

    export default {
        layout: PmcLayout,

        components: {
            KeepSessionAlive,
            CibMain,
            AssetsMain,
        },

        props: {
            status: String,
            auth: Object,
            errors: Object,
            hash: String,
            inputData: Object,
            assets: Array,

        },

        remember: {
            data: ['form', 'mountsCount', ],
            key: 'Pmc/Assets',
        },


        data() {
            return {
                form: this.$inertia.form({
                    // asset_color: this.inputData.asset_color,
                    logo: '',
                    asset_id: this.inputData.asset_id,
                    hash: this.hash,
                }),
                mountsCount: 0,
            }
        },

        mounted() {
            document.getElementById('main_right_part').style.backgroundImage = '';
            this.mountsCount++;

            if(1 < this.mountsCount) {
                this.$inertia.reload({only: ["inputData",]});
            }
            if(this.inputData.path === "cib") {
                document.getElementById('layout_intro_text').innerHTML = "<div><b>Customize your design.</b> Upload your company logo and select your campaign focus. Your logo should be a single color, transparent image file (png or svg) that's less than 5 MB in size.<br /><br /></div>";
            } else {
                document.getElementById('layout_intro_text').innerHTML = "<div>Next, <b>please choose one design layout option for the look and feel of your campaign</b>. For design options 3 and 4, you'll be able to replace the stock photo that’s currently shown with an image that better represents your individual business. For option 5, you can choose from a series of graphics and icons that will appear below your logo to better support your messaging.</div>";
            }
        },

        methods: {

            dataCollected(data) {
                data.hash = this.hash;
                this.$inertia.post('/pmc/assets', data, {
                    // forceFormData: true,
                    onFinish: (x) => {
                    }
                });
            },

            submit() {

            },
        },

    }
</script>
