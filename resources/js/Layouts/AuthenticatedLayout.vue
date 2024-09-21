<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import { ArrowRightIcon, ShoppingCartIcon, UsersIcon, CogIcon } from '@heroicons/vue/24/outline';
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import { Link } from "@inertiajs/vue3";

// State for controlling sidebar visibility
const showingSidebar = ref(true);
</script>

<template>
   <div class="flex min-h-screen bg-gray-100">
     <!-- Sidebar -->
     <aside
       :class="{ hidden: !showingSidebar }"
       class="fixed top-0 left-0 w-64 h-screen bg-white border-r border-gray-200"
     >
       <div class="flex flex-col h-full">
         <div class="flex-1 px-6 py-4">
           <div class="flex items-center">
             <ApplicationLogo class="block w-auto text-gray-800 fill-current h-9" />
           </div>
 
           <nav class="mt-6">
             <ul>
               <li>
                 <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                   <ArrowRightIcon class="w-5 h-5 text-gray-500" />
                   <span class="ms-3">Products</span>
                 </NavLink>
               </li>
               <li>
                 <NavLink :href="route('inventory')" :active="route().current('inventory')">
                   <ShoppingCartIcon class="w-5 h-5 text-gray-500" />
                   <span class="ms-3">Inventory</span>
                 </NavLink>
               </li>
               <li>
                 <NavLink :href="route('user')" :active="route().current('user')">
                   <UsersIcon class="w-5 h-5 text-gray-500" />
                   <span class="ms-3">Users</span>
                 </NavLink>
               </li>
               <li>
                 <NavLink :href="route('setting')" :active="route().current('setting')">
                   <CogIcon class="w-5 h-5 text-gray-500" />
                   <span class="ms-3">Settings</span>
                 </NavLink>
               </li>
             </ul>
           </nav>
         </div>
 
         <!-- Dropdown Menu -->
         <div class="px-6 py-4 mt-auto border-t border-gray-200">
           <Dropdown align="bottom" width="48">
             <template #trigger>
               <span class="inline-flex rounded-md">
                 <button
                   type="button"
                   class="inline-flex items-center px-3 py-2 text-sm font-bold leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none text-start"
                 >
                   <div>
                     <span class="text-sm font-bold text-gray-600">
                       {{ $page.props.auth.user.name }}
                     </span>
                     <br class="my-2" />
                     <span class="text-xs text-gray-500">
                       {{ $page.props.auth.user.email }}
                     </span>
                   </div>
                   <svg
                     class="ms-2 -me-0.5 h-4 w-4"
                     xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20"
                     fill="currentColor"
                   >
                     <path
                       fill-rule="evenodd"
                       d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                       clip-rule="evenodd"
                     />
                   </svg>
                 </button>
               </span>
             </template>
 
             <template #content>
               <div class="relative">
                 <div
                   class="absolute right-0 z-10 w-48 mb-2 bg-white border border-gray-200 rounded-md shadow-lg bottom-full"
                 >
                   <DropdownLink :href="route('profile.edit')">
                     Profile
                   </DropdownLink>
                   <DropdownLink
                     :href="route('logout')"
                     method="post"
                     as="button"
                   >
                     Log Out
                   </DropdownLink>
                 </div>
               </div>
             </template>
           </Dropdown>
         </div>
       </div>
     </aside>
 
     <!-- Main content -->
     <div class="flex-1 ml-64">
       <header class="bg-white shadow" v-if="$slots.header">
         <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
           <slot name="header" />
         </div>
       </header>
 
       <!-- Page Content -->
       <main class="p-4">
         <slot />
       </main>
     </div>
   </div>
 </template>