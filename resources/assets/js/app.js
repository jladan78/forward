
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('client', require('./components/Client.vue')); 
Vue.component('rol', require('./components/Rol.vue'));
Vue.component('user', require('./components/User.vue'));
Vue.component('mbrp_questionnaire', require('./components/Mbrp_questionnaire.vue'));
Vue.component('mbrp_quest_cli', require('./components/Mbrp_quest_cli.vue'));
Vue.component('mbrp_parameter', require('./components/Mbrp_parameter.vue'));
Vue.component('brs_quest', require('./components/Brs_quest.vue'));
Vue.component('urica_quest', require('./components/Urica_quest.vue'));
Vue.component('hwbTracker_cli', require('./components/HwbTracker_cli.vue'));
Vue.component('radarExample', require('./components/RadarExample.vue'));

Vue.component('categoria', require('./components/Categoria.vue'));
Vue.component('articulo', require('./components/Articulo.vue'));
Vue.component('proveedor', require('./components/Proveedor.vue'));

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(require('vue-moment'));
Vue.use(ElementUI);


const app = new Vue({
    el: '#app',
    data :{
        menu : 0,
        minibar:''
    }
});
