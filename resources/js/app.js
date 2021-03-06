/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import 'vue-search-select/dist/VueSearchSelect.css'
import VCalendar from 'v-calendar';

window.Vue = require('vue');

Vue.config.devtools = true;


import { library } from '@fortawesome/fontawesome-svg-core';
import { faStar,faStarHalfAlt,faFilm,faBook,faTv } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faStar,faStarHalfAlt,faFilm,faBook,faTv);

Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.use(VCalendar);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map((key) => {
    let name = key.split('/');
    let file = name.pop().split('.')[0];
    let dir = name.pop();
    if (dir !== 'components' && dir.charAt(0) !== '_') {
        file = dir + '' + file;
    }

    Vue.component(file.replace(/([a-z0-9])([A-Z])/g, '$1-$2').replace(/^-+|-+$/g, '').toLowerCase(), files(key).default)
});

Vue.component('rating-partial-form', require('./components/rating-partials/form').default);
Vue.component('profile-form', require('./components/profiles/form').default);
Vue.component('rating-form', require('./components/ratings/form').default);
Vue.component('rating-partial', require('./components/ratings/partials/rating-partial').default);
Vue.component('star', require('./components/ratings/partials/star').default);
Vue.component('star-rating', require('./components/ratings/partials/star-rating').default);
// Vue.component('default-form', require('./components/default/form').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
