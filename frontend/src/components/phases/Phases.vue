<template>
    <!-- <td class="text-center" colspan="5">
        <div class="d-flex flex-wrap justify-center">
            <v-btn
                v-for="phase in accessiblePhases"
                :key="phase.name"
                size="x-small"
                :color="phase.color"
                class="ma-1"
                @click="openPhaseDialog(phase.name, order)"
            >
                <i class="fa me-1" :class="phase.icon"></i> {{ phase.label }}
            </v-btn>
        </div>
    </td> -->

    <td class="text-center" colspan="">
    <div class="d-flex flex-wrap justify-center">
        <template v-for="(phase, index) in accessiblePhases" :key="phase.name">
        <!-- Insert a full-width break after every 6 items -->
        <template v-if="index > 0 && index % 5 === 0">
            <div class="w-100"></div>
        </template>

        <v-btn
            size="x-small"
            :color="phase.color"
            class="ma-1"
            @click="openPhaseDialog(phase.name, order)"
        >
            <i class="fa me-1" :class="phase.icon"></i> {{ phase.label }}
        </v-btn>
        </template>
    </div>
    </td>


    <!-- Dynamically render the correct dialog -->
    <component
        :is="getPhaseComponent(phaseDialog.phase)"
        v-if="phaseDialog.visible"
        v-model:visible="phaseDialog.visible"
        :order="phaseDialog.order"
    />
</template>

<script setup>
import { ref, computed } from 'vue'
import { usePhases } from '@/composables/usePhases'

// Import phase dialog components
import ReceivingDialog from './ReceivingDialog.vue'
import HistopathReceivingDialog from './HistopathReceivingDialog.vue'
import SpecimenProcessingDialog from './SpecimenProcessingDialog.vue'
import SlideReleaseDialog from './SlideReleaseDialog.vue'
import GrossingDialog from './GrossingDialog.vue'
import InitialResultDialog from './InitialResultDialog.vue'
import InitialReadingDialog from './InitialReadingDialog.vue'
import FinalReadingDialog from './FinalReadingDialog.vue'
import ValidationDialog from './ValidationDialog.vue'
import ReleasingDialog from './ReleasingDialog.vue'

const props = defineProps({ order: Object })
const { userPhases } = usePhases()

const phaseMap = {
    "Receiving": {
        icon: 'fa-truck-arrow-right',
        color: 'blue',
        label: 'Receiving'
    },
    "Histopath Receiving": {
        icon: 'fa-vials',
        color: 'deep-purple',
        label: 'Histopath Receiving'
    },
    "Specimen Processing": {
        icon: 'fa-flask-vial',
        color: 'indigo',
        label: 'Specimen Processing'
    },
    "Slide Release": {
        icon: 'fa-sliders',
        color: 'cyan',
        label: 'Slide Release'
    },
    "Grossing": {
        icon: 'fa-drumstick-bite',
        color: 'orange',
        label: 'Histopath Grossing'
    },
    "Initial Result": {
        icon: 'fa-chart-line',
        color: 'green',
        label: 'Initial Result'
    },
    "Initial Read": {
        icon: 'fa-book-medical',
        color: 'lime',
        label: 'Initial Reading'
    },
    "Final Read": {
        icon: 'fa-file-medical',
        color: 'teal',
        label: 'Final Reading'
    },
    "Validation": {
        icon: 'fa-check-circle',
        color: 'success',
        label: 'Validation'
    },
    "Releasing": {
        icon: 'fa-paper-plane',
        color: 'primary',
        label: 'Releasing'
    }
}

const accessiblePhases = computed(() =>
  userPhases.value
    .filter(phase => phaseMap[phase.name])
    .map(phase => ({ name: phase.name, ...phaseMap[phase.name] }))
)

const phaseDialog = ref({
  visible: false,
  phase: '',
  order: null,
})

const phaseComponentMap = {
    "Receiving": ReceivingDialog,
    "Histopath Receiving": HistopathReceivingDialog,
    "Specimen Processing": SpecimenProcessingDialog,
    "Slide Release": SlideReleaseDialog,
    "Grossing": GrossingDialog,
    "Initial Result": InitialResultDialog,
    "Initial Read": InitialReadingDialog,
    "Final Read": FinalReadingDialog,
    "Validation": ValidationDialog,
    "Releasing": ReleasingDialog,
}

function getPhaseComponent(phaseName) {
  return phaseComponentMap[phaseName] || null
}

function openPhaseDialog(phaseName, order) {
  phaseDialog.value.phase = phaseName
  phaseDialog.value.order = order
  phaseDialog.value.visible = true
}
</script>
