<template>
<div class="cib-main" v-if="extraData">
    <cib-logo v-if="currentStep === 'logo'"
        @logo-updated="logoUpdated"
        @logo-preview-updated="logoPreviewUpdated"
        @focus-updated="focusUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-logo>
    <cib-copies-overview v-else-if="currentStep === 'copies_overview'"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-copies-overview>
    <cib-banner-copies v-else-if="currentStep === 'tp1_banner_copies'"
        selector="tp1"
        step="tp1_banner_copies"
        :choose-title="copies.common.tp1.long_title"
        @subhead-updated="tp1BannerSubheadUpdated"
        @cta-updated="tp1BannerCtaUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-banner-copies>
    <cib-sm-copies v-else-if="currentStep === 'tp1_sm_copies'"
        selector="tp1"
        step="tp1_sm_copies"
        :choose-title="copies.common.tp1.long_title"
        @subhead-updated="tp1SmSubheadUpdated"
        @cta-updated="tp1SmCtaUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-sm-copies>
    <cib-landing-copies v-else-if="currentStep === 'tp1_landing_copies'"
        selector="tp1"
        step="tp1_landing_copies"
        :choose-title="copies.common.tp1.long_title"
        @subhead-updated="tp1LandingSubheadUpdated"
        @cta-updated="tp1LandingCtaUpdated"
        @intro-updated="tp1LandingIntroUpdated"
        @body-text-updated="tp1LandingBodyUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-landing-copies>
    <cib-email-copies v-else-if="currentStep === 'tp1_email_copies'"
        selector="tp1"
        step="tp1_email_copies"
        :choose-title="copies.common.tp1.long_title"
        @cta-updated="tp1EmailCtaUpdated"
        @intro-updated="tp1EmailIntroUpdated"
        @body-text-updated="tp1EmailBodyUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-email-copies>
    <cib-banner-copies v-else-if="currentStep === 'tp2_banner_copies'"
        selector="tp2"
        step="tp2_banner_copies"
        :choose-title="copies.common.tp2.long_title"
        @subhead-updated="tp2BannerSubheadUpdated"
        @cta-updated="tp2BannerCtaUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-banner-copies>
    <cib-sm-copies v-else-if="currentStep === 'tp2_sm_copies'"
        selector="tp2"
        step="tp2_sm_copies"
        :choose-title="copies.common.tp2.long_title"
        @subhead-updated="tp2SmSubheadUpdated"
        @cta-updated="tp2SmCtaUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-sm-copies>
    <cib-landing-copies v-else-if="currentStep === 'tp2_landing_copies'"
        selector="tp2"
        step="tp2_landing_copies"
        :choose-title="copies.common.tp2.long_title"
        @subhead-updated="tp2LandingSubheadUpdated"
        @cta-updated="tp2LandingCtaUpdated"
        @intro-updated="tp2LandingIntroUpdated"
        @body-text-updated="tp2LandingBodyUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-landing-copies>
    <cib-email-copies v-else-if="currentStep === 'tp2_email_copies'"
        selector="tp2"
        step="tp2_email_copies"
        :choose-title="copies.common.tp2.long_title"
        @cta-updated="tp2EmailCtaUpdated"
        @intro-updated="tp2EmailIntroUpdated"
        @body-text-updated="tp2EmailBodyUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-email-copies>
    <cib-banner-copies v-else-if="currentStep === 'tp3_banner_copies'"
        selector="tp3"
        step="tp3_banner_copies"
        :choose-title="copies.common.tp3.long_title"
        @subhead-updated="tp3BannerSubheadUpdated"
        @cta-updated="tp3BannerCtaUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-banner-copies>
    <cib-sm-copies v-else-if="currentStep === 'tp3_sm_copies'"
        selector="tp3"
        step="tp3_sm_copies"
        :choose-title="copies.common.tp3.long_title"
        @subhead-updated="tp3SmSubheadUpdated"
        @cta-updated="tp3SmCtaUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-sm-copies>
    <cib-landing-copies v-else-if="currentStep === 'tp3_landing_copies'"
        selector="tp3"
        step="tp3_landing_copies"
        :choose-title="copies.common.tp3.long_title"
        @subhead-updated="tp3LandingSubheadUpdated"
        @cta-updated="tp3LandingCtaUpdated"
        @intro-updated="tp3LandingIntroUpdated"
        @body-text-updated="tp3LandingBodyUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-landing-copies>
    <cib-email-copies v-else-if="currentStep === 'tp3_email_copies'"
        selector="tp3"
        step="tp3_email_copies"
        :choose-title="copies.common.tp3.long_title"
        @cta-updated="tp3EmailCtaUpdated"
        @intro-updated="tp3EmailIntroUpdated"
        @body-text-updated="tp3EmailBodyUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-email-copies>
    <cib-banner-copies v-else-if="currentStep === 'tp4_banner_copies'"
        selector="tp4"
        step="tp4_banner_copies"
        :choose-title="copies.common.tp4.long_title"
        @subhead-updated="tp4BannerSubheadUpdated"
        @cta-updated="tp4BannerCtaUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-banner-copies>
    <cib-sm-copies v-else-if="currentStep === 'tp4_sm_copies'"
        selector="tp4"
        step="tp4_sm_copies"
        :choose-title="copies.common.tp4.long_title"
        @subhead-updated="tp4SmSubheadUpdated"
        @cta-updated="tp4SmCtaUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-sm-copies>
    <cib-landing-copies v-else-if="currentStep === 'tp4_landing_copies'"
        selector="tp4"
        step="tp4_landing_copies"
        :choose-title="copies.common.tp4.long_title"
        @subhead-updated="tp4LandingSubheadUpdated"
        @cta-updated="tp4LandingCtaUpdated"
        @intro-updated="tp4LandingIntroUpdated"
        @body-text-updated="tp4LandingBodyUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-landing-copies>
    <cib-email-copies v-else-if="currentStep === 'tp4_email_copies'"
        selector="tp4"
        step="tp4_email_copies"
        :choose-title="copies.common.tp4.long_title"
        @cta-updated="tp4EmailCtaUpdated"
        @intro-updated="tp4EmailIntroUpdated"
        @body-text-updated="tp4EmailBodyUpdated"
        @next-clicked="nextClicked"
        @back-clicked="backClicked"
    ></cib-email-copies>
    <cib-comments v-else-if="currentStep === 'comments'"
         :nav-step="3"
         @comments-updated="commentsUpdated"
         @launch-date-updated="launchDateUpdated"
         @launch-time-updated="launchTimeUpdated"
         @next-clicked="nextClicked"
         @back-clicked="backClicked"
    ></cib-comments>
    <cib-questions v-else-if="currentStep === 'questions1'"
         step="questions1"
         section="customer_success"
         :page="1"
         title="Customer Success Questions"
         :input-questions="questions1"
         @answers-updated="answers1Updated"
         @next-clicked="nextClicked"
         @back-clicked="backClicked"
    ></cib-questions>
    <cib-questions v-else-if="currentStep === 'questions2'"
         step="questions2"
         section="customer_success"
         :page="2"
         title="Customer Success Questions"
         :input-questions="questions2"
         @answers-updated="answers2Updated"
         @next-clicked="nextClicked"
         @back-clicked="backClicked"
    ></cib-questions>
    <cib-questions v-else-if="currentStep === 'questions3'"
         step="questions3"
         title="Ask the Expert Questions"
         section="ask_the_expert"
         :page="1"
         :input-questions="questions3"
         @answers-updated="answers3Updated"
         @next-clicked="nextClicked"
         @back-clicked="backClicked"
    ></cib-questions>
    <cib-questions v-else-if="currentStep === 'questions4'"
         step="questions4"
         title="Ask the Expert Questions"
         section="ask_the_expert"
         :page="2"
         :input-questions="questions4"
         @answers-updated="answers4Updated"
         @next-clicked="nextClicked"
         @back-clicked="backClicked"
    ></cib-questions>
    <cib-profile v-else-if="currentStep === 'profile'"
         @profile-updated="profileUpdated"
         @profile-preview-updated="profilePreviewUpdated"
         @expert-name-updated="expertNameUpdated"
         @expert-title-updated="expertTitleUpdated"
         @next-clicked="nextClicked"
         @back-clicked="backClicked"
    ></cib-profile>
