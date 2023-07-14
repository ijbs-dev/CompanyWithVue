<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Bar, Pie} from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale,
         LinearScale, ArcElement} from 'chart.js';
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement);


const props = defineProps({
    data: {type: Object}
});

const sectors = ref([]);
const collaborators = ref([]);
const chartData = ref([]);
const chartOptions = ref([]);
const colors = ref([]);

const random = () => {
    return Math.floor(Math.random() * 256);
}

props.data.map ((row) => (
    sectors.value.push(row.name),
    collaborators.value.push(row.count),
    colors.value.push("rgb("+random()+","+random()+","+random()+")")
))

/* chartOptions.value = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        y: {
            beginAtZero: true
        }
    }
} */

chartOptions.value = {
    responsive: true}

chartData.value = {
    labels: sectors.value,
    datasets: [{
        label: 'Collaborators por Sector',
        data: collaborators.value,
        backgroundColor: colors.value,
        /* borderColor: colors.value,
        borderWidth: 1 */
    }]
}

</script>

<template>
    <Head title="Graphic" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Graphic</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <Bar :data="chartData" :options="chartOptions" />
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-2 lg:px-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <Pie Chart :data="chartData" :options="chartOptions" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
