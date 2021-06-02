<template>
    <breeze-authenticated-layout>
        <!-- This example requires Tailwind CSS v2.0+ -->

        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <!-- <h1 class="text-2xl font-semibold text-gray-900">Partners</h1> -->
            <div class="pb-3 border-b border-gray-200 sm:flex sm:items-center sm:justify-between">
                <!-- <h1 class="text-lg leading-6 font-medium text-gray-900"> -->
                <h1 class="text-2xl font-semibold text-gray-900">
                    Edit Partner
                </h1>
            </div>
        </div>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <!-- Replace with your content -->
            <!--
            This example requires Tailwind CSS v2.0+ 

            This example requires some changes to your config:

            ```
            // tailwind.config.js
            module.exports = {
              // ...
              plugins: [
                // ...
                require('@tailwindcss/forms'),
              ]
            }
            ```
          -->
            <div>
                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form @submit.prevent="submit" method="POST">
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6">
                                                <label for="email_address"
                                                    class="block text-sm font-medium text-gray-700">Email
                                                    address</label>
                                                <input type="email" required v-model="form.email" id="email_address"
                                                    autocomplete="email"
                                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            </div>

                                            <!-- Navigation -->
                                            <div class="col-span-6">
                                                <label for="navigation_level"
                                                    class="block text-sm font-medium text-gray-700">Navigation Level</label>
                                                <input type="text" required v-model="form.navigation_level" id="navigation"
                                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            </div>

                                            <!-- Path -->
                                            <div class="col-span-6">
                                                <label for="path"
                                                    class="block text-sm font-medium text-gray-700">Path</label>
                                                <input type="text" required v-model="form.path" id="path"
                                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                            
                                            <!-- Campaign Manager -->
                                            <div class="col-span-6">
                                                <label for="campaign_manager"
                                                    class="block text-sm font-medium text-gray-700">Campaign Manager</label>
                                                <input type="text" required v-model="form.campaign_manager" id="campaign_manager"
                                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <a :href="route('admin.partners')"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-black bg-gray-200 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 mr-1">
                                            Cancel
                                        </a>
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
        props: {
            partner: Object
        },
        data() {
            return {
                form: this.$inertia.form({
                    id: this.partner.id,
                    email: this.partner.email,
                    navigation_level: this.partner.navigation_level,
                    path: this.partner.path,
                    campaign_manager: this.partner.campaign_manager,
                }),
            }
        },
        created() {

        },
        methods: {
            submit() {
                this.form.put(route('admin.partners.update', this.partner?.id))
            },
        },
    }
</script>