</div>
</template>

<script>
import CibLogo from "./CibLogo";
import CibBannerCopies from "./CibBannerCopies";
import CibComments from "./CibComments";
import CibQuestions from "./CibQuestions";
import CibLandingCopies from "./CibLandingCopies";
import CibProfile from "./CibProfile";
import CibCopiesOverview from "./CibCopiesOverview";
import CibSmCopies from "./CibSmCopies";
import CibEmailCopies from "./CibEmailCopies";

import imageUploader from "../../tools/imageUploader";
import instanceLoader from '../../tools/instance';

export default {
    name: "CibMain",
    components: {
        CibEmailCopies,
        CibSmCopies,
        CibCopiesOverview, CibProfile, CibLandingCopies, CibQuestions, CibComments, CibBannerCopies, CibLogo},
    props: ["preSelected", "hash",],
    emits: ["dataCollected", ],

    data() {
        return {
            currentStep: "logo",
            steps: [
                "logo",

                "copies_overview",
                "tp1_banner_copies",
                "tp1_sm_copies",
                "tp1_email_copies",
                "tp2_banner_copies",
                "tp2_sm_copies",

                "tp2_landing_copies",
                "tp2_email_copies",

                "tp3_banner_copies",
                "tp3_sm_copies",
                "tp3_landing_copies",
                "tp3_email_copies",
                "tp4_banner_copies",
                "tp4_sm_copies",
                "tp4_landing_copies",
                "tp4_email_copies",
                "comments",
                "questions1",
                "questions2",
                "questions3",
                "questions4",
                "profile",
            ],

            layout:null,
            layoutSm:null,
            layoutLanding:null,
            layoutEmail:null,

            focus:null,

            logoFile: null,
            previewImage: null,

            profileFile: null,
            previewProfile: null,

            comments: null,
            launchDate: null,
            launchTime: null,

            copies: [],

            tp1: {
                banner_body: null,
                banner_cta: null,
                sm_body: null,
                sm_cta: null,

                email_intro: null,
                email_body: null,
                email_cta: null,
            },

            tp2: {
                banner_body: null,
                banner_cta: null,
                sm_body: null,
                sm_cta: null,

                landing_subhead: null,
                landing_intro: null,
                landing_body: null,
                landing_cta: null,

                email_intro: null,
                email_body: null,
                email_cta: null,
            },

            tp3: {
                banner_body: null,
                banner_cta: null,
                sm_body: null,
                sm_cta: null,

                landing_subhead: null,
                landing_intro: null,
                landing_body: null,
                landing_cta: null,

                email_intro: null,
                email_body: null,
                email_cta: null,
            },

            tp4: {
                banner_body: null,
                banner_cta: null,
                sm_body: null,
                sm_cta: null,

                landing_subhead: null,
                landing_intro: null,
                landing_body: null,
                landing_cta: null,

                email_intro: null,
                email_body: null,
                email_cta: null,
            },

            questions: null,

            expertName: null,
            expertTitle: null,

            extraData: null,
            toSendList: [],
            instance: null,
        };
    },

    async mounted() {
console.log("Hola");
        this.instance = await instanceLoader();
console.log("Ivan");

        document.getElementById('layout_intro_text').innerHTML = "<div><b>Customize your design.</b> Upload your company logo and select your campaign focus. Your logo should be a single color, transparent image file (png or svg) that's less than 5 MB in size.<br /><br /></div>";
console.log("Bibeg");
        this.copies = (await axios.get("/pmc/api/cib_copies?hash=" + this.hash)).data;
console.log(this.copies);

        let steps = ["logo"];
        this.toSendList = [];
        if(this.copies.setup.copies_overview) {
            steps = steps.concat(["copies_overview", ]);
        }
        for(let tp in this.copies.common) {
            const x = this.copies.common[tp];
            if(x.enabled) {
                steps = steps.concat(x.pages.map(x => {return tp + '_' + x + '_copies';}))
                this.toSendList.push(tp);
            }
        }


        if(this.instance.elements.comments || this.instance.elements.launch_date) {
            steps = steps.concat(["comments", ]);
            if(this.instance.elements.comments) {
                this.toSendList.push("comments");
            }
            if(this.instance.elements.launch_date) {
                this.toSendList.push("launchDate");
                this.toSendList.push("launchTime");
            }
        }

        this.questions = {};
        if(this.copies.questions.enabled) {
            steps = steps.concat(["questions1", "questions2", "questions3", "questions4",]);
            this.toSendList.push("questions");
            for(let qCat in this.copies.questions.categories) {
                this.questions[qCat] = this.copies.questions.categories[qCat].map(q => {
                    return {
                        question: q.question,
                        answer: "",
                    }
                });
            }
        }

        if(this.copies.setup.profile) {
            steps = steps.concat(["profile",]);
            this.toSendList.push("expertName");
            this.toSendList.push("expertTitle");
        }

        this.steps = steps;

        await this.loadLayoutInfo();
    },

    computed: {
        formToSend() {
            const form = {
                path: "cib",
                focus: this.focus,
                // logo: this.logoFile,
                // profile: this.profileFile,
                // comments: this.comments,
                // launchDate: this.launchDate,
                // launchTime: this.launchTime,
            };
            this.toSendList.forEach(x => {
                form[x] = this[x];
            });
            return form;
            /*{
                questions: this.questions,
                tp1: this.tp1,
                tp2: this.tp2,
                tp3: this.tp3,
                tp4: this.tp4,
                expertName: this.expertName,
                expertTitle: this.expertTitle,
            }*/
        },


        bannerPreview() {
            return {
                bodyText: this.tp1.banner_body.override
                    ? this.tp1.banner_body.override
                    : (
                        this.tp1.banner_body.original
                            ? this.tp1.banner_body.original
                            : this.copies.clouds.inform.tp1.banner_subhead[0]
                    ),
                cta: this.tp1.banner_cta.override
                    ? this.tp1.banner_cta.override
                    : (
                        this.tp1.banner_cta.original
                            ? this.tp1.banner_cta.original
                            : this.copies.common.tp1.banner_cta[0]
                    ),
            }
        },
        smPreview() {
            return {
                headline: this.sm.headline.override
                    ? this.sm.headline.override
                    : (
                        this.sm.headline.original
                            ? this.sm.headline.original
                            : this.copies.clouds.analytics.sm_headline[0]
                    ),
                bodyText: this.sm.bodyText.override
                    ? this.sm.bodyText.override
                    : (
                        this.sm.bodyText.original
                            ? this.sm.bodyText.original
                            : this.copies.clouds.analytics.sm_body[0]
                    ),
                cta: this.sm.cta.override
                    ? this.sm.cta.override
                    : (
                        this.sm.cta.original
                            ? this.sm.cta.original
                            : this.copies.cta[0]
                    ),
            }
        },

        questions1() {
            return this.copies.questions.categories.customer_success.slice(0, 3);
        },

        questions2() {
            return this.copies.questions.categories.customer_success.slice(3);
        },

        questions3() {
            return this.copies.questions.categories.ask_the_expert.slice(0, 3);
        },

        questions4() {
            return this.copies.questions.categories.ask_the_expert.slice(3);
        },

    },

    methods: {
        initUpload(imageType, f) {

            const form = new FormData();
            form.append("image", f);
            form.append("imageType", imageType);
            form.append("hash", this.hash);

            imageUploader.add(imageType, form);
        },

        logoUpdated(logoFile) {
            this.logoFile = logoFile
            this.initUpload("logo", logoFile);
        },

        logoPreviewUpdated(logoPreview) {
            this.previewImage = logoPreview
        },

        profileUpdated(file) {
            this.profileFile = file
            this.initUpload("profile", file);
        },

        profilePreviewUpdated(preview) {
            this.previewProfile = preview
        },

        focusUpdated(v) {
            this.focus = v;
        },

        nextClicked(step) {
            const idx = this.steps.indexOf(step);
            if(this.steps.length - 1 > idx) {
                this.currentStep = this.steps[idx + 1];
                window.scrollTo(0, 0);
            } else {
                imageUploader.done().then(x => {
                    this.$emit("dataCollected", this.formToSend);
                })
            }
        },

        backClicked(step) {
            const idx = this.steps.indexOf(step);
            if(idx > 0) {
                this.currentStep = this.steps[idx - 1];
                window.scrollTo(0, 0);
            } else {
                history.back();
            }
        },

        async loadLayoutInfo() {
            this.layout = (await axios.get("/pmc/api/layouts/Cib/image/large_rectangle")).data;
            this.layoutSm = (await axios.get("/pmc/api/layouts/Cib/image/facebook")).data;
            this.layoutLanding = (await axios.get("/pmc/api/layouts/Cib/image/landing")).data;
            this.layoutEmail = (await axios.get("/pmc/api/layouts/Cib/image/email")).data;
            this.extraData = (await axios.get("/pmc/api/extra_data/" + this.hash)).data;
        },




        tp1BannerSubheadUpdated(v) {
            this.tp1.banner_body = v;
        },
        tp1BannerCtaUpdated(v) {
            this.tp1.banner_cta = v;
        },
        tp1SmSubheadUpdated(v) {
            this.tp1.sm_body = v;
        },
        tp1SmCtaUpdated(v) {
            this.tp1.sm_cta = v;
        },

        tp1LandingSubheadUpdated(v) {
            this.tp1.landing_subhead = v;
        },
        tp1LandingIntroUpdated(v) {
            this.tp1.landing_intro = v;
        },
        tp1LandingBodyUpdated(v) {
            this.tp1.landing_body = v;
        },
        tp1LandingCtaUpdated(v) {
            this.tp1.landing_cta = v;
        },

        tp2BannerSubheadUpdated(v) {
            this.tp2.banner_body = v;
        },
        tp2BannerCtaUpdated(v) {
            this.tp2.banner_cta = v;
        },
        tp2SmSubheadUpdated(v) {
            this.tp2.sm_body = v;
        },
        tp2SmCtaUpdated(v) {
            this.tp2.sm_cta = v;
        },

        tp2LandingSubheadUpdated(v) {
            this.tp2.landing_subhead = v;
        },
        tp2LandingIntroUpdated(v) {
            this.tp2.landing_intro = v;
        },
        tp2LandingBodyUpdated(v) {
            this.tp2.landing_body = v;
        },
        tp2LandingCtaUpdated(v) {
            this.tp2.landing_cta = v;
        },

        tp3BannerSubheadUpdated(v) {
            this.tp3.banner_body = v;
        },
        tp3BannerCtaUpdated(v) {
            this.tp3.banner_cta = v;
        },
        tp3SmSubheadUpdated(v) {
            this.tp3.sm_body = v;
        },
        tp3SmCtaUpdated(v) {
            this.tp3.sm_cta = v;
        },

        tp3LandingSubheadUpdated(v) {
            this.tp3.landing_subhead = v;
        },
        tp3LandingIntroUpdated(v) {
            this.tp3.landing_intro = v;
        },
        tp3LandingBodyUpdated(v) {
            this.tp3.landing_body = v;
        },
        tp3LandingCtaUpdated(v) {
            this.tp3.landing_cta = v;
        },

        tp4BannerSubheadUpdated(v) {
            this.tp4.banner_body = v;
        },
        tp4BannerCtaUpdated(v) {
            this.tp4.banner_cta = v;
        },
        tp4SmSubheadUpdated(v) {
            this.tp4.sm_body = v;
        },
        tp4SmCtaUpdated(v) {
            this.tp4.sm_cta = v;
        },

        tp4LandingSubheadUpdated(v) {
            this.tp4.landing_subhead = v;
        },
        tp4LandingIntroUpdated(v) {
            this.tp4.landing_intro = v;
        },
        tp4LandingBodyUpdated(v) {
            this.tp4.landing_body = v;
        },
        tp4LandingCtaUpdated(v) {
            this.tp4.landing_cta = v;
        },

        tp1EmailCtaUpdated(v) {
            this.tp1.email_cta = v;
        },
        tp1EmailIntroUpdated(v) {
            this.tp1.email_intro = v;
        },
        tp1EmailBodyUpdated(v) {
            this.tp1.email_body = v;
        },

        tp2EmailCtaUpdated(v) {
            this.tp2.email_cta = v;
        },
        tp2EmailIntroUpdated(v) {
            this.tp2.email_intro = v;
        },
        tp2EmailBodyUpdated(v) {
            this.tp2.email_body = v;
        },

        tp3EmailCtaUpdated(v) {
            this.tp3.email_cta = v;
        },
        tp3EmailIntroUpdated(v) {
            this.tp3.email_intro = v;
        },
        tp3EmailBodyUpdated(v) {
            this.tp3.email_body = v;
        },

        tp4EmailCtaUpdated(v) {
            this.tp4.email_cta = v;
        },
        tp4EmailIntroUpdated(v) {
            this.tp4.email_intro = v;
        },
        tp4EmailBodyUpdated(v) {
            this.tp4.email_body = v;
        },


        commentsUpdated(v) {
            this.comments = v;
        },

        launchDateUpdated(v) {
            this.launchDate = v;
        },

        launchTimeUpdated(v) {
            this.launchTime = v;
        },

        answers1Updated(v) {
            for(let i = 0; i < v.length; i++) {
                this.questions.customer_success[i].answer = v[i];
            }
        },

        answers2Updated(v) {
            for(let i = 0; i < v.length; i++) {
                this.questions.customer_success[i+3].answer = v[i];
            }
        },

        answers3Updated(v) {
            for(let i = 0; i < v.length; i++) {
                this.questions.ask_the_expert[i].answer = v[i];
            }
        },

        answers4Updated(v) {
            for(let i = 0; i < v.length; i++) {
                this.questions.ask_the_expert[i+3].answer = v[i];
            }
        },

        expertNameUpdated(v) {
            this.expertName = v;
        },

        expertTitleUpdated(v) {
            this.expertTitle = v;
        },

    }
}
</script>

<style scoped>

</style>
