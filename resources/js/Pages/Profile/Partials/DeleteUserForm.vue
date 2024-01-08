<script setup lang="ts">
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';
import Password from "@/Components/Forms/User/Password.vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    password_for_deletion: '',
});
defineProps<{
    errors: {
        password_for_deletion: String,
    }
}>();
const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value?.focus());
};

const vueForm = ref(null)

const deleteUser = async () => {
    const validResult = await vueForm.value.validate()
    if (!validResult.valid) {
        return
    }
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value?.focus(),
        onFinish: () => {
            form.reset();
        },
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Delete Account</h2>

            <p class="mt-1 text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
                your account, please download any data or information that you wish to retain.
            </p>
        </header>

        <v-btn color="red">
            Delete Account
            <v-dialog
                v-model="confirmingUserDeletion"
                activator="parent"
                width="500"
            >
                <v-sheet>
                    <v-sheet class="my-2 mx-5">
                        <h2 class="text-lg font-medium text-gray-900">
                            Are you sure you want to delete your account?
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            Once your account is deleted, all of its resources and data will be permanently deleted. Please
                            enter your password to confirm you would like to permanently delete your account.
                        </p>

                        <v-form ref="vueForm" @submit.prevent="deleteUser">
                            <div class="mt-6">
                                <Password
                                    v-model="form.password_for_deletion"
                                    :error="errors.password_for_deletion"
                                    name="password_for_deletion"
                                />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                                <DangerButton
                                    class="ms-3"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                    @click="deleteUser"
                                >
                                    Delete Account
                                </DangerButton>
                            </div>
                        </v-form>
                    </v-sheet>
                </v-sheet>
            </v-dialog>
        </v-btn>
    </section>
</template>
