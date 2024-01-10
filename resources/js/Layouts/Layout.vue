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
    <v-layout class="rounded rounded-md">
        <v-app-bar height="80">
            <v-row justify="start">
                <v-img src="/images/logo.png" max-width="150px" max-height="100" class="ml-7" />
            </v-row>
            <v-row justify="end">
                <v-menu>
                    <template v-slot:activator="{ props }">
                        <v-icon icon="mdi-menu" v-bind="props" class="mr-5" size="40"></v-icon>
                    </template>
                    <v-list>
                        <v-list-item v-if="!isGuest">
                            <v-list-item-title>
                                <Link :href="route('dashboard')">Dashboard</Link>
                            </v-list-item-title>
                        </v-list-item>
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
            </v-row>
        </v-app-bar>

        <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
            <div class="mt-5">
                <slot />
            </div>
        </v-main>
    </v-layout>
</template>
