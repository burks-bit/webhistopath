<template>
    <td class="text-center" colspan="5">
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
    </td>

    <!-- Phase Dialog -->
    <v-dialog v-model="phaseDialog.visible" max-width="500">
        <v-card>
            <v-card-title class="text-h6">
            {{ capitalize(phaseDialog.phase) }} - {{ phaseDialog.specimen_id }}
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
</template>

<script setup>
import { usePhases } from '@/composables/usePhases'
import { computed } from 'vue'

const props = defineProps({
    order: Object
})

const { userPhases } = usePhases()

const phaseMap = {
    "Create Order": {
        icon: 'fa-plus-square',
        color: 'primary',
        label: 'Create Order'
    },
    "Receiving": {
        icon: 'fa-truck-arrow-right',
        color: 'info',
        label: 'Receiving'
    },
    "Histopath Receiving": {
        icon: 'fa-microscope',
        color: 'purple',
        label: 'Histopath Receiving'
    },
    "Specimen Processing": {
        icon: 'fa-vial',
        color: 'teal',
        label: 'Specimen Processing'
    },
    "Slide Release": {
        icon: 'fa-sliders-h',
        color: 'cyan',
        label: 'Slide Release'
    },
    "Grossing": {
        icon: 'fa-cut',
        color: 'orange',
        label: 'Grossing'
    },
    "Initial Read": {
        icon: 'fa-book-open',
        color: 'indigo',
        label: 'Initial Read'
    },
    "Final Read": {
        icon: 'fa-book-reader',
        color: 'deep-purple',
        label: 'Final Read'
    },
    "Validation": {
        icon: 'fa-check-circle',
        color: 'success',
        label: 'Validation'
    },
    "Releasing": {
        icon: 'fa-file-export',
        color: 'green',
        label: 'Releasing'
    }
}


const accessiblePhases = computed(() =>
    userPhases.value.filter(phase => phaseMap[phase.name]).map(phase => ({
      name: phase.name,
      ...phaseMap[phase.name]
    }))
)

const phaseDialog = ref({
    visible: false,
    phase: '',
    specimen_id: '',
    order: null,
})

const openPhaseDialog = (phaseName) => {
    phaseDialog.value.phase = phaseName
    phaseDialog.value.specimen_id = props.order.specimen_id
    phaseDialog.value.visible = true
    console.log(`Open ${phaseName} phase for order`, props.order.specimen_id)
}

function savePhaseAction() {
    console.log('Saving phase action for:', phaseDialog.value)
    phaseDialog.value.visible = false
}

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1)
}
</script>
