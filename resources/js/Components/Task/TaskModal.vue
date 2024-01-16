<script setup lang="ts">
    // const props = defineProps<{
    //     active: Boolean,
    // }>();
    import {useForm} from "@inertiajs/vue3";

    const goals = [
        {
            title: '----------------',
            value: null,
        },
        {
            title: 'Goal #1',
            value: 1,
        },
        {
            title: 'Goal #2',
            value: 2,
        },
        {
            title: 'Goal #3',
            value: 3,
        },
    ]
    const model = defineModel()

    const form = useForm({
        title: '',
        goal_id: null,
        note: '',
    });
    const submit = () => {
        form.post(route('tasks.store'), {
            onFinish: () => {
                form.reset()
                model.value = false
                //TODO: show a message
            },
            preserveState: false
        });
    };
</script>

<template>
    <slot></slot>
    <v-dialog
        v-model="model"
        width="800"
    >
        <v-card>
            <v-card-title>
                <span class="text-h5">New Daily Task</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col
                            cols="12"
                        >
                            <v-text-field
                                label="Title*"
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
                                :items="goals"
                                label="Goal"
                                v-model="form.goal_id"
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
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue-darken-1"
                    variant="text"
                    @click="model = false"
                >
                    Close
                </v-btn>
                <v-btn
                    color="blue-darken-1"
                    variant="text"
                    @click="submit"
                >
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<style scoped>

</style>
