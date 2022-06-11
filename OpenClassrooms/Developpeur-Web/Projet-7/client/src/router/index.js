import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/signup',
    name: 'Signup',
    component: () => import('../views/Signup.vue')
  },
  {
    path: '/account',
    name: 'Account',
    component: () => import('../views/Account.vue')
  },
  {
    path: '/articles',
    name: 'Articles',
    component: () => import('../views/Articles.vue')
  },
  {
    path: '/article/new',
    name: 'New Article',
    component: () => import('../views/NewArticle.vue')
  },
  {
    path: '/article/:id',
    name: 'Article',
    component: () => import('../views/OneArticle.vue')
  },
  {
    path: '/article/update/:id',
    name: 'Article Update',
    component: () => import('../views/UpdateArticle')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
