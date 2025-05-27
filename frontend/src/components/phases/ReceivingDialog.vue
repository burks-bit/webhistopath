<template>
    <v-dialog :model-value="visible" @update:model-value="emit('update:visible', $event)" max-width="80%">
        <v-card>
        <v-card-title class="text-h6">Receiving - {{ order.specimen_id }}</v-card-title>
        <v-card-text>
            <v-row>
                <v-col>
                    <div class="px-2 py-2 bg-indigo text-white font-weight-bold text-sm rounded-t-md mt-5">
                        Patient Info
                    </div>
                    <div class="d-flex align-start gap-4 pt-5">
                        <img 
                            :src="order.patient.sex === 'M' ? '/web_images/male.png' : '/web_images/female.png'" 
                            alt="Patient Image" 
                            class="rounded-circle object-cover"
                            width="150"
                            height="150"
                        />
                        <div class="pl-8">
                            <p><strong>Name:</strong> {{ order.patient.last_name }}, {{ order.patient.first_name }} {{ order.patient.middle_name }}</p>
                            <p><strong>Birthdate:</strong> {{ order.patient.birthdate }}</p>
                            <p><strong>Age:</strong> {{ order.patient.age }}</p>
                            <p><strong>Sex:</strong> {{ order.patient.sex }}</p>
                            <p><strong>Status:</strong> {{ order.patient.civil_status }}</p>
                            <p><strong>Contact:</strong> {{ order.patient.contact_no }}</p>
                        </div>
                    </div>
                </v-col>
                <v-col>
                    <div class="px-2 py-2 bg-indigo text-white font-weight-bold text-sm rounded-t-md mt-5">
                        Location & Physician Info
                    </div>
                    <div class="d-flex align-start gap-4 pt-5">
                        <div class="pl-8">
                            <p><strong>Location:</strong> {{ order.location.name }}</p>
                            <p><strong>Patient Type:</strong> {{ order.location.name }}</p>
                            <p><strong>Requesting Physician(s):
                                </strong> <span v-for="(physicianRecord, index) in order.patient_order_physicians" :key="index">
                                    <strong class="text-green">{{ physicianRecord.physician.first_name }} {{ physicianRecord.physician.last_name }} {{ physicianRecord.physician.diplomat }}</strong>
                                    <span v-if="index < order.patient_order_physicians.length - 1"> | </span>
                                </span>
                            </p>
                        </div>
                    </div>
                </v-col>
            </v-row>
            <div class="px-2 py-2 bg-indigo text-white font-weight-bold text-sm rounded-t-md mt-5">
                Specimen Info
            </div>
            
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn text @click="closeDialog"><i class="fa fa-cancel"></i> Cancel</v-btn>
            <v-btn color="primary" @click="save"><i class="fa fa-save"></i> Save</v-btn>
        </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script setup>
    const props = defineProps({
        visible: Boolean,
        order: Object,
    })
    const emit = defineEmits(['update:visible'])

    function closeDialog() {
        emit('update:visible', false)
    }

    function save() {
        console.log('Saving Receiving phase for:', props.order)
        emit('update:visible', false)
    }
</script>
