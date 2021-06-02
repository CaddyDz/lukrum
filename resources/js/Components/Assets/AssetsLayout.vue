<template>
<div class="assets-layout mt-16 ml-12">
    <title-update title="Choose Design Style"></title-update>
    <back-button @link-clicked="$emit('backClicked', 'layout')"></back-button>
    <nav-steps :step="1"></nav-steps>

    <h1 class="section-title ml-2">Choose One Design Style</h1>
    <div class="grid grid-cols-3 mt-8">
        <div class="col single-layout" v-for="l in layouts" :class="{active: l === selectedLayout, }">
            <div class="pr-12 mb-10">
                <label :for="'layout_' + l.code">
                    <div class="radio mb-4 pl-2">
                        <input type="radio" :value="l" :id="'layout_' + l.code" v-model="selectedLayout" />
                        <span v-text="l.title" ></span>
                    </div>
                    <img :src="l.featured_url" :alt="l.code" />
                </label>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-start mt-4">
<!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
<!--                Forgot your password?-->
<!--            </inertia-link>-->

        <breeze-button type="button" class="ml-2" :class="{ 'opacity-25': !formOk }" :disabled="!formOk" @click="$emit('nextClicked', 'layout')">
            Next
        </breeze-button>
    </div>

</div>
</template>

<script>
import BreezeButton from '@/Components/Button'
import NavSteps from "./NavSteps";
import BackButton from "../BackButton";
import TitleUpdate from "../TitleUpdate";
export default {
    name: "AssetsLayout",
    emits: ["layoutSelected", "nextClicked", "backCLicked", ],
    components: {
        TitleUpdate,
        BackButton,
        NavSteps,
        BreezeButton,
    },

    data() {
        return {
            layouts: [],
            selectedLayout: null,
        }
    },

    async mounted() {
        document.getElementById('layout_intro_text').innerHTML = "<div>Next, <b>please choose one design layout option for the look and feel of your campaign</b>. For design options 3 and 4, you'll be able to replace the stock photo that’s currently shown with an image that better represents your individual business. For option 5, you can choose from a series of graphics and icons that will appear below your logo to better support your messaging.</div>";

        this.layouts = (await axios.get('/pmc/api/layouts')).data

        let n = 1;
        for(let idx in this.layouts) {
            this.layouts[idx].title = "Design " + n;
            n++;
        }
        // console.log("Layout Mounted", this.layouts);

        const ps = this.$parent.preSelected;
// console.log(ps);
        if(this.$parent.layout) {
            this.selectedLayout = this.$parent.layout;
        } else if(ps && ps.layoutCode) {
            this.selectedLayout = this.layouts[ps.layoutCode];
        }
    },

    computed: {
        formOk() {
            return !!this.selectedLayout;
        },
    },

    watch: {
        selectedLayout(v) {
            this.$emit('layoutSelected', v);
        },
    }
}
</script>

<style scoped>
.assets-layout {
    margin-right: -35px;
}

.single-layout img {
    cursor: pointer;
}

.radio input {
    margin-bottom: 4px;
}

.radio span {
    padding-left:5px;
}
</style>
