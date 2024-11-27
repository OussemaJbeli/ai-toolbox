import './bootstrap';
import '../css/app.css';
import '../scss/app.scss';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import axios from 'axios';

import { AVPlugin } from "vue-audio-visual";

import VueHighlightJS from 'vue3-highlightjs';
import 'highlight.js/styles/default.css';

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(AVPlugin)
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(VueHighlightJS)
            .mount(el);
    },
    progress: {
        color: "#ffc502",
    },
});