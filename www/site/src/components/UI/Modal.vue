<script setup lang="ts">
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
defineProps({
  hideFooter: { type: Boolean, default: false },
  closeButtonShow: { type: Boolean, default: true },
  modelValue: { type: Boolean, default: false },
})
const emit = defineEmits<{
  // eslint-disable-next-line no-unused-vars
  (e: 'update:modelValue', value: boolean): void
}>()
</script>

<template>
  <TransitionRoot as="template" :show="modelValue">
    <Dialog
      as="div"
      class="t-fixed t-z-10 t-inset-0 t-overflow-y-auto"
      @close="emit('update:modelValue', false)"
    >
      <div
        class="t-flex t-items-end t-justify-center t-min-h-screen t-pt-4 t-px-4 t-pb-20 t-text-center sm:t-block sm:t-p-0"
      >
        <TransitionChild
          as="template"
          enter="ease-out duration-300"
          enter-from="t-opacity-0"
          enter-to="t-opacity-100"
          leave="ease-in duration-200"
          leave-from="t-opacity-100"
          leave-to="t-opacity-0"
        >
          <DialogOverlay
            class="t-fixed t-inset-0 t-bg-gray-500 t-bg-opacity-75 t-transition-opacity"
          />
        </TransitionChild>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="t-hidden sm:t-inline-block sm:t-align-middle sm:t-h-screen" aria-hidden="true">
          &#8203;
        </span>
        <TransitionChild
          as="template"
          enter="ease-out duration-300"
          enter-from="t-opacity-0 t-translate-y-4 sm:t-translate-y-0 sm:t-scale-95"
          enter-to="t-opacity-100 t-translate-y-0 sm:t-scale-100"
          leave="ease-in duration-200"
          leave-from="t-opacity-100 t-translate-y-0 sm:t-scale-100"
          leave-to="t-opacity-0 t-translate-y-4 sm:t-translate-y-0 sm:t-scale-95"
        >
          <div
            class="t-relative t-inline-block t-align-bottom t-bg-white t-rounded-lg t-text-left t-overflow-hidden t-shadow-xl t-transform t-transition-all sm:t-my-8 sm:t-align-middle sm:t-max-w-lg sm:t-w-full"
          >
            <slot></slot>
            <div
              v-if="!hideFooter"
              class="t-bg-gray-50 t-px-4 t-py-3 t-sm:px-6 t-flex t-flex-row t-justify-end t-items-center t-space-x-[8px]"
            >
              <slot name="prependButtons"></slot>
              <v-btn
                v-if="closeButtonShow"
                color="warning"
                @click="emit('update:modelValue', false)"
              >
                Закрыть
              </v-btn>
              <slot name="appendButtons"></slot>
            </div>
          </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
