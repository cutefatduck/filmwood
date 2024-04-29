// composables/visualizated.js
import { ref } from 'vue';
import axios from 'axios';

export function useGetVisualizated() {

  const GetVisualizated = ref([]);
  const loading = ref(false);

  const fetchVisualizatedByUserId = async (userID) => {
    try {
      loading.value = true;
      const response = await axios.get(`/api/user/visualizated/${userID}`);
      GetVisualizated.value = response.data;
    } catch (error) {
      console.error(`Error fetching visualizated for media with ID user ${userID}:`, error);
    } finally{
        loading.value = false;
    }
  };

  const addVisualizated = async (visualizatedData) => {
    try {
      await axios.post('/api/user/visualizated', visualizatedData);
    } catch (error) {
      console.error('Error adding visualizated:', error);
    }
  };

  return { GetVisualizated, loading, fetchVisualizatedByUserId, addVisualizated };
}