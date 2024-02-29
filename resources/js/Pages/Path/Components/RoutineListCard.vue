<script setup lang="ts">
import {computed, reactive, ref} from 'vue';
import Target from '@/Components/Task/Target'
import Routine from "@/Models/Routine";
import Path from "@/Models/Path";
import ProgressModal from "@/Components/Modals/ProgressModal.vue";
import {Task} from "@/types";
import {useForm} from "@inertiajs/vue3";
import RoutineModal from "@/Components/Modals/RoutineModal.vue";

const isRoutineCompleted = routine => (routine.today_progress?.value ?? 0) >= routine.amount

export interface Props {
    path: Path
}

const props = withDefaults(defineProps<Props>(), {
    path: null,
})

const form = useForm({});

const emit = defineEmits([]);

const routineModal = reactive({
    open: false,
    routine: new Routine(undefined, props.path.id)
})

const openRoutineModal = (routine: Routine) => {
    routineModal.routine = routine ? routine : new Routine(undefined, props.path.id)
    routineModal.open = true
}
const deleteRoutine = (routine: Routine) => {
    form.delete(route('routines.destroy', { id: routine.id }));
};

const reloadRoutines = () => {
    //TODO: show a toast for success.
}


</script>

<template>
    <v-card
        class="px-3 pt-3 my-5"
        min-width="800px"
        min-height="300px"
        title="Routine"
    >
        <v-table
            fixed-header
            height="300px"
        >
            <thead>
            <tr>
                <th class="text-left">
                    Name
                </th>
                <th class="text-left">
                    Amount
                </th>
                <th class="text-left">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="routine in path.routines"
                :key="routine.id"
            >
                <td>{{ routine.name }}</td>
                <td>{{ routine.amount }}{{ routine.unit}}</td>
                <td>
                    <v-icon @click="deleteRoutine(routine)" icon="mdi-delete" color="red mr-6" />
                    <v-icon @click="openRoutineModal(routine)" icon="mdi-pencil" color="grey" />
                </td>
            </tr>
            </tbody>
        </v-table>

        <v-card-actions class="px-7 d-flex flex-row justify-end">
            <v-btn
                type="submit"
                color="blue-darken-1"
                variant="text"
                @click="openRoutineModal(null)"
            >
                Create
            </v-btn>
        </v-card-actions>
    </v-card>

    <RoutineModal v-if="routineModal.open" v-model="routineModal.open" :routine="routineModal.routine" @updated:task="reloadRoutines()">

    </RoutineModal>
</template>

<style scoped>

</style>
