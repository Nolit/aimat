<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Password from "@/Components/Forms/User/Password.vue";

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    current_password: '',
    password: '',
});

defineProps<{
    errors: {
        password: String,
        current_password: String,
    }
}>();

const vueForm = ref(null)
const updatePassword = async () => {
    const validResult = await vueForm.value.validate()
    if (!validResult.valid) {
        return
    }
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            vueForm.value.resetValidation()
        },
        onError: () => {
            // if (form.errors.password) {
            //     form.reset('password');
            //     passwordInput.value?.focus();
            // }
            // if (form.errors.current_password) {
            //     form.reset('current_password');
            //     currentPasswordInput.value?.focus();
            // }
        },
    });
};


</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Update Password</h2>

            <p class="mt-1 text-sm text-gray-600">
                Ensure your account is using a long, random password to stay secure.
            </p>
        </header>

        <v-form @submit.prevent="updatePassword" class="mt-6 space-y-6" ref="vueForm">
            <div>
                <Password :error="errors.current_password" v-model="form.current_password" label="Current Password" name="current_password" />
                <Password :error="errors.password" v-model="form.password" label="New Password" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </v-form>
    </section>
</template>
