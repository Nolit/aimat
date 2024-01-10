<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Layout from "@/Layouts/Layout.vue";
import TaskCard from "@/Components/Task/TaskCard.vue";
import Target from '@/Components/Task/Target'
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

const targetsForDaily = [
    new Target('2024-01-08'),
    new Target('2024-01-09'),
    new Target('2024-01-10'),
    new Target('2024-01-11'),
    new Target('2024-01-12'),
]

const targetsForWeekly = [
    new Target('2023-12-25', '2023-12-31'),
    new Target('2024-01-01', '2024-01-07'),
    new Target('2024-01-08', '2024-01-14'),
    new Target('2024-01-15', '2024-01-21'),
    new Target('2024-01-22', '2024-01-29'),
]

const targetsForMonthly = [
    new Target('November'),
    new Target('December'),
    new Target('January'),
    new Target('February'),
    new Target('May'),
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
                <v-col><TaskCard title="Daily" :tasks="todayTodo" @clicked:add="openAddingDailyTaskModal" :targets="targetsForDaily" :target-key="1" /></v-col>
                <v-col><TaskCard title="Weekly" :tasks="todayTodo" @clicked:add="openAddingWeeklyTaskModal" :targets="targetsForWeekly" :target-key="2"  /></v-col>
                <v-col><TaskCard title="Monthly" :tasks="todayTodo" @clicked:add="openAddingMonthlyTaskModal" :targets="targetsForMonthly" :target-key="2"  /></v-col>

            </v-row>
        </div>
    </Layout>
</template>
