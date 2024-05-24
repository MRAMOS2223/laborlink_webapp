import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', redirect: '/login' },
    {
      path: '/',
      component: () => import('../layouts/default.vue'),
      children: [
        {
          path: 'dashboard',
          component: () => import('../pages/dashboard.vue'),
        },
        {
          path: 'employers',
          component: () => import('../pages/employers.vue'),
        },
        {
          path: 'applicants',
          component: () => import('../pages/applicants.vue'),
        },
        {
          path: 'chat-support',
          component: () => import('../pages/chat-support.vue'),
        },
        {
          path: 'statistics',
          component: () => import('../pages/statistics.vue'),
        },
        {
          path: 'subscribers',
          component: () => import('../pages/subscribers.vue'),
        },
        {
          path: 'profile',
          component: () => import('../pages/account-settings.vue'),
        },
        {
          path: 'transactions',
          component: () => import('../pages/transactions.vue'),
        },
        {
          path: 'user-ids',
          component: () => import('../pages/user-id-verification.vue'),
        },
        {
          path: 'account-settings',
          component: () => import('../pages/account-settings.vue'),
        },
      ],
    },
    {
      path: '/',
      component: () => import('../layouts/blank.vue'),
      children: [
        {
          path: 'login',
          component: () => import('../pages/login.vue'),
        },
        {
          path: 'register',
          component: () => import('../pages/register.vue'),
        },
        {
          path: 'forgot-password',
          component: () => import('../pages/forgot-password.vue'),
        },
        {
          path: '/:pathMatch(.*)*',
          component: () => import('../pages/[...all].vue'),
        },
      ],
    },
  ],
})

export default router
