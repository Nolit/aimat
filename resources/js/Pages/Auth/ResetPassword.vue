<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Layout from "@/Layouts/Layout.vue";
import Email from "@/Components/Forms/User/Email.vue";
import Password from "@/Components/Forms/User/Password.vue";
import {ref} from "vue";

const props = defineProps<{
    email: string;
    token: string;
}>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
});

const vueForm = ref(null)

const submit = async () => {
    const validResult = await vueForm.value.validate()
    if (!validResult.valid) {
        return
    }
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password');
            vueForm.value.resetValidation()
        },
    });
};
</script>

<template>
    <Head title="Reset Password" />
    <Layout>
        <v-card
            class="mx-auto pa-2"
            min-width="400"
            max-width="500"
            title="Reset Password"
        >
            <v-form @submit.prevent="submit" ref="vueForm">
                <div>
                    <Email v-model="form.email"  :error="form.errors.email"/>
                </div>

                <div class="mt-4">
                    <Password v-model="form.password" :error="form.errors.password" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <v-btn type="submit" color="primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Reset Password
                    </v-btn>
                </div>
            </v-form>>
        </v-card>
    </Layout>
</template>
