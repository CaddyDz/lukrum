<template>
    <breeze-authenticated-layout>
        <!-- This example requires Tailwind CSS v2.0+ -->
    
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
          <!-- <h1 class="text-2xl font-semibold text-gray-900">Partners</h1> -->
          <div class="pb-3 border-b border-gray-200 sm:flex sm:items-center sm:justify-between">
            <!-- <h1 class="text-lg leading-6 font-medium text-gray-900"> -->
            <h1 class="text-2xl font-semibold text-gray-900">
              Partners
            </h1>
            <div class="mt-3 flex sm:mt-0 sm:ml-4">
              <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg> Import CSV
              </button>
              <button type="button" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create
              </button>
            </div>
          </div>
        </div>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
          <!-- Replace with your content -->
          <div class="py-4">
              <!-- Page Content -->
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                          <thead class="bg-gray-50">
                            <tr>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Partner Email
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Partner Navigation Level
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Path
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Campaign Manager
                              </th>
                              <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <!-- Odd row -->
                            <tr class="bg-white">
                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                Jane Cooper
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Regional Paradigm Technician
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                jane.cooper@example.com
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Admin
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                              </td>
                            </tr>

                            <!-- Even row -->
                            <tr class="bg-gray-50">
                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                Cody Fisher
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Product Directives Officer
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                cody.fisher@example.com
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Owner
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                              </td>
                            </tr>

                            <!-- More people... -->
                          </tbody>
                        </table>
                      </div>
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
    }
</script>
