import { ref, onMounted, watch } from 'vue';
import axios from 'axios';
import APIConstants from '@/constants/ApiURL';
import Swal from 'sweetalert2'

export function useReceivingSpecimen(order_details) {

    const backendAPIURL = new APIConstants();
    const specimenRows = ref([
        {
            category_id: null,
            specimen_code: '',
            specimen_type: '',
            anatomical_site: '',
            container_count: 1,
            test_requested: '',
            notes: '',
        },
    ])

    const receivedSpecimens = ref([]);
    const getReceivedSpecimens = async () => {
        try {
            const response = await axios.get(`${backendAPIURL.backendIP()}api/getReceivedSpecimens`, 
        { params: { specimen_id: order_details.specimen_id } },
        { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }})
            console.log(response.data)
        } catch (error) {
            console.error('Error fetching specimens:', error)
        }
    }

    const saveReceiving = async () => {
        console.log('Saving Receiving phase...')
        console.log(specimenRows.value)

        try {
            const response = await axios.post(`${backendAPIURL.backendIP()}api/receiveSpecimen`,{
                patient_order_specimen_id: order_details.specimen_id,
                patient_order_location_id: order_details.location_id,
                specimen_details: specimenRows.value,
            }, { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }})
            console.log(response.data)
            if(response.data.success == true){
                // testOrders.value = response.data.test_orders;
                Swal.fire({
                    icon: 'success',
                    title: 'Saved',
                    text: 'Receiving details saved successfully!',
                })
            }
        } catch (error) {
            console.error('Error saving specimens:', error)
            Swal.fire('Error', 'Failed to save receiving.', 'error')
        }
    }

    onMounted(() => {
        getReceivedSpecimens()
    });

    return {
        receivedSpecimens,
        specimenRows,
        saveReceiving,
        getReceivedSpecimens,
    }
}