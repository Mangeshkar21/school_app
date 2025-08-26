<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Rocket, PencilIcon, TrashIcon, PlusIcon, SchoolIcon, StarIcon } from 'lucide-vue-next';

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
    title: 'Class',
    href: '/class',
  },
];
interface Clas {
  id: number,
  clas_name: string,
  clas_code: string,
  max_students:string
  status: string
  academic: { year_name: string }
  teacher: { user: { name: string } }
}

interface Props {
  classes: Clas[];
}
const props = defineProps<Props>();
const handleDelete = (id: number) => {
  if (confirm('Do you want to delete a product')) {
    router.delete(route('class.destroy', { id }))
  }
}

const page = usePage();


// Watch for flash messages




// Clean up timeout when component unmounts

</script>

<template>

  <Head title="Class Management" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="container mx-auto px-4 py-6">
      <div v-if="page.props.flash?.message" class="alert">


        <Alert class="bg-blue-300">
          <Rocket />
          <AlertTitle>Notification</AlertTitle>
          <AlertDescription>
            {{ page.props.flash?.message }}
          </AlertDescription>
        </Alert>
      </div>
      <!-- Header Section -->
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
          <h1 class="text-2xl font-bold text-gray-800">Class Management</h1>
          <p class="text-sm text-gray-500 mt-1">Manage all registered classes in the system</p>
        </div>
        <Link :href="route('class.create')"
          class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors">
        <PlusIcon class="w-5 h-5" />
        Add New Class
        </Link>
      </div>

      <!-- Notification Alert -->


      <!-- Schools Table -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="relative overflow-x-auto">
          <Table>
            <TableHeader class="bg-gray-50">
              <TableRow>
                <TableHead class="w-[200px]">Class Name</TableHead>
                <TableHead>Class Code</TableHead>
                <TableHead>Academic Year</TableHead>
                <TableHead>Class Teacher</TableHead>
                <TableHead>Max Students</TableHead>
                <TableHead>Status</TableHead>
                <TableHead class="text-center w-[150px]">Actions</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              <TableRow v-for="clas in props.classes" :key="clas.id" class="hover:bg-gray-50 transition-colors">
                <TableCell class="font-medium">
                  {{ clas.clas_name }}
                </TableCell>
                <TableCell>
                  <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                    {{ clas.clas_code }}
                  </span>
                </TableCell>
                <TableCell>{{ clas.academic?.year_name }}</TableCell>
                <TableCell>
                  {{ clas.teacher?.user?.name }}
                </TableCell>
                <TableCell>{{ clas.max_students }}</TableCell>
                <TableCell class="max-w-[200px] truncate">
                  <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" v-model="clas.status" true-value="active" false-value="inactive"
                      class="sr-only peer">
                    <div
                      class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                    </div>
                    <span class="ml-3 text-sm font-medium text-gray-900">
                      {{ clas.status }}
                    </span>
                  </label>
                </TableCell>
                <TableCell>
                  <div class="flex justify-end gap-2">
                    <Link   :href="`/class/${clas.id}/edit`"
                      class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                    <PencilIcon class="w-4 h-4 mr-1" />
                    Edit
                    </Link>

                    <Button @click="handleDelete(clas.id)" variant="destructive" size="sm" class="gap-1">
                      <TrashIcon class="w-4 h-4" />
                      Delete
                    </Button>

                  </div>
                </TableCell>
              </TableRow>

            </TableBody>
          </Table>
        </div>
      </div>


    </div>
  </AppLayout>
</template>