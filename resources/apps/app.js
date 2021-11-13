require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
//import VueAxios from 'vue-axios';
//import Axios from 'axios';
import store from './store'
//Vue.use(VueRouter,VueAxios,Axios);
import routes from './routers'
import App from './components/App.vue';
import { ClientTable, ServerTable } from 'vue-tables-2'
import VueToastr2 from 'vue-toastr-2'
import 'vue-toastr-2/dist/vue-toastr-2.min.css'
import Vuelidate from 'vuelidate'
import 'vue-search-select/dist/VueSearchSelect.css'

//const router = new VueRouter({ mode: 'history', routes: routes });
//new Vue(Vue.util.extend({ router }, App)).$mount("#app");

window.toastr = require('toastr')
 
Vue.use(VueRouter);
Vue.use(VueToastr2)
Vue.use(ClientTable)
Vue.use(ServerTable, {skin: 'table table-striped'}, false, 'bootstrap4')
Vue.use(Vuelidate)

export const router = new VueRouter({
    mode: 'history',
    routes: routes
});


router.beforeEach((to, from, next) => {

    // Save access token to local storage when user logged in
    if (to.path == "/loggedin" && to.query.token !== undefined) {

      // Remove token if exists
      if (localStorage.getItem('token_ttl')) {

        localStorage.removeItem('token');
      }
  
      //const now = new Date()
      store.commit('login', to.query.token)
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + to.query.token
      next({ path: '/' });
    }

    // Check login time expired
    if (localStorage.getItem('token_ttl')) {

        const now = new Date().getTime()

        if (now > localStorage.getItem('token_ttl')){

          document.cookie = 'sso_token=; Max-Age=-99999999;';
          localStorage.removeItem('token');
          localStorage.removeItem('userInfo');
          localStorage.clear();
          axios.post('/logout')
              .then(() => location.href = '/')
        }

        localStorage.setItem("token_ttl", now + (3*60*60*1000))  
    }
  
    // Remove access token from local storage when user logged out
    if (to.path == "/loggedout/") {

      store.commit('logout')
      next({ path: '/' });
    }
  
    // If the route requires auth, and user not logged in, then do register first
    if (to.matched.some(record => record.meta.requiresAuth) && !store.getters.isAuth) {
      //document.location = "/sso";
      next()
    }
  
    // Set axios header when user authed
    if (store.getters.isAuth) {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token')
    }
  
    next() 
})

const app = new Vue({
    el: '#app',
    router,
    render: (h) => h(App)
});
