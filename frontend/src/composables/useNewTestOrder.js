import { ref } from 'vue';
import axios from 'axios';
import APIConstants from '@/constants/ApiURL';

export function useNewTestOrder() {
    
    const backendAPIURL = new APIConstants();
    const searchQuery = ref('');
    const newTestOrderDialog = ref(false);
    const patients = ref({ data: [] });
    const selectedPatient = ref(null);
    const selectedTests = ref([]);

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

    const histopathologyTests = [
        'Biopsy - Breast',
        'Biopsy - Skin',
        'Biopsy - Cervix',
        'Biopsy - Prostate',
        'Biopsy - Colon',
        'Pap Smear',
        'Liver Tissue Exam',
        'Bone Marrow Aspiration'
    ];

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
    }

    const clearSearch = () => {
        searchQuery.value = "";
        patients.value = { data: [] };
        selectedPatient.value = null;
    };

    const saveTestOrder = () => {
        console.log(selectedPatient.value)
        console.log(selectedTests.value)
    }

    return {
        patients,
        openNewTestOrder,
        newTestOrderDialog,
        closeNewTestOrderDialog,
        searchQuery,
        searchPatient,
        selectPatient,
        selectedPatient,
        clearSearch,
        histopathologyTests,
        selectedTests,
        toggleTest,
        saveTestOrder
    }
}