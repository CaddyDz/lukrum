require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Toasted from 'vue-toasted';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const myMixin = {
    methods: {
        route,
        isObjectEmpty(someObject){
          return !(Object.keys(someObject).length)
        },
    }
}

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin(myMixin)
    .use(InertiaPlugin)
    .component('QuillEditor', QuillEditor)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });
