<template>
    <div class="color-preview" :style="{backgroundColor: localColor}" @click="triggerClicked"></div>
    <div class="color-inner">
        <breeze-input type="text" id="color" class="block w-full" v-model="localColor" @click="triggerClicked"></breeze-input>
        <div class="the-picker"></div>
<!--        @click="triggerClicked"-->
    </div>
<!--    <chrome-picker ></chrome-picker>-->

<!--    @input="updateFromPicker"-->
    <!--                   v-if="showPicker" -->
</template>

<script>
import BreezeInput from '@/Components/Input'
// import {Chrome} from 'vue-color';

import Pickr from 'pickr-widget';

// const ChromePicker = Chrome;
export default {
    name: "ColorPicker",
    props: ["modelValue"],
    emits: ['update:modelValue'],
    components: {
        BreezeInput,
    },

    mounted() {
        const _that = this;
        this.picker = new Pickr({
            el: ".the-picker",
            default: this.localColor,
            // parent: ".color-preview",
            components: {
                hue: true,     // Hue slider

                // Bottom interaction bar, theoretically you could use 'true' as propery.
                // But this would also hide the save-button.
                interaction: {
                    hex: true,  // hex option  (hexadecimal representation of the rgba value)
                    rgba: true,
                    input: true,
                },
                lockOpacity: true,
            },
            onChange(c) {
// console.log(c.toHEX().toString());
                _that.localColor = c.toHEX().toString();
            },
            onHide() {
                console.log("Closed");
            }
        });
        // this.$nextTick(() => {
        //     this.picker.on("change", c => {
        //     });
        // });
    },

    unmounted() {
        this.picker.destroyAndRemove();
    },
    data() {
        return {
            localColor: this.modelValue,
            showPicker: false,
            colors: {
                hex: this.modelValue,
            },
            picker: null,
        }
    },
    updated() {
        this.localColor = this.modelValue;
        this.picker.setColor(this.localColor);
    },
    methods: {
        triggerClicked() {
            console.log(this.picker.isOpen());
            this.picker.show();
        },

        updateFromPicker(v) {
            console.log(v);
        },
    },
    watch: {
        localColor(v) {
            this.$emit("update:modelValue", v);
        }
    }
}
</script>

<style scoped>
.color-preview {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: inline-block;
    margin-right: 35px;
    vertical-align:middle;
    cursor: pointer;
}

.color-inner {
    display:inline-block;
    vertical-align:middle;
}
</style>
