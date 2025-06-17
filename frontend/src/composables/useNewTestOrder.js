import { ref, onMounted, watch } from 'vue';
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
    const testOrders = ref({})
    const currentPage = ref(1)
    const loading = ref(false)
    const selectedLocation = ref(null)
    const selectedPhysicians = ref([])


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
            const response = await axios.post(`${backendAPIURL.backendIP()}api/saveTestOrder`,{
                patient: selectedPatient.value,
                tests: selectedTests.value,
                location: selectedLocation.value,
                requesting_physician: selectedPhysicians.value
            }, { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }})
            console.log(response.data)
            if(response.data.success == true){
                testOrders.value = response.data.test_orders;
                Swal.fire('Success', 'test order saved successfully. test orders fetched!', 'success')
                clearSearch()
                closeNewTestOrderDialog()
                getTestOrders()
            }
        } catch (error) {
            console.error('Error saving test order:', error)
            Swal.fire('Error', 'Failed to save test order.', 'error')
        }
    }

    const getTestOrders = async (filter = {}) => {
        try {
            loading.value = true;
            console.log('=======filter========')
            console.log(filter)
            const params = {
                page: currentPage.value,
                filter_parameter: filter
            };
            const response = await axios.get(
                `${backendAPIURL.backendIP()}api/getTestOrders`,
                { params }
            );
            testOrders.value = response.data.test_orders;
            console.log(response.data)
        } catch (error) {
            console.error('Error fetching test order:', error);
            Swal.fire('Error', 'Failed to fetch test orders.', 'error');
        } finally {
            loading.value = false;
        }
    };

    watch(currentPage, () => {
        getTestOrders();
    });


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
                newPatientDialog.value = false;
                isEdit.value = false
                newPatients.value = {};
                newPatientDialog.value = false;
                getTestOrders()
            } else {
                await axios.post(`${backendAPIURL.backendIP()}api/savePatient`, 
                {patient_info: newPatients.value},
                { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }})
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

    const openEditPatientTestOrderDialog = (selectedPatient) => {
        isEdit.value = true
        newPatients.value = { ...selectedPatient }
        newPatientDialog.value = true
    }

    const locations = ref([])
    const getLocations = async () => {
        try {
            const response = await axios.get(`${backendAPIURL.backendIP()}api/getLocations`)
            locations.value = response.data.locations
            console.log('============== check get_locations return =============')
            console.log(response.data)
        } catch (error) {
            console.error('Failed to fetch user phases:', error)
        }
    }

    const physicians = ref([])
    const getPhysicians = async () => {
        try {
            const response = await axios.get(`${backendAPIURL.backendIP()}api/getPhysicians`)
            physicians.value = response.data.physicians
            console.log('============== check getPhysicians return =============')
            console.log(response.data)
        } catch (error) {
            console.error('Failed to fetch physicians:', error)
        }
    }

    onMounted(() => {
        getTestOrders()
    });

    getTestgroups()

    return {
        patients,
        newPatientDialog,
        newPatients,
        valid,
        newTestOrderDialog,
        searchQuery,
        isEdit,
        selectedPatient,
        selectedTests,
        test_groups,
        testOrders,
        currentPage,
        loading,
        locations,
        physicians,
        selectedLocation,
        selectedPhysicians,
        openNewTestOrder,
        closeNewTestOrderDialog,
        searchPatient,
        selectPatient,
        clearSearch,
        toggleTest,
        saveTestOrder,
        getTestgroups,
        newPatient,
        savePatient,
        cancelnewPatient,
        openEditPatientDialog,
        getTestOrders,
        openEditPatientTestOrderDialog,
        getLocations,
        getPhysicians,
    }
}