<script setup lang="ts">
import DefaultLayout from '@/layouts/Default.vue'
import HeaderLayout from '@/components/Layouts/Header.vue'
import Login from '@/components/Login.vue'
import UModal from '@/components/UI/Modal.vue'
import { ref } from 'vue'

let loginPopUpShow = ref(false)
const onOpenLoginPopUp = () => (loginPopUpShow.value = true)
</script>

<template>
  <default-layout>
    <header-layout @on-login-click="onOpenLoginPopUp" />
    <slot></slot>
    <u-modal v-model="loginPopUpShow">
      <login />
      <template #appendButtons>
        <v-btn color="primary" text>Вход</v-btn>
      </template>
    </u-modal>
  </default-layout>
</template>
