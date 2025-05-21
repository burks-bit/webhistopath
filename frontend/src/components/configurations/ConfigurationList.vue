<template>
  <v-row no-gutters>
    <v-col>
      <v-sheet class="pa-2 ma-2">
        <h4>Configurations</h4>
      </v-sheet>
    </v-col>
    <v-col class="text-right">
      <v-sheet class="pa-2 ma-2">
        <v-btn variant="tonal" color="blue" size="small" @click="openAddConfigurationDialog">
          <i class="fa-solid fa-square-plus"></i> New Configuration
        </v-btn>
      </v-sheet>
    </v-col>
  </v-row>

  <v-row no-gutters>
    <v-col>
      <v-text-field
        density="compact"
        variant="outlined"
        style="width: 65%"
        label="Search Configuration"
        color="success"
        v-model="searchQuery"
        @input="searchConfigurations"
        debounce="500"
      />
    </v-col>
  </v-row>

  <v-table density="compact">
    <thead>
      <tr>
        <th class="text-left">ID</th>
        <th class="text-left">Name</th>
        <th class="text-left">Description</th>
        <th class="text-left">value</th>
        <th class="text-left">Status</th>
        <th class="text-left">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="configuration in configurations.data" :key="configuration.id">
        <td>{{ configuration.id }}</td>
        <td>{{ configuration.name }}</td>
        <td>{{ configuration.description }}</td>
        <td>{{ configuration.value }}</td>
        <td>
            <div v-if ="configuration.status === 1">
                On
            </div>
            <div v-else>
                Off
            </div>
        </td>
        <td>
          <v-btn color="blue" @click="openEditConfigurationDialog(configuration)" size="small">
            <i class="fa fa-edit"></i> Edit
          </v-btn>
          &nbsp;
          <v-btn color="red" @click="deleteConfig(configuration)" size="small">
            <i class="fa fa-trash"></i> Delete
          </v-btn>
        </td>
      </tr>
    </tbody>
  </v-table>

  <!-- Add/Edit Configuration Dialog -->
  <v-dialog v-model="addConfigurationDialog" max-width="600px">
    <v-card>
      <v-card-title>
        <span class="headline">{{ isEdit ? 'Edit' : 'Add New' }} Configuration</span>
      </v-card-title>
      <v-card-text>
        <v-form ref="configurationForm" v-model="valid">
          <v-text-field v-model="currentConfiguration.name" label="Configuration Name" required />
          <v-text-field v-model="currentConfiguration.description" label="Description" />
          <v-text-field v-model="currentConfiguration.value" label="Value" type="number" required />
          <v-switch 
            v-model="currentConfiguration.status" 
            :label="currentConfiguration.status === 1 ? 'Active' : 'Inactive'" 
            :true-value="1" 
            :false-value="0" 
            color="green" 
          />
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-btn text @click="closeAddConfigurationDialog">
          <i class="fa fa-cancel"></i> Cancel
        </v-btn>
        <v-btn color="primary" @click="saveConfiguration">
          <i class="fa fa-save"></i> {{ isEdit ? 'Update' : 'Save' }}
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
  import { useConfigurations } from '@/composables/useConfigurations'

  const {
    configurations,
    searchQuery,
    addConfigurationDialog,
    currentConfiguration,
    isEdit,
    valid,
    searchConfigurations,
    openAddConfigurationDialog,
    openEditConfigurationDialog,
    closeAddConfigurationDialog,
    saveConfiguration,
    deleteConfig
  } = useConfigurations()
</script>
