<script setup lang="ts">
    import {Task} from "@/types";
    import { required } from "@/utils/rules"
    import {useForm} from "@inertiajs/vue3";
    import {ref, computed } from "vue";
    import Path from "@/Models/Path";

    export interface Props {
        task: Task|null,
        paths: Array<Path>,
    }

    const props = defineProps<Props>();
    const model = defineModel()
    const emit = defineEmits(['updated:task']);

    const defaultPathId = props.task?.path_id ?? props.paths.length === 1 ? props.paths[0].id : null

    const form = useForm({
        title: props.task?.title ?? '',
        path_id: defaultPathId,
        note: props.task?.note,
        is_achieved: Boolean(props.task?.is_achieved)
    });
    const vueForm = ref(null)
    const isEditMode = props.task !== null

    const options = {
        onFinish: () => {
            if (!form.hasErrors) {
                emit('updated:task')
                close()
                //TODO: show a message
            }
        },
    }
    const submit = async () => {
        const validResult = await vueForm.value.validate()
        if (!validResult.valid) return
        if (props.task) {
            form.patch(route('tasks.update', { id: props.task.id }), options);
        } else {
            form.post(route('tasks.store'), options);
        }
    };

    const deleteTask = () => {
        form.delete(route('tasks.destroy', { id: props.task.id }), options);
    }

    const rules = {
        required: required,
    };

    const close = () => {
        form.reset()
        model.value = false
    }

    const paths = props.paths.map(path => {
        return {
            title: path.name,
            value: path.id,
        }
    })
</script>

<template>
    <slot></slot>
    <v-dialog
        v-model="model"
        width="800"
    >
        <v-card>
            <v-form @submit.prevent="submit" ref="vueForm">
                <v-card-title>
                    <span class="text-h5">Task</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col
                                cols="12"
                            >
                                <v-text-field
                                    label="Title*"
                                    :rules="[rules.required]"
                                    :error-messages="form.errors.title"
                                    v-model="form.title"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col
                                cols="12"
                                sm="6"
                                md="4"
                            >
                                <v-select
                                    :items="paths"
                                    label="Path"
                                    v-model="form.path_id"

                                    required
                                ></v-select>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-textarea
                                    label="Memo"
                                    v-model="form.note"
                                ></v-textarea>
                            </v-col>
                        </v-row>
                        <v-row v-if="isEditMode">
                            <v-checkbox label="achieved" color="success" v-model="form.is_achieved" />
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions class="px-7">
                    <v-btn
                        v-if="isEditMode"
                        type="button"
                        color="red"
                        variant="text"
                        @click="deleteTask"
                    >
                        Delete</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn
                        type="button"
                        color="blue-darken-1"
                        variant="text"
                        @click="close"
                    >
                        Close
                    </v-btn>
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
    </v-dialog>
</template>

<style scoped>

</style>
