<script setup lang="ts">
import {Head, router, useForm} from '@inertiajs/vue3';
import Layout from "@/Layouts/Layout.vue";
import {Ref, ref, nextTick, computed} from "vue";
import Path from "@/Models/Path";

const props = defineProps({
    paths: {
        type: Array<Path>,
        required: true
    },
});
const form = useForm({})

const page = ref(1);
const countPerPage = 5;
const pageLength = Math.ceil(props.paths.length / countPerPage);

const createPath = async () => {
    await form.post(route('paths.store'))
}
const moveToDetail = pathId => {
    form.get(route('paths.show', {'id': pathId}))
}
</script>

<template>
    <Head title="Path" />

    <Layout>
        <v-sheet
            class="my-12"
            min-width="500px"
            min-height="100px"
        >
            <v-container class="d-flex flex-row justify-end ">
                <v-btn color="primary" @click="createPath()">Create</v-btn>
            </v-container>
            <v-data-iterator :items="paths" :page="page">
                <template v-slot:default="{ items }">
                    <template
                        v-for="item in items"
                        :key="item.raw.name"
                    >
                        <v-card
                            :title="item.raw.name"
                            :text="item.raw.note"
                            class="pa-5"
                            @click="moveToDetail(item.raw.id)"
                        ></v-card>
                        <br>
                    </template>
                </template>
                <template v-slot:footer>
                    <v-pagination :length="pageLength" v-model="page"></v-pagination>
                </template>
            </v-data-iterator>
        </v-sheet>
    </Layout>
</template>
