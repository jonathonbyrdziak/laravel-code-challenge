/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import App from './components/App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

/**
 * Not much documentation on this datatable, here's what I found.
 * 
 * https://github.com/GerkinDev/vuejs-datatable
 * https://gerkindev.github.io/vuejs-datatable/
 * 
 */
import 'vuejs-datatable/dist/themes/bootstrap-4.esm';
import {VuejsDatatableFactory} from 'vuejs-datatable';
Vue.use(VuejsDatatableFactory);

/**
 * Allows events to be passed back up the chain through the vuejs-datatable.
 * This is being used for the action buttons in the datatable cells
 *
 */
import EventBus from './eventBus';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
});
