// resources/js/router.js
import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from './components/Login.vue';
import Signup from './components/Signup.vue';
import InventoryManagement from './components/InventoryManagement.vue';
import ItemManagement from './components/ItemManagement.vue';

Vue.use(VueRouter);

export default new VueRouter({
  routes: [
    { path: '/login', component: Login },
    { path: '/signup', component: Signup },
    { path: '/inventory', component: InventoryManagement },
    { path: '/items', component: ItemManagement }
  ]
});
