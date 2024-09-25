<script setup>
import NavLink from '@/Components/NavLink.vue'
import { buttonVariants } from '@/Components/ui/button'
import { cn } from '@/lib/utils'
import { GaugeIcon, PackageIcon } from 'lucide-vue-next'

const navRoutes = [
   { href: 'dashboard', icon: GaugeIcon, title: 'Dashboard' },
   { href: 'inventory', icon: PackageIcon, title: 'Inventory' }
]
</script>

<template>
   <nav class="grow flex flex-col gap-2 p-2">
      <template v-for="navRoute in navRoutes">
         <NavLink
            :class="
               cn(buttonVariants({ variant: 'ghost' }), 'gap-1.5 justify-start p-1.5 text-base')
            "
            :href="route(navRoute.href)"
            :active="route().current(navRoute.href)"
         >
            <component class="size-5" :is="navRoute.icon" />
            <span class="font-medium">{{ navRoute.title }}</span>
         </NavLink>
      </template>
   </nav>
</template>
