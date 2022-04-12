import { createRouter, createWebHashHistory } from 'vue-router'

export const LAYOUTS = {
  MAIN_LAYOUT: 'MainLayout',
  DEFAULT_LAYOUT: 'DefaultLayout',
}

const routes = [
  {
    path: '/',
    name: 'index',
    meta: { layout: LAYOUTS.MAIN_LAYOUT },
    component: () => import('@/pages/index.vue'),
  },
]

export default createRouter({
  history: createWebHashHistory(),
  routes,
})
