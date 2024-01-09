<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Layout from "@/Layouts/Layout.vue";
import TaskCard from "@/Components/TaskCard.vue";
defineProps({ canRegister: Boolean, canLogin: Boolean, canLogout: Boolean })

const todayTodo = [
    {
        title: 'Item #1',
        value: 1,
        completed: true
    },
    {
        title: 'Item #2',
        value: 2,
        completed: true
    },
    {
        title: 'Item #3',
        value: 3,
        completed: false
    },
]
</script>

<template>
    <Head title="Dashboard" />

    <Layout  :can-register="canRegister" :can-login="canLogin" :can-logout="canLogout">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <v-row>
                <v-col><TaskCard title="Today" :tasks="todayTodo" /></v-col>
                <v-col><TaskCard title="This week" :tasks="todayTodo" /></v-col>
                <v-col><TaskCard title="This month" :tasks="todayTodo" /></v-col>

            </v-row>
        </div>
    </Layout>
</template>
