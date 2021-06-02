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
                <div class="inline-flex sm:max-w-xs mr-3">
                  <span class="text-gray-400">
                    <svg class="mt-2 w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                  </span>
                  <input type="text" v-model="search_keyword" name="email" id="email" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="search...">
                </div>
                <inertia-link :href="route('admin.partners.import-csv')" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg> Import CSV
                </inertia-link>
              <inertia-link :href="route('admin.partners.create')" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                New
              </inertia-link>
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
                                <div class="flex">
                                    Partner Navigation Level
                                      <span v-if="sort_navigation_asc" style="cursor:pointer;" v-on:click="sort_partners($event, 'navigation_level', 'desc')">
                                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                      </span>
                                      <span v-else style="cursor:pointer;" v-on:click="sort_partners($event, 'navigation_level', 'asc')">
                                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                                      </span>
                                </div>
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex">
                                  Path
                                  <span v-if="sort_path_asc" style="cursor:pointer;" v-on:click="sort_partners($event, 'path', 'desc')">
                                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                  </span>
                                  <span v-else style="cursor:pointer;" v-on:click="sort_partners($event, 'path', 'asc')">
                                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                                  </span>
                                </div>
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex">
                                  Campaign Manager
                                  <span v-if="sort_campaign_asc" style="cursor:pointer;" v-on:click="sort_partners($event, 'campaign_manager', 'desc')">
                                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                  </span>
                                  <span v-else style="cursor:pointer;" v-on:click="sort_partners($event, 'campaign_manager', 'asc')">
                                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                                  </span>
                                </div>
                              </th>
                              <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <!-- Odd row -->
                            <template v-if="!isObjectEmpty(partners_data)">
                              <tr v-for="(partner, key) in partners_data" :key="key" class="bg-white">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                  {{ partner.email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                  {{ partner.navigation_level }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                  {{ partner.path }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                  {{ partner.campaign_manager }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                  <a :href="route('admin.partners.edit', partner.id)" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                              </tr>
                            </template>
                            <template v-else>
                              <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No Data.</td>
                              </tr>
                            </template>
                            <!-- More people... -->
                          </tbody>
                        </table>
                      </div>
                        <pagination :links="pagination_data" />
                    </div>
                  </div>
                </div>
          </div>
          <!-- /End replace -->
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Admin';
    import Pagination from "@/Components/Pagination";

    export default {
        components: {
            BreezeAuthenticatedLayout,
            Pagination,
        },
        props: {
          partners: Object
        },
        data() {
          return {
            sort_navigation_asc: true,
            sort_path_asc: true,
            sort_campaign_asc: true,
            search_request: null,
            search_keyword: "",
            search_field: "",
            search_sort_order: "",
            pagination_data: this.partners.links,
            partners_data: this.partners.data.map(item => {
                    return {
                        id: item.id,
                        email: item.email,
                        navigation_level: item.navigation_level,
                        path: item.path,
                        campaign_manager: item.campaign_manager
                    };
                })
          }
        },
        watch: {
          search_keyword: function(val) {
            this.filter();
          }
        },
        methods: {
          sort_partners(event, field, sort_order) {
            switch (field) {
              case "navigation_level":
                this.sort_navigation_asc = !this.sort_navigation_asc
                break;
              case "path":
                this.sort_path_asc = !this.sort_path_asc
                break;
              case "campaign_manager":
                this.sort_campaign_asc = !this.sort_campaign_asc
                break;
            
              default:
                break;
            }
            this.search_field = field;
            this.search_sort_order = sort_order;
            this.filter();
          },
          async filter() {
            this.cancelSearch();
            this.search_request = axios.CancelToken.source();
            let response = await axios.get(route('admin.partners.filter', this.search_keyword),
              { 
                cancelToken: this.search_request.token,
                params: {
                  field: this.search_field, sortOrder: this.search_sort_order
                }
              }).then((res) => {
              let data = res.data.data.data
              this.partners_data = data.map(item => {
                  return {
                      id: item.id,
                      email: item.email,
                      navigation_level: item.navigation_level,
                      path: item.path,
                      campaign_manager: item.campaign_manager,
                  };
              })
              this.pagination_data = res.data.data.links;
            }).catch(error => console.log(error));
          },
          cancelSearch () {
            if (this.search_request) {
              this.search_request.cancel('Start new search, stop active search');
              // console.log('cancel request done');
            }
          }
        }
    }
</script>
