<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
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
import {Ref, ref, nextTick, computed} from "vue";
import {Task} from "@/types";

const props = defineProps({ canRegister: Boolean, canLogin: Boolean, canLogout: Boolean, tasks: Array<Task> })

const taskModal: Ref<{task: Task|null, open: boolean}> = ref({
    task: null,
    open: false
})

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
        id: 1,
        completed: true
    },
    {
        title: 'Item #2',
        id: 2,
        completed: true
    },
    {
        title: 'Item #3',
        id: 3,
        completed: false
    },
]

const openTaskModal = (id?: number|null) => {
    taskModal.value.task = props.tasks.find((task) => task.id === id)
    taskModal.value.open = true
}
const reloadTasks = () => {
    nextTick(() => {
        router.reload({ only: ['tasks'] })
    })
}

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
                <v-col><TaskCard title="Routine" :tasks="todayTodo" @clicked:add="openAddingDailyTaskModal" :targets="targetsForDaily" :target-key="30" /></v-col>
                <v-col><TaskCard title="Others" :tasks="tasks" @clicked:add="openTaskModal()" :disable-add="false" @clicked:update="id => openTaskModal(id)" /></v-col>
<!--                <v-col><TaskCard title="Weekly" :tasks="todayTodo" @clicked:add="openAddingWeeklyTaskModal" :targets="targetsForWeekly" :target-key="8"  /></v-col>-->
<!--                <v-col><TaskCard title="Monthly" :tasks="todayTodo" @clicked:add="openAddingMonthlyTaskModal" :targets="targetsForMonthly" :target-key="12"  /></v-col>-->
            </v-row>
        </div>
    </Layout>


    <TaskModal v-if="taskModal.open" v-model="taskModal.open" :task="taskModal.task" @updated:task="reloadTasks()">

    </TaskModal>
</template>
