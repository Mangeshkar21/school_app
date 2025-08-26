<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Student ',
        href: '/students/create',
    },
];
interface Student {
    id: number,
    academic_id: number,
    user_id: number,
    clas_id: number,
    section_id: number,
    roll_number: string,
    admission_date: Date,
    dob: Date,
    gender: string,
    blood_group: string,
    address: string,
    parent_name: string,
    parent_contact: string,
    status: string

}
const props = defineProps<{
    student ?: Student,
    users: { id: number; name: string }[]
    academics: { id: number; year_name: string }[]
    sections: { id: number; section_name: string }[]
    classes:{id:number;clas_name:string}[]

}>();
const form = useForm({
    user_id: props.student ? props.student.user_id || "" : "",
    academic_id: props.student ? props.student.academic_id || "" : "",
    clas_id: props.student ? props.student.clas_id || "" : "",
    section_id: props.student ? props.student.section_id || "" : "",
    roll_number: props.student ? props.student.roll_number || "" : "",
    admission_date: props.student ? props.student.admission_date || "" : "",
    dob: props.student ? props.student.dob || "" : "",
    gender: props.student ? props.student.gender || "" : "",
    blood_group: props.student ? props.student.blood_group || "" : "",
    address: props.student ? props.student.address || "" : "",
    parent_name: props.student ? props.student.parent_name || "" : "",
    parent_contact: props.student ? props.student.parent_contact || "" : "",
    status: props.student ? props.student.status || "" : "",

})
const handleSubmit = () => {
    console.log(form);

    if (props.student) {
        // Update existing academic record
        form.put(route('student.update', { id: props.student }));
    } else {
        // Create new academic record
        form.post(route('student.store'));
    }
};
</script>

<template>

    <Head title="Teacher" />
    <!-- {{ teacher }} -->
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="card-header">
                <h2 class="text-center">{{ student ? 'Edit Student' : 'Create Student' }}</h2>
            </div>
            <div class="card-mt-3">
                <Link :href="route('student.index')"><Button class="mb-4" variant="destructive">Back</Button></Link>
            </div>
            <div class="card-body">

                <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                    <div class="form-container"
                        style="max-width: 600px; margin: 0 auto; padding: 2rem; font-family: 'Segoe UI', Arial, sans-serif;">
                        <h2 style="color: #2c3e50; margin-bottom: 1.5rem; font-weight: 600;">Teacher Information</h2>

                        <div class="grid gap mb-6">
                            <label for="user_id">Student Name</label>
                            <select id="user_id" v-model="form.user_id" required
                                class="border border-gray-300 rounded-md px-3 py-2">
                                <option value="" disabled>Select Academic</option>
                                <option v-for="user in props.users" :key="user.id" :value="user.id">
                                    {{ user.name }}
                                </option>
                            </select>
                        </div>

                        <div class="grid gap mb-6">
                            <label for="clas_id">Class</label>
                            <select id="clas_id" v-model="form.clas_id" required
                                class="border border-gray-300 rounded-md px-3 py-2">
                                <option value="" disabled>Select Class</option>
                                <option v-for="clas in props.classes" :key="clas.id" :value="clas.id">
                                    {{ clas.clas_name }}
                                </option>
                            </select>
                        </div>


                        <div class="grid gap mb-6">
                            <label for="section_id">Section</label>
                            <select id="section_id" v-model="form.section_id" required
                                class="border border-gray-300 rounded-md px-3 py-2">
                                <option value="" disabled>Select Section</option>
                                <option v-for="section in props.sections" :key="section.id" :value="section.id">
                                    {{ section.section_name }}
                                </option>
                            </select>
                        </div>

                        <div class="grid gap mb-6">
                            <label for="academic_id">Academic</label>
                            <select id="academic_id" v-model="form.academic_id" required
                                class="border border-gray-300 rounded-md px-3 py-2">
                                <option value="" disabled>Select academic</option>
                                <option v-for="academic in props.academics" :key="academic.id" :value="academic.id">
                                    {{ academic.year_name }}
                                </option>
                            </select>
                        </div>

                        <div class="grid gap mb-6">
                            <label for="gender">Gender</label>
                            <select id="gender" v-model="form.gender" required
                                class="border border-gray-300 rounded-md px-3 py-2">
                                <option value="" disabled>Select gender</option>
                                <option value="male" >Male</option>
                                <option value="female" >Female</option>
                                <option value="other" >Other</option>

                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="roll_number" class="block text-sm font-medium text-gray-700 mb-1">Roll No</label>
                            <input type="text" id="roll_number" v-model="form.roll_number"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Roll no">
                        </div>


                        <div class="mb-6">
                            <label for="admission_date" class="block text-sm font-medium text-gray-700 mb-1">Admission
                                Date</label>
                            <input type="date" id="admission_date" v-model="form.admission_date"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="admission date">
                        </div>

                        <div class="mb-6">
                            <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                            <input type="date" id="dob" v-model="form.dob"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="date of birth">
                        </div>


                        <div class="mb-6">
                            <label for="blood_group" class="block text-sm font-medium text-gray-700 mb-1">Blood
                                Group</label>
                            <input type="text" id="blood_group" v-model="form.blood_group"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Blood Group">
                        </div>

                        <div class="mb-6">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <input type="text" id="address" v-model="form.address"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="address">
                        </div>

                        <div class="mb-6">
                            <label for="parent_name" class="block text-sm font-medium text-gray-700 mb-1">Parent
                                Name</label>
                            <input type="text" id="parent_name" v-model="form.parent_name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="parent name">
                        </div>

                        <div class="mb-6">
                            <label for="parent_contact" class="block text-sm font-medium text-gray-700 mb-1">Class
                                Code</label>
                            <input type="text" id="parent_contact" v-model="form.parent_contact"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="parent contact">
                        </div>



                        <div class="mb-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="status" v-model="form.status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white appearance-none">
                                <option value="" disabled selected>Select status</option>
                                <option value="active" class="py-1">Active</option>
                                <option value="inactive" class="py-1">InActive</option>
                                <option value="graduated" class="py-1">Graduated</option>
                                <option value="left" class="py-1">Left</option>
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            {{ student ? 'update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>



        </div>
    </AppLayout>
</template>
