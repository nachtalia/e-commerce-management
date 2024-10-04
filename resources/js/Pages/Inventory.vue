<script setup>
import { ref, computed } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'

import Modal from '@/Components/Modal.vue'

import Pagination from '@/Components/ui/pagination/Pagination.vue'
import PaginationEllipsis from '@/Components/ui/pagination/PaginationEllipsis.vue'
import PaginationFirst from '@/Components/ui/pagination/PaginationFirst.vue'
import PaginationLast from '@/Components/ui/pagination/PaginationLast.vue'
import PaginationNext from '@/Components/ui/pagination/PaginationNext.vue'
import PaginationPrev from '@/Components/ui/pagination/PaginationPrev.vue'

import Button from '@/Components/ui/button/Button.vue'
import Table from '@/Components/ui/table/Table.vue'
import TableBody from '@/Components/ui/table/TableBody.vue'
import TableCaption from '@/Components/ui/table/TableCaption.vue'
import TableCell from '@/Components/ui/table/TableCell.vue'
import TableHead from '@/Components/ui/table/TableHead.vue'
import TableHeader from '@/Components/ui/table/TableHeader.vue'
import TableRow from '@/Components/ui/table/TableRow.vue'
import TextInput from '@/Components/TextInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownMenuTrigger from '@/Components/ui/dropdown-menu/DropdownMenuTrigger.vue'
import InputLabel from '@/Components/InputLabel.vue'

const invoices = ref([
   { id: 'INV001', description: 'Paid', price: '$250.00', stock: 'Credit Card', category: 'Badge' },
   { id: 'INV002', description: 'Pending', price: '$150.00', stock: 'PayPal', category: 'Badge' },
   {
      id: 'INV003',
      description: 'Unpaid',
      price: '$350.00',
      stock: 'Bank Transfer',
      category: 'Badge'
   },
   { id: 'INV004', description: 'Paid', price: '$200.00', stock: 'Credit Card', category: 'Badge' },
   {
      id: 'INV005',
      description: 'Refunded',
      price: '$100.00',
      stock: 'Credit Card',
      category: 'Badge'
   },
   {
      id: 'INV006',
      description: 'Refunded',
      price: '$100.00',
      stock: 'Credit Card',
      category: 'Badge'
   },
   {
      id: 'INV007',
      description: 'Refunded',
      price: '$100.00',
      stock: 'Credit Card',
      category: 'Badge'
   },
   {
      id: 'INV008',
      description: 'Refunded',
      price: '$100.00',
      stock: 'Credit Card',
      category: 'Badge'
   },
   {
      id: 'INV009',
      description: 'Refunded',
      price: '$100.00',
      stock: 'Credit Card',
      category: 'Badge'
   },
   {
      id: 'INV010',
      description: 'Refunded',
      price: '$100.00',
      stock: 'Credit Card',
      category: 'Badge'
   },
   {
      id: 'INV011',
      description: 'Refunded',
      price: '$100.00',
      stock: 'Credit Card',
      category: 'Badge'
   },
   {
      id: 'INV012',
      description: 'Refunded',
      price: '$100.00',
      stock: 'Credit Card',
      category: 'Badge'
   },
   {
      id: 'INV013',
      description: 'Refunded',
      price: '$100.00',
      stock: 'Credit Card',
      category: 'Badge'
   },
   {
      id: 'INV014',
      description: 'Refunded',
      price: '$100.00',
      stock: 'Credit Card',
      category: 'Badge'
   }
])

const currentPage = ref(1)
const pageSize = 5
const showModal = ref(false)

const paginatedInvoices = computed(() => {
   const start = (currentPage.value - 1) * pageSize
   return invoices.value.slice(start, start + pageSize)
})

const handlePageChange = (page) => {
   currentPage.value = page
}

const openModal = () => {
   showModal.value = true
}

const closeModal = () => {
   showModal.value = false
}

const router = useRouter()

const form = ref({
   description: '',
   price: '',
   stock: '',
   category: ''
})

