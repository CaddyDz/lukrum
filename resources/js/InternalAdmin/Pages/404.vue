<template>
  <div>
    <!--
      Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
      Read the documentation to get started: https://tailwindui.com/documentation
    -->
      <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
          <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
            404 <small>Page Not Found.</small>
          </h2>
        </div>
      </div>
  </div>
</template>
<script>
import { NOT_FOUND_LAYOUT } from '@/InternalAdmin/layouts.js'
export default {
    mounted() {
        this.$store.commit('SET_LAYOUT', NOT_FOUND_LAYOUT)
    },
    setup() {
        
    },
}
</script>