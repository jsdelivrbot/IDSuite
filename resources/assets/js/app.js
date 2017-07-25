
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.amcharts = require('amcharts3');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// window.Vue = require('vue');
//
// require('vue-resource');

// Vue.component('example', require('./components/Example.vue'));
//
// Vue.component('appheader', require('./components/appheader.vue'));
//
// const app = new Vue({
//     el: '#root'
// });
//
// Vue.http.interceptors.push((request, next) =>{
//     request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);
//
//     next();
// });


/**
 * attach csrf token to all ajax request
 *
 */

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
