<script setup lang="ts">
import { ref } from 'vue';
import {required, email} from "@/utils/rules"

const props = defineProps<{
    tasks: Array<{
        title: string
        completed: boolean
    }>
    title: string
}>();

defineEmits(['input']);
const model = defineModel()

const rules = {
    required: required,
    email: email
};

</script>

<template>
    <v-card :title="title" min-height="100" min-width="400">
        <v-list>
            <template v-for="task in tasks">
                <v-list-item>
                    <v-row>
                        <v-col cols="1">
                            <v-icon icon="mdi-check-circle" v-show="task.completed" />
                        </v-col>
                        <v-col>
                            <v-list-item-title>{{ task.title}}</v-list-item-title>
                        </v-col>
                    </v-row>
                </v-list-item>
            </template>
        </v-list>
    </v-card>
</template>
