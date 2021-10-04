/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue').default;
 
 import axios from 'axios'
 Vue.prototype.$http = axios

 import Vuex from 'vuex'
 Vue.use(Vuex)

 import VueResource from 'vue-resource'
 Vue.use(VueResource)
 
 import VueRouter from 'vue-router'
 Vue.use(VueRouter)
 
 import VueMask from 'v-mask'
 Vue.use(VueMask);
 
 import ViaCep from 'vue-viacep'
 Vue.use(ViaCep);

 

 import moment from 'moment'
 Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('DD/MM/YYYY')
  }
});
  
 
 import store from './store'

 import routes  from './admin/routes.js'
 import MasterIndex from './admin/index.vue'

 import  CpIndex  from './admin/index.vue'
 
 var router = new VueRouter({
     mode: 'history',
     routes
  });
 
 const app = new Vue({
     router,
     el: '#admin',
     components:{
      CpIndex
      
     },    
     render: h => h(MasterIndex),
     components:{
       MasterIndex,
       
     },    
     store,     

     
 });
 