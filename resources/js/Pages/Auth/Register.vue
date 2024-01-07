<script setup lang="ts">
import Username from "@/Components/Forms/User/Username.vue";
import Email from '@/Components/Forms/User/Email.vue';
import Password from '@/Components/Forms/User/Password.vue';
import { Link, useForm } from '@inertiajs/vue3';
import Layout from "@/Layouts/Layout.vue";
import {ref} from "vue";
import { required, email, min } from "@/utils/rules"

const form = useForm({
    name: '',
    email: '',
    password: ''
});

const vueForm = ref(null)
const submit = async () => {
    const validResult = await vueForm.value.validate()
    if (validResult.valid) {
        form.post(route('register'), {
            onFinish: response => {

            },
        });
    }
};

const rules = {
    required: required,
    email: email,
    min: min(8)
};

const show1 = ref(false)

defineProps<{
    errors: {
        name: String,
        email: String,
        password: String
    }
}>()


</script>

<template>
    <Layout>
        <v-card
            class="mx-auto pa-2"
            min-width="400"
            title="User Registration"
        >
            <v-form @submit.prevent="submit" ref="vueForm">
                <div>
                    <Username v-model="form.name" :error="errors.name" />
                </div>

                <div>
                    <Email v-model="form.email" :error="errors.email" />
                </div>

                <div>
                    <Password :error="errors.password" v-model="form.password" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link
                        :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Already registered?
                    </Link>

                    <v-btn @click="submit" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Register</v-btn>
                </div>
            </v-form>
        </v-card>
    </Layout>
</template>
