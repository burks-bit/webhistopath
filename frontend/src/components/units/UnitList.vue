<template>
  <v-row no-gutters>
    <v-col>
      <v-sheet class="pa-2 ma-2">
        <h4>Units</h4>
      </v-sheet>
    </v-col>
    <v-col class="text-right">
      <v-sheet class="pa-2 ma-2">
        <v-btn variant="tonal" color="blue" size="small" @click="openAddUnitDialog">
          <i class="fa-solid fa-square-plus"></i> New Unit
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
        label="Search Item"
        color="success"
        v-model="searchQuery"
        @input="searchUnits"
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
        <th class="text-left">Status</th>
        <th class="text-left">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="unit in units.data" :key="unit.id">
        <td>{{ unit.id }}</td>
        <td>{{ unit.name }}</td>
        <td>{{ unit.description }}</td>
        <td>{{ unit.status }}</td>
        <td>
          <router-link :to="'/admin/unit/edit/' + unit.id" class="bg-blue v-btn v-btn-lg py-1 px-2">
            <span class="mdi mdi-square-edit-outline"></span>Edit
          </router-link>
        </td>
      </tr>
    </tbody>
  </v-table>

  <v-dialog v-model="addUnitDialog" max-width="600px">
    <v-card>
      <v-card-title>
        <span class="headline">Add New Unit</span>
      </v-card-title>
      <v-card-text>
        <v-form ref="unitForm" v-model="valid">
          <v-text-field v-model="newUnits.name" label="Unit Name" required />
          <v-text-field v-model="newUnits.description" label="Description" />
          <v-switch 
            v-model="newUnits.status" 
            :label="newUnits.status === 1 ? 'Active' : 'Inactive'" 
            :true-value="1" 
            :false-value="0" 
            color="green" 
          />
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-btn text @click="closeAddUnitDialog">
          <i class="fa fa-cancel"></i> Cancel
        </v-btn>
        <v-btn color="primary" @click="saveUnit">
          <i class="fa fa-cancel"></i> Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
  import { useUnits } from '@/composables/useUnits';

  const {
    units,
    searchQuery,
    newUnits,
    valid,
    addUnitDialog,
    getUnits,
    searchUnits,
    openAddUnitDialog,
    closeAddUnitDialog,
    saveUnit
  } = useUnits();

  getUnits();
</script>
