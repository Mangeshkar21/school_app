<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link,useForm} from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: ' Academic',
        href: '/academic/create',
    },
];
interface Academic {
    id:number,
    year_name:string,
    start_date:Date,
    end_date:Date,
    status:string
}
const props = defineProps<{academic:Academic}>();
const form=useForm({
    year_name:props.academic ? props.academic.year_name ||"":"",
    start_date:props.academic ? props.academic.start_date ||"":"",
    end_date:props.academic ? props.academic.end_date||"":"",
    status:props.academic ? props.academic.status||"":"",
    
})
const handleSubmit = () => {
    console.log(form);
    
    if (props.academic) {
        // Update existing academic record
        form.put(route('academic.update', { academic:props. academic }));
    } else {
        // Create new academic record
        form.post(route('academic.store'));
    }
};
</script>

<template>

    <Head title="Academic" />
  <!-- {{ academic }} -->
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="card-header">
             <h2 class="text-center">{{ academic ? 'Edit Academic' : 'Create Academic' }}</h2>
            </div>
            <div class="card-mt-3">
                <Link :href="route('academic.index')"><Button class="mb-4" variant="destructive">Back</Button></Link>
            </div>
            <div class="card-body">
                <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                    <div class="form-container"
                        style="max-width: 600px; margin: 0 auto; padding: 2rem; font-family: 'Segoe UI', Arial, sans-serif;">
                        <h2 style="color: #2c3e50; margin-bottom: 1.5rem; font-weight: 600;">Academic Information</h2>

                        <div class="mb-6">
                            <label for="year_name" class="block text-sm font-medium text-gray-700 mb-1"> Academic Year</label>
                            <input type="text" id="year_name" v-model="form.year_name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="Enter Academic Year ">
                        </div>

  

                        <div class="mb-6">
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input type="date" id="start_date" v-model="form.start_date"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="starting year">
                        </div>

                        <div class="mb-6">
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="date" id="end_date" v-model="form.end_date"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Enter school address">
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
                            {{academic ? 'Update' : 'Create'  }}
                        </button>
                    </div>
                </form>
            </div>



        </div>
    </AppLayout>
</template>
