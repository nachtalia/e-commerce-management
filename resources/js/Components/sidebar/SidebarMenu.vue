<script setup>
import { buttonVariants } from '@/Components/ui/button'
import {
   DropdownMenu,
   DropdownMenuContent,
   DropdownMenuItem,
   DropdownMenuLabel,
   DropdownMenuSeparator,
   DropdownMenuTrigger
} from '@/Components/ui/dropdown-menu'

import { cn } from '@/lib/utils'
import { Link } from '@inertiajs/vue3'
import { ChevronDownIcon } from 'lucide-vue-next'
</script>

<template>
   <DropdownMenu>
      <DropdownMenuTrigger
         :class="cn(buttonVariants({ size: 'icon', variant: 'ghost' }), 'size-5')"
      >
         <ChevronDownIcon class="size-5" />
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
</template>
