<template>
    <keep-session-alive :hash="hash"></keep-session-alive>
    <title-update title="Schedule Event"></title-update>
    <div class="mb-4">
        <h1 class="section-title" v-if="step === 'blog-interview'">Use the calendar below to schedule time with your Campaign Manager.</h1>
        <h1 class="section-title" v-else>Use the calendar below to schedule an asset review session with your Campaign Manager.</h1>
    </div>


    <breeze-validation-errors class="mb-4" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">

        <div class="calendly-container" id="calendar_container" v-show="!appointment_exists"></div>
        <div v-show="appointment_exists">
            <h1>You have already made an appointment!!</h1>
        </div>

        <div class="flex items-center justify-start mt-4 mb-4">
            <!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
            <!--                Forgot your password?-->
            <!--            </inertia-link>-->

            <breeze-button class="ml-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing || !appointment_has_been_set">
                Next
            </breeze-button>
        </div>

        <div><i>Be sure to click "<b>Schedule Event</b>" before you click "Next."</i></div>
    </form>

</template>

<script>
    import BreezeButton from '@/Components/Button'
    import PmcLayout from "@/Layouts/Pmc2"
    import BreezeInput from '@/Components/Input'
    import BreezeSelect from '@/Components/Select'
    import BreezeCheckbox from '@/Components/Checkbox'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'

    import Input from "../../Components/Input";
    import KeepSessionAlive from "../../Components/KeepSessionAlive";
    import TitleUpdate from "../../Components/TitleUpdate";

    export default {
        layout: PmcLayout,

        components: {
            TitleUpdate,
            KeepSessionAlive,
            Input,
            BreezeButton,
            BreezeInput,
            BreezeSelect,
            BreezeCheckbox,
            BreezeLabel,
            BreezeValidationErrors
        },

        props: {
            status: String,
            auth: Object,
            errors: Object,
            hash: String,
            calendlyUrl: String,
            path: String,
            step: String,
            inputData: Object,
        },

        remember: {
            data: ['form', 'appointment_exists', ],
            key: 'Pmc/Calendar',
        },

        data() {
            return {
                form: this.$inertia.form({
                    hash: this.hash,
                    event_details: null,
                    need_update: false,
                    step: this.step,
                }),
                appointment_exists: false, //this.inputData.appointment_exists,
                appointment_has_been_set: false,
            }
        },

        mounted() {
            document.getElementById('main_right_part').style.backgroundImage = '';
            document.getElementById('layout_intro_text').innerHTML = "<div>Please schedule an <b>appointment</b>.</div>";
            this.initCalendly();
        },

        updated() {
            this.form.step = this.step;
        },

        methods: {
            initCalendly() {

                const _cThis = this;

                (new Promise((resolve, reject) => {
                    if(typeof Calendly !== "undefined") {
                        resolve("Already Loaded");
                    } else {
                        console.log("Not Loaded, Loading");
                        let script = document.createElement('script');
                        script.onload = () => {
                            resolve("Loaded OK.");
                        };
                        script.async = true;
                        script.src = "https://assets.calendly.com/assets/external/widget.js";
                        document.head.appendChild(script);

                        window.addEventListener('message', _cThis.catchEvent);
                    }

                })).then(x => {
                    // console.log(x);
                    // console.log(typeof Calendly);

                    _cThis.createCalendar();
                });
            },

            createCalendar() {
                const container = document.getElementById("calendar_container");
                container.innerHTML = "";
                Calendly.initInlineWidget({
                    url: this.calendlyUrl,
                    parentElement: container,
                    prefill: {
                        name: this.inputData.name,
                        email: this.inputData.email,
                    },
                });
            },

            catchEvent(e) {

                if(e.data && e.data.event && "calendly.event_scheduled" === e.data.event) {
                    this.form.event_details = JSON.stringify(e.data.payload);
                    this.form.need_update = true;
                    this.appointment_has_been_set = true;
                }
                // console.log(e);
            },

            submit() {
                this.form.post('/pmc/calendar', {
                        onSuccess: page => {
                            if(this.form.need_update) {
                                // this.appointment_exists = true;
                            }
                            // this.hash = page.props.hash;
                        },
                    })
                // this.route('pmc.contact.submit')
            }
        },

        watch: {
            step(v) {
                console.log("Step :: ", v);
                if("initial-asset-review" === v) {
                    this.createCalendar();
                }
            },
        }
    }
</script>
<style scoped>
.calendly-container {
    min-width: 320px;
    height: 780px;
    overflow-y: hidden;
}

</style>
