<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Layout from "@/Layouts/Layout.vue";
defineProps({ canRegister: Boolean, canLogin: Boolean, canLogout: Boolean })
</script>

<template>
    <Head title="Dashboard" />

    <Layout  :can-register="canRegister" :can-login="canLogin" :can-logout="canLogout">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            Dashboard
        </div>
    </Layout>
</template>
