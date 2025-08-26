<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Section',
        href: '/sections/create',
    },
];
interface Section {
    id: number,
    class_id: number,
    section_name: string,
    max_students: number,


}
const props = defineProps<{
    section?: Section,
    // users: { id: number; name: string }[]
    clas: { id: number; clas_name: string }[]

}>();
const form = useForm({
    class_id: props.section ? props.section.class_id || "" : "",
    section_name: props.section ? props.section.section_name || "" : "",
    max_students: props.section ? props.section.max_students || "" : "",

})
const handleSubmit = () => {
    console.log(form);

    if (props.section) {
        // Update existing academic record
        form.put(route('section.update', { id: props.section }));
    } else {
        // Create new academic record
        form.post(route('section.store'));
    }
};
</script>

<template>

    <Head title="Section" />
    <!-- {{ teacher }} -->
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="card-header">
                <h2 class="text-center">{{ section ? 'Edit Section' : 'Create Section' }}</h2>
            </div>
            <div class="card-mt-3">
                <Link :href="route('section.index')"><Button class="mb-4" variant="destructive">Back</Button></Link>
            </div>
            <div class="card-body">

                <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                    <div class="form-container"
                        style="max-width: 600px; margin: 0 auto; padding: 2rem; font-family: 'Segoe UI', Arial, sans-serif;">
                        <h2 style="color: #2c3e50; margin-bottom: 1.5rem; font-weight: 600;">Teacher Information</h2>

                        <div class="grid gap mb-6">
                            <label for="class_id">Class Name</label>
                            <select id="class_id" v-model="form.class_id" required
                                class="border border-gray-300 rounded-md px-3 py-2">
                                <option value="" disabled>Select Class</option>
                                <option v-for="cl in props.clas" :key="cl.id" :value="cl.id">
                                    {{ cl.clas_name }}
                                </option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="section_name" class="block text-sm font-medium text-gray-700 mb-1">Section
                                Name</label>
                            <input type="text" id="section_name" v-model="form.section_name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="section name">
                        </div>

                        <div class="mb-6">
                            <label for="max_students" class="block text-sm font-medium text-gray-700 mb-1">Maximum
                                Students</label>
                            <input type="number" id="max_students" v-model="form.max_students"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="max students">
                        </div>


                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            {{ section ? 'update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>



        </div>
    </AppLayout>
</template>
