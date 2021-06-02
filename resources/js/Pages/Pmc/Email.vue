<template>
    <keep-session-alive :hash="inputHash"></keep-session-alive>
    <title-update title="Partner's Email"></title-update>
    <div class="pl-16">
        <form @submit.prevent="submit">
            <div class="flex justify-end mt-8 lang-container mr-4" v-if="instance && instance.elements.language">
                <breeze-select v-model="form.lang" :options="languages"></breeze-select>
            </div>
            <div v-else class="mt-12">&nbsp;</div>

            <div class="mt-36">
                <h1 class="section-title">Enter Your Email Address</h1>
            </div>


            <div class="w-9/12">
                    <div class="ml-0">
                        <breeze-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required  placeholder="Email Address *" />
                    </div>
            </div>
            <div class="w-9/12 mt-4" v-if="instance && instance.passwordProtected">
                    <div class="ml-0">
                        <breeze-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required  placeholder="Password *" />
                    </div>
            </div>


            <div class="flex items-center justify-start mt-6">
    <!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
    <!--                Forgot your password?-->
    <!--            </inertia-link>-->

                <breeze-button class="ml-1" :class="{ 'opacity-25': form.processing }" :disabled="emailNotFound || form.processing">
                    Next
                </breeze-button>
            </div>

            <div class="mt-6 email-not-found mr-32" v-if="emailNotFound">
                <div class="emf-title">This email address is not approved for access.</div>
                <div class="emf-body mt-2 mr-6">Please contact <a href="mailto:help@lukrum.com">help@lukrum.com</a> to get access to the Digital Marketing Services Campaign Builder.</div>
            </div>
        </form>

        <div class="modal absolute w-full h-full top-0 left-0 flex items-center justify-center" :class="{'opacity-0': !showLangModal, 'pointer-events-none': !showLangModal, }">
            <div class="modal-overlay absolute w-full h-full bg-black opacity-25 top-0 left-0 cursor-pointer" @click="showLangModal=false"></div>
            <div class="absolute w-4/12 bg-white rounded-sm shadow-lg flex items-center justify-center text-2xl ml-20">
                <div class="close-link" @click="showLangModal=false">x</div>
                <div class="p-16">
                    <h1 class="mb-8">Guiding Text Language</h1>
                    <div class="modal-copy">
                        The guiding text within Salesforce Digital Marketing Services Campaign Builder is in English,
                        <b>but your assets will be translated to the language of your choice</b>.
                        In order to customize your experience, please feel free to edit your text in either
                        English or the language you selected.
                    </div>
                </div>
            </div>
        </div>

        <div class="modal absolute w-full h-full top-0 left-0 flex items-center justify-center" :class="{'opacity-0': !showMobileModal, 'pointer-events-none': !showMobileModal, }">
            <div class="modal-overlay absolute w-full h-full bg-black opacity-25 top-0 left-0 cursor-pointer" @click="showMobileModal=false"></div>
            <div class="absolute w-8/12 bg-white rounded-sm shadow-lg flex items-center justify-center text-2xl">
                <div class="close-link" @click="showMobileModal=false">x</div>
                <div class="px-8 py-16">
<!--                    <h1 class="mb-8">Guiding Text Language</h1>-->
                    <div class="modal-copy">
                        We recommend <b>using a desktop or laptop</b> computer to ensure you have the optimal experience using Lukrum.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import PmcLayout from "@/Layouts/Pmc2"
    import BreezeInput from '@/Components/Input'
    import BreezeSelect from '@/Components/Select'
    import BreezeValidationErrors from '@/Components/ValidationErrors'
    import KeepSessionAlive from "../../Components/KeepSessionAlive";
    import TitleUpdate from "../../Components/TitleUpdate";
    import instanceLoader from "../../tools/instance";

    export default {
        layout: PmcLayout,

        components: {
            TitleUpdate,
            KeepSessionAlive,
            BreezeButton,
            BreezeInput,
            BreezeSelect,
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
            key: 'Pmc/Email',
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: this.inputData.email,
                    password: "",
                    lang: this.inputData.lang,
                }),
                oldLang: this.inputData.lang,
                hash: this.inputHash,
                emailNotFound: false,

                showLangModal: false,
                showMobileModal: false,

                languages: [
                    {value:"eng", label:"English"},
                    {value:"fra", label:"French"},
                    {value:"deu", label:"German"},
                    {value:"esp_eur", label:"Spanish (Europe)"},
                    {value:"esp_lat", label:"Spanish (LATAM)"},
                ],

                instance: null,
            }
        },

        async mounted() {
            this.instance = await instanceLoader();
// console.log("Email mounted");
//             document.getElementById('main_right_part').style.backgroundImage = 'url(' + this.instance.emailBgUrl + ')';
            document.getElementById('layout_container').classList.add('page-email');
            //layout-right-part px-6 py-4

            // document.getElementById('layout_intro_text').innerHTML = "<div>This website will show you how to build valuable assets for your marketing campaign. <b>Before you begin, please be sure to review the <a href=\"#\">Partner Welcome Guide</a></b> so you have all the required information to build the best campaign.</div>";
            document.getElementById('layout_intro_text').innerHTML = this.instance.textBody.email_left;

            if(!this.form.lang) {
                this.form.lang = this.languages[0].value;
            }

            if(window.innerWidth < 768) {
                this.showMobileModal = true;
            }

        },
        unmounted() {
            document.getElementById('layout_container').classList.remove('page-email');
        },

        watch: {
            "form.email": {
                handler(v) {
                    this.emailNotFound = false;
                }
            },

            "form.lang": {
                handler(v) {
                    if(!this.oldLang) {
                        this.oldLang = v;
                        return;
                    }
                    if(this.oldLang === v) return;
                    this.showLangModal = true;
                },
            }
        },

        methods: {
            async submit() {

                const emailStatus = (await axios.post('/pmc/test_email', {
                    email: this.form.email,
                })).data

                if(emailStatus.ok) {

                    if(window.analytics) {
                        await window.analytics.identify({
                            email: this.form.email,
                        });
                    }


                    this.form
                        .transform(data => ({
                            ... data,
                            hash: this.hash,
                        }))
                        .post('/pmc/email', {
                            onSuccess: page => {
                                this.hash = page.props.hash;
                            },
                        });
                } else {
                    this.emailNotFound = true;
                }
            }
        }
    }
</script>

<style scoped>

.lang-container select {
    font-size: 0.8em;
    padding: 7px 27px 7px 15px;
}

.modal {
    transition: opacity 0.25s ease;
}

.modal h1 {
    font-family: ITCAvantGardeDemi, Arial, Helvetica, sans-serif;
    font-size: 18pt;
    font-weight: bold;
    color: #032e61;
}
.modal .modal-copy {
    font-family: SalesforceSansRegular, Arial, Helvetica, sans-serif;
    font-size: 14pt;
    line-height: 1.3em;
}

.modal .close-link {
    position:absolute;
    top:10px;
    right:10px;
    padding: 2px 10px;
    cursor: pointer;
    color: #9a8f87;
}
</style>
