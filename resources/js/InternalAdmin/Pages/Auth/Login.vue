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
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
          <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form @submit.prevent="login" method="POST">
              <div v-show="invalid_message" class="flex pb-2 text-red-500"><svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg> Invalid Username or Password</div>
              <div>
                <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                  Email address
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input id="email" type="email" v-model="login.email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
              </div>

              <div class="mt-6">
                <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                  Password
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input id="password" type="password" v-model="login.password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
              </div>

              <div class="mt-6 flex items-center justify-between">
                <div class="flex items-center">
                  <input id="remember_me" v-model="login.remember" type="checkbox" class="form-checkbox h-4 w-4 text-cyan-600 transition duration-150 ease-in-out">
                  <label for="remember_me" class="ml-2 block text-sm leading-5 text-gray-900">
                    Remember me
                  </label>
                </div>

                <div class="text-sm leading-5">
                  <router-link :to="{ name: 'forgot-password' }" class="font-medium text-cyan-600 hover:text-cyan-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    Forgot your password?
                  </router-link>
                </div>
              </div>

              <div class="mt-6">
                <span class="block w-full rounded-md shadow-sm">
                  <button type="submit" :disabled="isLoading" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-500 focus:outline-none focus:border-cyan-700 focus:shadow-outline-cyan active:bg-cyan-700 transition duration-150 ease-in-out">
                    <span v-show="!isLoading">Sign in</span>
                    <span v-show="isLoading">Signing in...</span>
                  </button>
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
      invalid_message: false,
      login: {
        email: '',
        password: '',
        remember: ''
      }
    }
  },
  mounted() {
    if (this.$route.name === "login" && this.$store.state.auth.user) {
      this.$router.push({ name: 'home'});
    }
    this.$store.commit('SET_LAYOUT', LOGIN_LAYOUT)
    },
  methods: {
    login() {
      console.log('submitting');
      const form = reactive({
        email: this.login.email,
        password: this.login.password,
        remember: this.login.remember,
      });

      function submit() {
        Inertia.post('/auth/login', form)
      }

      return { form, submit }
    },
      // async userLogin() {
      //     this.isLoading = true;
      //       // let response = await this.$axios.$post(process.env.baseUrl + '/api/login', this.login);
      //   this.$store.dispatch('auth/login', this.login).then(
      //     () => {
      //       this.$router.push({ name: 'home'});
      //     },
      //     error => {
      //       this.invalid_message = true;
      //       // this.message =
      //       //   (error.response && error.response.data) ||
      //       //   error.message ||
      //       //   error.toString();
      //     }
      //   ).then(() => {
      //     this.isLoading = false;
      //   });
      // }
  }
}
</script>