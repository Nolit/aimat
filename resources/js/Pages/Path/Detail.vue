<script setup lang="ts">
import {Head, router, useForm} from '@inertiajs/vue3';
import Layout from "@/Layouts/Layout.vue";
import { ref } from "vue";
import Path from "@/Models/Path";
import TaskListCard from "@/Pages/Path/Components/TaskListCard.vue";
import RoutineListCard from "@/Pages/Path/Components/RoutineListCard.vue";
import PathEditCard from "@/Pages/Path/Components/PathEditCard.vue";

const props = defineProps({
    path: {
        type: Path,
        required: true
    }
});

</script>

<template>
    <Head title="Detail" />

    <Layout>
        <PathEditCard :path="path" />
        <RoutineListCard :path="path" />
        <TaskListCard :path="path" />
    </Layout>
</template>
