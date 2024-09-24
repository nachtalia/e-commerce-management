<script setup lang="ts">
import { ref } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import BarChart from '@/Components/ui/chart/BarChart.vue'

const activeSection = ref('sales')
</script>

<template>
   <Head title="Products" />

   <AuthenticatedLayout>
      <template #header>
         <h2 class="font-sans text-3xl antialiased font-bold leading-tight text-gray-800">
            Dashboard
         </h2>
      </template>

      <div class="flex">
         <div class="flex-auto w-80 bg-white border border-gray-200 rounded p-4 me-4 font-semibold">
            Total Revenue
            <div class="font-bold text-7xl mt-2">$1,213.00</div>
         </div>
         <div class="flex-auto w-20 bg-white border border-gray-200 rounded p-4 font-semibold">
            Products
            <div class="font-bold text-7xl mt-2">54,321</div>
         </div>
      </div>

      <div class="border border-gray-200 bg-white rounded mt-4">
         <div class="flex">
            <div class="flex-auto w-80 border border-gray-200 p-4 font-semibold">
               Bar Chart - Interactive
               <div class="font-normal">Showing total visitors for the last 3 months</div>
            </div>
            <div class="flex-auto w-10 border border-gray-200 p-4">
               Desktop
               <div class="font-bold text-3xl">24,828</div>
            </div>
            <div class="flex-auto w-10 border border-gray-200 p-4">
               Desktop
               <div class="font-bold text-3xl">25,010</div>
            </div>
         </div>

         <div>
            <BarChart />
         </div>
      </div>
   </AuthenticatedLayout>
</template>
