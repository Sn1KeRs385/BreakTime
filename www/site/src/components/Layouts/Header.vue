<script setup lang="ts">
import { Popover, PopoverButton, PopoverGroup, PopoverPanel } from '@headlessui/vue'
import {
  // BookmarkAltIcon,
  // CalendarIcon,
  // ChartBarIcon,
  // CursorClickIcon,
  MenuIcon,
  // PhoneIcon,
  // PlayIcon,
  // RefreshIcon,
  // ShieldCheckIcon,
  // SupportIcon,
  // ViewGridIcon,
  XIcon,
} from '@heroicons/vue/outline'
import { ChevronDownIcon } from '@heroicons/vue/solid'

const emit = defineEmits<{
  // eslint-disable-next-line no-unused-vars
  (e: 'onLoginClick'): void
}>()

const solutions = [
  // {
  //   name: 'Analytics',
  //   description: 'Get a better understanding of where your traffic is coming from.',
  //   href: '#',
  //   icon: ChartBarIcon,
  // },
  // {
  //   name: 'Engagement',
  //   description: 'Speak directly to your customers in a more meaningful way.',
  //   href: '#',
  //   icon: CursorClickIcon,
  // },
  // {
  //   name: 'Security',
  //   description: "Your customers' data will be safe and secure.",
  //   href: '#',
  //   icon: ShieldCheckIcon,
  // },
  // {
  //   name: 'Integrations',
  //   description: "Connect with third-party tools that you're already using.",
  //   href: '#',
  //   icon: ViewGridIcon,
  // },
  // {
  //   name: 'Automations',
  //   description: 'Build strategic funnels that will drive your customers to convert',
  //   href: '#',
  //   icon: RefreshIcon,
  // },
]
const callsToAction = [
  // { name: 'Watch Demo', href: '#', icon: PlayIcon },
  // { name: 'Contact Sales', href: '#', icon: PhoneIcon },
]
const resources = [
  // {
  //   name: 'Help Center',
  //   description: 'Get all of your questions answered in our forums or contact support.',
  //   href: '#',
  //   icon: SupportIcon,
  // },
  // {
  //   name: 'Guides',
  //   description: 'Learn how to maximize our platform to get the most out of it.',
  //   href: '#',
  //   icon: BookmarkAltIcon,
  // },
  // {
  //   name: 'Events',
  //   description: 'See what meet-ups and other events we might be planning near you.',
  //   href: '#',
  //   icon: CalendarIcon,
  // },
  // {
  //   name: 'Security',
  //   description: 'Understand how we take your privacy seriously.',
  //   href: '#',
  //   icon: ShieldCheckIcon,
  // },
]
const recentPosts = [
  // { id: 1, name: 'Boost your conversion rate', href: '#' },
  // { id: 2, name: 'How to use search engine optimization to drive traffic to your site', href: '#' },
  // { id: 3, name: 'Improve your customer experience', href: '#' },
]
</script>

