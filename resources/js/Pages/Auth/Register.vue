<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Layout from "@/Layouts/Layout.vue";
import {ref} from "vue";

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
    required: v => {
        return !!v || 'Field is required'
    },
    email: v => {
        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return pattern.test(v) || 'Not an email address.'
    },
    min: v => v.length >= 8 || 'Min 8 characters',
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
                    <v-text-field
                        :rules="[rules.required]"
                        label="Name"
                        placeholder="your nickname"
                        hint="Enter your name to be called in our app"
                        v-model="form.name"
                        :error-messages="errors.name"
                    />
                </div>

                <div>
                    <v-text-field
                        :rules="[rules.required, rules.email]"
                        label="Email"
                        placeholder="your nickname"
                        hint="Enter your name to be called in our app"
                        v-model="form.email"
                        :error-messages="errors.email"
                    />
                </div>

                <div>
                    <v-text-field
                        v-model="form.password"
                        :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                        :rules="[rules.required, rules.min]"
                        :type="show1 ? 'text' : 'password'"
                        label="Password"
                        hint="At least 8 characters"
                        counter
                        @click:append="show1 = !show1"
                        :error-messages="errors.password"
                    ></v-text-field>
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
