<template>
  <v-container fluid>
    <v-row justify="center" class="mb-6">
      <v-col cols="12" md="8" class="text-center">
        <h2 class="text-h4 font-weight-bold mb-2">
          <i class="fas fa-user-md me-2 text-primary"></i> Pathologist Dashboard
        </h2>
        <p class="text-subtitle-1 text-grey-darken-1">Manage and finalize case reports, slides, and examination details</p>
      </v-col>
    </v-row>

    <v-row>
      <v-col
        v-for="(card, i) in cards"
        :key="i"
        cols="12"
        sm="6"
        md="4"
      >
        <v-card class="mx-auto" color="#f9f9f9" elevation="2">
          <v-card-title class="d-flex align-center">
            <i :class="`${card.icon} text-primary me-3`" style="font-size: 1.4rem;"></i>
            <span class="text-h6 font-weight-medium">{{ card.title }}</span>
          </v-card-title>

          <v-card-subtitle class="mb-4 px-4">
            {{ card.subtitle }}
          </v-card-subtitle>

          <v-card-actions>
            <v-btn
              variant="tonal"
              color="success"
              size="small"
              @click="card.action()"
            >
              <i class="fas fa-eye me-2"></i> View
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref } from 'vue'
import Swal from 'sweetalert2'

const cards = ref([
  {
    title: 'Assigned Cases',
    subtitle: 'Review pathology cases assigned to you.',
    icon: 'fas fa-briefcase-medical',
    action: () => Swal.fire('Navigating to Assigned Cases'),
  },
  {
    title: 'Gross Examination',
    subtitle: 'Enter or edit gross examination observations.',
    icon: 'fas fa-file-medical',
    action: () => Swal.fire('Navigating to Gross Examination'),
  },
  {
    title: 'Slide & Block Entry',
    subtitle: 'Add slides or blocks and label them.',
    icon: 'fas fa-th-large',
    action: () => Swal.fire('Navigating to Slide & Block Entry'),
  },
  {
    title: 'Microscopic Review',
    subtitle: 'Input microscopic findings and impressions.',
    icon: 'fas fa-eye',
    action: () => Swal.fire('Navigating to Microscopic Review'),
  },
  {
    title: 'Validation & Release',
    subtitle: 'Approve and finalize pathology reports.',
    icon: 'fas fa-check-double',
    action: () => Swal.fire('Navigating to Validation & Release'),
  },
  {
    title: 'Archived Reports',
    subtitle: 'Access previously signed-out cases.',
    icon: 'fas fa-archive',
    action: () => Swal.fire('Navigating to Archived Reports'),
  },
])
</script>

<style scoped>
.me-2 {
  margin-right: 0.5rem;
}
.me-3 {
  margin-right: 0.75rem;
}
</style>