<template>
  <Popover class="t-relative t-bg-white">
    <div>
      <div
        class="t-flex t-justify-between t-items-center t-border-b-2 t-border-gray-100 t-py-6 md:t-justify-start md:t-space-x-10"
      >
        <div class="t-flex t-justify-start lg:t-w-0 lg:t-flex-1">
          <a href="#">
            <span class="t-sr-only">Workflow</span>
            <img
              class="t-h-8 t-w-auto sm:t-h-10"
              src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
              alt=""
            />
          </a>
        </div>
        <div class="t--mr-2 t--my-2 md:t-hidden">
          <PopoverButton
            class="t-bg-white t-rounded-md t-p-2 t-inline-flex t-items-center t-justify-center t-text-gray-400 hover:t-text-gray-500 hover:t-bg-gray-100 focus:t-outline-none focus:t-ring-2 focus:t-ring-inset focus:t-ring-indigo-500"
          >
            <span class="t-sr-only">Open menu</span>
            <MenuIcon class="t-h-6 t-w-6" aria-hidden="true" />
          </PopoverButton>
        </div>
        <PopoverGroup as="nav" class="t-hidden md:t-flex t-space-x-10">
          <Popover v-slot="{ open }" class="t-relative">
            <PopoverButton
              :class="[
                open ? 't-text-gray-900' : 't-text-gray-500',
                't-group t-bg-white t-rounded-md t-inline-flex t-items-center t-text-base t-font-medium hover:t-text-gray-900 focus:t-outline-none focus:t-ring-2 focus:t-ring-offset-2 focus:t-ring-indigo-500',
              ]"
            >
              <span>Solutions</span>
              <ChevronDownIcon
                :class="[
                  open ? 't-text-gray-600' : 't-text-gray-400',
                  't-ml-2 t-h-5 t-w-5 group-hover:t-text-gray-500',
                ]"
                aria-hidden="true"
              />
            </PopoverButton>

            <transition
              enter-active-class="t-transition t-ease-out t-duration-200"
              enter-from-class="t-opacity-0 t-translate-y-1"
              enter-to-class="t-opacity-100 t-translate-y-0"
              leave-active-class="t-transition t-ease-in t-duration-150"
              leave-from-class="t-opacity-100 t-translate-y-0"
              leave-to-class="t-opacity-0 t-translate-y-1"
            >
              <PopoverPanel
                class="t-absolute t-z-10 -t-ml-4 t-mt-3 t-transform t-px-2 t-w-screen t-max-w-md sm:t-px-0 lg:t-ml-0 lg:t-left-1/2 lg:-t-translate-x-1/2"
              >
                <div
                  class="t-rounded-lg t-shadow-lg t-ring-1 t-ring-black t-ring-opacity-5 t-overflow-hidden"
                >
                  <div
                    class="t-relative t-grid t-gap-6 t-bg-white t-px-5 t-py-6 sm:t-gap-8 sm:t-p-8"
                  >
                    <a
                      v-for="item in solutions"
                      :key="item.name"
                      :href="item.href"
                      class="-t-m-3 t-p-3 t-flex t-items-start t-rounded-lg hover:t-bg-gray-50"
                    >
                      <component
                        :is="item.icon"
                        class="t-flex-shrink-0 t-h-6 t-w-6 t-text-indigo-600"
                        aria-hidden="true"
                      />
                      <div class="t-ml-4">
                        <p class="t-text-base t-font-medium t-text-gray-900">
                          {{ item.name }}
                        </p>
                        <p class="t-mt-1 t-text-sm t-text-gray-500">
                          {{ item.description }}
                        </p>
                      </div>
                    </a>
                  </div>
                  <div
                    class="t-px-5 t-py-5 t-bg-gray-50 t-space-y-6 sm:t-flex sm:t-space-y-0 sm:t-space-x-10 sm:t-px-8"
                  >
                    <div v-for="item in callsToAction" :key="item.name" class="t-flow-root">
                      <a
                        :href="item.href"
                        class="-t-m-3 t-p-3 t-flex t-items-center t-rounded-md t-text-base t-font-medium t-text-gray-900 hover:t-bg-gray-100"
                      >
                        <component
                          :is="item.icon"
                          class="t-flex-shrink-0 t-h-6 t-w-6 t-text-gray-400"
                          aria-hidden="true"
                        />
                        <span class="t-ml-3">{{ item.name }}</span>
                      </a>
                    </div>
                  </div>
                </div>
              </PopoverPanel>
            </transition>
          </Popover>

          <a href="#" class="t-text-base t-font-medium t-text-gray-500 hover:t-text-gray-900">
            Pricing
          </a>
          <a href="#" class="t-text-base t-font-medium t-text-gray-500 hover:t-text-gray-900">
            Docs
          </a>

          <Popover v-slot="{ open }" class="t-relative">
            <PopoverButton
              :class="[
                open ? 't-text-gray-900' : 't-text-gray-500',
                't-group t-bg-white t-rounded-md t-inline-flex t-items-center t-text-base t-font-medium hover:t-text-gray-900 focus:t-outline-none focus:t-ring-2 focus:t-ring-offset-2 focus:ring-indigo-500',
              ]"
            >
              <span>More</span>
              <ChevronDownIcon
                :class="[
                  open ? 't-text-gray-600' : 't-text-gray-400',
                  't-ml-2 t-h-5 t-w-5 group-hover:t-text-gray-500',
                ]"
                aria-hidden="true"
              />
            </PopoverButton>

            <transition
              enter-active-class="t-transition t-ease-out t-duration-200"
              enter-from-class="t-opacity-0 t-translate-y-1"
              enter-to-class="t-opacity-100 t-translate-y-0"
              leave-active-class="t-transition t-ease-in t-duration-150"
              leave-from-class="t-opacity-100 t-translate-y-0"
              leave-to-class="t-opacity-0 t-translate-y-1"
            >
              <PopoverPanel
                class="t-absolute t-z-10 t-left-1/2 t-transform -t-translate-x-1/2 t-mt-3 t-px-2 t-w-screen t-max-w-md sm:t-px-0"
              >
                <div
                  class="t-rounded-lg t-shadow-lg t-ring-1 t-ring-black t-ring-opacity-5 t-overflow-hidden"
                >
                  <div
                    class="t-relative t-grid t-gap-6 t-bg-white t-px-5 t-py-6 sm:t-gap-8 sm:t-p-8"
                  >
                    <a
                      v-for="item in resources"
                      :key="item.name"
                      :href="item.href"
                      class="-t-m-3 t-p-3 t-flex t-items-start t-rounded-lg hover:t-bg-gray-50"
                    >
                      <component
                        :is="item.icon"
                        class="t-flex-shrink-0 t-h-6 t-w-6 t-text-indigo-600"
                        aria-hidden="true"
                      />
                      <div class="t-ml-4">
                        <p class="t-text-base t-font-medium t-text-gray-900">
                          {{ item.name }}
                        </p>
                        <p class="t-mt-1 t-text-sm t-text-gray-500">
                          {{ item.description }}
                        </p>
                      </div>
                    </a>
                  </div>
                  <div class="t-px-5 t-py-5 t-bg-gray-50 sm:t-px-8 sm:t-py-8">
                    <div>
                      <h3
                        class="t-text-sm t-tracking-wide t-font-medium t-text-gray-500 t-uppercase"
                      >
                        t-Recent Posts
                      </h3>
                      <ul role="list" class="t-mt-4 t-space-y-4">
                        <li
                          v-for="post in recentPosts"
                          :key="post.id"
                          class="t-text-base t-truncate"
                        >
                          <a
                            :href="post.href"
                            class="t-font-medium t-text-gray-900 hover:t-text-gray-700"
                          >
                            {{ post.name }}
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="t-mt-5 t-text-sm">
                      <a href="#" class="t-font-medium t-text-indigo-600 hover:t-text-indigo-500">
                        t-View t-all posts
                        <span aria-hidden="true">&rarr;</span>
                      </a>
                    </div>
                  </div>
                </div>
              </PopoverPanel>
            </transition>
          </Popover>
        </PopoverGroup>
        <div class="t-hidden md:t-flex t-items-center t-justify-end md:t-flex-1 lg:t-w-0">
          <button
            type="button"
            class="t-whitespace-nowrap t-text-base t-font-medium t-text-gray-500 hover:t-text-gray-900"
            @click="emit('onLoginClick')"
          >
            Вход
          </button>
          <a
            href="#"
            class="t-ml-8 t-whitespace-nowrap t-inline-flex t-items-center t-justify-center t-px-4 t-py-2 t-border t-border-transparent t-rounded-md t-shadow-sm t-text-base t-font-medium t-text-white t-bg-indigo-600 hover:t-bg-indigo-700"
          >
            Регистрация
          </a>
        </div>
      </div>
    </div>

    <transition
      enter-active-class="t-duration-200 t-ease-out"
      enter-from-class="t-opacity-0 t-scale-95"
      enter-to-class="t-opacity-100 t-scale-100"
      leave-active-class="t-duration-100 t-ease-in"
      leave-from-class="t-opacity-100 t-scale-100"
      leave-to-class="t-opacity-0 t-scale-95"
    >
      <PopoverPanel
        focus
        class="t-absolute t-top-0 t-inset-x-0 t-p-2 t-transition t-transform t-origin-top-right md:t-hidden"
      >
        <div
          class="t-rounded-lg t-shadow-lg t-ring-1 t-ring-black t-ring-opacity-5 t-bg-white t-divide-y-2 t-divide-gray-50"
        >
          <div class="t-pt-5 t-pb-6 t-px-5">
            <div class="t-flex t-items-center t-justify-between">
              <div>
                <img
                  class="t-h-8 t-w-auto"
                  src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                  alt="Workflow"
                />
              </div>
              <div class="t--mr-2">
                <PopoverButton
                  class="t-bg-white t-rounded-md t-p-2 t-inline-flex t-items-center t-justify-center t-text-gray-400 hover:t-text-gray-500 hover:t-bg-gray-100 focus:t-outline-none focus:t-ring-2 focus:t-ring-inset focus:t-ring-indigo-500"
                >
                  <span class="t-sr-only">Close menu</span>
                  <XIcon class="t-h-6 t-w-6" aria-hidden="true" />
                </PopoverButton>
              </div>
            </div>
            <div class="t-mt-6">
              <nav class="t-grid t-gap-y-8">
                <a
                  v-for="item in solutions"
                  :key="item.name"
                  :href="item.href"
                  class="-t-m-3 t-p-3 t-flex t-items-center t-rounded-md hover:t-bg-gray-50"
                >
                  <component
                    :is="item.icon"
                    class="t-flex-shrink-0 t-h-6 t-w-6 t-text-indigo-600"
                    aria-hidden="true"
                  />
                  <span class="t-ml-3 t-text-base t-font-medium t-text-gray-900">
                    {{ item.name }}
                  </span>
                </a>
              </nav>
            </div>
          </div>
          <div class="t-py-6 t-px-5 t-space-y-6">
            <div class="t-grid t-grid-cols-2 t-gap-y-4 t-gap-x-8">
              <a href="#" class="t-text-base t-font-medium t-text-gray-900 hover:t-text-gray-700">
                Pricing
              </a>

              <a href="#" class="t-text-base t-font-medium t-text-gray-900 hover:t-text-gray-700">
                Docs
              </a>
              <a
                v-for="item in resources"
                :key="item.name"
                :href="item.href"
                class="t-text-base t-font-medium t-text-gray-900 hover:t-text-gray-700"
              >
                {{ item.name }}
              </a>
            </div>
            <div>
              <a
                href="#"
                class="t-w-full t-flex t-items-center t-justify-center t-px-4 t-py-2 t-border t-border-transparent t-rounded-md t-shadow-sm t-text-base t-font-medium t-text-white t-bg-indigo-600 hover:t-bg-indigo-700"
              >
                Регистрация
              </a>
              <p class="t-mt-6 t-text-center t-text-base t-font-medium t-text-gray-500">
                Уже есть аккаунт?
                {{ ' ' }}
                <button
                  type="button"
                  class="t-text-indigo-600 hover:t-text-indigo-500"
                  @click="emit('onLoginClick')"
                >
                  Вход
                </button>
              </p>
            </div>
          </div>
        </div>
      </PopoverPanel>
    </transition>
  </Popover>
</template>
