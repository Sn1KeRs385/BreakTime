import { createApp } from 'vue'
import App from '@/App.vue'
import router from '@/plugins/router'
import vuetify from '@/plugins/vuetify'
import { loadFonts } from '@/plugins/webfontloader'
import '@/styles/app.scss'
import { VueMaskDirective } from 'v-mask'

const vMaskV2 = VueMaskDirective
const vMaskV3 = {
  beforeMount: vMaskV2.bind,
  updated: vMaskV2.componentUpdated,
  unmounted: vMaskV2.unbind,
}

await loadFonts()

createApp(App).directive('mask', vMaskV3).use(vuetify).use(router).mount('#app')
