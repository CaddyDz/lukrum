<template>
    <keep-session-alive :hash="hash"></keep-session-alive>
    <title-update title="Thank You!"></title-update>
    <div class="ml-16 mr-20 mt-40">

    <form @submit.prevent="submit">

        <h1 class="section-title mb-4">Thank You!</h1>
        <div>
            <div v-if="instance" v-html="instance.textBody.thank_you"></div>
            <br /><br />
            If you have any questions, please send a message to <a href="mailto:help@lukrum.com">help@lukrum.com</a>.
        </div>

    </form>
    </div>

</template>

<script>
    import BreezeButton from '@/Components/Button'
    import PmcLayout from "@/Layouts/Pmc2"
    import BreezeInput from '@/Components/Input'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'
    import KeepSessionAlive from "../../Components/KeepSessionAlive";
    import TitleUpdate from "../../Components/TitleUpdate";

    import instanceLoader from "../../tools/instance";

    export default {
        layout: PmcLayout,

        components: {
            TitleUpdate,
            KeepSessionAlive,
            // Input,
            BreezeButton,
            BreezeInput,
            // BreezeSelect,
            // BreezeCheckbox,
            BreezeLabel,
            BreezeValidationErrors
        },

        props: {
            status: String,
            auth: Object,
            errors: Object,
            hash: String,
            inputData: Object,
        },

        remember: {
            data: ['form', ],
            key: 'Pmc/ThankYou',
        },


        data() {
            return {
                form: this.$inertia.form({
                    // asset_color: this.inputData.asset_color,
                    hash: this.hash,
                }),
                instance: null,
            }
        },

        async mounted() {
            this.instance = await instanceLoader();
            document.getElementById('main_right_part').style.backgroundImage = '';
            document.getElementById('layout_intro_text').innerHTML = "<div>Finally, <b>Thank You!</div>";
        },

        methods: {
            submit() {
                // return;
            }
        },

    }
</script>

<style scoped>
.asset-example h1 {
    text-align: center;
    font-weight: bold;
}
</style>
