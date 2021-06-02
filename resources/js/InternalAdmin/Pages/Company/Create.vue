<template>
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="lg:flex lg:items-center lg:justify-between">
  <div class="flex-1 min-w-0">
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
      New Company
    </h2>
    <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
      <!-- <div class="mt-2 flex items-center text-sm text-gray-500">
        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        200
      </div> -->
      <!-- <div class="mt-2 flex items-center text-sm text-gray-500">
        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
        </svg>
        Closing on January 9, 2020
      </div> -->
    </div>
  </div>
  <div class="mt-5 flex lg:mt-0 lg:ml-4">
    <span class="sm:ml-3">
      <router-link :to="{name: 'company-management'}" type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
        <!-- Heroicon name: solid/check -->
        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
        Back
      </router-link>
    </span>
  </div>
</div>

<div class="max-w-2xl">
  <!-- Replace with your content -->
  <div class="py-4">
      <!-- Page Content -->
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
          <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                  <form @submit.prevent="submit" method="POST">
                      <div class="shadow overflow-hidden sm:rounded-md">
                          <div class="px-4 py-5 bg-white sm:p-6">
                              <div class="grid grid-cols-6 gap-6">
                                  <div class="col-span-6">
                                      <label for="name"
                                          class="block text-sm font-medium text-gray-700">Company Name</label>
                                      <input type="text" v-model="form.name" required id="name"
                                          autocomplete="off"
                                          class="mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <div v-show="form_errors?.name" class="mt-1 text-red-500">{{form_errors?.name[0]}}</div>
                                  </div>

                                  <!-- Navigation -->
                                  <div class="col-span-6">
                                      <label for="assigned_csm_email_level"
                                          class="block text-sm font-medium text-gray-700">Assigned CSM Email</label>
                                      <input type="email" v-model="form.assigned_csm_email" required id="assigned_csm_email"
                                          class="mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                  </div>

                                  <!-- Path -->
                                  <div class="col-span-6">
                                      <label for="customer_admin_email"
                                          class="block text-sm font-medium text-gray-700">Customer Admin Email</label>
                                      <input type="email" v-model="form.customer_admin_email" required id="customer_admin_email"
                                          class="mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                  </div>

                                  <!-- Campaign Manager -->
                                  <div class="col-span-6">
                                      <label for="campaign_manager"
                                          class="block text-sm font-medium text-gray-700">Campaign Manager</label>
                                      <input type="text" v-model="form.campaign_manager" required id="campaign_manager"
                                          class="mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                  </div>

                                    <!-- Features -->
                                  <div class="col-span-6">
                                      <div class="block">
                                        <span class="text-gray-700">Features</span>
                                        <div class="mt-2">
                                          <div>
                                            <label class="inline-flex items-center">
                                              <input type="checkbox" class="form-checkbox text-green-500" checked>
                                              <span class="ml-2">Stripe Payment</span>
                                            </label>
                                          </div>

                                          <div>
                                            <label class="inline-flex items-center">
                                              <input type="checkbox" class="form-checkbox text-green-500" checked>
                                              <span class="ml-2">Intercom</span>
                                            </label>
                                          </div>

                                          <div>
                                            <label class="inline-flex items-center">
                                              <input type="checkbox" class="form-checkbox text-green-500" checked>
                                              <span class="ml-2">Calendly</span>
                                            </label>
                                          </div>

                                        </div>
                                      </div>

                                  </div>

                                  <div class="col-span-6 bg-gray-300" style="height:1px;"> </div>
                                  
                                  <div class="col-span-6">
                                        <toggle-button :label="'Ability to turn Individual Pages'"/>
                                        <toggle-button :label="'Asset type'" />
                                  </div>
                              </div>
                          </div>
                          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                              <router-link :to="{name: 'company-management'}"
                                  class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-black bg-gray-200 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 mr-1">
                                  Cancel
                              </router-link>
                              <submit-loading-button :isLoading="isLoading" />
                          </div>
                      </div>
                  </form>
              </div>
            </div>
          </div>
        </div>

  </div>
  <!-- /End replace -->
</div>

</template>
<script>
import { DEFAULT_LAYOUT } from '@/InternalAdmin/layouts.js'
import ToggleButton from '@/InternalAdmin/Components/ToggleButton'
import SubmitLoadingButton from '@/InternalAdmin/Components/SubmitLoadingButton'

export default {
    data() {
      return {
        isLoading: false,
        form: {
          name: '',
          assigned_csm_email: '',
          customer_admin_email: '',
          campaign_manager: ''
        },
        form_errors: null,
      }
    },
    components: {
        ToggleButton,
        SubmitLoadingButton
    },
    mounted() {
      this.$store.commit('SET_LAYOUT', DEFAULT_LAYOUT)
    },
    methods: {
      async submit() {
          this.isLoading = true;
        this.$store.dispatch('company/create', this.form).then(
          (res) => {
            this.$notify({ type: "success", text: res.data.message });
            this.form = {
              name: '',
              assigned_csm_email: '',
              customer_admin_email: '',
              campaign_manager: ''
            }
            // this.$router.push({ name: 'home'});
          },
          error => {
            if (error.response.status == 422) {
              this.form_errors = error.response.data.errors
              return;
            }
            this.$notify({ type: "error", text: error.response.data.message });
          }
        ).then(() => {
          this.isLoading = false;
        });
      }
    }
}
</script>