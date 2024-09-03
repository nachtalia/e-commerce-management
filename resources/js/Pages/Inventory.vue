<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const activeSection = ref('sales');
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
        </template>

        <div class="flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-gray-200 border-r border-gray-300">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold">Navigation</h3>
                    <ul>
                        <li>
                            <button 
                                @click="activeSection = 'import'"
                                :class="{ 'font-semibold': activeSection === 'import' }"
                                class="block w-full px-4 py-2 text-left hover:bg-gray-300">
                                Import/Export
                            </button>
                        </li>
                        <li>
                            <button 
                                @click="activeSection = 'products'"
                                :class="{ 'font-semibold': activeSection === 'products' }"
                                class="block w-full px-4 py-2 text-left hover:bg-gray-300">
                                Products
                            </button>
                        </li>
                        <li>
                            <button 
                                @click="activeSection = 'supplier'"
                                :class="{ 'font-semibold': activeSection === 'supplier' }"
                                class="block w-full px-4 py-2 text-left hover:bg-gray-300">
                                Suppliers
                            </button>
                        </li>
                    </ul>
                </div>
            </aside>

            <!-- Main content -->
            <main class="flex-1 p-6">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="p-6 text-gray-900">
                        <div v-if="activeSection === 'import'">
                            <h3 class="text-xl font-semibold">Import/Export</h3>
                            <!-- Add content or charts here -->
                        </div>
                        <div v-if="activeSection === 'products'">
                            <h3 class="text-xl font-semibold">Products</h3>
                            <!-- Add recent activity logs here -->
                        </div>
                        <div v-if="activeSection === 'supplier'">
                            <h3 class="text-xl font-semibold">Suppliers</h3>
                            <!-- Add alerts here -->
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </AuthenticatedLayout>
</template>
