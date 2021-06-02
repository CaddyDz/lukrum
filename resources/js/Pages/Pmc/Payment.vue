<template>
    <keep-session-alive :hash="hash"></keep-session-alive>
    <title-update title="Payment Information"></title-update>
    <div class="mb-4 mt-16">
        <h1 class="section-title">Payment Information</h1>
    </div>


<!--    <form @submit.prevent="submit">-->

        <div class="stripe-container" id="payment_container">

            <form id="payment-form" @submit.prevent="processPayment">
                <div class="payment-area" v-show="pStatus === 'payment'">
                    <div class="product">{{inputData.productName}} ${{ inputData.productPrice }} USD</div>
                    <div id="card-element" ref="card_element" ><!--Stripe.js injects the Card Element--></div>
                    <button id="submit" :disabled="buttonDisabled || isLoading">
                        <div class="spinner" id="spinner" v-show="isLoading"></div>
                        <span id="button-text">Pay now</span>
                    </button>
                    <p id="card-error" role="alert" v-text="cardErrorMessage"></p>
                    <p class="result-message" v-show="!!resultUrl">
                        Payment succeeded, see the result in your
                        <a :href="resultUrl" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
                    </p>
                </div>
                <div class="preparing-area" v-show="pStatus === 'preparing'">
                    <h2>Your asset is being prepared. Please stand by ...</h2>
                </div>
                <div class="done-area" v-show="pStatus === 'done'">
<!--                    <h2>Your asset is ready.</h2>-->
<!--                    <a target="_blank" :href="assetLink">Download</a>-->
                    <h2>Your assets have been sent to your Campaign Manager. They will be released to you after your scheduled review session.</h2>
                </div>
            </form>

        </div>

        <div class="flex items-center justify-end mt-4">
            <!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
            <!--                Forgot your password?-->
            <!--            </inertia-link>-->

<!--            <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="true || form.processing">-->
<!--                Next &gt;&gt;-->
<!--            </breeze-button>-->
        </div>
<!--    </form>-->
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

    import {loadStripe} from '@stripe/stripe-js';
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
            inputData: Object,
            stripeKey: String,
        },

        remember: {
            data: ['form', ],
            key: 'Pmc/Payment',
        },

        data() {
            return {
                form: this.$inertia.form({
                    hash: this.hash,
                    event_details: null,
                }),
                paymentParams: null,
                buttonDisabled: true,
                cardErrorMessage: "",
                resultUrl: "",
                isLoading: false,
                pStatus: "payment",
                assetLink: null,
            }
        },

        unmounted() {
            // window.removeEventListener('message', this.catchEvent)
        },

        async mounted() {
            document.getElementById('main_right_part').style.backgroundImage = '';
            document.getElementById('layout_intro_text').innerHTML = "<div>Please <b>enter your payment info</b>.</div>";

            const stripe = await loadStripe(this.stripeKey);
            const {clientSecret} = (await axios.post('/stripe/create', {
                hash: this.hash,
            })).data;

            const elements = stripe.elements();
            const style = {
                base: {
                    color: "#32325d",
                    fontFamily: 'Arial, sans-serif',
                    fontSmoothing: "antialiased",
                    fontSize: "16px",
                    "::placeholder": {
                        color: "#32325d"
                    }
                },
                invalid: {
                    fontFamily: 'Arial, sans-serif',
                    color: "#fa755a",
                    iconColor: "#fa755a"
                }
            };
            const card = elements.create("card", { style: style });
            // Stripe injects an iframe into the DOM
            await this.$nextTick(() => {
                card.mount(this.$refs.card_element);
            });

            card.on("change", event => {
                // Disable the Pay button if there are no card details in the Element
                this.buttonDisabled = event.empty;
                this.cardErrorMessage = event.error ? event.error.message : "";
            });

            this.paymentParams = {stripe, card, clientSecret};

        },

        methods: {

            async processPayment() {
                this.isLoading = true;

                try {
                    const preCheck = (await axios.post('/pmc/pre_payment_check', {
                        hash: this.hash,
                    })).data;

                    if(!preCheck.ok) {
                        this.showError(preCheck.error);
                        return;
                    }
                } catch (err) {
                    this.showError("Something Went Wrong, Please Refresh The Page");
                    return;
                }

                const {stripe, card, clientSecret} = this.paymentParams;

                const result = await stripe
                    .confirmCardPayment(clientSecret, {
                        payment_method: {
                            card: card
                        }
                    });

                // console.log(result);

                if (result.error) {
                    // Show error to your customer
                    this.showError(result.error.message);
                } else {
                    //     The payment succeeded!
                    this.orderComplete(result.paymentIntent.id);
                }
            },


            async orderComplete(paymentIntentId) {
                this.isLoading = false;

                this.cardErrorMessage = "";
                this.resultUrl = "https://dashboard.stripe.com/test/payments/" + paymentIntentId;
                this.buttonDisabled = true;

                this.pStatus = "preparing";
                const response = (await axios.post('/pmc/payment_processed', {
                    hash: this.hash,
                    paymentReference: paymentIntentId,
                })).data;
console.log(response);
                this.pStatus = "done";
                this.assetLink = response.assetUrl;

                this.submit();
            },
    // Show the customer the error from Stripe if their card fails to charge

            showError(errorMsgText) {
                this.isLoading = false;
                this.cardErrorMessage = errorMsgText;
                // setTimeout(() => {
                //     this.cardErrorMessage = "";
                // }, 4000);
            },

/*
            initCalendly() {
                console.log("INit", typeof Calendly);

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
                        document.head.appendChild(script)

                        window.addEventListener('message', _cThis.catchEvent)
                    }

                })).then(x => {
                    console.log(x);
                    console.log(typeof Calendly);

                    Calendly.initInlineWidget({
                        url: "https://calendly.com/azagarov/15min",
                        parentElement: document.getElementById("calendar_container"),
                        prefill: {
                            name: _cThis.inputData.name,
                            email: _cThis.inputData.email,
                        },
                    });
                });
            },
*/
            submit() {
                this.form.post('/pmc/payment', {
                        onSuccess: page => {
                            // this.hash = page.props.hash;
                        },
                    })
                // this.route('pmc.contact.submit')
            }
        }
    }
