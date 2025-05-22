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
                       <i class="fa fa-plus me-1"></i> New Test Order
                    </v-btn>
                </v-sheet>
            </v-col>
        </v-row>

        <v-table>
            <thead>
                <tr>
                    <th class="text-center">Patient Name</th>
                    <th class="text-center">Accession #</th>
                    <th class="text-center" colspan="5">Histopath Phases</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(order, index) in testOrders" :key="index" class="">
                    <td class="text-center align-top pt-1 pb-2">
                        <b class="text-success text-uppercase">{{ order.patientName }}</b><br>
                        <small class="text-muted">49 y/o • Male</small><br>
                        <v-btn class="mt-2 text-capitalize" color="info" size="x-small" variant="tonal">
                            <i class="fa fa-edit me-1"></i> Edit Profile
                        </v-btn>
                        <!-- <b>S25-0001</b><br>
                        <small class="text-muted">Surgical Pathology Report</small><br>
                        <small class="text-muted">05/20/2025</small> -->
                    </td>

                    <td class="text-center align-top">
                        <b>S25-0001</b><br>
                        <small class="text-muted">Surgical Pathology Report</small><br>
                        <small class="text-muted">05/20/2025</small>
                    </td>

                    <td class="text-center" colspan="5">
                        <div class="d-flex flex-wrap justify-center">
                        <v-btn size="x-small" color="info" class="ma-1" @click="openPhaseDialog('receiving', order)">
                            <i class="fa fa-pencil me-1"></i> Receiving
                        </v-btn>

                        <v-btn size="x-small" color="orange" class="ma-1" @click="openPhaseDialog('grossing', order)">
                            <i class="fa fa-scissors me-1"></i> Grossing
                        </v-btn>

                        <v-btn size="x-small" color="indigo" class="ma-1" @click="openPhaseDialog('initialRead', order)">
                            <i class="fa fa-book-open me-1"></i> Initial Read
                        </v-btn>

                        <v-btn size="x-small" color="indigo" class="ma-1" @click="openPhaseDialog('finalRead', order)">
                            <i class="fa fa-bookmark me-1"></i> Final Read
                        </v-btn>

                        <v-btn size="x-small" color="success" class="ma-1" @click="openPhaseDialog('validation', order)">
                            <i class="fa fa-book-open-reader me-1"></i> Validation
                        </v-btn>
                        </div>
                    </td>
                </tr>
            </tbody>
            </v-table>

            <!-- Phase Dialog -->
            <v-dialog v-model="phaseDialog.visible" max-width="500">
            <v-card>
                <v-card-title class="text-h6">
                {{ capitalize(phaseDialog.phase) }} - {{ phaseDialog.order?.patientName }}
                </v-card-title>
                <v-card-text>
                <!-- Insert your phase-specific form or logic here -->
                <p>Perform actions related to <strong>{{ phaseDialog.phase }}</strong> phase here.</p>
                </v-card-text>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn text @click="phaseDialog.visible = false">Cancel</v-btn>
                <v-btn color="primary" @click="savePhaseAction">Save</v-btn>
                </v-card-actions>
            </v-card>
            </v-dialog>

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
                                variant="outlined"
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
                                    <div class="mt-2">
                                        <v-btn
                                            color="indigo"
                                            class="text-capitalize"
                                            block
                                            @click="newPatient"
                                        >
                                            <i class="fa fa-user-plus mr-1"></i> New Patient
                                        </v-btn>
                                    </div>
                                </div>
                            </div>

                            </v-sheet>
                        </v-col>

                        <v-col cols="12" md="8">
                            <v-sheet class="pa-4">
                                <div class="px-2 py-2 bg-indigo text-white font-weight-bold text-sm rounded-t-md">
                                    Patient Info
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
                                        <div class="pl-8">
                                            <p><strong>Name:</strong> {{ selectedPatient.last_name }}, {{ selectedPatient.first_name }} {{ selectedPatient.middle_name }}</p>
                                            <p><strong>Birthdate:</strong> {{ selectedPatient.birthdate }}</p>
                                            <p><strong>Age:</strong> {{ selectedPatient.age }}</p>
                                            <p><strong>Sex:</strong> {{ selectedPatient.sex }}</p>
                                            <p><strong>Status:</strong> {{ selectedPatient.civil_status }}</p>
                                            <p><strong>Contact:</strong> {{ selectedPatient.contact_no }}</p>
                                        </div>
                                    </div>
                                    <div class="ml-auto" >
                                        <v-btn
                                            color="success"
                                            size="small"
                                            class="text-capitalize"
                                            @click="openEditPatientDialog(selectedPatient)">
                                            <i class="fa fa-user-edit"></i> Edit
                                        </v-btn>
                                    </div>

                                </div>
                                <div v-else>
                                    <img 
                                        src="/web_images/loader.png" 
                                        alt="Patient Image" 
                                        class=""
                                        height="170"
                                    />
                                </div>
                                <div class="px-2 py-2 bg-indigo text-white font-weight-bold text-sm rounded-t-md mt-5">
                                    Procedure Info
                                </div>

                                <div class="p-4 flex flex-wrap gap-2">
                                    <v-btn
                                        v-for="test in test_groups"
                                        :key="test.id"
                                        @click="toggleTest(test)"
                                        :variant="selectedTests.some(t => t.id === test.id) ? 'flat' : 'outlined'"
                                        color="indigo"
                                        class="text-sm text-capitalize mt-1 ml-1"
                                        :title="test.description"
                                    >
                                    <i class="fas fa-flask mr-2"></i> {{ test.name }}
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

        <v-dialog
            v-model="newPatientDialog"
            persistent
            class="dialog-top"
            max-width="50%"
            height="70%"
        >
            <v-card>
                <v-card-title>
                    <span class="headline">{{ isEdit ? 'Edit' : 'New' }} Patient</span>
                </v-card-title>
                <v-card-text>
                    <v-form ref="unitForm" v-model="valid">
                        <v-row>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    v-model="newPatients.first_name"
                                    label="First Name"
                                    variant="outlined"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    v-model="newPatients.middle_name"
                                    label="Middle Name"
                                    variant="outlined"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    v-model="newPatients.last_name"
                                    label="Last Name"
                                    variant="outlined"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    v-model="newPatients.birthdate"
                                    label="Birthdate"
                                    variant="outlined"
                                    type="date"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-select
                                    v-model="newPatients.sex"
                                    label="Gender"
                                    variant="outlined"
                                    item-title="gender"
                                    item-value="abbr"
                                    :items="genders"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-select
                                    v-model="newPatients.civil_status"
                                    label="Civil Status"
                                    variant="outlined"
                                    item-title="civil_status"
                                    item-value="abbr"
                                    :items="civil_statuses"
                                ></v-select>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="6">
                                <v-select
                                    v-model="newPatients.religion"
                                    label="Religion"
                                    variant="outlined"
                                    item-title="religion"
                                    item-value="abbr"
                                    :items="religions"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field
                                    v-model="newPatients.contact_no"
                                    label="Contact No"
                                    variant="outlined"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="12">
                                <v-text-field
                                    v-model="newPatients.address"
                                    label="Patient Address"
                                    variant="outlined"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-btn
                        color="primary"
                        class="text-capitalize"
                        variant="tonal"
                        size="small"
                        @click="cancelnewPatient"
                    >
                        <i class="fa fa-cancel"></i> Cancel
                    </v-btn>
                    
                    <v-btn
                        color="success"
                        class="text-capitalize"
                        variant="tonal"
                        size="small"
                        @click="savePatient"
                    >
                        <i class="fa fa-save"></i> Save
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
        selectedTests,
        toggleTest,
        saveTestOrder,
        test_groups,
        newPatient,
        newPatients,
        newPatientDialog,
        valid,
        savePatient,
        cancelnewPatient,
        openEditPatientDialog,
        isEdit
    } = useNewTestOrder();

    const genders = [
        { gender: 'Male', abbr: 'M' },
        { gender: 'Female', abbr: 'F' },
    ]

    const civil_statuses = [
        { civil_status: 'None', abbr: 'None' },
        { civil_status: 'Single', abbr: 'Single' },
        { civil_status: 'Married', abbr: 'Married' },
        { civil_status: 'Widowed', abbr: 'Widowed' },
    ]

    const religions = [
        { religion: 'None', abbr: 'None' },
        { religion: 'Roman Catholic', abbr: 'RC' },
        { religion: 'Born Again', abbr: 'BAC' },
        { religion: 'Iglesia ni Kristo', abbr: 'INC' },
        { religion: 'Muslim', abbr: 'Muslim' },
    ]

    const testOrders = ref([
        {
            patientName: 'John Doe',
            receiving: 'Received',
            grossing: 'Done',
            initialRead: 'In Progress',
            finalRead: '',
            validation: ''
        },
        {
            patientName: 'Jane Smith',
            receiving: '',
            grossing: '',
            initialRead: '',
            finalRead: '',
            validation: ''
        }
    ])

    const phaseDialog = ref({
        visible: false,
        phase: '',
        order: null
    })

    function openPhaseDialog(phase, order) {
        phaseDialog.value.phase = phase
        phaseDialog.value.order = order
        phaseDialog.value.visible = true
    }

    function savePhaseAction() {
        // Add your save logic here
        console.log('Saving phase action for:', phaseDialog.value)
        phaseDialog.value.visible = false
    }

    function capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1)
    }
</script>
            
<style scoped>
    .v-list-item {
        transition: background 0.2s ease;
    }
    .v-list-item:hover {
        background-color: #e3f2fd !important;
    }
</style>