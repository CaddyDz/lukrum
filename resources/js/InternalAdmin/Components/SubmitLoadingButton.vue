<template>
    <button type="submit" :disabled="isLoading"
        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
        <span v-show="!isLoading">
            Create
        </span>
        <span v-show="isLoading">Creating ...</span>
    </button>
</template>
<script>
export default {
    props: {
        isLoading: Boolean
    }
}
</script>