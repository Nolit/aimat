<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Layout from "@/Layouts/Layout.vue";
import Email from "@/Components/Forms/User/Email.vue";
import {ref} from "vue";

defineProps<{
    status?: string;
    errors: {
        email: string
    }
}>();

const form = useForm({
    email: '',
});
const vueForm = ref(null)
const submit = async () => {
    const validResult = await vueForm.value.validate()
    if (validResult.valid) {
        form.post(route('password.email'));
    }
};
</script>

<template>
    <Head title="Forgot Password" />
    <Layout>
        <v-card
            class="mx-auto pa-2"
            min-width="400"
            max-width="500"
            title="User Registration"
        >
            <div class="mb-4 text-sm text-gray-600">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset
                link that will allow you to choose a new one.
            </div>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <v-form @submit.prevent="submit" ref="vueForm">
                <div>
                    <Email v-model="form.email"  :error="form.errors.email"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <v-btn type="submit" color="black" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Email Password Reset Link
                    </v-btn>
                </div>
            </v-form>
        </v-card>

    </Layout>
</template>
