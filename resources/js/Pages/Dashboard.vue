<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Layout from "@/Layouts/Layout.vue";
import TaskCard from "@/Components/Task/TaskCard.vue";
import Target from '@/Components/Task/Target'
import {
    subDays,
    addDays,
    eachDayOfInterval,
    format,
    previousMonday,
    nextMonday,
    nextSunday,
    subWeeks,
    subYears, addMonths
} from "date-fns";
import TaskModal from "@/Components/Task/TaskModal.vue";
import {ref} from "vue";
import {Task} from "@/types";

const props = defineProps({ canRegister: Boolean, canLogin: Boolean, canLogout: Boolean, tasks: Array<Task> })
const _tasks = props.tasks?.map(task => {
    return {
        title: task.title,
        value: task.id,
        completed: task.is_archived
    }
})
const tasks = ref(_tasks)
const taskModal = ref(false)

const today = new Date()

const targetsForDaily = eachDayOfInterval({
    start: subDays(today, 30),
    end: addDays(today, 30)
}).map(date => new Target(format(date, 'yyyy-MM-dd')))

const startDaysOfWeek = [previousMonday(subWeeks(today, 8))]
for (let i=0; i<16; i++) {
    startDaysOfWeek.push(nextMonday(startDaysOfWeek[startDaysOfWeek.length-1]))
}
const targetsForWeekly = startDaysOfWeek.map(
    startDayOfWeek => new Target(
        format(startDayOfWeek, 'yyyy-MM-dd'),
        format(nextSunday(startDayOfWeek), 'yyyy-MM-dd')
    )
)

const datesOfMonth = [subYears(today, 1)]
for (let i=0; i<24; i++) {
    datesOfMonth.push(addMonths(datesOfMonth[datesOfMonth.length-1], 1))
}
const targetsForMonthly = datesOfMonth.map(date => new Target(format(date, 'MMMM yyyy')))

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

    <Layout :can-register="canRegister" :can-login="canLogin" :can-logout="canLogout">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <v-row>
                <v-col><TaskCard title="Task" :tasks="tasks" @clicked:add="taskModal = true" :disable-add="false" /></v-col>
                <v-col><TaskCard title="Daily" :tasks="todayTodo" @clicked:add="openAddingDailyTaskModal" :targets="targetsForDaily" :target-key="30" /></v-col>
                <v-col><TaskCard title="Weekly" :tasks="todayTodo" @clicked:add="openAddingWeeklyTaskModal" :targets="targetsForWeekly" :target-key="8"  /></v-col>
                <v-col><TaskCard title="Monthly" :tasks="todayTodo" @clicked:add="openAddingMonthlyTaskModal" :targets="targetsForMonthly" :target-key="12"  /></v-col>
            </v-row>
        </div>
    </Layout>


    <TaskModal v-model="taskModal">

    </TaskModal>
</template>
