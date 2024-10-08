<template>
   <div class="text-left">
      <button
         @click="toggleDropdown"
         class="inline-flex justify-center rounded-md border shadow-sm px-2 py-1 bg-white text-m font-bold
            text-gray-700 hover:bg-gray-50 focus:outline-none"
      >
         ...
      </button>

      <div
         v-if="isOpen"
         class="origin-top-right absolute right-0 me-4 mt-2 w-30 rounded-md shadow-lg bg-white ring-1 ring-black
            text-center ring-opacity-5"
         @click.outside="isOpen = false"
      >
         <div class="py-1">
            <a
               href="#"
               @click.prevent="handleUpdate"
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
            >
               Update
            </a>
            <a
               href="#"
               @click.prevent="handleDelete"
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
            >
               Delete
            </a>
         </div>
      </div>
   </div>
</template>

<script>
export default {
   data() {
      return {
         isOpen: false
      }
   },
   methods: {
      toggleDropdown() {
         this.isOpen = !this.isOpen
      },
      handleUpdate() {
         // Emit an event to handle update action
         this.$emit('update-item')
      },
      handleDelete() {
         // Emit an event to handle delete action
         this.$emit('delete-item')
      }
   }
}
</script>
