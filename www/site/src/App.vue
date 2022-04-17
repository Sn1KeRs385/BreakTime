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
import * as Layouts from '@/layouts'
import { LAYOUTS } from '@/plugins/router'
import { defineComponent, computed } from 'vue'
import { useRoute } from 'vue-router'

export default defineComponent({
  name: 'App',
  components: {
    ...Layouts,
  },
  setup() {
    const route = useRoute()
    const layout = computed((): string => {
      let layout: string | undefined = route.meta.layout as string
      if (layout) {
        if (!Object.keys(Layouts).includes(layout)) {
          layout = undefined
        }
      }
      return layout || LAYOUTS.DEFAULT_LAYOUT
    })
    return {
      layout,
    }
  },
})
</script>
