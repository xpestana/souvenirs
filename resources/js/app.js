require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Toaster from '@meforma/vue-toaster';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import CKEditor from '@ckeditor/ckeditor5-vue';
import mitt from  'mitt';

const emitter = mitt();

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const ap = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Toaster)
            .use( CKEditor )
            .use(VueSweetalert2)
            .mixin({ methods: { route } })
        ap.config.globalProperties.emitter = emitter
        ap.mount(el);
    },
});

InertiaProgress.init({ color: '#31516B' });
