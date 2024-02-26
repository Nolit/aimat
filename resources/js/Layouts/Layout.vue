<script setup lang="ts">
import { Link, router, usePage } from '@inertiajs/vue3';
import {ref} from "vue";
import {useI18n} from "vue-i18n";
const { locale } = useI18n()
const locale2 = ref(locale)
const logout = () => {
    router.post(route('logout'))
}

const changeLocale = locale => {
    router.put(route('locale.put', {locale: locale}))
    locale2.value = locale
}

const page = usePage()
const isGuest = page.props.isGuest

</script>

<template>
    <v-layout class="rounded rounded-md">
        <v-app-bar height="80" class="px-15">
            <v-row justify="start">
                <v-img src="/images/logo.png" max-width="150px" max-height="100" class="ml-7" />
            </v-row>
            <v-row justify="end">
                <v-menu>
                    <template v-slot:activator="{ props }">
                        <v-btn v-bind="props">{{ $t('language') }}</v-btn>
                    </template>
                    <v-list>
                        <v-list-item @click="changeLocale('en')">
                            English
                        </v-list-item>
                        <v-list-item @click="changeLocale('ja')">
                            日本語
                        </v-list-item>
                    </v-list>
                </v-menu>
                <v-menu>
                    <template v-slot:activator="{ props }">
                        <v-icon icon="mdi-menu" v-bind="props" class="mr-5" size="40"></v-icon>
                    </template>
                    <v-list>
                        <v-list-item v-if="!isGuest">
                            <v-list-item-title>
                                <Link :href="route('dashboard')">{{ $t('dashboard') }}</Link>
                            </v-list-item-title>
                        </v-list-item>
                        <v-list-item v-if="!isGuest">
                            <v-list-item-title>
                                <Link :href="route('paths.index')">{{ $t('path') }}</Link>
                            </v-list-item-title>
                        </v-list-item>
                        <v-list-item v-if="isGuest">
                            <v-list-item-title>
                                <Link :href="route('login')">{{ $t('login') }}</Link>
                            </v-list-item-title>
                        </v-list-item>
                        <v-list-item v-if="isGuest">
                            <v-list-item-title>
                                <Link :href="route('register')">{{ $t('register') }}</Link>
                            </v-list-item-title>
                        </v-list-item>
                        <v-list-item v-if="!isGuest">
                            <v-list-item-title>
                                <button @click="logout()">{{ $t('logout') }}</button>
                            </v-list-item-title>
                        </v-list-item>
                        <v-list-item v-if="!isGuest">
                            <v-list-item-title>
                                <Link :href="route('profile.edit')">{{ $t('profile') }}</Link>
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
