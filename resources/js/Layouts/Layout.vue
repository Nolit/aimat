<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import DropdownLink from "@/Components/DropdownLink.vue";

const logout = () => {
    router.post(route('logout'))
}

const page = usePage()
const isGuest = page.props.isGuest

</script>

<template>
    <Head title="Aimat" />

    <v-layout class="rounded rounded-md">
        <v-app-bar title="Logo here">
            <v-menu>
                <template v-slot:activator="{ props }">
                    <v-icon icon="mdi-menu" v-bind="props" class="mr-5"></v-icon>
                </template>
                <v-list>
                    <v-list-item v-if="isGuest">
                        <v-list-item-title>
                            <Link :href="route('login')">Log in</Link>
                        </v-list-item-title>
                    </v-list-item>
                    <v-list-item v-if="isGuest">
                        <v-list-item-title>
                            <Link :href="route('register')">Register</Link>
                        </v-list-item-title>
                    </v-list-item>
                    <v-list-item v-if="!isGuest">
                        <v-list-item-title>
                            <button @click="logout()">Log out</button>
                        </v-list-item-title>
                    </v-list-item>
                    <v-list-item v-if="!isGuest">
                        <v-list-item-title>
                            <Link :href="route('profile.edit')">Profile</Link>
                        </v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>

        <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
            <div class="mt-5">
                <slot />
            </div>
        </v-main>
    </v-layout>
</template>
