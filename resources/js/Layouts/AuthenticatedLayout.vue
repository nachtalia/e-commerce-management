<script setup>
import { Sidebar } from '@/Components/sidebar'
</script>

<template>
   <div class="grid grid-cols-[15.625em_1fr]">
      <Sidebar />
      <main class="p-2">
         <slot />
      </main>
   </div>
</template>
