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
                                @click="activeSection = 'sales'"
                                :class="{ 'font-semibold': activeSection === 'sales' }"
                                class="block w-full px-4 py-2 text-left hover:bg-gray-300">
                                Sales Reports
                            </button>
                        </li>
                        <li>
                            <button 
                                @click="activeSection = 'activity'"
                                :class="{ 'font-semibold': activeSection === 'activity' }"
                                class="block w-full px-4 py-2 text-left hover:bg-gray-300">
                                Recent Activity Logs
                            </button>
                        </li>
                        <li>
                            <button 
                                @click="activeSection = 'alerts'"
                                :class="{ 'font-semibold': activeSection === 'alerts' }"
                                class="block w-full px-4 py-2 text-left hover:bg-gray-300">
                                Alerts
                            </button>
                        </li>
                    </ul>
                </div>
            </aside>

            <!-- Main content -->
            <main class="flex-1 p-6">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="p-6 text-gray-900">
                        <div v-if="activeSection === 'sales'">
                            <h3 class="text-xl font-semibold">Sales Reports and Trends</h3>
                            <!-- Add content or charts here -->
                        </div>
                        <div v-if="activeSection === 'activity'">
                            <h3 class="text-xl font-semibold">Recent Activity Logs</h3>
                            <!-- Add recent activity logs here -->
                        </div>
                        <div v-if="activeSection === 'alerts'">
                            <h3 class="text-xl font-semibold">Alerts</h3>
                            <!-- Add alerts here -->
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </AuthenticatedLayout>
</template>
