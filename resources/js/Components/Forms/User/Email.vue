<script setup lang="ts">
import { ref } from 'vue';
import {required, email} from "@/utils/rules"

defineProps<{
    error: string
}>();

defineEmits(['input']);
const model = defineModel()

const rules = {
    required: required,
    email: email
};

</script>

<template>
    <v-text-field
        :rules="[rules.required, rules.email]"
        label="Email"
        placeholder="your email address"
        v-model="model"
        :error-messages="error"
    />
</template>
