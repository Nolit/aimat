<script setup lang="ts">
import {computed, reactive} from 'vue';
import Path from "@/Models/Path";
import ProgressModal from "@/Components/Modals/ProgressModal.vue";
import {useI18n} from "vue-i18n";
const i18n = useI18n();

const isRoutineCompleted = routine => (routine.today_progress?.value ?? 0) >= routine.amount

export interface Props {
    paths: Array<Path>,
    title: String
}

const props = withDefaults(defineProps<Props>(), {
    paths: [],
    title: ''
})

const emit = defineEmits(['clicked:routine']);

const incompletedPathIds = computed({
    get() {
        return props.paths.filter(path => {
            return path.routines.some(routine =>  {
                return !isRoutineCompleted(routine)
            })
        }).map(path => {
            return path.id
        })
    },

    set(val) {

    },
});

const progressModal = reactive({
    open: false,
    routine: undefined
})

const openProgressModal = routine => {
    progressModal.routine = routine
    progressModal.open = true
}

const progressUpdated = routine => {
    console.log(`${routine.name} is progressed!!`);
}

const tweet = () => {
    const routines = props.paths.flatMap(path => {
        return path.routines
    })
    const headerContents = i18n.t('tweet_header') + "\n"
    const routineContents = routines
        .filter(routine => routine.today_progress?.value)
        .map(routine => {
            const routineName = routine.name
            const amountOfProgress = routine.today_progress?.value ?? 0
            return `・${routineName} ${amountOfProgress}${(routine.unit)}`
        })
        .join("\n") + "\n"

    const contents = headerContents + routineContents

    const s = encodeURIComponent(contents);
    var url = document.location.href;

    if (contents != "") {
        url = "http://twitter.com/share?url=" + escape(url) + "&text=" + s;
        window.open(url);
    }
}

</script>

<template>
    <v-card :title="title" min-height="100" min-width="500">
        <template v-slot:append>
            <v-icon icon="mdi-share-all" @click="tweet()" />
        </template>
        <v-list :opened="incompletedPathIds">
            <template v-for="path in paths">
                <v-list-group :value="path.id">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                        >
                            <v-list-item-title>
                                <v-row>
                                    <v-col cols="1">
<!--                                        <v-icon icon="mdi-check" color="#BDBDBD" v-if="incompletedPathIds.includes(path.id)" />-->
                                        <v-icon icon="mdi-check" color="red" v-if="!incompletedPathIds.includes(path.id)" />
                                    </v-col>
                                    <v-col>
                                        <v-list-item-title>{{ path.name }}</v-list-item-title>
                                    </v-col>
                                </v-row>

                            </v-list-item-title>
                        </v-list-item>
                    </template>

                    <v-list-item v-for="routine in path.routines" @click="openProgressModal(routine)">
                        <v-list-item-title>
                            <v-row>
                                <v-col cols="1">
<!--                                    <v-icon icon="mdi-check" color="red" v-show="isRoutineCompleted(routine)" />-->
                                </v-col>
                                <v-col cols="7">
                                    <v-list-item-title>{{ routine.name }}</v-list-item-title>
                                </v-col>
                            </v-row>
                        </v-list-item-title>
                        <v-list-item-subtitle>
                            <v-row>
                                <v-col cols="1"></v-col>
                                <v-col>
                                    {{ routine.today_progress?.value ?? 0 }} {{ routine.unit }} / {{
                                        routine.amount
                                    }} {{ routine.unit }}
                                </v-col>
                            </v-row>
                        </v-list-item-subtitle>
                    </v-list-item>

                </v-list-group>

<!--                <v-divider-->
<!--                    :thickness="1"-->
<!--                    class="border-opacity-100"></v-divider>-->
<!--                <v-list-item @click="$emit('clicked:update', task.id)">-->
<!--                    <v-row>-->
<!--                        <v-col cols="1">-->
<!--                            <v-icon icon="mdi-check" color="red" v-show="task.completed" />-->
<!--                        </v-col>-->
<!--                        <v-col>-->
<!--                            <v-list-item-title>{{ task.title }}</v-list-item-title>-->
<!--                        </v-col>-->
<!--                    </v-row>-->
<!--                </v-list-item>-->
            </template>
        </v-list>


        <ProgressModal v-if="progressModal.open" v-model="progressModal.open" :routine="progressModal.routine" @updated:progress="progressUpdated">

        </ProgressModal>
    </v-card>

</template>

<style scoped>

</style>
