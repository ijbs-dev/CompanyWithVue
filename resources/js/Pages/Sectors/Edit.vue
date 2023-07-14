<script setup> // resources\js\Pages\Sectors\Edit.vue
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    sector: {type: Object}});

const form = useForm({ //
    name:props.sector.name
});

</script>

<template>
    <Head title="Edit Sector" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Sector</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="$event=>form.patch(route('sectors.update', sector))"
                        class="mt-6 space-y-6 max-w-x1">
                        <InpuLabel for="name" value="Sector"></InpuLabel>
                        <TextInput id="name" v-model="form.name" autofocus requered
                           type="text" class="mt-1 block w-full"/>
                        <InputError :message="form.errors.name" class="mt-2" />
                        <PrimaryButton :disabled="form.processing">
                            <i class="fa-solid fa-save"></i> Save
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
