<script setup lang="ts">
import { ref } from 'vue'

const phone = ref('')
const password = ref('')
const showPassword = ref(false)
const rules = {
  required: (value) => !!value || 'Required.',
  min: (v) => v.length >= 8 || 'Min 8 characters',
}
</script>

<template>
  <v-card>
    <v-card-text>
      <v-text-field
        v-model="phone"
        v-mask="'+7 (###) ###-##-##'"
        :rules="[() => !!phone || 'Поле обязательно для заполнения']"
        label="Номер телефона"
        placeholder="+7 999 999 99 99"
        bg-color="$firstColor"
        required
        color="primary"
      ></v-text-field>
      <v-text-field
        v-model="password"
        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
        :rules="[rules.required, rules.min]"
        :type="showPassword ? 'text' : 'password'"
        name="input-10-1"
        label="Пароль"
        color="primary"
        @click:append="showPassword = !showPassword"
      ></v-text-field>
    </v-card-text>
  </v-card>
</template>
