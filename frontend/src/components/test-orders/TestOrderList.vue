<template>
    <div>
        <v-row no-gutters>
            <v-col>
                <v-sheet class="pa-2 ma-2">
                    <h4>Test Orders</h4>
                </v-sheet>
            </v-col>
            <v-col>
                <v-sheet class="pa-2 ma-2 text-right">
                    <v-btn
                        class="text-capitalize"
                        size="small" 
                        color="primary"  
                        @click="openNewTestOrder" 
                    >
                        New Test Order
                    </v-btn>
                </v-sheet>
            </v-col>
        </v-row>

        <v-dialog
            v-model="newTestOrderDialog"
            persistent
            class="dialog-top"
            max-width="100%"
            height="80%"
        >
            <v-card>
                <v-card-title>
                    <span class="headline">New Test Order</span>
                </v-card-title>
                <v-card-text>
                    <v-row>
                        <v-col cols="12" md="4">
                            <v-sheet class="pa-4">
                            <v-text-field
                                clearable
                                v-model="searchQuery"
                                @input="searchPatient"
                                label="Search patient"
                                @click:clear="clearSearch"
                                @keydown.enter="searchPatient"
                                color="primary"
                                @click:append-inner="searchPatient"
                                autofocus
                            ></v-text-field>
                            <div class="mt-4">
                                <div v-if="patients && patients.length">
                                    <div style="max-height: 450px; overflow-y: auto;" class="rounded border">
                                        <v-list dense nav>
                                            <v-list-item
                                                v-for="patient in patients"
                                                :key="patient.id"
                                                @click="selectPatient(patient)"
                                                class="hover:bg-blue-100 cursor-pointer px-3 py-2"
                                                
                                            >
                                                <v-list-item-content>
                                                    <v-list-item-title>
                                                        <div class="d-flex">
                                                        <img 
                                                            :src="patient.sex === 'M' ? '/web_images/male.png' : '/web_images/female.png'" 
                                                            alt="Patient Image" 
                                                            class="rounded-full object-cover"
                                                            width="30"
                                                            height="30"
                                                        />
                                                        <div class="pl-3 pt-2">
                                                            <strong class="uppercase text-indigo-600">{{ patient.last_name }},</strong>
                                                            {{ patient.first_name }} {{ patient.middle_name }}
                                                        </div>
                                                        </div>
                                                    </v-list-item-title>
                                                </v-list-item-content>

                                            </v-list-item>
                                        </v-list>
                                    </div>

                                </div>
                                <div v-else class="text-center text-muted">
                                    No patients found.
                                </div>
                            </div>

                            </v-sheet>
                        </v-col>

                        <v-col cols="12" md="8">
                            <v-sheet class="pa-4">
                                <div class="px-2 py-2 bg-indigo text-white font-weight-bold text-sm rounded-t-md">
                                    Patient Details
                                </div>
                                <div v-if="selectedPatient" class="d-flex align-center gap-2">
                                    <div class="d-flex align-start gap-4 pt-5">
                                        <img 
                                            :src="selectedPatient.sex === 'M' ? '/web_images/male.png' : '/web_images/female.png'" 
                                            alt="Patient Image" 
                                            class="rounded-circle object-cover"
                                            width="150"
                                            height="150"
                                        />
                                        
                                        <div class="pl-8 ">
                                            <p><strong>Name:</strong> {{ selectedPatient.last_name }}, {{ selectedPatient.first_name }} {{ selectedPatient.middle_name }}</p>
                                            <p><strong>Birthdate:</strong> {{ selectedPatient.birthdate }}</p>
                                            <p><strong>Age:</strong> {{ selectedPatient.age }}</p>
                                            <p><strong>Sex:</strong> {{ selectedPatient.sex }}</p>
                                            <p><strong>Status:</strong> {{ selectedPatient.civil_status }}</p>
                                            <p><strong>Contact:</strong> {{ selectedPatient.contact_no }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                    <em>Select a patient to view details.</em>
                                </div>
                                <div class="px-2 py-2 bg-indigo text-white font-weight-bold text-sm rounded-t-md mt-5">
                                    Select Procedures
                                </div>

                                <div class="p-4 flex flex-wrap gap-2">
                                    <v-btn
                                        v-for="test in histopathologyTests"
                                        :key="test"
                                        @click="toggleTest(test)"
                                        :variant="selectedTests.includes(test) ? 'flat' : 'outlined'"
                                        color="indigo"
                                        class="text-sm text-capitalize mt-1 ml-1"
                                    >
                                       <i class="fas fa-flask mr-2"></i> {{ test }}
                                    </v-btn>
                                </div>

                            </v-sheet>
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions>
                    <v-btn
                        color="primary"
                        class="text-capitalize"
                        variant="tonal"
                        size="small"
                        @click="closeNewTestOrderDialog"
                    >
                        <i class="fa fa-cancel"></i> Cancel
                    </v-btn>
                    <v-btn
                        color="success"
                        class="text-capitalize"
                        variant="tonal"
                        size="small"
                        @click="saveTestOrder"
                    >
                        <i class="fa fa-save"></i> Save Test Order
                    </v-btn>
                </v-card-actions>
                </v-card>
        </v-dialog>
    </div>
</template>

<script setup>
    import { useNewTestOrder } from '@/composables/useNewTestOrder';

    const {
        openNewTestOrder,
        newTestOrderDialog,
        closeNewTestOrderDialog,
        searchQuery,
        searchPatient,
        patients,
        selectedPatient,
        selectPatient,
        clearSearch,
        histopathologyTests,
        selectedTests,
        toggleTest,
        saveTestOrder
    } = useNewTestOrder();
</script>
            
<style scoped>
    .v-list-item {
        transition: background 0.2s ease;
    }
    .v-list-item:hover {
        background-color: #e3f2fd !important;
    }
</style>