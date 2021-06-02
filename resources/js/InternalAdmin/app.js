require('./bootstrap');

// Import modules...
import { createApp, h, resolveComponent  } from 'vue';
import App from "@/InternalAdmin/App.vue";
import router from '@/InternalAdmin/router';
import { store } from './store';
import Notifications from '@kyvg/vue3-notification'

const el = document.getElementById('app');

// const app = createApp({
//   components: {
//     App
//   }
// });

// app.mount("#app");

const myMixin = {
    methods: {
        isObjectEmpty(someObject){
          return !(Object.keys(someObject).length)
        },
    }
}

const app = createApp(App)
.use(store)
.use(Notifications)
.mixin(myMixin)
.use(router).mount('#app');

// createApp({
//     render: h => h(App)
// })
// .mixin(myMixin)
// .mount(el);