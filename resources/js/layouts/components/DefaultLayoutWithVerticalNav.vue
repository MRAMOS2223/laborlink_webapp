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


updateTitle(window.location.href);

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

        <h3 class="title">{{ title }}</h3>

        <VSpacer />

        <NavbarThemeSwitcher class="me-2" />

        <UserProfile />
      </div>
    </template>

    <template #vertical-nav-content>
      <VerticalNavLink
        v-on:click="updateTitle('dashboard')"
        :item="{
          title: 'Dashboard',
          icon: 'bx-home',
          to: '/dashboard',
        }"
      />
      <VerticalNavLink
        v-on:click="updateTitle('employers')"
        :item="{
          title: 'Employers',
          icon: 'mdi-account-cog-outline',
          to: '/employers',
        }"
      />

      <VerticalNavLink
        v-on:click="updateTitle('applicants')"
        :item="{
          title: 'Applicants',
          icon: 'mdi-account-cog-outline',
          to: '/applicants',
        }"
      />

      <VerticalNavLink
        v-on:click="updateTitle('chat-support')"
        :item="{
          title: 'Chat Support',
          icon: 'mdi-account-cog-outline',
          to: '/chat-support',
        }"
      />

      <VerticalNavLink
        v-on:click="updateTitle('statistics')"
        :item="{
          title: 'Statistics',
          icon: 'mdi-account-cog-outline',
          to: '/statistics',
        }"
      />
      
      <VerticalNavLink
        v-on:click="updateTitle('subscribers')"
        :item="{
          title: 'Subscribers',
          icon: 'mdi-account-cog-outline',
          to: '/subscribers',
        }"
      />

      <VerticalNavLink
        v-on:click="updateTitle('transactions')"
        :item="{
          title: 'Transactions',
          icon: 'mdi-account-cog-outline',
          to: '/transactions',
        }"
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

.title{
  color: black;
}
</style>
