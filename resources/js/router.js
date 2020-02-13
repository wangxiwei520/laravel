import Vue from 'vue'
import VueRouter from 'vue-router'
//home 组件
import Home from './components/admin/Home.vue'
Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            name:"index",
            path:'/',
            component: resolve =>void(require(['./components/admin/Index.vue'], resolve)),
            // 子路由
            children: [
                // 默认子组件
                {
                    name: 'home',
                    path: '',
                    component: Home
                },
            ]
        },
        {
            name:"login",
            path:'/login',
            component: resolve =>void(require(['./components/admin/Login.vue'], resolve))
        }
    ],

})
