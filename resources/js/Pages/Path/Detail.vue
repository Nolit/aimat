<script setup lang="ts">
import {Head, router, useForm} from '@inertiajs/vue3';
import Layout from "@/Layouts/Layout.vue";
import {Ref, ref, nextTick, computed, reactive} from "vue";
import Path from "@/Models/Path";
import {required} from "@/utils/rules";
import TaskModal from "@/Components/Task/TaskModal.vue";
import RoutineModal from "@/Components/Modals/RoutineModal.vue";
import Routine from "@/Models/Routine";
import {useI18n} from "vue-i18n";
import TaskListCard from "@/Components/Cards/TaskListCard.vue";
const i18n = useI18n();

const props = defineProps({
    path: {
        type: Path,
        required: true
    },
});

const form = useForm({
    name: props.path.name,
    note: props.path.note,
});

const vueForm = ref(null)

const rules = {
    required: required,
};

const updatePath = async () => {
    const validResult = await vueForm.value.validate()
    if (!validResult.valid) return
    form.patch(route('paths.update', { id: props.path.id }));
};

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

const openDeleteDialog = () => {
    if (confirm(i18n.t('confirm_deletion'))) {
        form.delete(route('paths.destroy', {'id': props.path?.id }))
    }
}


</script>

<template>
    <Head title="Detail" />

    <Layout>
        <v-card
            class="px-3 pt-3"
            min-width="800px"
            title="Path"
        >
            <v-form @submit.prevent="updatePath" ref="vueForm">
                <v-text-field
                    label="Name*"
                    :rules="[rules.required]"
                    :error-messages="form.errors.name"
                    v-model="form.name"
                    required
                ></v-text-field>


                <v-textarea
                    label="Note"
                    v-model="form.note"
                ></v-textarea>

                <v-card-actions class="px-7">
                    <v-btn
                        type="button"
                        color="red"
                        variant="text"
                        @click="openDeleteDialog()"
                    >
                        Delete
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn
                        type="submit"
                        color="blue-darken-1"
                        variant="text"
                    >
                        Save
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>

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
        <TaskListCard :tasks="path.tasks" />
    </Layout>
    <RoutineModal v-if="routineModal.open" v-model="routineModal.open" :routine="routineModal.routine" @updated:task="reloadRoutines()">

    </RoutineModal>
</template>
