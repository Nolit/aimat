<script setup lang="ts">
    // const props = defineProps<{
    //     active: Boolean,
    // }>();
    const model = defineModel()
</script>

<template>
    <slot></slot>
    <v-dialog
        v-model="model"
        width="800"
    >
        <v-card>
            <v-card-title>
                <span class="text-h5">New Daily Task</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col
                            cols="12"
                        >
                            <v-text-field
                                label="Title*"
                                required
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <v-text-field
                                type="number"
                                label="Daily Quantity"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col>
                            <v-select
                                :items="['times', 'pages', 'books', 'seconds', 'minutes', 'hours']"
                                label="Unit"
                                required
                            ></v-select>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-select
                                :items="['-----', 'Goal1', 'Goal2', 'Goal3', 'Goal4']"
                                label="Goal"
                                required
                            ></v-select>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <v-textarea
                                label="Memo"
                            ></v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue-darken-1"
                    variant="text"
                    @click="model = false"
                >
                    Close
                </v-btn>
                <v-btn
                    color="blue-darken-1"
                    variant="text"
                    @click="model = false"
                >
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<style scoped>

</style>
