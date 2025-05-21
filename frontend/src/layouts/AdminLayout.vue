<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" theme="">
      <v-list>
        <v-list-item class="text-center">
          <img :src="imageSrc" alt="Example Image" height="60"/>
        </v-list-item>
        <v-list-item title="" link href="/admin">
          <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </v-list-item>

        <!-- Tests -->
        <v-list-group v-model="expandedGroup" value="tests">
          <template v-slot:activator="{ props }">
            <v-list-item title="" v-bind="props">
              <i class="fa-solid fa-flask me-2"></i> Tests
            </v-list-item>
          </template>
          <v-list-item title="" to="/admin/products">
            <i class="fas fa-vial me-2"></i> Test Groups
          </v-list-item>
          <v-list-item title="" to="/admin/units">
            <i class="fas fa-microscope me-2"></i> Test Codes
          </v-list-item>
        </v-list-group>


        <!-- System Settings -->
        <v-list-group v-model="expandedGroup" value="users">
          <template v-slot:activator="{ props }">
            <v-list-item title="" v-bind="props">
              <i class="fas fa-cogs me-2"></i> System Settings
            </v-list-item>
          </template>
          <v-list-item title="" to="/admin/users">
            <i class="fas fa-users-cog me-2"></i> Accounts
          </v-list-item>
          <v-list-item title="" to="/admin/roles">
            <i class="fas fa-users me-2"></i> Roles
          </v-list-item>
          <v-list-item title="" to="/admin/configurations">
            <i class="fas fa-sliders-h me-2"></i> Configurations
          </v-list-item>
        </v-list-group>


        <!-- Reports / Analytics -->
        <v-list-group v-model="expandedGroup" value="analytics">
          <template v-slot:activator="{ props }">
            <v-list-item title="" v-bind="props">
              <i class="fa fa-chart-pie me-2" style="color: #171717;"></i> Analytics
            </v-list-item>
          </template>

          <v-list-item title="" to="/admin/general_report">
            <i class="fas fa-chart-bar me-2"></i> General Reports
          </v-list-item>
        </v-list-group>
        <v-list-item title="" to="/admin/audit_logs">
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
        <i class="fas fa-user me-2" style="font-size: 16px;"></i>
        Welcome, <b>Admin!</b>
      </v-app-bar-title>
      <div v-if="userRole == 0">
        <!-- <SelectPage /> -->
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
