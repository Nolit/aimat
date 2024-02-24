<script setup lang="ts">
    import {Task} from "@/types";
    import {required, minDigit} from "@/utils/rules"
    import {useForm} from "@inertiajs/vue3";
    import {ref, computed } from "vue";
    import Routine from "@/Models/Routine";
    import { useI18n }  from "vue-i18n";

    export interface Props {
        routine: Routine
    }

    const props = defineProps<Props>()
    const model = defineModel()
    const emit = defineEmits(['updated:task'])
    const i18n = useI18n();
    const units =  [
        i18n.t('unit.times'),
        i18n.t('unit.pages'),
        i18n.t('unit.books'),
        i18n.t('unit.seconds'),
        i18n.t('unit.minutes'),
        i18n.t('unit.hours'),
    ]
    const form = useForm({
        path_id: props.routine.path_id,
        name: props.routine.name,
        type: props.routine.type,
        amount: props.routine.amount,
        unit: props.routine.unit,
        note: props.routine.note,
    });
    const vueForm = ref(null)
    const isEditMode = props.routine.id !== undefined

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
        if (isEditMode) {
            form.patch(route('routines.update', { id: props.routine.id }), options);
        } else {
            form.post(route('routines.store'), options);
        }
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
        <v-card>
            <v-form @submit.prevent="submit" ref="vueForm">
                <v-card-title>
                    <span class="text-h5">Routine</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col
                                cols="12"
                            >
                                <v-text-field
                                    label="Name*"
                                    :rules="[rules.required]"
                                    :error-messages="form.errors.name"
                                    v-model="form.name"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col
                                cols="2"
                                class="pr-0"
                            >
                                <v-text-field
                                    type="number"
                                    label="Amount*"
                                    :rules="[rules.required, rules.minDigit(1)]"
                                    :error-messages="form.errors.amount"
                                    v-model="form.amount"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col
                                cols="2"
                                class="pl-0"
                            >
                                <v-select
                                    :items="units"
                                    label="Unit"
                                    v-model="form.unit"
                                    required
                                ></v-select>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col
                                cols="12"
                            >
                                <v-textarea
                                    label="Note"
                                    v-model="form.note"
                                    :error-messages="form.errors.note"
                                ></v-textarea>
                            </v-col>
                        </v-row>
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

<style scoped>

</style>
