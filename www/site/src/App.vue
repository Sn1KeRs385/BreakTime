<template>
  <v-app>
    <v-main>
      <component :is="layout" v-if="layout">
        <router-view />
      </component>
      <router-view v-else />
    </v-main>
  </v-app>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'
import * as Layouts from '@/layouts'
import { LAYOUTS } from '@/plugins/router'

@Options({
  components: {
    ...Layouts,
  },
})
export default class App extends Vue {
  get layout(): string {
    let layout: string | undefined = this.$route.meta.layout as string
    if (layout) {
      if (!Object.keys(Layouts).includes(layout)) {
        layout = undefined
      }
    }
    return layout || LAYOUTS.DEFAULT_LAYOUT
  }
}
</script>
