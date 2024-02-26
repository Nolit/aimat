<script setup lang="ts">
import {computed, reactive, ref} from 'vue';
import Target from '@/Components/Task/Target'
import Routine from "@/Models/Routine";
import Path from "@/Models/Path";
import ProgressModal from "@/Components/Modals/ProgressModal.vue";
import {Task} from "@/types";

const isRoutineCompleted = routine => (routine.today_progress?.value ?? 0) >= routine.amount

export interface Props {
    tasks: Array<Task>
}

const props = withDefaults(defineProps<Props>(), {
    tasks: [],
})

const emit = defineEmits([]);


const taskModal = reactive({
    open: false,
    task: undefined
})

const deleteTask = (task: Task) => {

}

const openTaskModal = task => {
    taskModal.task = task
    taskModal.open = true
}

const taskUpdated = (task: Task) => {
    console.log(`${task.title} is updated!!`);
}


</script>

<template>
    <v-card
        class="px-3 pt-3 my-5"
        min-width="800px"
        min-height="300px"
        title="Task"
    >
        <v-table
            fixed-header
            height="300px"
        >
            <thead>
            <tr>
                <th class="text-left" width="30px">

                </th>
                <th class="text-left">
                    Name
                </th>
                <th class="text-left">
                    Note
                </th>
                <th class="text-left">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="task in tasks"
                :key="task.id"
            >
                <td>
                    <v-icon icon="mdi-check" color="red" v-if="task.is_achieved" />
                </td>
                <td>
                    {{ task.title }}
                </td>
                <td style="max-width: 200px">{{ task.note }}</td>
                <td>
                    <v-icon @click="deleteTask(task)" icon="mdi-delete" color="red mr-6" />
                    <v-icon @click="openTaskModal(task)" icon="mdi-pencil" color="grey" />
                </td>
            </tr>
            </tbody>
        </v-table>

        <v-card-actions class="px-7 d-flex flex-row justify-end">
            <v-btn
                type="submit"
                color="blue-darken-1"
                variant="text"
                @click="openTaskModal(null)"
            >
                Create
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<style scoped>

</style>
