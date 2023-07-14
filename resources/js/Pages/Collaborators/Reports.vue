<template>
    <Head title="Reports" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reports</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <InputLabel for="rep" Value="Report:" />
                    <SelectInput id="rep" class="mt-1 block w-3/4" v-model="report" :options="types" />
                </div>
                <div v-if="report === '1'" class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <DataTable :data="collaborators" :columns="columns1" class="w-full border border-gray-400"
                        :options="{ responsive: true, autoWidth: false, dom: 'Bfrtip', buttons: buttons1 }">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-2 py-2">#</th>
                                <th class="px-2 py-2">NAME</th>
                                <th class="px-2 py-2">EMAIL</th>
                                <th class="px-2 py-2">PHONE</th>
                                <th class="px-2 py-2">SECTOR</th>
                            </tr>
                        </thead>
                    </DataTable>
                </div>
                <div v-else class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <DataTable :data="sectors" :columns="columns2" class="w-full border border-gray-400"
                        :options="{ responsive: true, autoWidth: false, dom: 'Bfrtip', buttons: buttons2 }">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-2 py-2">#</th>
                                <th class="px-2 py-2">NAME</th>
                            </tr>
                        </thead>
                    </DataTable>
                </div>

            </div>

        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/SelectInput.vue';
import DataTable from 'datatables.net-vue3';
import 'datatables.net-dt/css/jquery.dataTables.css';
import ButtonsHtml5 from 'datatables.net-buttons/js/dataTables.buttons';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';
import 'datatables.net-responsive-dt';
import 'datatables.net-responsive-dt/css/responsive.dataTables.min.css';
import JsZip from 'jszip';
import pdfmake from 'pdfmake/build/pdfmake';
import * as pdfFonts from 'pdfmake/build/vfs_fonts';
pdfmake.vfs = pdfFonts.pdfMake ? pdfFonts.pdfMake.vfs : pdfmake.vfs;

import 'datatables.net-dt/css/jquery.dataTables.css';
import 'datatables.net-buttons-dt/css/buttons.dataTables.css';
import 'datatables.net-buttons/js/dataTables.buttons';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';

window.JSZip = JsZip;
DataTable.use(ButtonsHtml5);

const props = defineProps({
    sectors: { type: Object },
    collaborators: { type: Object }
});

const columns1 = ref([]);
const columns2 = ref([]);
const buttons1 = ref([]);
const buttons2 = ref([]);
const report = ref('');
const types = ref([{ 'id': 1, 'name': 'Collaborators' }, { 'id': 2, 'name': 'Sectors' }]);

columns1.value = [
    {
        data: null, render: function (data, type, row, meta) { return (meta.row + 1) }
    },
    { data: 'name' },
    { data: 'email' },
    { data: 'phone' },
    { data: 'sector' },
]

columns2.value = [
    { data: null, render: function (data, type, row, meta) { return (meta.row + 1) } },
    { data: 'name' },
];
buttons1.value = [
    {
        title: 'Collaborators',
        extend: 'excelHtml5',
        text: '<i class="fa-solid fa-file-excel"></i> Excel',
        className: 'inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',
    },
    {
        title: 'Collaborators',
        extend: 'pdfHtml5',
        text: '<i class="fa-solid fa-file-pdf"></i> Pdf',
        className: 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition',
    },
    {
        title: 'Collaborators',
        extend: 'print',
        text: '<i class="fa-solid fa-print"></i> Print',
        className: 'inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition',
    },
    {
        title: 'Collaborators',
        extend: 'copy',
        text: '<i class="fa-solid fa-copy"></i> Copy',
        className: 'inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring focus:ring-yellow-300 disabled:opacity-25 transition',
    },
];

buttons2.value = [
    {
        title: 'Sectors',
        extend: 'excelHtml5',
        text: '<i class="fa-solid fa-file-excel"></i> Excel',
        className: 'inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:ring focus:ring-purple-300 disabled:opacity-25 transition',
    },
    {
        title: 'Sectors',
        extend: 'pdfHtml5',
        text: '<i class="fa-solid fa-file-pdf"></i> Pdf',
        className: 'inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition',
    },
    {
        title: 'Sectors',
        extend: 'print',
        text: '<i class="fa-solid fa-print"></i> Print',
        className: 'inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-700 active:bg-pink-900 focus:outline-none focus:border-pink-900 focus:ring focus:ring-pink-300 disabled:opacity-25 transition',
    },
    {
        title: 'Sectors',
        extend: 'copy',
        text: '<i class="fa-solid fa-copy"></i> Copy',
        className: 'inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring focus:ring-yellow-300 disabled:opacity-25 transition',
    },
];

</script>

