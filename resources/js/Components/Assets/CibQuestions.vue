<template>
<div class="assets-logo mt-16 ml-12">
    <title-update :title="title"></title-update>
    <back-button @link-clicked="$emit('backClicked', step)"></back-button>
    <nav-steps :step="navStep ? navStep : 4"></nav-steps>
    <div class="mr-6">
        <div class="mb-4">
            <div class="mb-4 ml-2">
                <h1 class="section-title">{{ title }}</h1>
            </div>

            <div v-for="(q, idx) in inputQuestions">
                <div class="m-2">
                    <!--                    <breeze-label for="firstName" value="*First Name" />-->
                    <div class="question-body" v-text="q.question"></div>
                    <breeze-text-area id="comments" rows="8" class="mt-1 block w-full" v-model="answers[idx]" :placeholder="q.placeholder" autofocus />
                    <div class="minimum mb-8">{{minLen}} character minimum required ({{answers[idx].length}}).</div>
                </div>
            </div>
        </div>

<!--        <hr />-->


<!--
        <div class="asset-example mt-16">
            <h1>PREVIEW</h1>
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

            <breeze-button type="button" class="ml-2" :class="{ 'opacity-25': !formOk }" :disabled="!formOk" @click="$emit('nextClicked', step)">
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
import BreezeTextArea from '@/Components/InputTextArea'
import NavSteps from "./NavSteps";
import CibPreview from "./CibPreview";
import BackButton from "../BackButton";
import TitleUpdate from "../TitleUpdate";

export default {
    name: "CibQuestions",
    emits: ["nextClicked", "backClicked", "answersUpdated", ],
    props: ["navStep", "step", "inputQuestions", "title", "section", "page", ],

    components: {
        TitleUpdate,
        BackButton,
        CibPreview,
        NavSteps,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeSelect,
        BreezeTextArea,
    },
    data() {
        return {
            answers: this.inputQuestions.map(x => ""),
            minLen: 100, // back to to 350 one of these days
        }
    },

    mounted() {
        if(this.section === "ask_the_expert") {
            document.getElementById('layout_intro_text').innerHTML = "<div>The questions on the following pages are for the <b>Ask The Expert</b> intro to the State of Commerce Report. Please provide the answers from your expert as well as your expert's name, title, and photo. Each of the question fields has a " + this.minLen + " character minmum requirement before you can proceed to the next page.</div>";
        } else {
            document.getElementById('layout_intro_text').innerHTML = "<div>The following questions are intended to help your Campaign Manager <b>build your customer success story</b>. While they will be discussing these with you during one of your scheduled meetings, we would like our copywriters to be able to get a head start on crafting your story. Each of these fields has a " + this.minLen + " character minimum requirement before you can proceed to the next page.</div>";
        }

        const ps = this.$parent.preSelected;

        const pageSize = 3;
        const shift = (this.page - 1) * pageSize;

        for(let i = 0; i < pageSize; i++) {
            if(!this.$parent.questions[this.section][i + shift]) break;
            if(this.$parent.questions[this.section][i + shift].answer) {
                this.answers[i] = this.$parent.questions[this.section][i + shift].answer;
            } else if(ps && ps.questions && ps.questions[this.section] && ps.questions[this.section][i + shift]) {
                this.answers[i] = ps.questions[this.section][i + shift];
            }
        }
    },

    watch: {
        answers: {
            deep: true,
            handler(v) {
                this.$emit("answersUpdated", v);
            }
        },
    },

    computed: {
        formOk() {
            return this.answers.reduce((c, x) => {
                return c && (x.length >= this.minLen || x === "-");
            }, true);
        },

    },

    methods: {
    }

}
</script>
<style scoped>
.minimum {
    font-size: 0.8em;
    font-style: italic;
}
</style>
