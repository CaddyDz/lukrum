<template>
  <div>
    <!--
      Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
      Read the documentation to get started: https://tailwindui.com/documentation
    -->
      <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
          <!-- <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/v1/workflow-mark-on-white.svg" alt="Workflow"> -->
          <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
            SalesForce
          </h2>
          <h4 class="mt-2 text-center text-xl leading-9 font-extrabold text-gray-900">Forgot Password</h4>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
          <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form @submit.prevent="forgotPassword" method="POST">
              <div v-show="invalid_message.status" class="flex pb-2 text-red-500"><svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg> {{invalid_message.message}}</div>
              <div v-show="success_message" class="flex pb-2 text-green-500">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                We have emailed your password reset link!
              </div>
              <div>
                <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                  Email address
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input id="email" type="email" v-model="form.email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
              </div>

              <div class="mt-6">
                <span class="block w-full rounded-md shadow-sm">
                  <button type="submit" :disabled="isLoading" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-500 focus:outline-none focus:border-cyan-700 focus:shadow-outline-cyan active:bg-cyan-700 transition duration-150 ease-in-out">
                    <span v-show="isLoading">
                      Please wait...
                    </span>
                    <span v-show="!isLoading">
                      Send
                    </span>
                  </button>
                </span>
              </div>
              <div class="mt-1">
                <span class="block w-full rounded-md shadow-sm">
                  <router-link :to="{name: 'login'}" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-700 transition duration-150 ease-in-out">
                    <span>
                      Back to login
                    </span>
                  </router-link>
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</template>
<script>
import { LOGIN_LAYOUT } from '@/InternalAdmin/layouts.js'
import { LOGIN_API_URL } from '@/InternalAdmin/router/api_routes.js'
export default {
  data() {
    return {
      isLoading: false,
      invalid_message: {
        status: false,
        message: 'Invalid Email'
      },
      success_message: false,
      form: {
        email: '',
      }
    }
  },
  mounted() {
    this.$store.commit('SET_LAYOUT', LOGIN_LAYOUT)
    },
  methods: {
      resetValidationMessage() {
        this.success_message = false;
        this.invalid_message.status = false;
      },
      async forgotPassword() {
        this.isLoading = true;
            let response = await axios.post(process.env.MIX_API_URL + '/auth/forgot-password', this.form).then(
          () => {
            this.resetValidationMessage();
            // this.$router.push({ name: 'home'});
            this.success_message = true
          },
          error => {
            this.resetValidationMessage();
            this.invalid_message.status = true;
            if (error.response.status == 422) {
              this.invalid_message.message = error.response.data.message
            }
          }
        ).then(() => {
          this.isLoading = false;
        });
      }
  }
}
</script>