<script setup>
import { Separator } from '@/Components/ui/separator'
import SidebarFooter from './SidebarFooter.vue'
import SidebarHeader from './SidebarHeader.vue'
import SidebarNav from './SidebarNav.vue'
</script>

<template>
   <aside class="border flex flex-col min-h-svh">
      <SidebarHeader />
      <SidebarNav />
      <Separator />
      <SidebarFooter />
   </aside>
</template>
