<template>
  <div>
    <div class="ml-3 relative">
          <div>
            <button @click="toggleProfileDropDown" ref="userMenu" class="max-w-xs flex items-center text-sm rounded-full focus:outline-none focus:bg-gray-100 lg:p-2 lg:rounded-md lg:hover:bg-gray-100" id="user-menu" aria-label="User menu" aria-haspopup="true">
              <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
              <p class="hidden ml-3 text-gray-700 text-sm leading-5 font-medium lg:block">
                Admin
              </p>
              <!-- Heroicon name: chevron-down -->
              <svg class="hidden flex-shrink-0 ml-1 h-5 w-5 text-gray-400 lg:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
          <!--
            Profile dropdown panel, show/hide based on dropdown state.

            Entering: "transition ease-out duration-100"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          -->
          <div v-if="showProfileDropDown" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
            <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150" role="menuitem">Your Profile</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150" role="menuitem">Settings</a>
              <a href="javascript:;" @click="logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150" role="menuitem">Logout</a>
            </div>
          </div>
        </div>
  </div>
</template>
<script>
  export default {
    data: () => ({
      showProfileDropDown: false,
    }),
    methods: {
      async logout() {
        this.$store.dispatch('auth/logout');
        this.$router.push({name: 'login'});
      },
      toggleProfileDropDown: function (event) {
        return this.showProfileDropDown = !this.showProfileDropDown
      },
      close (e) {
        if (!this.$el.contains(e.target)) {
          this.showProfileDropDown = false
        }
      }
    },
    mounted () {
      document.addEventListener('click', this.close)
    },
    beforeDestroy () {
      document.removeEventListener('click',this.close)
    }
  }
</script>
