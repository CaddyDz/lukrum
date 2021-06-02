<template>
    <component v-bind:is="layout"></component>
</template>

<script>
import DefaultLayout from './layouts/Default'
import LoginLayout from './layouts/Login'
import NotFoundLayout from './layouts/NotFound'
export default {
  computed: {
    layout () {
      return this.$store.getters.layout
    }
  },
  components: {
    DefaultLayout,
    LoginLayout,
    NotFoundLayout
    // define as many layouts you want for the application
  }
}
</script>