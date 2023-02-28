/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';

import * as VueRouter from 'vue-router';
import LayoutComponent from './components/LayoutComponent.vue';
import CreateComponent from './components/CreateComponent.vue';
import EditComponent from './components/EditComponent.vue';
import AboutComponent from './components/AboutComponent.vue';
import CreateProduct from './components/products/CreateProduct.vue';
import UpdateProduct from './components/products/UpdateProduct.vue';
import ListOfProducts from './components/products/ListOfProducts.vue';

/**
 *
 *
 *
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

const routes = [
  { path: '/', component: LayoutComponent },
  { path: '/create', component: CreateComponent },
  {
    path: '/edit/:id', component: EditComponent, name: 'editUser', props: true,
  },
  {
    path: '/about/:id', component: AboutComponent, name: 'aboutUser', props: true,
  },
  { path: '/products', component: ListOfProducts },
  { path: '/products/create', component: CreateProduct },
  {
    path: '/products/edit/:id', component: UpdateProduct, name: 'updateProduct', props: true,
  },
];

const router = VueRouter.createRouter({
  history: VueRouter.createWebHistory(),
  routes,
});

app.component('layout', LayoutComponent);
app.use(router);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/LayoutComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
