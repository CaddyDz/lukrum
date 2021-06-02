<template>
    <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" @input="inputOccurred" ref="input" v-model="localValue">
        <option v-for="o in options" :value="o.value" v-text="o.label"></option>
    </select>
</template>

<script>
    export default {
        props: ['modelValue', 'options', ],

        emits: ['update:modelValue'],

        data() {
            return {
                localValue: this.modelValue,
            }
        },

        updated() {
            this.localValue = this.modelValue;
        },

        methods: {
            focus() {
                this.$refs.input.focus()
            },

            inputOccurred(e) {
                this.$emit('update:modelValue', this.options[e.target.selectedIndex].value);
            }
        }
    }
</script>

