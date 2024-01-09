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

const openAddingDailyTaskModal = () => {
    alert('open a dialog for adding daily task')
}
const openAddingWeeklyTaskModal = () => {
    alert('open a dialog for adding weekly task')
}
const openAddingMonthlyTaskModal = () => {
    alert('open a dialog for adding monthly task')
}
</script>

<template>
    <Head title="Dashboard" />

    <Layout  :can-register="canRegister" :can-login="canLogin" :can-logout="canLogout">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <v-row>
                <v-col><TaskCard title="Daily" :tasks="todayTodo" @clicked:add="openAddingDailyTaskModal" :target1="'2024-01-10'" /></v-col>
                <v-col><TaskCard title="Weekly" :tasks="todayTodo" @clicked:add="openAddingWeeklyTaskModal" :target1="'2024-01-08'"  :target2="'2024-01-14'" /></v-col>
                <v-col><TaskCard title="Monthly" :tasks="todayTodo" @clicked:add="openAddingMonthlyTaskModal" :target1="'January'" /></v-col>

            </v-row>
        </div>
    </Layout>
</template>
