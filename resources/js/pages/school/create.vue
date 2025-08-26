<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link,useForm} from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create School',
        href: '/school/create',
    },
];
const form=useForm({
    name:'',
    medium:'',
    board:'',
    address:'',
    rating:''
})
const handleSubmit=()=>{
   console.log(form)
   form.post(route('school.store'));
}
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="card-header">
                <h2 class="text-center">Create School</h2>
            </div>
            <div class="card-mt-3">
                <Link :href="route('school.index')"><Button class="mb-4" variant="destructive">Back</Button></Link>
            </div>
            <div class="card-body">
                <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                    <div class="form-container"
                        style="max-width: 600px; margin: 0 auto; padding: 2rem; font-family: 'Segoe UI', Arial, sans-serif;">
                        <h2 style="color: #2c3e50; margin-bottom: 1.5rem; font-weight: 600;">School Information</h2>

                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" id="name" v-model="form.name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="Enter school name">
                        </div>

                        <div class="mb-6">
                            <label for="medium" class="block text-sm font-medium text-gray-700 mb-1">Medium</label>
                            <select id="medium" v-model="form.medium"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white appearance-none">
                                <option value="" disabled selected>Select medium</option>
                                <option value="english" class="py-1">English</option>
                                <option value="tamil" class="py-1">Tamil</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="board" class="block text-sm font-medium text-gray-700 mb-1">Board</label>
                            <input type="text" id="board" v-model="form.board"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Board of education">
                        </div>

                        <div class="mb-6">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <input type="text" id="address" v-model="form.address"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Enter school address">
                        </div>

                        <div class="mb-6">
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating
                                (1-5)</label>
                            <div class="relative w-32">
                                <input type="number" id="rating" min="1" max="5" v-model="form.rating"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="0-5">
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                                    <span class="text-sm">★</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Submit Information
                        </button>
                    </div>
                </form>
            </div>



        </div>
    </AppLayout>
</template>
