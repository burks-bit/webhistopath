import { ref } from 'vue';
import axios from 'axios';
import APIConstants from '@/constants/ApiURL';
import Swal from 'sweetalert2'

export function useNewTestOrder() {
    
    const backendAPIURL = new APIConstants();
    const searchQuery = ref('');
    const newTestOrderDialog = ref(false);
    const patients = ref({ data: [] });
    const test_groups = ref({ data: [] });
    const selectedPatient = ref(null);
    const selectedTests = ref([]);
    const newPatientDialog = ref(false);
    const valid = ref(false);
    const isEdit = ref(false);

    const newPatients = ref({
        first_name: '',
        middle_name: '',
        last_name: '',
        birthdate: '',
        sex: '',
        civil_status: '',
        religion: '',
        contact_no: '',
        address: '',
    });

    const searchPatient = async () => {
        if (searchQuery.value.trim() === '') {
            clearSearch();
            return;
        }
        try {
            const response = await axios.get(`${backendAPIURL.backendIP()}api/searchPatient?patient=${searchQuery.value}`);
            console.log(response.data)
            patients.value = response.data.patients;
        } catch (error) {
            console.error('Error searching units:', error);
        }
    };

    const getTestgroups = async () => {
        try {
            const response = await axios.get(`${backendAPIURL.backendIP()}api/getTestgroups`);
            test_groups.value = response.data.test_groups;
        } catch (error) {
            console.error('Error fetching units:', error);
        }
    };

    const toggleTest = (test) => {
        const index = selectedTests.value.indexOf(test);
        if (index > -1) {
            selectedTests.value.splice(index, 1);
        } else {
            selectedTests.value.push(test);
        }
    };
    // const toggleTest = (test) => {
    //     const index = selectedTests.findIndex(t => t.id === test.id);
    //     if (index > -1) {
    //         selectedTests.splice(index, 1);
    //     } else {
    //         selectedTests.push(test);
    //     }
    // };


    const selectPatient = (patient) => {
        selectedPatient.value = patient;
    };

    const openNewTestOrder = () => {
        newTestOrderDialog.value = true;
    }

    const closeNewTestOrderDialog = () => {
        newTestOrderDialog.value = false;
        searchQuery.value = ''
        patients.value = { data: [] };
        selectedPatient.value = '';
        selectedTests.value = [];
        newPatients.value = {};
    }

    const clearSearch = () => {
        searchQuery.value = "";
        patients.value = { data: [] };
        selectedPatient.value = null;
    };

    const saveTestOrder = async () => {
        
        console.log(selectedPatient.value)
        console.log(selectedTests.value)

        try {
            await axios.post(`${backendAPIURL.backendIP()}api/saveTestOrder`,{
                patient: selectedPatient.value,
                tests: selectedTests.value
            })
            Swal.fire('Success', 'test order saved successfully.', 'success')

            // clearSearch()
            // closeNewTestOrderDialog()
        } catch (error) {
            console.error('Error saving test order:', error)
            Swal.fire('Error', 'Failed to save test order.', 'error')
        }
    }

    const newPatient = () => {
        isEdit.value = false;
        newPatientDialog.value = true;
        newTestOrderDialog.value = false
    }

    const cancelnewPatient = () => {
        newPatientDialog.value = false;
        newTestOrderDialog.value = true
    }

    const savePatient = async () => {
        console.log(valid.value)
        console.log(newPatients.value)
        if (!valid.value) return
        try {
            if (isEdit.value) {
                await axios.put(`${backendAPIURL.backendIP()}api/updatePatient`, newPatients.value)
                //   Swal.fire('Success', 'patient details updated successfully.', 'success')
                // alert('patient details updated successfully')
                // clearSearch()
                // newPatients.value = {};
                // newPatientDialog.value = false;
                // isEdit.value = false
            } else {
                await axios.post(`${backendAPIURL.backendIP()}api/savePatient`, newPatients.value)
                // alert('patient details saved successfully')
                // clearSearch()
                newPatients.value = {};
                newPatientDialog.value = false;
                newTestOrderDialog.value = true
                //Swal.fire('Success', 'Configuration saved successfully.', 'success')
            }
            
        } catch (error) {
            console.error('Error saving patient:', error)
            Swal.fire('Error', 'Failed to save patient.', 'error')
        }
    }

    const openEditPatientDialog = (selectedPatient) => {
        isEdit.value = true
        newPatients.value = { ...selectedPatient }
        newPatientDialog.value = true
    }

    getTestgroups()

    return {
        patients,
        openNewTestOrder,
        newTestOrderDialog,
        closeNewTestOrderDialog,
        searchQuery,
        isEdit,
        searchPatient,
        selectPatient,
        selectedPatient,
        clearSearch,
        selectedTests,
        toggleTest,
        saveTestOrder,
        getTestgroups,
        test_groups,
        newPatient,
        newPatientDialog,
        newPatients,
        valid,
        savePatient,
        cancelnewPatient,
        openEditPatientDialog
    }
}