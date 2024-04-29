// composables/valorations.js
import { ref } from 'vue';
import axios from 'axios';

export function useGetValorations() {

  const GetValorations = ref([]);
  const loading = ref(false);

  const fetchValorationsByMediaId = async (mediaId) => {
    try {
      loading.value = true;
      const response = await axios.get(`/api/media/valorations/${mediaId}`);
      GetValorations.value = response.data;
    } catch (error) {
      console.error(`Error fetching valuations for media with ID ${mediaId}:`, error);
    } finally{
        loading.value = false;
    }
  };
  

  const addValoration = async (valorationData) => {
    try {
      await axios.post('/api/media/valoration', valorationData);
    } catch (error) {
      console.error('Error adding valoration:', error);
    }
  };

  return { GetValorations, loading, fetchValorationsByMediaId, addValoration };
}
