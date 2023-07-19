import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'loginPage',
    component: () => import('./../views/LoginPage.vue'),
  },
  {
    path: '/registerPage',
    name: 'registerPage',
    component: () => import('./../views/RegisterPage.vue'),
  },
  {
    path: '/homePage',
    name: 'homePage',
    component: () => import('./../views/HomePage/HomePage.vue'),
  },
  {
    path: '/cartPage',
    name: 'cartPage',
    component: () => import('./../views/HomePage/CartPage.vue'),
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
