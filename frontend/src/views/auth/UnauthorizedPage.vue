<template>
  <v-container class="fill-height" fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" sm="8" md="6" class="text-center">
        <v-card class="pa-6" elevation="10">
          <v-card-title class="text-h4 text-red">
            <i class="fas fa-exclamation-triangle me-2" style="color: red;"></i>
            Unauthorized Access
          </v-card-title>

          <v-card-text class="text-body-1 mt-4">
            You do not have permission to view this page.
          </v-card-text>

          <v-card-actions class="justify-center mt-4">
            <v-btn color="primary" @click="$router.push('/')">
              Go to Home
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
// No script required
</script>
