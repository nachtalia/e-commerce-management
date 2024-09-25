<script setup>
import SidebarMenu from './SidebarMenu.vue'
</script>

<template>
   <section class="grid grid-cols-[1fr_1.25em] px-[0.875em] py-2">
      <p class="font-medium text-sm">{{ $page.props.auth.user.name }}</p>
      <p class="text-xs text-muted-foreground">
         {{ $page.props.auth.user.email }}
      </p>
      <div class="row-span-full col-start-2 h-5">
         <SidebarMenu />
      </div>
   </section>
</template>
