import { ref } from 'vue';
import axios from 'axios';
import APIConstants from '@/constants/ApiURL';

export function useAuditLogs() {
    const backendAPIURL = new APIConstants();
    const audit_logs = ref({ data: [] });
    const searchQuery = ref('');
    const valid = ref(false);


    const getAuditLogs = async () => {
        try {
            const response = await axios.get(`${backendAPIURL.backendIP()}api/getAuditLogs`);
            audit_logs.value = response.data.audit_logs;
        } catch (error) {
            console.error('Error fetching units:', error);
        }
    };

    const searchAudtiLogs = async () => {
        if (searchQuery.value.trim() === '') {
            await getAuditLogs();
            return;
        }
        try {
            const response = await axios.get(`${backendAPIURL.backendIP()}api/searchAuditLogs?item=${searchQuery.value}`);
            audit_logs.value = response.data.audit_logs
        } catch (error) {
            console.error('Error searching audit_logs:', error);
        }
    };

    return {
        audit_logs,
        searchQuery,
        valid,
        getAuditLogs,
        searchAudtiLogs,
    };
}
