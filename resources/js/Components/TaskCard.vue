<script setup lang="ts">
import { ref } from 'vue';
import {required, email} from "@/utils/rules"

const props = defineProps<{
    tasks: Array<{
        title: string
        completed: boolean
    }>
    title: string
    target1: string
    target2?: string|undefined
}>();

defineEmits(['clicked:add']);
const model = defineModel()
const _target = props.target1 + (props.target2 ? ('~'+props.target2) : '')
const target = ref(_target)
const tasks = props.tasks
//TODO: sort by completed last

</script>

<template>
    <v-card :title="title" :subtitle="target" min-height="100" min-width="400">
        <v-list>
            <template v-for="task in tasks">
                <v-list-item>
                    <v-row>
                        <v-col cols="1">
                            <v-icon icon="mdi-check" color="red" v-show="task.completed" />
                        </v-col>
                        <v-col>
                            <v-list-item-title>{{ task.title}}</v-list-item-title>
                        </v-col>
                    </v-row>
                </v-list-item>
            </template>
            <v-list-item  class="d-flex flex-row justify-center" @click="$emit('clicked:add')">
                <v-icon icon="mdi-plus-circle-outline" color="grey" />
            </v-list-item>
        </v-list>
    </v-card>
</template>
