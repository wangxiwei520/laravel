/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/*--elemnent-ui--*/
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

/*--router----*/

import App from './App.vue'; //添加的内容
import router from './router';//添加的内容
Vue.use(ElementUI);
Vue.component('example', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    router,  //添加的内容
    render: h => h(App)
}).$mount('#app');

