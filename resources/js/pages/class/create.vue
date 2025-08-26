<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: ' Class',
        href: '/class/create',
    },
];
interface Clas {
    id: number,
    academic_id: number,
    teacher_id: string,
    clas_name: string,
    clas_code: number,
    max_students: number,
    status: string

}
const props = defineProps<{
    clas?: Clas,
    // users: { id: number; name: string }[]
    academics:{id: number; year_name:string}[]
    teachers:{id:number; user_id:number;name:string}[]

}>();
const form = useForm({
    academic_id: props.clas ? props.clas.academic_id || "" : "",
    teacher_id: props.clas ? props.clas.teacher_id || "" : "",
    clas_name: props.clas ? props.clas.clas_name || "" : "",
    clas_code: props.clas ? props.clas.clas_code || "" : "",
    max_students: props.clas ? props.clas.max_students || "" : "",
    status: props.clas ? props.clas.status || "" : "",

})
const handleSubmit = () => {
    console.log(form);

    if (props.clas) {
        // Update existing academic record
        form.put(route('class.update', { id: props.clas }));
    } else {
        // Create new academic record
        form.post(route('class.store'));
    }
};
</script>

<template>

    <Head title="Teacher" />
    <!-- {{ teacher }} -->
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="card-header">
                <h2 class="text-center">{{ clas ? 'Edit Class' : 'Create Class' }}</h2>
            </div>
            <div class="card-mt-3">
                <Link :href="route('class.index')"><Button class="mb-4" variant="destructive">Back</Button></Link>
            </div>
            <div class="card-body">

                <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                    <div class="form-container"
                        style="max-width: 600px; margin: 0 auto; padding: 2rem; font-family: 'Segoe UI', Arial, sans-serif;">
                        <h2 style="color: #2c3e50; margin-bottom: 1.5rem; font-weight: 600;">Teacher Information</h2>

                        <div class="grid gap mb-6">
                            <label for="academic_id">Academic Year</label>
                            <select id="academic_id" v-model="form.academic_id" required
                                class="border border-gray-300 rounded-md px-3 py-2">
                                <option value="" disabled>Select Academic</option>
                                <option v-for="academic in props.academics" :key="academic.id" :value="academic.id">
                                    {{ academic.year_name }}
                                </option>
                            </select>
                        </div>

                        <div class="grid gap mb-6">
                            <label for="teacher_id">Class Teacher</label>
                            <select id="teacher_id" v-model="form.teacher_id" required
                                class="border border-gray-300 rounded-md px-3 py-2">
                                <option value="" disabled>Select Teacher</option>
                                <option v-for="teacher in props.teachers" :key="teacher.id" :value="teacher.id">
                                    {{ teacher.user.name }}
                                </option>
                            </select>
                        </div>



                        <div class="mb-6">
                            <label for="clas_name"
                                class="block text-sm font-medium text-gray-700 mb-1">Class Name</label>
                            <input type="text" id="clas_name" v-model="form.clas_name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="class name">
                        </div>

                        <div class="mb-6">
                            <label for="clas_code"
                                class="block text-sm font-medium text-gray-700 mb-1">Class Code</label>
                            <input type="text" id="clas_code" v-model="form.clas_code"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="class code">
                        </div>

                        <div class="mb-6">
                            <label for="max_students" class="block text-sm font-medium text-gray-700 mb-1">Maximum Students</label>
                            <input type="number" id="max_students" v-model="form.max_students"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Enter Salary">
                        </div>
                   

                        <div class="mb-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="status" v-model="form.status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white appearance-none">
                                <option value="" disabled selected>Select status</option>
                                <option value="active" class="py-1">Active</option>
                                <option value="inactive" class="py-1">InActive</option>
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            {{ clas ? 'update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>



        </div>
    </AppLayout>
</template>
