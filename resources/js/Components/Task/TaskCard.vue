<script setup lang="ts">
import { ref } from 'vue';
import {required, email} from "@/utils/rules"
import Target from '@/Components/Task/Target'



// class TargetList {
//     private targets: Array<Target>
//     private curent: Number
//
//     next() {
//
//     }
//
//     prev() {
//
//     }
// }

const props = defineProps<{
    tasks: Array<{
        title: string
        completed: boolean
    }>
    title: string
    targets: Array<Target>
    targetKey: Number
}>();

const emit = defineEmits(['clicked:add', 'changed:target', 'clicked:prev', 'clicked:next', 'clicked:target']);
const model = defineModel()
const targetKey = ref(props.targetKey)
const tasks = props.tasks
//TODO: sort by completed last

const prev = () => {
    targetKey.value -= 1
    emit('clicked:prev')
}
const next = () => {
    targetKey.value += 1
    emit('clicked:next')
}

</script>

<template>
    <v-card :title="title" min-height="100" min-width="400">
        <v-card-subtitle>
            <v-row style="text-align: center;">
                <v-col cols="2">
                    <v-btn class="btn-prev" :flat="true" @click="prev()" :disabled="targetKey <= 0">
                        <v-icon icon="mdi-arrow-left-bold" color="grey" />
                    </v-btn>
                </v-col>
                <v-col>
                    <v-btn :flat="true" @click="$emit('clicked:target')">
                        {{ targets[targetKey].toString() }}
                    </v-btn>
                </v-col>
                <v-col cols="2">
                    <v-btn class="btn-next" :flat="true" @click="next()" :disabled="targetKey >= targets.length-1">
                        <v-icon icon="mdi-arrow-right-bold" color="grey" />
                    </v-btn>
                </v-col>
            </v-row>
        </v-card-subtitle>
        <v-list>
            <template v-for="task in tasks">
                <v-list-item>
                    <v-row>
                        <v-col cols="1">
                            <v-icon icon="mdi-check" color="red" v-show="task.completed" />
                        </v-col>
                        <v-col>
                            <v-list-item-title>{{ task.title }}</v-list-item-title>
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

<style>
    .btn-prev:disabled,.btn-next:disabled {
        color: #ffffff;
    }
</style>
