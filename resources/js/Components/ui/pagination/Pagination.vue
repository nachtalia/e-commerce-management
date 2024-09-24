<template>
   <nav aria-label="Pagination" class="flex items-center justify-between">
      <!-- First Page Button -->
      <button
         @click="goToPage(1)"
         :disabled="currentPage === 1"
         class="px-4 py-2 text-sm font-medium m-1 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300
            disabled:opacity-50"
      >
         First
      </button>

      <!-- Previous Page Button -->
      <button
         @click="goToPage(currentPage - 1)"
         :disabled="currentPage === 1"
         class="px-4 py-2 text-sm m-1 font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300
            disabled:opacity-50"
      >
         Prev
      </button>

      <!-- Page Numbers -->
      <template v-for="(item, index) in paginationItems" :key="index">
         <button
            v-if="item.type === 'page'"
            @click="goToPage(item.value)"
            :class="{ 'bg-blue-500 text-white': item.value === currentPage }"
            class="w-10 h-10 p-0 text-sm m-1 font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300"
         >
            {{ item.value }}
         </button>
         <span v-if="item.type === 'ellipsis'" class="px-4 py-2 text-sm font-medium text-gray-700">
            ...
         </span>
      </template>

      <!-- Next Page Button -->
      <button
         @click="goToPage(currentPage + 1)"
         :disabled="currentPage === totalPages"
         class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300
            disabled:opacity-50 m-1"
      >
         Next
      </button>

      <!-- Last Page Button -->
      <button
         @click="goToPage(totalPages)"
         :disabled="currentPage === totalPages"
         class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300
            disabled:opacity-50 m-1"
      >
         Last
      </button>
   </nav>
</template>

<script>
export default {
   props: {
      total: {
         type: Number,
         required: true
      },
      siblingCount: {
         type: Number,
         default: 1
      },
      showEdges: {
         type: Boolean,
         default: true
      },
      defaultPage: {
         type: Number,
         default: 1
      }
   },
   data() {
      return {
         currentPage: this.defaultPage
      }
   },
   computed: {
      totalPages() {
         return Math.ceil(this.total / 5) // Adjust if pageSize changes
      },
      paginationItems() {
         const items = []
         if (this.showEdges && this.totalPages > 1) {
            items.push({ type: 'page', value: 1 })
            if (this.currentPage > 2) items.push({ type: 'ellipsis', index: 1 })
         }
         for (
            let i = Math.max(2, this.currentPage - this.siblingCount);
            i <= Math.min(this.totalPages - 1, this.currentPage + this.siblingCount);
            i++
         ) {
            items.push({ type: 'page', value: i })
         }
         if (this.showEdges && this.totalPages > 1) {
            if (this.currentPage < this.totalPages - 1) items.push({ type: 'ellipsis', index: 2 })
            items.push({ type: 'page', value: this.totalPages })
         }
         return items
      }
   },
   methods: {
      goToPage(page) {
         this.currentPage = Math.max(1, Math.min(page, this.totalPages))
         this.$emit('page-changed', this.currentPage)
      }
   }
}
</script>
