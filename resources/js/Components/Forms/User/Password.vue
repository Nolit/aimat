<script setup lang="ts">
import { ref } from 'vue';
import { required, min } from "@/utils/rules"

defineProps<{
    error: string
}>();

defineEmits(['input']);
const model = defineModel()

const rules = {
    required: required,
    min: min(8)
};
const show = ref(false)

</script>

<template>
    <v-text-field
        v-model="model"
        :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
        :rules="[rules.required, rules.min]"
        :type="show ? 'text' : 'password'"
        label="Password"
        hint="At least 8 characters"
        counter
        @click:append="show = !show"
        :error-messages="error"
    ></v-text-field>
</template>
