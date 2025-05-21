import { ref, onMounted } from 'vue'
import axios from 'axios'
import APIConstants from '@/constants/ApiURL'
import Swal from 'sweetalert2'

const backendAPIURL = new APIConstants()

export function useConfigurations() {
    const configurations = ref({ data: [] })
    const searchQuery = ref('')
    const addConfigurationDialog = ref(false)
    const isEdit = ref(false)
    const valid = ref(false)

    const currentConfiguration = ref({
        id: '',
        name: '',
        description: '',
        value: 0,
        status: 0
    })

    const getConfigurations = async () => {
        try {
        const response = await axios.get(`${backendAPIURL.backendIP()}api/get_configurations`)
        console.log(response.data)
        configurations.value = response.data.configurations
        } catch (error) {
        console.error('Error fetching configurations:', error)
        }
    }

    const searchConfigurations = async () => {
        if (!searchQuery.value.trim()) return getConfigurations()
        try {
        const response = await axios.get(`${backendAPIURL.backendIP()}api/searchConfigurations?query=${searchQuery.value}`)
        configurations.value = { data: response.data.configurations }
        } catch (error) {
        console.error('Error searching configurations:', error)
        }
    }

    const openAddConfigurationDialog = () => {
        isEdit.value = false
        currentConfiguration.value = {
        id: '',
        name: '',
        description: '',
        value: 0,
        status: 0
        }
        addConfigurationDialog.value = true
    }

    const openEditConfigurationDialog = (config) => {
        isEdit.value = true
        currentConfiguration.value = { ...config }
        addConfigurationDialog.value = true
    }

    const closeAddConfigurationDialog = () => {
        addConfigurationDialog.value = false
    }

    const saveConfiguration = async () => {
        console.log(currentConfiguration.value)
        if (!valid.value) return
        try {
            if (isEdit.value) {
                await axios.put(`${backendAPIURL.backendIP()}api/updateConfiguration`, currentConfiguration.value)
                Swal.fire('Success', 'Configuration updated successfully.', 'success')
            } else {
                await axios.post(`${backendAPIURL.backendIP()}api/createConfiguration`, currentConfiguration.value)
                Swal.fire('Success', 'Configuration saved successfully.', 'success')
            }
            closeAddConfigurationDialog()
            await getConfigurations()
        } catch (error) {
            console.error('Error saving configuration:', error)
            Swal.fire('Error', 'Failed to save/update configuration.', 'error')
        }
    }

    const deleteConfig = async (configuration) => {
        const confirm = await Swal.fire({
            title: 'Are you sure?',
            text: `Delete configuration "${configuration.name}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        })

        if (confirm.isConfirmed) {
        try {
            await axios.post(`${backendAPIURL.backendIP()}api/deleteConfig`, { config_id: configuration.id })
            await getConfigurations()
            Swal.fire('Deleted!', 'Configuration has been deleted.', 'success')
        } catch (error) {
            console.error('Error deleting configuration:', error)
            Swal.fire('Error', 'Failed to delete configuration.', 'error')
        }
        }
    }

    onMounted(getConfigurations)

    return {
        configurations,
        searchQuery,
        addConfigurationDialog,
        currentConfiguration,
        isEdit,
        valid,
        getConfigurations,
        searchConfigurations,
        openAddConfigurationDialog,
        openEditConfigurationDialog,
        closeAddConfigurationDialog,
        saveConfiguration,
        deleteConfig
    }
}
