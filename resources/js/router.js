import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            name:"index",
            path:'/',
            component: resolve =>void(require(['./components/ExampleComponent.vue'], resolve))
        },
        {
            name:"login",
            path:'/login',
            component: resolve =>void(require(['./components/admin/Login.vue'], resolve))
        }
    ],

})
