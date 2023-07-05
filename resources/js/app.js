import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import axios from './axios';
import moment from 'moment';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const setGlobalProperties = (app) => {
    const axiosInstance = axios.create();

    app.config.globalProperties.$axios = { ...axiosInstance };

    app.config.globalProperties.$filters = {
        truncate(text, stop, clamp) {
            return text.slice(0, stop) + (stop < text.length ? clamp || '...' : '')
        },

        timeAgo(date) {
            return moment(date).fromNow();
        },
    }
};

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
          .use(plugin)
          .use(ZiggyVue, Ziggy);

        setGlobalProperties(app);

        app.mount(el);
        return app;
    },
    progress: {
        color: '#4B5563',
    },
});
