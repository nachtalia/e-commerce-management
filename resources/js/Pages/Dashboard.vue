<script setup lang="ts">
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const activeSection = ref('sales');
</script>

<template>
  <Head title="Products" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-sans text-3xl antialiased font-bold leading-tight text-gray-800">Dashboard</h2>
    </template>

    <div class="py-1 overflow-hidden bg-white border border-gray-200 rounded-xl">
        DAshboard
</div>

  </AuthenticatedLayout>
</template>
