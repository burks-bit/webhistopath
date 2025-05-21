<template>
  <v-container fluid>
    <v-row justify="center" class="mb-6">
      <v-col cols="12" md="8" class="text-center">
        <h2 class="text-h4 font-weight-bold mb-2">
          <i class="fas fa-vials me-2 text-primary"></i> Histopath Admin Dashboard
        </h2>
        <p class="text-subtitle-1 text-grey-darken-1">Manage procedures, phases, and system configurations</p>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" md="4" v-for="card in cards" :key="card.title">
        <v-card class="elevation-2">
          <v-card-title class="d-flex align-center">
            <i :class="`${card.icon} text-${card.color} me-3`" style="font-size: 20px;"></i>
            <span class="text-subtitle-1 font-weight-medium">{{ card.title }}</span>
          </v-card-title>
          <v-card-subtitle>{{ card.subtitle }}</v-card-subtitle>
          <v-card-actions>
            <v-btn :color="card.color" variant="flat" size="small">
              <i class="fas fa-eye me-2"></i> View
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
const cards = [
  {
    title: 'Procedure Management',
    subtitle: 'Define and update histopath procedures.',
    icon: 'fas fa-dna',
    color: 'indigo',
  },
  {
    title: 'Phase Configuration',
    subtitle: 'Customize procedural phases and flow.',
    icon: 'fas fa-project-diagram',
    color: 'deep-purple',
  },
  {
    title: 'System Settings',
    subtitle: 'Configure system-wide preferences.',
    icon: 'fas fa-cogs',
    color: 'cyan',
  },
  {
    title: 'User Access',
    subtitle: 'Control user roles and permissions.',
    icon: 'fas fa-user-lock',
    color: 'primary',
  },
  {
    title: 'Activity Logs',
    subtitle: 'Audit actions and monitor activity.',
    icon: 'fas fa-file-alt',
    color: 'orange',
  },
  {
    title: 'Data Backup',
    subtitle: 'Export and backup key datasets.',
    icon: 'fas fa-database',
    color: 'green',
  },
]
</script>

<style scoped>
.me-2 {
  margin-right: 0.5rem;
}
.me-3 {
  margin-right: 0.75rem;
}
</style>
