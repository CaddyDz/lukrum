<template>
<div class="assets-logo mt-16 ml-12">
    <title-update title="Additional Comments"></title-update>
    <back-button @link-clicked="$emit('backClicked', 'comments')"></back-button>
    <nav-steps :step="navStep ? navStep : 3"></nav-steps>
    <div class="mr-6">
        <div class="mb-4">
            <div class="mb-4 ml-2" v-if="$parent.instance.elements.comments">
                <h1 class="section-title">Additional Comments</h1>
            </div>

            <div class="m-2" v-if="$parent.instance.elements.comments">
                <!--                    <breeze-label for="firstName" value="*First Name" />-->
                <breeze-text-area id="comments" rows="8" class="mt-1 block w-full" v-model="comments" placeholder="Write Additional Comments" autofocus />
            </div>

            <div class="mb-4 mt-4 ml-2" v-if="$parent.instance.elements.launch_date">
                <h1 class="section-title">Launch Date</h1>
            </div>

            <div class="m-2" v-if="$parent.instance.elements.launch_date">
                <!--                    <breeze-label for="lastName" value="*Last Name" />-->
<!--                <breeze-input id="launchDate" type="date" class="m-1 inline-block w-6/12" v-model="launchDate" required placeholder="MM/DD/YY *" />-->
<!--                <breeze-input id="launchTime" type="time" class="m-1 inline-block w-5/12" v-model="launchTime" required placeholder="HH:MM *" />-->
                <!-- <date-picker v-model="launchDate" class="m-1 inline-block w-6/12 the-input focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm"></date-picker> -->
                <date-picker class="inline-block h-full" :min-date="new Date()"  v-model="launchDate">
                  <template v-slot="{ inputValue, togglePopover }">
                    <div class="flex items-center">
                      <button
                        class="p-2 bg-blue-100 border border-blue-200 hover:bg-blue-200 text-blue-600 rounded-l focus:bg-blue-500 focus:text-white focus:border-blue-500 focus:outline-none"
                        @click="togglePopover()"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          class="w-4 h-4 fill-current"
                        >
                          <path
                            d="M1 4c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4zm2 2v12h14V6H3zm2-6h2v2H5V0zm8 0h2v2h-2V0zM5 9h2v2H5V9zm0 4h2v2H5v-2zm4-4h2v2H9V9zm0 4h2v2H9v-2zm4-4h2v2h-2V9zm0 4h2v2h-2v-2z"
                          ></path>
                        </svg>
                      </button>
                      <input
                        readonly
                        type="text"
                        autocomplete="off"
                        :value="inputValue"
                        class="bg-white text-gray-700 w-full py-1 px-2 appearance-none border rounded-r focus:outline-none focus:border-blue-500"
                      />
                    </div>
                  </template>
                </date-picker>
            </div>
        </div>
<!--        <hr />-->

<!--
        <div class="asset-example mt-16">
            <h1>BANNER PREVIEW</h1>
            <cib-preview
                ref="preview"
                width="250"
                height="500"
                :layout="$parent.layout"
                :logo="$parent.previewImage"
                headline=""
                :body-text="$parent.bannerPreview.bodyText"
                :cta="$parent.bannerPreview.cta"

            ></cib-preview>
        </div>
-->

        <div class="flex items-center start mt-8">
            <!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
            <!--                Forgot your password?-->
            <!--            </inertia-link>-->

            <breeze-button type="button" class="ml-2" :class="{ 'opacity-25': !formOk }" :disabled="!formOk" @click="$emit('nextClicked', 'comments')">
                Next
            </breeze-button>
        </div>
    </div>
</div>
</template>

<script>
import BreezeButton from '@/Components/Button'
import BreezeInput from '@/Components/Input'
import BreezeLabel from '@/Components/Label'
import BreezeTextArea from '@/Components/InputTextArea'
import NavSteps from "./NavSteps";
import CibPreview from "./CibPreview";
import BackButton from "../BackButton";
import TitleUpdate from "../TitleUpdate";
// import DatePicker from 'vue3-datepicker';
import { Calendar, DatePicker } from 'v-calendar';


export default {
    name: "CibComments",
    emits: [
        "nextClicked", "backClicked", "commentsUpdated", "launchDateUpdate", "launchTimeUpdated",
    ],
    props: ["navStep"],

    components: {
        TitleUpdate,
        BackButton,
        CibPreview,
        NavSteps,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeTextArea,
        DatePicker,
    },
    data() {
        return {
            comments: null,
            launchDate: null,
        }
    },

    mounted() {
        document.getElementById('layout_intro_text').innerHTML = "<div>Finally, please <b>provide any additional notes</b> that could potentially be beneficial to your campaign manager and enter your anticipated campaign launch date.</div>";

        const ps = this.$parent.preSelected;

        if(this.$parent.comments) {
            this.comments = this.$parent.comments;
        } else if(ps && ps.comments) {
            this.comments = ps.comments;
        }

        if(this.$parent.launchDate) {
            this.launchDate = new Date(Date.parse(this.$parent.launchDate));
        } else if(ps && ps.launchDate) {
            this.launchDate = new Date(Date.parse(ps.launchDate));
        }
    },

    watch: {

        comments(v) {
            this.$emit("commentsUpdated", v);
        },
        launchDate(v) {
            let month = '' + (v.getMonth() + 1);
            let day = '' + v.getDate();
            const year = v.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            this.$emit("launchDateUpdated", [year, month, day].join('-'));
        },
    },

    computed: {
        formOk() {
            return this.launchDate;
        },

    },

    methods: {
    }

}
</script>
