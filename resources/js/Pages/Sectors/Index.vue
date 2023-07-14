<script setup> // resources\js\Pages\Sectors\Index.vue
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const props = defineProps({
    sectors: {type:Object}
});

const form = useForm({
    id:''
});

const deleteSector = (id,name) => {
    const alerta = Swal.mixin({
        buttonsStyling:true
    });
    alerta.fire({
        title: 'Are you sure delete?',
        text: "You won't be able to revert this! "+name,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('sectors.destroy',id), {
                preserveScroll: true,
                onSuccess: () => alerta.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                ),
                onError: () => passwordInput.value.focus(),
                onFinish: () => form.reset(),
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            alerta.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
            )
        }
    });

}

</script>
<template>
    <Head title="Sectors" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sectors</h2>
        </template>

        <div class="py-12">
                <div class="bg-white grid v-screen place-items-center">
                    <div class="mt-3 mb-3 flex">
                        <Link :href="route('sectors.create')"
                         :class="'px-4 py-2 bg-gray-800 text-white border rounded-md font-semibold text-xs'">
                            <i class="fa-solid fa-plus-circle"></i> Add
                        </Link>
                    </div>
                    <div class="bg-white grid v-screen place-items-center">
                        <table class="table-auto border border-gray-400">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-4">#</th>
                                    <th class="px-4 py-4">SECTOR</th>
                                    <th class="px-4 py-4"></th>
                                    <th class="px-4 py-4"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="sec, i in sectors" :key="sec.id">
                                    <td class="border border-gray-400 px-4 py-4">{{ i+1 }}</td>
                                    <td class="border border-gray-400 px-4 py-4">{{ sec.name }}</td>
                                    <td class="border border-gray-400 px-4 py-4">
                                        <Link :href="route('sectors.edit', sec.id)"
                                         :class="'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'">
                                            <i class="fa-solid fa-edit"></i>
                                        </Link>
                                    </td>
                                    <td class="border border-gray-400 px-4 py-4">
                                        <DangerButton @click="deleteSector(sec.id,sec.name)">
                                            <i class="fa-solid fa-trash"></i>
                                        </DangerButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
</template>
