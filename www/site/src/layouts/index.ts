import { defineAsyncComponent } from 'vue'

export const DefaultLayout = defineAsyncComponent(
  () => import('@/layouts/Default.vue')
)
export const MainLayout = defineAsyncComponent(
  () => import('@/layouts/Main.vue')
)
