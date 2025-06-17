<template>
  <v-dialog :model-value="visible" @update:model-value="emit('update:visible', $event)" max-width="80%">
    <v-card>
      <v-card-title class="text-h6">Receiving - {{ order.specimen_id }}</v-card-title>
      <v-card-text>
        <v-row>
          <!-- Patient Info -->
          <v-col>
            <div class="px-2 py-2 bg-indigo text-white font-weight-bold text-sm rounded-t-md mt-5">
              Patient Info
            </div>
            <div class="d-flex align-start gap-4 pt-5">
              <img :src="order.patient.sex === 'M' ? '/web_images/male.png' : '/web_images/female.png'"
                   alt="Patient Image" class="rounded-circle object-cover" width="150" height="150" />
              <div class="pl-8">
                <p><strong>Name:</strong> {{ order.patient.last_name }}, {{ order.patient.first_name }} {{ order.patient.middle_name }}</p>
                <p><strong>Birthdate:</strong> {{ order.patient.birthdate }}</p>
                <p><strong>Age:</strong> {{ order.patient.age }}</p>
                <p><strong>Sex:</strong> {{ order.patient.sex }}</p>
                <p><strong>Status:</strong> {{ order.patient.civil_status }}</p>
                <p><strong>Contact:</strong> {{ order.patient.contact_no }}</p>
              </div>
              <div class="pl-8 text-right justify-center">
                <v-btn
                  size="x-small"
                  variant="tonal"
                  color="info"
                  class="text-capitalize"
                  @click="openEditPatientDialog(order.patient)"
                >
                  <i class="fa fa-edit mr-1"></i> Edit Patient Info
                </v-btn>

              </div>
            </div>
          </v-col>

          <!-- Location & Physician Info -->
          <v-col>
            <div class="px-2 py-2 bg-indigo text-white font-weight-bold text-sm rounded-t-md mt-5">
              Location & Physician Info
            </div>
            <div class="d-flex align-start gap-4 pt-5">
              <div class="pl-8">
                <p><strong>Location:</strong>
                  <!-- {{ order.location.name }} -->
                </p>
                <p><strong>Patient Type:</strong>
                  <!-- {{ order.location.name }} -->
                </p>
                <p>
                  <strong>Requesting Physician(s):</strong>
                  <span v-for="(physicianRecord, index) in order.patient_order_physicians" :key="index">
                    <strong class="text-green">
                      {{ physicianRecord.physician.first_name }} {{ physicianRecord.physician.last_name }} {{ physicianRecord.physician.diplomat }}
                    </strong>
                    <span v-if="index < order.patient_order_physicians.length - 1"> | </span>
                  </span>
                </p>
                <v-btn
                  size="x-small"
                  variant="tonal"
                  color="info"
                  class="text-capitalize"
                >
                  <i class="fa fa-edit mr-1"></i> Edit Location
                </v-btn>
                <br>
                <v-btn
                  size="x-small"
                  variant="tonal"
                  color="info"
                  class="text-capitalize"
                >
                  <i class="fa fa-edit mr-1"></i> Edit Patient Type
                </v-btn>
                <br>
                <v-btn
                  size="x-small"
                  variant="tonal"
                  color="info"
                  class="text-capitalize"
                >
                  <i class="fa fa-edit mr-1"></i> Edit Requesting Physician
                </v-btn>
              </div>
            </div>
          </v-col>
        </v-row>

        <!-- Specimen Info -->
        <div class="px-2 py-2 bg-indigo text-white font-weight-bold text-sm rounded-t-md mt-5">
          Specimen Info
        </div>
        <div class="pt-2">
            <div v-for="(row, index) in specimenRows" :key="index" class="mb-2">
                <v-row>
                    <v-col cols="12" md="2">
                        <v-select
                            v-model="row.category_id"
                            :items="specimen_categories"
                            label="Specimen Category"
                            variant="outlined"
                            item-title="name"
                            item-value="id"
                        />
                    </v-col>

                    <v-col cols="12" md="1">
                        <v-text-field v-model="row.specimen_code" variant="outlined" label="Spec.clear Code" />
                    </v-col>

                    <v-col cols="12" md="2">
                      <v-select
                        v-model="row.specimen_type"
                        :items="specimenTypes"
                        label="Specimen Type"
                        variant="outlined"
                        :menu-props="{ maxHeight: '300px' }"
                        return-object={false}
                      />
                    </v-col>

                    <v-col cols="12" md="2">
                        <v-text-field v-model="row.anatomical_site" variant="outlined" label="Anatomical Site" />
                    </v-col>

                    <v-col cols="12" md="1">
                        <v-text-field v-model.number="row.container_count" variant="outlined" label="# Containers" type="number" />
                    </v-col>

                    <v-col cols="12" md="4">
                        <v-text-field v-model="row.test_requested" variant="outlined" label="Test Requested" />
                    </v-col>

                    <v-col cols="12" md="12">
                        <v-textarea v-model="row.notes" label="Specimen Notes" variant="outlined" rows="1" auto-grow />
                    </v-col>

                    <v-col cols="12" class="d-flex justify-end">
                        <v-btn v-if="index === 0" color="success" @click="addNewSpecimenRow" class="me-2">
                        <i class="fa fa-plus"></i>
                        </v-btn>
                        <v-btn v-if="index > 0" color="error" @click="specimenRows.splice(index, 1)">
                        <i class="fa fa-minus"></i>
                        </v-btn>
                    </v-col>
                </v-row>
            </div>
        </div>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn text @click="closeDialog"><i class="fa fa-cancel"></i> Cancel</v-btn>
        <v-btn color="primary" @click="saveReceiving"><i class="fa fa-save"></i> Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { ref } from 'vue'
import { useReceivingSpecimen } from '@/composables/useReceivingSpecimen'

const props = defineProps({
  visible: Boolean,
  order: Object,
})

const emit = defineEmits(['update:visible'])

function closeDialog() {
  emit('update:visible', false)
}

// From composable
const {
  receivedSpecimens,
  specimenRows,
  saveReceiving,
  getReceivedSpecimens
} = useReceivingSpecimen(props.order)

// Dropdown options
const specimen_categories = ref([
  { id: 1, name: 'Tissue' },
  { id: 2, name: 'Fluid' },
  { id: 3, name: 'Biopsy' },
  { id: 4, name: 'Cytology' },
])

const specimenTypes = ref([
  'Blood',
  'Urine',
  'Sputum',
  'Tissue',
  'Fluid',
  'Swab',
  'Cytology',
  'Other'
])

// Add new row
const addNewSpecimenRow = () => {
  specimenRows.value.push({
    category_id: null,
    specimen_code: '',
    specimen_type: '',
    anatomical_site: '',
    container_count: 1,
    test_requested: '',
    notes: '',
  })
}
</script>
