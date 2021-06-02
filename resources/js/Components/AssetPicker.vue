<template>
<div class="grid grid-cols-5">
    <div class="m-1 single-asset" v-for="(a, idx) in assets" :class="{active: idx === selectedAsset}">
        <h4 class="mb-2" v-text="a.title"></h4>

        <div class="color-thumb" @click="pickAsset(idx)">
            <div class="color-sub-title">
                <span v-text="a.color"></span>
            </div>
            <div class="color-demo" :style="{backgroundColor: a.color}"></div>
        </div>

<!--        <div class="asset-thumb" @click="pickAsset(idx)">-->
<!--            <div class="asset-demo" :style="{backgroundImage: 'url('+a.url+')'}"></div>-->
<!--        </div>-->
    </div>
</div>
</template>

<script>
    export default {
        name: "AssetPicker",
        props: ["value", "assets", ],
        emits: ["update:modelValue"],
        data() {
            return {
                selectedAsset: null,
            }
        },

        methods: {
            preSelectAsset(val) {
                const idx = this.assets.findIndex(x => x.id === val);
                if(idx >= 0) {
                    this.pickAsset(idx);
                }
            },

            pickAsset(idx) {
                this.selectedAsset = idx;
                this.$emit('update:modelValue', this.assets[idx]);
            },
        }
    }
</script>

<style scoped>
.color-thumb {
    border:solid 1px rgb(89, 89, 89);
    cursor:pointer;
}

.single-asset.active .color-thumb {
    border:solid 3px rgb(89, 89, 89);
}

.single-asset.active .color-sub-title {
    border-bottom: solid 3px rgb(89, 89, 89);
}

.color-sub-title {
    text-align: center;
    background-color: rgb(236, 236, 236);
    border-bottom: solid 1px rgb(89, 89, 89);
}


.color-demo {
    height: 50px;
    /*background-size: contain;*/
}

</style>
