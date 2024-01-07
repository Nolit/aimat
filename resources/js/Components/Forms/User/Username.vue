<script setup lang="ts">
import { required } from "@/utils/rules"

defineProps<{
    error: string
}>();

defineEmits(['input']);
const model = defineModel()

const rules = {
    required: required,
};

</script>

<template>
    <v-text-field
        :rules="[rules.required]"
        label="Name"
        placeholder="your nickname"
        hint="Enter your name to be called in our app"
        v-model="model"
        :error-messages="error"
    />
</template>
