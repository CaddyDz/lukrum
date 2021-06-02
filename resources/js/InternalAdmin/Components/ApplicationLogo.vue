<template>
    <img v-if="instance" :src="url" alt="SalesForce Logo" />
</template>
<script>
import instanceLoader from '../tools/instance';
export default {
    props: ["mod"],
    data() {
        return {
            instance: null,
        }
    },
    async mounted() {
        this.instance = await instanceLoader();
    },
    computed: {
        url() {
            if(!this.instance) return "";

            const defKey = "logoUrl";
            const tryKey = defKey + this.mod;
            if(this.instance[tryKey]) return this.instance[tryKey];
            return this.instance[defKey];
        }
    }
}
</script>
