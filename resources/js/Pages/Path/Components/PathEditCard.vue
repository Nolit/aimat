<script setup lang="ts">
import {computed, reactive, ref} from 'vue';
import Target from '@/Components/Task/Target'
import Routine from "@/Models/Routine";
import Path from "@/Models/Path";
import ProgressModal from "@/Components/Modals/ProgressModal.vue";
import {Task} from "@/types";
import Layout from "@/Layouts/Layout.vue";
import {useForm} from "@inertiajs/vue3";
import {required} from "@/utils/rules";
import {useI18n} from "vue-i18n";
const i18n = useI18n();

const props = defineProps({
    path: {
        type: Path,
        required: true
    },
});

const emit = defineEmits([]);

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

const openDeleteDialog = () => {
    if (confirm(i18n.t('confirm_deletion'))) {
        form.delete(route('paths.destroy', {'id': props.path?.id }))
    }
}

</script>

<template>
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
</template>

<style scoped>

</style>
