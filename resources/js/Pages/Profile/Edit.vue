<script setup lang="ts">
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head, Link} from '@inertiajs/vue3';
import Layout from "@/Layouts/Layout.vue";

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
    errors: {
        name: String,
        email: String,
        password: String,
        current_password: String,
        password_for_deletion: String,
    }
}>();
</script>

<template>
    <Head title="Profile" />
    <Layout>
        <v-card
            class="mx-auto pa-2"
            min-width="400"
            title="Profile"
        >
            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit" ref="vueForm">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            :errors="errors"
                            class="max-w-xl mb-12"
                        />

                        <UpdatePasswordForm
                            :errors="errors" class="max-w-xl mb-12" />


                        <DeleteUserForm class="max-w-xl" :errors="errors" />
                    </div>
                </div>
            </form>
        </v-card>
    </Layout>
</template>
