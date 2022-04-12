<template>
  <div class="max-w-screen-2xl mx-auto px-4 sm:px-6">
    <slot></slot>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'

@Options({
  components: {},
})
export default class DefaultLayout extends Vue {}
</script>
