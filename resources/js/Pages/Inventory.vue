<script setup>
import { ref, computed, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue'
import Pagination from '@/Components/ui/pagination/Pagination.vue'
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
import InputLabel from '@/Components/InputLabel.vue'
import DropdownMenu from '@/Components/DropdownMenu.vue'

const invoices = ref([])

const props = defineProps({
   product: Object
})

const currentPage = ref(1)
const pageSize = 8
const showModal = ref(false)
const showUpdateModal = ref(false)

const paginatedProducts = computed(() => {
   const start = (currentPage.value - 1) * pageSize
   return props.product.data.slice(start, start + pageSize) || []
})

watch(currentPage, () => {
   console.log('Page changed:', currentPage.value)
})
const handlePageChange = (page) => {
   currentPage.value = page
}

const openModal = () => {
   showModal.value = true
}

const closeModal = () => {
   showModal.value = false
   showUpdateModal.value = false
   resetForm()
}

const resetForm = () => {
   data.reset()
}

const data = useForm({
   id: '',
   name: '',
   description: '',
   price: '',
   stock: '',
   category: ''
})

const save = () => {
   if (data.id) {
      data.put(route('products.update', data.id), {
         onSuccess: () => {
            alert('Product updated successfully!')
            resetForm()
         }
      })
   } else {
      data.post(route('products.create'), {
         onSuccess: () => {
            alert('Product created successfully!')
            resetForm()
         }
      })
   }
}

const openUpdateModal = (product) => {
   data.id = product.id
   data.name = product.name
   data.description = product.description
   data.price = product.price
   data.stock = product.inventory.stock
   data.category = product.category.name
   showUpdateModal.value = true
}

const deleteProduct = (id) => {
   if (confirm('Are you sure you want to delete this product?')) {
      data.delete(route('products.destroy', id), {
         onSuccess: () => {
            alert('Product deleted successfully!')
         }
      })
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
                  <TableHead>Name</TableHead>
                  <TableHead>Description</TableHead>
                  <TableHead>Price</TableHead>
                  <TableHead>Stock</TableHead>
                  <TableHead>Category</TableHead>
                  <TableHead>Actions</TableHead>
               </TableRow>
            </TableHeader>

            <TableBody>
               <TableRow v-for="product in paginatedProducts" :key="product.id">
                  <TableCell>INV00{{ product.id }}</TableCell>
                  <TableCell>{{ product.name }}</TableCell>
                  <TableCell>{{ product.description }}</TableCell>
                  <TableCell>{{ product.price }}</TableCell>
                  <TableCell>{{ product.inventory.stock }}</TableCell>
                  <TableCell>
                     <span class="p-1 bg-gray-200 border rounded-full pe-2 ps-2">{{
                        product.category.name
                     }}</span>
                  </TableCell>
                  <TableCell>
                     <DropdownMenu
                        @update-item="openUpdateModal(product)"
                        @delete-item="deleteProduct(product.id)"
                     >
                     </DropdownMenu>
                  </TableCell>
               </TableRow>
            </TableBody>
         </Table>
      </div>

      <!-- Pagination Controls -->
      <div class="flex items-center justify-between mt-4">
         <Pagination
            :total="props.product.total"
            :sibling-count="1"
            :default-page="currentPage.value"
            @page-changed="handlePageChange"
         />
      </div>

      <!-- Modal for Creating New Product -->
      <Modal :show="showModal" @close="closeModal">
         <template #default>
            <h3 class="text-lg font-semibold p-4">Create New Product</h3>
            <form class="p-4" @submit.prevent="save">
               <div class="mt-4">
                  <InputLabel for="name">Name</InputLabel>
                  <TextInput
                     id="name"
                     v-model="data.name"
                     type="text"
                     class="mt-1 block w-full"
                     required
                  />
               </div>
               <div class="mt-4">
                  <InputLabel for="description">Description</InputLabel>
                  <TextInput
                     id="description"
                     v-model="data.description"
                     type="text"
                     class="w-full"
                     required
                  />
               </div>
               <div class="mt-4">
                  <InputLabel for="price">Price</InputLabel>
                  <TextInput
                     id="price"
                     v-model.number="data.price"
                     type="number"
                     class="mt-1 w-full"
                     min="0"
                     required
                  />
               </div>
               <div class="mt-4">
                  <InputLabel for="stock">Stock</InputLabel>
                  <TextInput
                     id="stock"
                     v-model.number="data.stock"
                     type="number"
                     class="mt-1 block w-full"
                     min="0"
                     required
                  />
               </div>
               <div class="mt-4">
                  <InputLabel for="category">Category</InputLabel>
                  <select v-model="data.category" id="category" class="mt-1 block w-full" required>
                     <option disabled value="">Select a category</option>
                     <option value="Category 1">Category 1</option>
                     <option value="Category 2">Category 2</option>
                  </select>
               </div>
               <div class="mt-4">
                  <PrimaryButton type="submit">Submit</PrimaryButton>
               </div>
            </form>
         </template>
         <template #footer>
            <Button @click="closeModal">Cancel</Button>
         </template>
      </Modal>

      <!-- Modal for Updating Product -->
      <Modal :show="showUpdateModal" @close="closeModal">
         <template #default>
            <h3 class="text-lg font-semibold p-4">Update Product</h3>
            <form class="p-4" @submit.prevent="save">
               <div class="mt-4">
                  <InputLabel for="name">Name</InputLabel>
                  <TextInput
                     id="name"
                     v-model="data.name"
                     type="text"
                     class="mt-1 block w-full"
                     required
                  />
               </div>
               <div class="mt-4">
                  <InputLabel for="description">Description</InputLabel>
                  <TextInput
                     id="description"
                     v-model="data.description"
                     type="text"
                     class="w-full"
                     required
                  />
               </div>
               <div class="mt-4">
                  <InputLabel for="price">Price</InputLabel>
                  <TextInput
                     id="price"
                     v-model.number="data.price"
                     type="number"
                     class="mt-1 w-full"
                     min="0"
                     required
                  />
               </div>
               <div class="mt-4">
                  <InputLabel for="stock">Stock</InputLabel>
                  <TextInput
                     id="stock"
                     v-model.number="data.stock"
                     type="number"
                     class="mt-1 block w-full"
                     min="0"
                     required
                  />
               </div>
               <div class="mt-4">
                  <InputLabel for="category">Category</InputLabel>
                  <select v-model="data.category" id="category" class="mt-1 block w-full" required>
                     <option disabled value="">Select a category</option>
                     <option value="Category 1">Category 1</option>
                     <option value="Category 2">Category 2</option>
                  </select>
               </div>
               <div class="mt-4">
                  <PrimaryButton type="submit">Update</PrimaryButton>
               </div>
            </form>
         </template>
         <template #footer>
            <Button @click="closeModal">Cancel</Button>
         </template>
      </Modal>
   </AuthenticatedLayout>
</template>
