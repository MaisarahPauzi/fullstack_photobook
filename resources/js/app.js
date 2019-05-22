require('./bootstrap');
import Vue          from 'vue'
import VueRouter    from 'vue-router'
import Vuetify      from 'vuetify'
import Vuex         from 'vuex'

Vue.use(VueRouter)
Vue.use(Vuetify)
Vue.use(Vuex)

import App          from './views/App.vue'
import Dashboard    from './views/Dashboard'
import Login        from './views/Login'
import Register     from './views/Register'
import Home         from './views/Welcome'
import Photobook    from './views/Photobook'
import Upload       from './views/Upload'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                requiresAuth: true
               }
        },
        {
          path: '/photobook',
          name: 'photobook',
          component: Photobook,
          meta: {
            requiresAuth: true
           }
        },
        {
          path: '/upload',
          name: 'upload',
          component: Upload,
          meta: {
            requiresAuth: true
           }
        }
    ],
});



const store = new Vuex.Store({
    state: {
      loginToken:'',
      isLoggedin:false
    },
    mutations: {
     
      
      //authentication
      savetoken(state,newtoken){
        state.loginToken = newtoken
      },
      loggedIn(state){
        state.isLoggedin = true
      },
      loggedOut(state){
        state.isLoggedin = false;
        state.loginToken = '';
        router.push('login');
      }
    },
    actions: {
  
    }
  });

  router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      if (!store.state.isLoggedin) {
        next({
          path: '/login',
          query: { redirect: to.fullPath }
        })
      } else {
        next()
      }
    } else {
      next() // make sure to always call next()!
    }
  });
const app = new Vue({
    el: '#app',
    components: { App },
    store,
    router,
    
});