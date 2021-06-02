<template>
    <keep-session-alive :hash="inputHash"></keep-session-alive>
    <title-update title="Contact Info"></title-update>
    <div class="ml-16 mr-20">
    <div class="mb-4 mt-40 ml-2">
        <h1 class="section-title">Contact Information</h1>
    </div>


    <form @submit.prevent="submit">
        <div class="required-fields my-4">* Required Field</div>

        <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="m-2">
<!--                    <breeze-label for="firstName" value="*First Name" />-->
                    <breeze-input id="firstName" type="text" class="mt-1 block w-full" v-model="form.first_name" placeholder="First Name *" required autofocus />
                </div>

                <div class="m-2">
<!--                    <breeze-label for="lastName" value="*Last Name" />-->
                    <breeze-input id="lastName" type="text" class="mt-1 block w-full" v-model="form.last_name" required placeholder="Last Name *" />
                </div>

                <div class="m-2 col-span-2">
<!--                    <breeze-label for="company" value="*Company" />-->
                    <breeze-input id="company" type="text" class="mt-1 block w-full" v-model="form.company" required placeholder="Company *" />
                </div>

                <div class="m-2 col-span-2">
<!--                    <breeze-label for="jobTitle" value="*Job Title" />-->
                    <breeze-input id="jobTitle" type="text" class="mt-1 block w-full" v-model="form.job_title" placeholder="Title" />
                </div>

                <div class="m-2 col-span-2">
<!--                    <breeze-label for="email" value="*Email Address" />-->
                    <breeze-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" disabled readonly />
                </div>

                <div class="m-2 col-span-2">
<!--                    <breeze-label for="phone" value="Phone Number" />-->
                    <breeze-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required placeholder="Phone Number *" />
                </div>

                <div class="m-2">
<!--                    <breeze-label for="country" value="*Country" />-->
                    <breeze-input id="country" type="text" class="mt-1 block w-full" v-model="form.country" required placeholder="Country *" />
                </div>

                <div class="m-2">
<!--                    <breeze-label for="state" value="State / Province" />-->
                    <breeze-input id="city" type="text" class="mt-1 block w-full" v-model="form.city" required placeholder="City *" />
                </div>
                <div class="m-2">
<!--                    <breeze-label for="state" value="State / Province" />-->
                    <breeze-input id="state" type="text" class="mt-1 block w-full" v-model="form.state" required placeholder="State/Province *" />
                </div>
                <div class="m-2">
<!--                    <breeze-label for="state" value="State / Province" />-->
                    <breeze-input id="zip_code" type="text" class="mt-1 block w-full" v-model="form.zip_code" required placeholder="Zip/Postal Code *" />
                </div>
            <div class="m-2 col-span-2">
                <!--                    <breeze-label for="country" value="*Country" />-->
                <breeze-input id="address" type="text" class="mt-1 block w-full" v-model="form.address" required placeholder="Mailing Address *" />
            </div>
            <div class="m-2 col-span-2">
                <!--                    <breeze-label for="country" value="*Country" />-->
                <breeze-input id="company_url" type="text" class="mt-1 block w-full" v-model="form.company_url" placeholder="Company URL" />
            </div>
<!--            <div class="m-2 col-span-2">-->
                <!--                    <breeze-label for="email" value="*Email Address" />-->
<!--                <breeze-input id="navigator_level" type="text" class="mt-1 block w-full" v-model="form.navigator_level" disabled readonly />-->
<!--            </div>-->
            <div class="m-2 col-span-2">
                <!--                    <breeze-label for="email" value="*Email Address" />-->
                <breeze-input id="program" type="text" class="mt-1 block w-full" v-model="form.program" disabled readonly />
            </div>

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
            BreezeButton,
            BreezeInput,
            BreezeSelect,
            BreezeLabel,
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
            key: 'Pmc/Contact',
        },

        async mounted() {
            this.instance = await instanceLoader();
            document.getElementById('layout_intro_text').innerHTML = this.instance.textBody.contact_left;
            document.getElementById('main_right_part').style.backgroundImage = '';
        },

        data() {
            return {
                form: this.$inertia.form({
                    first_name: this.inputData.first_name,
                    last_name: this.inputData.last_name,
                    company: this.inputData.company,
                    job_title: this.inputData.job_title,
                    email: this.inputData.email,
                    phone: this.inputData.phone,
                    country: this.inputData.country,
                    city: this.inputData.city,
                    state: this.inputData.state,
                    zip_code: this.inputData.zip_code,
                    address: this.inputData.address,
                    company_url: this.inputData.company_url,
                    // navigator_level: this.inputData.navigator_level,
                    program: this.inputData.program,
                }),
                hash: this.inputHash,
                instance: null,
            }
        },

        methods: {
            async submit() {

                if(window.analytics) {
                    await window.analytics.identify(this.hash, {
                        firstName: this.form.first_name,
                        lastName: this.form.last_name,
                        email: this.form.email,
                        phone: this.form.phone,
                        title: this.form.job_title,
                        website: this.form.company_url,
                        address: {
                            street: this.form.address,
                            city: this.form.city,
                            state: this.form.state,
                            postalCode: this.form.zip_code,
                            country: this.form.country,
                        },
                        company: {
                            name: this.form.company,
                        },
                        plan: "Campaign-in-a-Box" === this.form.program ? "CIB" : "CC",
                        logins: this.inputData.logins,
                    });
                }


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
<style scoped>
.required-fields {
    font-size: 0.8em;
    font-style: italic;
}
</style>
