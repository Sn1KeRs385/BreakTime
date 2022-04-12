<template>
  <default-layout>
    <header-layout @on-login-click="onOpenLoginPopUp" />
    <slot></slot>
    <!--    <v-dialog>-->
    <!--      <login />-->
    <!--    </v-dialog>-->
    <u-modal v-model="loginPopUpShow" hide-footer>
      <login />
    </u-modal>
  </default-layout>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'
import DefaultLayout from '@/layouts/Default.vue'
import HeaderLayout from '@/components/Layouts/Header.vue'
import Login from '@/components/Login.vue'
import UModal from '@/components/UI/Modal.vue'

@Options({
  components: { DefaultLayout, HeaderLayout, Login, UModal },
})
export default class MainLayout extends Vue {
  loginPopUpShow = false

  onOpenLoginPopUp() {
    this.loginPopUpShow = true
  }
}
</script>
