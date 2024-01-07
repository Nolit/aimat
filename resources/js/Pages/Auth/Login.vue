<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Layout from "@/Layouts/Layout.vue";
import { required, email } from "@/utils/rules"
import Email from "@/Components/Forms/User/Email.vue";
import Password from "@/Components/Forms/User/Password.vue";

defineProps<{
    canResetPassword?: boolean;
    status?: string;
    errors: {
        email: String,
        password: String
    }
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};

const rules = {
    required: required,
    email: email
};
</script>

<template>
    <Head title="Login" />
    <Layout>
        <v-card
            class="mx-auto pa-2"
            min-width="400"
            title="Login"
        >
            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit" ref="vueForm">
                <div>
                    <Email v-model="form.email" :error="errors.email" />
                </div>

                <div>
                    <Password :error="errors.password" v-model="form.password" />
                </div>

                <div>
                    <label class="flex items-center">
                        <v-checkbox label="Remember me" v-model="form.remember" />
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Forgot your password?
                    </Link>

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Log in
                    </PrimaryButton>
                </div>
            </form>
        </v-card>
    </Layout>
</template>
