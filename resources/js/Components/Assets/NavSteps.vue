<template>
<nav class="component--steps pb-8 pt-4">
    <ol class="flex">
        <li v-for="s in steps" class="cursor-default ml-2.5 mr-2.5 text-xl text-center" :class="{prev: s.prev, active: s.active}" :data-step="s.step" v-text="s.step"></li>
    </ol>
</nav>
</template>

<script>
export default {
    name: "NavSteps",
    props:["totalSteps", "step"],
    data() {
        let steps = [];

        let totalSteps = this.totalSteps;
        if(!totalSteps) totalSteps = 5;

        for(let i = 1; i <= totalSteps; i++) {
            steps.push({
                step: i,
                prev: i < this.step,
                active: i === this.step,
                next: i > this.step,
            })
        }
        return {
            steps,
        }
    }
}
</script>
