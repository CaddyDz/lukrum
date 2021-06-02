<template>
    <div class="min-h-screen flex flex-col items-center py-6 sm:py-0 bg-gray-100">
        <div class="w-full sm:max-w-6xl my-6 bg-white shadow-md min-h-full layout-container" id="layout_container" v-if="instance">
            <div class="layout-left-part pl-28 pr-20 pt-20 pb-20" id="main_left_part">
                <div class="app-logo-container">
                    <breeze-application-logo></breeze-application-logo>
                </div>
                <div class="layout-main-title mt-10" v-html="instance.headerHtml"></div>
                <div class="wunderman-thompson mt-2" v-html="instance.subHeaderHtml"></div>
                <div id="layout_intro_text" class="layout-intro-text mt-10 pr-20 mb-10">
                    <div>
                        This website will help you build assets for your marketing campaign. <b>Before you begin, please be sure to review the Partner Welcome Guide</b>. It is essential that you gather all the listed assets and write answers to the questions related to your program before you sign in. Gathering all the required information in advance will help ensure you build the best campaign possible.
                    </div>
                </div>

                <div class="left-part-footer" v-html="instance.footerHtml"></div>
            </div>
            <div class="layout-right-part px-6 py-4" id="main_right_part">
                <slot />
            </div>
        </div>
    </div>
</template>

<script>
    import BreezeApplicationLogo from '@/Components/ApplicationLogo'
    import instanceLoader from '../tools/instance';

    export default {
        components: {
            BreezeApplicationLogo,
        },
        data() {
            return {
                instance: null,
            }
        },
        async mounted() {
            this.instance = await instanceLoader();
        },
    }
</script>
