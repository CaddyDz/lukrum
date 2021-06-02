<template>
    <breeze-authenticated-layout>
        <!-- This example requires Tailwind CSS v2.0+ -->
    
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
          <!-- <h1 class="text-2xl font-semibold text-gray-900">Partners</h1> -->
          <div class="pb-3 border-b border-gray-200 sm:flex sm:items-center sm:justify-between">
            <!-- <h1 class="text-lg leading-6 font-medium text-gray-900"> -->
            <h1 class="text-2xl font-semibold text-gray-900">
              Import CSV
            </h1>
          </div>
        </div>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
          <!-- Replace with your content -->
          <div class="py-4">
              <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                  <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Select CSV file to import partners.
                  </h3>
                  <!-- <div class="mt-2 max-w-xl text-sm text-gray-500">
                    <p>
                      Change the email address you want associated with your account.
                    </p>
                  </div> -->
                  <form @submit.prevent="submit" class="mt-5 sm:flex sm:items-center">
                    <div class="w-full sm:max-w-xs">
                        <input required type="file" @input="form.file = $event.target.files[0]">
                    </div>
                    <button type="submit" class="mt-3 w-full inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                      Import
                    </button>
                  </form>
                </div>
              </div>
          </div>
          <!-- /End replace -->
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Admin'

    export default {
        components: {
            BreezeAuthenticatedLayout,
        },
        data() {
          return {
            form: this.$inertia.form({
              file: null,
            }),
          }
        },
        created() {
          
        },
        methods: {
          submit() {
            this.form.post(route('admin.partners.store-csv'))
          },
        },
    }
</script>
