<script setup lang="ts">
    import {required, minDigit} from "@/utils/rules"
    import {useForm} from "@inertiajs/vue3";
    import { ref } from "vue";
    import Routine from "@/Models/Routine";

    export interface Props {
        routine: Routine
    }

    const props = defineProps<Props>()
    const model = defineModel()
    const emit = defineEmits(['updated:progress'])
    const progress = props.routine.today_progress
    const form = useForm({
        value: progress?.value ?? 0,
    });
    const vueForm = ref(null)

    const options = {
        onFinish: () => {
            if (!form.hasErrors) {
                emit('updated:progress', props.routine)
                close()
                //TODO: show a message
            }
        },
    }
    const submit = async () => {
        const validResult = await vueForm.value.validate()
        if (!validResult.valid) return
        form.put(route('routines.today-progress.put', { id: props.routine.id }), options);
    };

    const rules = {
        required: required,
        minDigit: minDigit,
    };

    const close = () => {
        form.reset()
        model.value = false
    }
</script>

<template>
    <slot></slot>
    <v-dialog
        v-model="model"
        width="800"
    >
        <v-card :title="routine.name">
            <v-form @submit.prevent="submit" ref="vueForm">
                <v-card-text>
                    <v-container style="background-color: white!important;">
                        <v-text-field
                            type="number"
                            label="Value*"
                            :rules="[rules.required, rules.minDigit(1)]"
                            :error-messages="form.errors.value"
                            v-model="form.value"
                            required
                            :suffix="routine.unit"
                        ></v-text-field>
                    </v-container>
                </v-card-text>
                <v-card-actions class="px-7">
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

<style>
    span.v-text-field__suffix {
        background-color: white!important;
    }
</style>
