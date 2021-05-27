import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/home',
    name: 'home',
    component: () => import('../components/Home.vue')
  },
  {
    path: '/',
    name: 'signup',
    component: () => import('../components/Signup.vue')
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('../components/Login.vue')
  },
  {
    path: '/forgot-password',
    name: 'forgot-password',
    component: () => import('../components/ForgotPassword.vue')
  },
  {
    path: '/user-list',
    name: 'user-list',
    component: () => import('../components/UserTable.vue')
  },
  {
    path: '/profile',
    name: 'profile',
    component: () => import('../components/Profile.vue')
  },
  {
    path: '/add-role',
    name: 'add-role',
    component: () => import('../components/AddRole.vue')
  },
  {
    path: '/my-roles',
    name: 'roles',
    component: () => import('../components/Roles.vue')
  },
  {
    path: '/manage-roles',
    name: 'manage-roles',
    component: () => import('../components/ManageRole.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
