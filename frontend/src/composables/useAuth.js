import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import Swal from 'sweetalert2';
import APIConstants from '@/constants/ApiURL';

export function useAuth() {
  const loading = ref(false);
  const router = useRouter();

  const showAlert = (title, icon, html, timer = 2000, callback = null) => {
    let timerInterval;
    Swal.fire({
      title,
      icon,
      html,
      timer,
      didOpen: () => {
        timerInterval = setInterval(() => {}, 50);
      },
      willClose: () => {
        clearInterval(timerInterval);
        if (callback) callback();
      },
    });
  };

  const login = async ({ email, password }) => {
    console.log('login triggered')
    if (!email || !password) {
      showAlert('Validation Error', 'warning', 'Both fields are required.');
      return false;
    }

    loading.value = true;
    try {
      const response = await axios.post(
        new APIConstants().backendIP() + 'api/login',
        { email, password }
      );

      if (response.data.status === '401') {
        showAlert('Warning!', 'warning', response.data.message);
        return false;
      }

      localStorage.setItem('token', response.data.token);
      localStorage.setItem('userRole', response.data.role);
      localStorage.setItem('user_id', response.data.user_id);
      localStorage.setItem('token_expiry', response.data.expires_at);

      const roleRoutes = {
        0: { message: 'Welcome, Admin!', route: 'AdminHome' },
        1: { message: 'Welcome, Histotech!', route: 'HistotechHome' },
        2: { message: 'Welcome, Pathologist!', route: 'PathologistHome' },
      };

      const { message, route } = roleRoutes[response.data.role] || {};
      showAlert('Success!', 'success', message, 2000, () => {
        router.push({ name: route });
      });

      return true;
    } catch (error) {
      console.error('Login failed', error.response?.data || error);
      showAlert('Error', 'error', 'Login request failed.');
      return false;
    } finally {
      loading.value = false;
    }
  };

  const logout = async () => {
    loading.value = true;
    try {
      await axios.post(
        new APIConstants().backendIP() + 'api/logout',
        null,
        {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        }
      );
    } catch (error) {
      console.error('Logout failed', error);
    } finally {
      localStorage.removeItem('token');
      localStorage.removeItem('userRole');
      localStorage.removeItem('user_id');
      localStorage.removeItem('token_expiry');
      router.push({ name: 'Login' });
      loading.value = false;
    }
  };

  return {
    login,
    logout,
    loading,
  };
}
