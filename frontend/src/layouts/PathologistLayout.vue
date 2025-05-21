<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" theme="">
      <v-list>
        <v-list-item class="text-center">
          <img :src="imageSrc" alt="Example Image" height="60"/>
        </v-list-item>
        <v-list-item title="" link href="/pathologist">
          <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </v-list-item>

        <!-- Test Orders -->
        <v-list-group v-model="expandedGroup" value="tests">
          <template v-slot:activator="{ props }">
            <v-list-item title="" v-bind="props">
              <i class="fas fa-vials me-2"></i> Test Orders
            </v-list-item>
          </template>
          <v-list-item title="" to="/pathologist/products">
            <i class="fas fa-tachometer-alt me-2"></i> Test Order Dashboard
          </v-list-item>
          <v-list-item title="" to="/pathologist/units">
            <i class="fas fa-check-circle me-2"></i> Released Test Orders
          </v-list-item>
          <v-list-item title="" to="/pathologist/categories">
            <i class="fas fa-search me-2"></i> Search Patient
          </v-list-item>
        </v-list-group>


        <!-- Reports / Analytics -->
        <v-list-group v-model="expandedGroup" value="analytics">
          <template v-slot:activator="{ props }">
            <v-list-item title="" v-bind="props">
              <i class="fa fa-chart-pie me-2" style="color: #171717;"></i> Analytics
            </v-list-item>
          </template>
          <v-list-item title="" to="/pathologist/general_report">
            <i class="fas fa-chart-bar me-2"></i> General Reports
          </v-list-item>
        </v-list-group>
        <v-list-item title="" to="/pathologist/audit_logs">
          <i class="fas fa-chart-line me-2"></i> Audit Logs
        </v-list-item>
        
      </v-list>

      <template v-slot:append>
        <div class="pa-2">
          <v-btn block @click="logout" color="red" :loading="loading">
            <i class="fa fa-sign-out"></i> Logout
          </v-btn>
        </div>
      </template>
    </v-navigation-drawer>

    <v-app-bar :elevation="1">
      <v-btn icon @click="drawer = !drawer">
        <i class="fas fa-bars"></i>
      </v-btn>

      <v-app-bar-title class="d-flex align-center" style="font-size: 14px;">
        <i class="fas fa-user-md me-2" style="font-size: 16px;"></i>
        Welcome, <b>Pathologist!</b>
      </v-app-bar-title>

      <div v-if="userRole == 0" class="ml-auto">
        <!-- Admin-specific content can go here -->
      </div>
    </v-app-bar>


    <v-main>
      <v-container fluid>
        <router-view />
      </v-container>
    </v-main>
  </v-app>
</template>

<script setup>
  import { useAuth } from '@/composables/useAuth';
  import imageSrc from '@/assets/webhistopath.png';
  const drawer = ref(null);
  const { logout, loading } = useAuth();
</script>
