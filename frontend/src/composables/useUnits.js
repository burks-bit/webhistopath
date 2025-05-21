import { ref } from 'vue';
import axios from 'axios';
import APIConstants from '@/constants/ApiURL';

export function useUnits() {
    const backendAPIURL = new APIConstants();
    const units = ref({ data: [] });
    const searchQuery = ref('');
    const valid = ref(false);
    const addUnitDialog = ref(false);

    const newUnits = ref({
        name: '',
        description: '',
        status: ''
    });

    const getUnits = async () => {
        try {
        const response = await axios.get(`${backendAPIURL.backendIP()}api/getUnits`);
        units.value = response.data.units;
        } catch (error) {
        console.error('Error fetching units:', error);
        }
    };

    const searchUnits = async () => {
        if (searchQuery.value.trim() === '') {
        await getUnits();
        return;
        }
        try {
        const response = await axios.get(`${backendAPIURL.backendIP()}api/searchProduct?item=${searchQuery.value}`);
        units.value = { data: response.data.items };
        } catch (error) {
        console.error('Error searching units:', error);
        }
    };

    const openAddUnitDialog = () => {
        addUnitDialog.value = true;
    };

    const closeAddUnitDialog = () => {
        addUnitDialog.value = false;
        newUnits.value = '';
    };

    const saveUnit = async () => {
        console.log(newUnits)
        if (valid.value) {
        try {
            const response = await axios.post(`${backendAPIURL.backendIP()}api/createUnit`, newUnits.value);
            console.log(response.data);
            await getUnits();
            closeAddUnitDialog();
        } catch (error) {
            console.error('Error saving product:', error);
        }
        }
    };

    return {
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
    };
}
