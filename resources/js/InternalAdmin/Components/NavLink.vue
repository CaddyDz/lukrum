<template>
    <inertia-link :href="href" :class="classes">
        <slot />
    </inertia-link>
</template>

<script>
    export default {
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                            ? 'bg-cyan-100 text-cyan-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md'
                            : 'text-gray-100 bg-700 hover:bg-cyan-600 hover:text-gray-100 group flex items-center px-2 py-2 text-sm font-medium rounded-md'
            }
        }
    }
</script>
