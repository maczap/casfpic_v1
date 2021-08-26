/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueResource from 'vue-resource'
Vue.use(VueResource)

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueMask from 'v-mask'
Vue.use(VueMask);

import ViaCep from 'vue-viacep'
Vue.use(ViaCep);

import store from './store'
import  CpCadastro  from './components/cadastro.vue'
import  CpCookie  from './components/cookie.vue'

window.csrfToken = document.querySelector('meta[name="csrf-token"]').content;


var router = new VueRouter({
    mode: 'history',
    routes: []
  });

const app = new Vue({
    router,
    el: '#app',
    components:{
        CpCadastro,
        CpCookie
    },    
    mounted: function () {
    },
    store,  
});
