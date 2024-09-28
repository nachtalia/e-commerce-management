<script setup>
import Checkbox from '@/Components/Checkbox.vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import SecondaryButton from '@/Components/SecondaryButton.vue'

defineProps({
   canResetPassword: {
      type: Boolean
   },
   status: {
      type: String
   }
})

const form = useForm({
   email: '',
   password: '',
   remember: false
})

const submit = () => {
   form.post(route('login'), {
      onFinish: () => form.reset('password')
   })
}
</script>

<template>
   <GuestLayout>
      <Head title="Log in" />

      <div class="flex h-screen">
         <div class="w-1/2 flex items-center justify-center p-10">
            <div>
               <h1 class="text-6xl font-bold leading-tight mb-4">Lorem Ipsum dolor sit amet..</h1>
               <p class="text-xl text-gray-600 mb-8">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua.
               </p>
               <Link href="/about" class="text-blue-600 hover:underline text-lg">
                  Read more about our app →
               </Link>
            </div>
         </div>

         <!-- Right Section (Form) -->
         <div class="w-1/2 flex items-center justify-center">
            <form
               class="w-full max-w-md p-8 shadow-lg bg-white rounded-md"
               @submit.prevent="submit"
            >
               <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                  {{ status }}
               </div>

               <div>
                  <InputLabel for="email" value="Email" />

                  <TextInput
                     id="email"
                     type="email"
                     class="block p-4 w-full mt-1 h-10 border border-opacity-100"
                     v-model="form.email"
                     placeholder="Email"
                     required
                     autofocus
                     autocomplete="username"
                  />

                  <InputError class="mt-2" :message="form.errors.email" />
               </div>

               <div class="mt-4">
                  <InputLabel for="password" value="Password" />

                  <TextInput
                     id="password"
                     type="password"
                     class="block p-4 w-full mt-1 border border-opacity-100 h-10"
                     v-model="form.password"
                     placeholder="Password"
                     required
                     autocomplete="current-password"
                  />

                  <InputError class="mt-2" :message="form.errors.password" />
               </div>

               <div class="block mt-4">
                  <label class="flex items-center">
                     <Checkbox name="remember" v-model:checked="form.remember" />
                     <span class="text-sm text-gray-600 ms-2">Remember me</span>
                  </label>
               </div>
               <div class="mt-4">
                  <PrimaryButton
                     class="w-full h-10 flex items-center justify-center"
                     :class="{ 'opacity-25': form.processing }"
                     :disabled="form.processing"
                  >
                     Log in
                  </PrimaryButton>
               </div>

               <div class="mt-4 text-center">
                  <span class="text-sm text-gray-600">Not registered yet?</span>
                  <Link :href="route('register')" class="text-blue-600 hover:underline ms-2">
                     Create an account
                  </Link>
               </div>
            </form>
         </div>
      </div>
   </GuestLayout>
</template>
