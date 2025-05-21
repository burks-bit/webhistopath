<template>
  <v-row no-gutters>
    <v-col>
      <v-sheet class="pa-2 ma-2">
        <h4>Audit Logs</h4>
      </v-sheet>
    </v-col>
  </v-row>

  <v-row no-gutters>
    <v-col>
      <v-text-field
        density="compact"
        variant="outlined"
        style="width: 65%"
        label="Search log"
        color="success"
        v-model="searchQuery"
        @input="searchAudtiLogs"
        debounce="500"
      />
    </v-col>
  </v-row>

  <v-table density="compact">
    <thead>
      <tr>
        <th class="text-left">ID</th>
        <th class="text-left">Action Type</th>
        <th class="text-left">Action Description</th>
        <th class="text-left">Performed By</th>
        <!-- <th class="text-left">Actions</th> -->
      </tr>
    </thead>
    <tbody>
      <tr v-for="audit_log in audit_logs.data" :key="audit_log.id">
        <td>{{ audit_log.id }}</td>
        <td :class="getActionTypeClass(audit_log.action_type)">
            <strong>{{ audit_log.action_type }}</strong>
        </td>
        <td>{{ audit_log.action_description }}</td>
        <td>
            {{ audit_log.performed_by.name }} <small class="text-muted text-green">({{ audit_log.performed_by?.user_type }})</small>
        </td>
        <!-- <td>
          <router-link :to="'/admin/audit_log/edit/' + audit_log.id" class="bg-blue v-btn v-btn-lg py-1 px-2">
            <span class="mdi mdi-square-edit-outline"></span>Edit
          </router-link>
        </td> -->
      </tr>
    </tbody>
  </v-table>


</template>

<script setup>
  import { useAuditLogs } from '@/composables/useAuditLogs';

  const {
    audit_logs,
    searchQuery,
    getAuditLogs,
    searchAudtiLogs,
  } = useAuditLogs();

  getAuditLogs();

    const getActionTypeClass = (actionType) => {
        switch (actionType) {
            case 'CREATE':
            return 'text-green font-weight-bold'; // Vuetify class for green & bold
            case 'UPDATE':
            return 'text-orange font-weight-bold';
            case 'DELETE':
            return 'text-red font-weight-bold';
            default:
            return '';
        }
    };

</script>
