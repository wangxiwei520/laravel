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
// 引入axios
import axios from 'axios'
// 直接把 axios 挂载在Vue的原型上
Vue.prototype.axios = axios;
/*--router----*/
//引入公共方法
import  commonFun from './common/common.js';
Vue.prototype.commonFun = commonFun;

import App from './App.vue';
import router from './router';
const url='/';/*设置全局请求地址*/
axios.interceptors.request.use(
    config => {
        let api_token = sessionStorage.getItem('api_token');
        if (api_token) {  // 判断是否存在token，如果存在的话，
            if (config.data == null) {
                config.data = {api_token:api_token};
            }else {
                config.data['api_token'] = api_token;
            }
        }
        if (config.url.indexOf(url) === -1) {
            config.url = url + config.url;/*拼接完整请求路径*/
        }
        return config;
    },
    err => {
        return Promise.reject(err);
    });
router.beforeEach((to, from, next) => {
    // 定义一个登录状态
    let isLogin;

    // 允许携带cookie
    axios.defaults.withCredentials=true;
    // 发送请求 去检查用户是否登录

    axios.post('/api/checkIsLogin')
        .then(response => {
            isLogin = response.data.data.isLogin;
            // 如果已经登录 true 直接放行
            if (isLogin) {
                next()
            } else {
                // 否则是 false
                // 如果去的是登录页
                if (to.path === '/login') {
                    next()
                } else {
                    // 如果去的是其他页码 跳转到登录页面
                    return next({'path': '/login'})
                }
            }
        })
});
Vue.use(ElementUI);
Vue.component('example', require('./components/ExampleComponent.vue').default);
// 全局路由守卫
const app = new Vue({
    router,  //添加的内容
    render: h => h(App)
}).$mount('#app');

