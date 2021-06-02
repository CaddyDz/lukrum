<template>
<div class="grid grid-cols-5">
    <div class="m-1 single-color" v-for="(c, idx) in colors" :class="{active: idx === selectedColor}">
        <h4 class="mb-2" v-text="c.title"></h4>
        <div class="color-thumb" @click="pickColor(idx)">
            <div class="color-sub-title">
                <span v-text="c.subTitle"></span>
            </div>
            <div class="color-demo" :style="{backgroundColor: c.css}"></div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: "AssetColorPicker",
        props: ["value"],
        emits: ["update:modelValue"],
        data() {
            return {
                colors: [{
                        title: "Color 1:",
                        subTitle: "#7BA7D8",
                        css: "#7BA7D8"
                    }, {
                        title: "Color 2:",
                        subTitle: "#A6C4E8",
                        css: "#A6C4E8"
                    }, {
                        title: "Color 3:",
                        subTitle: "#9BC386",
                        css: "#9BC386"
                    }, {
                        title: "Color 4:",
                        subTitle: "#F8E5A3",
                        css: "#F8E5A3"
                    }, {
                        title: "Color 5:",
                        subTitle: "#F8F8FF",
                        css: "#F8F8FF"
                }],
                selectedColor: null,
            }
        },

        methods: {
            preSelectCss(val) {
                const idx = this.colors.findIndex(x => x.css === val);
                if(idx >= 0) {
                    this.pickColor(idx);
                }
            },

            pickColor(idx) {
                this.selectedColor = idx;
                this.$emit('update:modelValue', this.colors[idx]);
            },
        }
    }
</script>

<style scoped>
.color-thumb {
    border:solid 1px rgb(89, 89, 89);
    cursor:pointer;
}

.single-color.active .color-thumb {
    border:solid 3px rgb(89, 89, 89);
}

.single-color.active .color-sub-title {
    border-bottom: solid 3px rgb(89, 89, 89);
}

.color-sub-title {
    text-align: center;
    background-color: rgb(236, 236, 236);
    border-bottom: solid 1px rgb(89, 89, 89);
}

.color-demo {
    height: 50px;
}

</style>
