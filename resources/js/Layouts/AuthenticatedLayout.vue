<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import NavLink from '@/Components/NavLink.vue'
import { buttonVariants } from '@/Components/ui/button'
import {
   DropdownMenu,
   DropdownMenuContent,
   DropdownMenuItem,
   DropdownMenuLabel,
   DropdownMenuSeparator,
   DropdownMenuTrigger
} from '@/Components/ui/dropdown-menu'
import { Separator } from '@/Components/ui/separator'
import { cn } from '@/lib/utils'
import { Link } from '@inertiajs/vue3'
import { ChevronDownIcon, GaugeIcon, PackageIcon } from 'lucide-vue-next'

const ICON_SIZE = 'size-5'

const navRoutes = [
   { href: 'dashboard', icon: GaugeIcon, title: 'Dashboard' },
   { href: 'inventory', icon: PackageIcon, title: 'Inventory' }
]
</script>

<template>
   <div class="grid grid-cols-[15.625em_1fr]">
      <!-- SIDEBAR -->
      <aside class="border flex flex-col min-h-svh">
         <!-- SIDEBAR HEADER -->
         <div class="inline-flex gap-1.5 justify-center items-center px-[0.875em] py-2">
            <span class="pt-2 pb-5">
               <ApplicationLogo class="size-16" />
            </span>
         </div>
         <!-- SIDEBAR NAV -->
         <nav class="grow flex flex-col gap-2 p-2">
            <template v-for="navRoute in navRoutes">
               <NavLink
                  :class="
                     cn(
                        buttonVariants({ variant: 'ghost' }),
                        'gap-1.5 justify-start p-1.5 text-base'
                     )
                  "
                  :href="route(navRoute.href)"
                  :active="route().current(navRoute.href)"
               >
                  <component :class="ICON_SIZE" :is="navRoute.icon" />
                  <span class="font-medium">{{ navRoute.title }}</span>
               </NavLink>
            </template>
         </nav>
         <Separator />
         <!-- SIDEBAR FOOTER -->
         <section class="grid grid-cols-[1fr_1.25em] px-[0.875em] py-2">
            <p class="font-medium text-sm">{{ $page.props.auth.user.name }}</p>
            <p class="text-xs text-muted-foreground">
               {{ $page.props.auth.user.email }}
            </p>
            <div class="row-span-full col-start-2 h-5">
               <!-- SIDEBAR MENU -->
               <DropdownMenu>
                  <DropdownMenuTrigger
                     :class="cn(buttonVariants({ size: 'icon', variant: 'ghost' }), ICON_SIZE)"
                  >
                     <ChevronDownIcon :class="ICON_SIZE" />
                  </DropdownMenuTrigger>
                  <DropdownMenuContent>
                     <DropdownMenuLabel>Menu</DropdownMenuLabel>
                     <DropdownMenuSeparator />
                     <DropdownMenuItem class="px-0 py-0">
                        <Link
                           class="grow px-2 py-1.5 text-start"
                           method="post"
                           as="button"
                           :href="route('logout')"
                           >Logout</Link
                        >
                     </DropdownMenuItem>
                  </DropdownMenuContent>
               </DropdownMenu>
            </div>
         </section>
      </aside>
      <!-- MAIN CONTENT  -->
      <main class="p-2">
         <slot />
      </main>
   </div>
</template>
