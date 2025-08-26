<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage,router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Rocket,PencilIcon, TrashIcon, PlusIcon, SchoolIcon, StarIcon } from 'lucide-vue-next';

import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'School',
        href: '/school',
    },
];
interface school{
   id:number,
   name:string,
   medium:string,
   board:string,
   address:string,
   rating:number   
}

interface Props{
    schools:school[];
}
const props = defineProps<Props>();
const handleDelete =(id:number) =>{
    if(confirm('Do you want to delete a product')){
        router.delete(route('school.destroy', {id}))
    }
}
   
const page = usePage();


// Watch for flash messages




// Clean up timeout when component unmounts

</script>

<template>
  <Head title="School Management" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="container mx-auto px-4 py-6">
      <div v-if="page.props.flash?.message" class="alert">

       
              <Alert class="bg-blue-300">
                  <Rocket/>
    <AlertTitle>Notification</AlertTitle>
    <AlertDescription>
           {{ page.props.flash?.message }}         
    </AlertDescription>
  </Alert>
      </div>
      <!-- Header Section -->
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
          <h1 class="text-2xl font-bold text-gray-800">School Management</h1>
          <p class="text-sm text-gray-500 mt-1">Manage all registered schools in the system</p>
        </div>
        <Link 
          :href="route('school.create')" 
          class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors"
        >
          <PlusIcon class="w-5 h-5" />
          Add New School
        </Link>
      </div>

      <!-- Notification Alert -->


      <!-- Schools Table -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="relative overflow-x-auto">
          <Table>
            <TableHeader class="bg-gray-50">
              <TableRow>
                <TableHead class="w-[200px]">Name</TableHead>
                <TableHead>Medium</TableHead>
                <TableHead>Board</TableHead>
                <TableHead>Address</TableHead>
                <TableHead class="text-center">Rating</TableHead>
                <TableHead class="text-center w-[150px]">Actions</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              <TableRow v-for="school in props.schools" :key="school.id" class="hover:bg-gray-50 transition-colors">
                <TableCell class="font-medium">
                  {{ school.name }}
                </TableCell>
                <TableCell>
                  <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                    {{ school.medium }}
                  </span>
                </TableCell>
                <TableCell>{{ school.board }}</TableCell>
                <TableCell class="max-w-[200px] truncate" :title="school.address">
                  {{ school.address }}
                </TableCell>
                <TableCell class="text-center">
                  <div class="flex items-center justify-center">
                    <StarIcon class="w-4 h-4 text-yellow-500 fill-yellow-500 mr-1" />
                    <span>{{ school.rating }}/5</span>
                  </div>
                </TableCell>
                <TableCell>
                  <div class="flex justify-end gap-2">
                    <Link 
                      :href="route('school.edit', school.id)" 
                      class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition-colors"
                    >
                      <PencilIcon class="w-4 h-4 mr-1" />
                      Edit
                    </Link>
                    <Button 
                      @click="handleDelete(school.id)"
                      variant="destructive" 
                      size="sm"
                      class="gap-1"
                    >
                      <TrashIcon class="w-4 h-4" />
                      Delete
                    </Button>
                  </div>
                </TableCell>
              </TableRow>
              <TableRow v-if="props.schools.length === 0">
                <TableCell colspan="6" class="text-center py-8 text-gray-500">
                  <div class="flex flex-col items-center justify-center gap-2">
                    <SchoolIcon class="w-10 h-10 text-gray-300" />
                    <p>No schools found</p>
                    <Link :href="route('school.create')" class="text-indigo-600 hover:underline">
                      Add your first school
                    </Link>
                  </div>
                </TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </div>
      </div>

      <!-- Pagination (if applicable) -->
      <!-- <div class="mt-6 flex justify-end" v-if="props.schools.meta">
        <Pagination :links="props.schools.meta.links" />
      </div> -->
    </div>
  </AppLayout>
</template>