</script>
<style scoped>
    .product {
        margin-bottom: 14px;
    }

    .stripe-container {
        width: 30vw;
        min-width: 500px;
        align-self: center;
        box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
        0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
        border-radius: 7px;
        padding: 40px;
    }

    .stripe-container input {
        border-radius: 6px;
        margin-bottom: 6px;
        padding: 12px;
        border: 1px solid rgba(50, 50, 93, 0.1);
        height: 44px;
        font-size: 16px;
        width: 100%;
        background: white;
    }

    .result-message {
        line-height: 22px;
        font-size: 16px;
    }

    .result-message a {
        color: rgb(89, 111, 214);
        font-weight: 600;
        text-decoration: none;
    }

    #card-error {
        color: rgb(105, 115, 134);
        text-align: left;
        font-size: 13px;
        line-height: 17px;
        margin-top: 12px;
    }

    #card-element {
        border-radius: 4px 4px 0 0 ;
        padding: 12px;
        border: 1px solid rgba(50, 50, 93, 0.1);
        height: 44px;
        width: 100%;
        background: white;
    }

    #payment-request-button {
        margin-bottom: 32px;
    }

    /* Buttons and links */
    .stripe-container button {
        background: #5469d4;
        color: #ffffff;
        font-family: Arial, sans-serif;
        border-radius: 0 0 4px 4px;
        border: 0;
        padding: 12px 16px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        display: block;
        transition: all 0.2s ease;
        box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
        width: 100%;
    }
    .stripe-container button:hover {
        filter: contrast(115%);
    }
    .stripe-container button:disabled {
        opacity: 0.5;
        cursor: default;
    }

    /* spinner/processing state, errors */
    .spinner,
    .spinner:before,
    .spinner:after {
        border-radius: 50%;
    }
    .spinner {
        color: #ffffff;
        font-size: 22px;
        text-indent: -99999px;
        margin: 0px auto;
        position: relative;
        width: 20px;
        height: 20px;
        box-shadow: inset 0 0 0 2px;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
    }
    .spinner:before,
    .spinner:after {
        position: absolute;
        content: "";
    }
    .spinner:before {
        width: 10.4px;
        height: 20.4px;
        background: #5469d4;
        border-radius: 20.4px 0 0 20.4px;
        top: -0.2px;
        left: -0.2px;
        -webkit-transform-origin: 10.4px 10.2px;
        transform-origin: 10.4px 10.2px;
        -webkit-animation: loading 2s infinite ease 1.5s;
        animation: loading 2s infinite ease 1.5s;
    }
    .spinner:after {
        width: 10.4px;
        height: 10.2px;
        background: #5469d4;
        border-radius: 0 10.2px 10.2px 0;
        top: -0.1px;
        left: 10.2px;
        -webkit-transform-origin: 0px 10.2px;
        transform-origin: 0px 10.2px;
        -webkit-animation: loading 2s infinite ease;
        animation: loading 2s infinite ease;
    }

    @-webkit-keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    @keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @media only screen and (max-width: 600px) {
        form {
            width: 80vw;
        }
    }
</style>
