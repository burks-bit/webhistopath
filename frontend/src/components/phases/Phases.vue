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

const props = defineProps({ order: Object })
const { userPhases } = usePhases()

const phaseMap = {
  "Receiving": { icon: 'fa-truck-arrow-right', color: 'info', label: 'Receiving' },
  "Histopath Receiving": { icon: 'fa-microscope', color: 'purple', label: 'Histopath Receiving' },
  "Specimen Processing": { icon: 'fa-microscope', color: 'purple', label: 'Specimen Processing' },
  "Slide Release": { icon: 'fa-microscope', color: 'purple', label: 'Slide Release' },
  "Grossing": { icon: 'fa-microscope', color: 'purple', label: 'Histopath Grossing' },
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
  // Add more mappings...
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
