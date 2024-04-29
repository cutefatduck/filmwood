// composables/favorites.js
import { ref } from 'vue';
import axios from 'axios';

export function useGetFavorites() {

  const GetFavorites = ref([]);
  const loading = ref(false);

  const fetchFavoritesByUserId = async (userID) => {
    try {
      loading.value = true;
      const response = await axios.get(`/api/user/favorites/${userID}`);
      GetFavorites.value = response.data;
    } catch (error) {
      console.error(`Error fetching favorites for media with ID user ${userID}:`, error);
    } finally{
        loading.value = false;
    }
  };
  
  const addFavorites = async (favoriteData) => {
    try {
      await axios.post('/api/user/favorites', favoriteData);
    } catch (error) {
      console.error('Error adding favorites:', error);
    }
  };

  return { GetFavorites, loading, fetchFavoritesByUserId, addFavorites };
}