<template>
    <div class="ml-16 mr-20">

    <form @submit.prevent="submit">
        <div class="mb-4 mt-40 ml-2">
            <h1 class="section-title">Additional Comments</h1>
        </div>

        <div class="m-2">
<!--                    <breeze-label for="firstName" value="*First Name" />-->
            <breeze-text-area id="comments" type="text" class="mt-1 block w-full" v-model="form.comments" placeholder="Write Additional Comments" autofocus />
        </div>



        <div class="flex items-center justify-start mt-4">
<!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
<!--                Forgot your password?-->
<!--            </inertia-link>-->

            <breeze-button class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Next
            </breeze-button>
        </div>
    </form>
    <div class="mb-40"></div>
    </div>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import PmcLayout from "@/Layouts/Pmc2"
    import BreezeInput from '@/Components/Input'
    import BreezeSelect from '@/Components/Select'
    import BreezeTextArea from '@/Components/InputTextArea'
    // import BreezeCheckbox from '@/Components/Checkbox'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'

    import UsStates from '@/tools/states'
    // import Input from "../../Components/Input";

    export default {
        layout: PmcLayout,

        components: {
            // Input,
            BreezeButton,
            BreezeInput,
            BreezeSelect,
            // BreezeCheckbox,
            BreezeLabel,
            BreezeTextArea,
            BreezeValidationErrors
        },

        props: {
            status: String,
            auth: Object,
            errors: Object,
            inputHash: String,
            inputData: Object,
        },

        remember: {
            data: ['hash', 'form', ],
            key: 'Pmc/Comments',
        },

        mounted() {
            document.getElementById('layout_intro_text').innerHTML = "<div>Finally, please <b>provide any additional notes</b> that could potentially be beneficial to your campaign manager and enter your anticipated campaign launch date.</div>";
        },

        data() {
            return {
                form: this.$inertia.form({
                    comments: this.inputData.comments,
                    launch_date: this.inputData.launch_date,
                    launch_time: this.inputData.launch_time,
                }),
                hash: this.inputHash,
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        hash: this.hash,
                    }))
                    .post('/pmc/contact', {
                        onSuccess: page => {
                            this.hash = page.props.hash;
                        },
                    })
                // this.route('pmc.contact.submit')
            }
        }
    }
</script>
