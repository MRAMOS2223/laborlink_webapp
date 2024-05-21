<script setup>
import upgradeBannerDark from '@images/pro/upgrade-banner-dark.png'
import upgradeBannerLight from '@images/pro/upgrade-banner-light.png'
import VerticalNavLayout from '@layouts/components/VerticalNavLayout.vue'
import VerticalNavLink from '@layouts/components/VerticalNavLink.vue'
import { useTheme } from 'vuetify'

// Components
import Footer from '@/layouts/components/Footer.vue'
import NavbarThemeSwitcher from '@/layouts/components/NavbarThemeSwitcher.vue'
import UserProfile from '@/layouts/components/UserProfile.vue'

const vuetifyTheme = useTheme()

const upgradeBanner = computed(() => {
  return vuetifyTheme.global.name.value === 'light' ? upgradeBannerLight : upgradeBannerDark
})

let title = ""

function updateTitle(linkTitle) {
  
  if(linkTitle.includes("transactions")){
    title="Transactions"
  }
  else if(linkTitle.includes("dashboard")){
    title="Dashboard"
  }
  else if(linkTitle.includes("employers")){
    title="Employers"
  }
  else if(linkTitle.includes("applicants")){
    title="Applicants"
  }
  else if(linkTitle.includes("chat-support")){
    title="Chat Support"
  }
  else if(linkTitle.includes("statistics")){
    title="Statistics"
  }
  else if(linkTitle.includes("subscribers")){
    title="Subscribers"
  }
}

updateTitle(window.location.href)
</script>

<template>
  <VerticalNavLayout>
    <!-- 👉 navbar -->
    <template #navbar="{ toggleVerticalOverlayNavActive }">
      <div class="d-flex h-100 align-center">
        <!-- 👉 Vertical nav toggle in overlay mode -->
        <IconBtn
          class="ms-n3 d-lg-none"
          @click="toggleVerticalOverlayNavActive(true)"
        >
          <VIcon icon="bx-menu" />
        </IconBtn>

        <h3 class="title">
          {{ title }}
        </h3>

        <VSpacer />

        <NavbarThemeSwitcher class="me-2" />

        <UserProfile />
      </div>
    </template>

    <template #vertical-nav-content>
      <VerticalNavLink
        :item="{
          title: 'Dashboard',
          icon: 'bx-home',
          to: '/dashboard',
        }"
        @click="updateTitle('dashboard')"
      />
      <VerticalNavLink
        :item="{
          title: 'Employers',
          icon: 'mdi-domain',
          to: '/employers',
        }"
        @click="updateTitle('employers')"
      />

      <VerticalNavLink
        :item="{
          title: 'Applicants',
          icon: 'mdi-account-group',
          to: '/applicants',
        }"
        @click="updateTitle('applicants')"
      />

      <VerticalNavLink
        :item="{
          title: 'Chat Support',
          icon: 'mdi-face-agent',
          to: '/chat-support',
        }"
        @click="updateTitle('chat-support')"
      />

      <VerticalNavLink
        :item="{
          title: 'Statistics',
          icon: 'mdi-chart-box-outline',
          to: '/statistics',
        }"
        @click="updateTitle('statistics')"
      />
      
      <VerticalNavLink
        :item="{
          title: 'Subscribers',
          icon: 'mdi-account-multiple-outline',
          to: '/subscribers',
        }"
        @click="updateTitle('subscribers')"
      />

      <VerticalNavLink
        :item="{
          title: 'Transactions',
          icon: 'mdi-bank-transfer',
          to: '/transactions',
        }"
        @click="updateTitle('transactions')"
      />
    </template>
    <slot />

    <!-- 👉 Footer -->
    <template #footer>
      <Footer />
    </template>
  </VerticalNavLayout>
</template>

<style lang="scss" scoped>
.meta-key {
  border: thin solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 6px;
  block-size: 1.5625rem;
  line-height: 1.3125rem;
  padding-block: 0.125rem;
  padding-inline: 0.25rem;
}

.title {
  color: black;
}
</style>