const submit = async () => {
   try {
      await router.post('/post', form.value)
   } catch (error) {
      console.error('Error submitting forms:', error)
   }
}
</script>

<template>
   <Head title="Products" />

   <AuthenticatedLayout>
      <template #header>
         <h2 class="font-sans text-3xl antialiased font-bold leading-tight text-gray-800">
            Products
         </h2>
      </template>

      <div class="flex flex-row-reverse mb-6">
         <PrimaryButton @click="openModal">
            <span>
               <svg
                  class="w-6 h-6 text-gray-500"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
               >
                  <path
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     stroke-width="2"
                     d="M12 4v16m8-8H4"
                  />
               </svg>
            </span>
            Create
         </PrimaryButton>
      </div>

      <div class="py-1 overflow-hidden bg-white border border-gray-200 rounded-xl">
         <Table>
            <TableHeader>
               <TableRow>
                  <TableHead>ID</TableHead>
                  <TableHead>Description</TableHead>
                  <TableHead>Price</TableHead>
                  <TableHead>Stock</TableHead>
                  <TableHead>Category</TableHead>
               </TableRow>
            </TableHeader>

            <TableBody>
               <TableRow v-for="invoice in paginatedInvoices" :key="invoice.id">
                  <TableCell>{{ invoice.id }}</TableCell>
                  <TableCell>{{ invoice.description }}</TableCell>
                  <TableCell>{{ invoice.price }}</TableCell>
                  <TableCell>{{ invoice.stock }}</TableCell>
                  <TableCell>
                     <span class="p-1 bg-gray-200 border rounded-full pe-2 ps-2">{{
                        invoice.category
                     }}</span>
                  </TableCell>
               </TableRow>
            </TableBody>
         </Table>
      </div>

      <!-- Pagination Controls -->
      <div class="flex items-center justify-between mt-4">
         <Pagination
            :total="invoices.length"
            :sibling-count="1"
            :default-page="currentPage"
            @page-changed="handlePageChange"
         >
            <template v-slot:pagination-controls="{ page, items }">
               <PaginationFirst :current="page" />
               <PaginationPrev :current="page" />
               <div class="flex items-center gap-1">
                  <template v-for="(item, index) in items" :key="index">
                     <PaginationEllipsis v-if="item.type === 'ellipsis'" :index="index" />
                     <Button
                        v-else-if="item.type === 'page'"
                        @click="handlePageChange(item.value)"
                        :class="{ 'bg-blue-500 text-white': item.value === page }"
                     >
                        {{ item.value }}
                     </Button>
                  </template>
               </div>
               <PaginationNext :current="page" />
               <PaginationLast :current="page" />
            </template>
         </Pagination>
      </div>

      <!-- Modal Component -->
      <Modal :show="showModal" @close="closeModal">
         <template #default>
            <h3 class="text-lg font-semibold p-4">Create New Invoice</h3>
            <form class="p-4">
               <div class="mt-4">
                  <InputLabel for="description">Description</InputLabel>
                  <TextInput
                     id="description"
v-model="form.description"
                     type="text"
                     class="w-full"
                  />
               </div>
               <div class="mt-4">
                  <InputLabel for="price">Price</InputLabel>
                  <TextInput id="price" v-model="form.price" type="text" class="mt-1 w-full" />
               </div>
               <div class="mt-4">
                  <InputLabel for="stock">Stock</InputLabel>
                  <TextInput
                     id="stock"
v-model="form.stock"
                     type="text"
                     class="mt-1 block w-full"
                  />
               </div>
               <div class="mt-4">
                  <InputLabel for="Category">Category</InputLabel>
                  <TextInput
                     id="category"
v-model="category"
                     type="text"
                     class="mt-1 block w-full"
                  />
               </div>
               <div class="mt-4">
                  <PrimaryButton type="button">Submit</PrimaryButton>
               </div>
            </form>
         </template>
         <template #footer>
            <Button @click="closeModal">Cancel</Button>
            <PrimaryButton @click="closeModal">Create</PrimaryButton>
         </template>
      </Modal>
   </AuthenticatedLayout>
</template>
