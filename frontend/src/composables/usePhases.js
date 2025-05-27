import { ref, onMounted } from 'vue';
import axios from 'axios';
import APIConstants from '@/constants/ApiURL';
import Swal from 'sweetalert2'

export function usePhases() {
  const backendAPIURL = new APIConstants()
  const userPhases = ref([])
  const fetchUserPhases = async () => {
    try {
        
        const userId = localStorage.getItem('user_id')
        console.log('========== usePhases =========')
        console.log(userId)
        const { data } = await axios.get(`${backendAPIURL.backendIP()}api/user/phases`, {
            params: {
                loggedin_user_id: userId
            }
        })
      userPhases.value = data
      console.log('============== check access return =============')
      console.log(data)
    } catch (error) {
      console.error('Failed to fetch user phases:', error)
    }
  }

  onMounted(fetchUserPhases)

  return {
    userPhases,
    fetchUserPhases
  }
}