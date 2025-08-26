<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: ' Teacher',
        href: '/teacher/create',
    },
];
interface Teacher {
    id: number,
    user_id: number,
    qualification: string,
    specialization: string,
    salary: number,
    hire_date: Date,
    status: string

}
const props = defineProps<{
    teacher?: Teacher,
    users: { id: number; name: string }[]
}>();
const form = useForm({
    user_id: props.teacher ? props.teacher.user_id || "" : "",
    qualification: props.teacher ? props.teacher.qualification || "" : "",
    specialization: props.teacher ? props.teacher.specialization || "" : "",
    salary: props.teacher ? props.teacher.salary || "" : "",
    hire_date: props.teacher ? props.teacher.hire_date || "" : "",
    status: props.teacher ? props.teacher.status || "" : "",

})
const handleSubmit = () => {
    console.log(form);

    if (props.teacher) {
        // Update existing academic record
        form.put(route('teacher.update', { id: props.teacher }));
    } else {
        // Create new academic record
        form.post(route('teacher.store'));
    }
};
</script>

<template>

    <Head title="Teacher" />
    <!-- {{ teacher }} -->
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="card-header">
                <h2 class="text-center">{{ teacher ? 'Edit Teacher' : 'Create Teacher' }}</h2>
            </div>
            <div class="card-mt-3">
                <Link :href="route('teacher.index')"><Button class="mb-4" variant="destructive">Back</Button></Link>
            </div>
            <div class="card-body">
         
                <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                    <div class="form-container"
                        style="max-width: 600px; margin: 0 auto; padding: 2rem; font-family: 'Segoe UI', Arial, sans-serif;">
                        <h2 style="color: #2c3e50; margin-bottom: 1.5rem; font-weight: 600;">Teacher Information</h2>

                        <div class="grid gap mb-6">
                            <label for="user_id">User</label>
                            <select id="user_id" v-model="form.user_id" required
                                class="border border-gray-300 rounded-md px-3 py-2">
                                <option value="" disabled>Select user</option>
                                <option v-for="user in props.users" :key="user.id" :value="user.id">
                                    {{ user.name }}
                                </option>
                            </select>
                        </div>




                        <div class="mb-6">
                            <label for="qualification"
                                class="block text-sm font-medium text-gray-700 mb-1">Qualification</label>
                            <input type="text" id="qualification" v-model="form.qualification"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="qualification">
                        </div>

                        <div class="mb-6">
                            <label for="specialization"
                                class="block text-sm font-medium text-gray-700 mb-1">Specialization</label>
                            <input type="text" id="specialization" v-model="form.specialization"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="specialization">
                        </div>

                        <div class="mb-6">
                            <label for="salary" class="block text-sm font-medium text-gray-700 mb-1">Salary</label>
                            <input type="number" id="salary" v-model="form.salary"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Enter Salary">
                        </div>
                        <div class="mb-6">
                            <label for="hire_date" class="block text-sm font-medium text-gray-700 mb-1">Hire
                                Date</label>
                            <input type="date" id="hire_date" v-model="form.hire_date"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Enter hire date">
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
                            {{ teacher ? 'update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>



        </div>
    </AppLayout>
</template>
