<template>
    <v-container class="fill-height">
        <v-responsive class="align-center text-center fill-height">
            <v-row justify="center">
                <v-col cols="12" sm="8" md="4">
                        <v-img height="120" src="@/assets/webhistopath.png" />
                        <div class="mt-4" />
                    <v-sheet width="" class="mx-auto">
                        <v-card elevation="14">
                            <!-- <v-card-title class="headline grey lighten-2">
                                Login
                            </v-card-title> -->
                            <v-card-text>
                            <v-form @submit.prevent="handleSubmit">
                                <v-text-field
                                    v-model="email"
                                    :counter="10"
                                    label="Username / Email"
                                    required
                                    hide-details
                                    class="mt-2" color=""
                                    :autofocus="true"
                                ></v-text-field>
                                <v-text-field
                                    v-model="password"
                                    label="Password"
                                    hide-details
                                    required
                                    type="password"
                                    class="mt-4" color=""
                                ></v-text-field>
                                <v-btn type="submit" class="mt-6" block color="success" size="large" :loading="loading">
                                    Login <i class="fa-solid fa-right-to-bracket"></i></v-btn>
                            </v-form>
                            </v-card-text>
                        </v-card>
                        <div v-if="branchData" class="py-5">
                            <ul>
                                <li class="text-green" v-for="branch in branchData" :key="branch.id" style="list-style: none;font-weight: bold;">{{ branch.name }}</li>
                                <li class="text-grey" v-for="branch in branchData" :key="branch.id" style="list-style: none;">{{ branch.address }} - Branch</li>
                            </ul>
                        </div>
                        <div class="px-7 m-10 px-10 text-grey">
                            <b>DEV BERT &copy;</b> {{ getCurrentYear }}
                        </div>
                        <br />
                    </v-sheet>
                    
                </v-col>
            </v-row>
        </v-responsive>
    </v-container>
  </template>

  <script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuth } from '@/composables/useAuth';
import axios from 'axios';
import APIConstants from '@/constants/ApiURL';

const { login, loading } = useAuth();
const email = ref('');
const password = ref('');

const backendAPIURL = new APIConstants();
const branchData = ref(null);

const getBranch = async () => {
  try {
    const response = await axios.get(backendAPIURL.backendIP() + 'api/getBranch');
    console.log(response.data)
    branchData.value = response.data.branch;
  } catch (error) {
    console.error('Problem with API', error);
  }
};
getBranch();

const getCurrentYear = new Date().getFullYear();

const handleSubmit = async () => {
  await login({ email: email.value, password: password.value });
};
</script>
