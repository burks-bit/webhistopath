<template>
  <v-container fluid>
    <v-row justify="center" class="mb-6">
      <v-col cols="12" md="8" class="text-center">
        <h2 class="text-h4 font-weight-bold mb-2">
          <i class="fas fa-microscope me-2 text-primary"></i> Histotech Dashboard
        </h2>
        <p class="text-subtitle-1 text-grey-darken-1">Monitor and manage incoming specimens and lab workflow</p>
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
    title: 'Incoming Specimens',
    subtitle: 'Log and track received specimens for processing.',
    icon: 'fas fa-vial',
    action: () => Swal.fire('Navigating to Incoming Specimens'),
  },
  {
    title: 'Embedding & Sectioning',
    subtitle: 'Manage tissue embedding and sectioning workflows.',
    icon: 'fas fa-cut',
    action: () => Swal.fire('Navigating to Embedding & Sectioning'),
  },
  {
    title: 'Staining Queue',
    subtitle: 'View and process specimens awaiting staining.',
    icon: 'fas fa-paint-brush',
    action: () => Swal.fire('Navigating to Staining Queue'),
  },
  {
    title: 'Slide Review',
    subtitle: 'Mark slides for review and quality control.',
    icon: 'fas fa-microscope',
    action: () => Swal.fire('Navigating to Slide Review'),
  },
  {
    title: 'Specimen Storage',
    subtitle: 'Manage archived specimens and block storage.',
    icon: 'fas fa-warehouse',
    action: () => Swal.fire('Navigating to Specimen Storage'),
  },
  {
    title: 'Lab Reports',
    subtitle: 'Generate and print histology workflow reports.',
    icon: 'fas fa-file-medical-alt',
    action: () => Swal.fire('Navigating to Lab Reports'),
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
