require('./bootstrap');

window.Vue = require('vue');
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('front-page', require('./components/Front.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('InfiniteLoading', require('vue-infinite-loading'));
// Vue.component('MugenScroll ', require('vue-mugen-scroll'));


const app = new Vue({
    el: '#app',
});
