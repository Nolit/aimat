<script setup lang="ts">
import { ref } from 'vue';
import Target from '@/Components/Task/Target'

export interface Props {
    tasks: Array<{
        id: number
        title: string
        completed: boolean
        note: string
    }>
    title: string
    targets: Array<Target>|null
    targetKey: Number
    disableAdd: boolean
}

const props = withDefaults(defineProps<Props>(), {
    tasks: null,
    title: '',
    targets: null,
    targetKey: 0,
    disableAdd: true,
})

const emit = defineEmits(['clicked:add', 'clicked:update', 'clicked:prev', 'clicked:next', 'clicked:target']);
const targetKey = ref(props.targetKey)
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
        <v-card-subtitle v-if="targets !== null">
<!--            <v-row style="text-align: center;">-->
<!--                <v-col cols="2">-->
<!--                    <v-btn class="btn-prev" :flat="true" @click="prev()" :disabled="targetKey <= 0">-->
<!--                        <v-icon icon="mdi-arrow-left-bold" color="grey" />-->
<!--                    </v-btn>-->
<!--                </v-col>-->
<!--                <v-col>-->
<!--                    <v-btn :flat="true" @click="$emit('clicked:target')">-->
<!--                        {{ targets[targetKey].toString() }}-->
<!--                    </v-btn>-->
<!--                </v-col>-->
<!--                <v-col cols="2">-->
<!--                    <v-btn class="btn-next" :flat="true" @click="next()" :disabled="targetKey >= targets.length-1">-->
<!--                        <v-icon icon="mdi-arrow-right-bold" color="grey" />-->
<!--                    </v-btn>-->
<!--                </v-col>-->
<!--            </v-row>-->
        </v-card-subtitle>
        <v-list>
            <template v-for="task in tasks">
                <v-list-item @click="$emit('clicked:update', task.id)">
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
            <v-list-item v-if="!disableAdd" class="d-flex flex-row justify-center" @click="$emit('clicked:add')">
                <v-icon icon="mdi-plus-circle-outline" color="grey" />
            </v-list-item>
        </v-list>
    </v-card>
</template>

<style scoped>
    .btn-prev:disabled,.btn-next:disabled {
        color: #ffffff;
    }
</style>
