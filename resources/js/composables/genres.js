// composables/genres.js
import { ref } from 'vue';
import axios from 'axios';

export function useGetGenres() {
    const GetGenres = ref([]);
    const loading = ref(false);

    const fetchGenres = async () => {
        try {
            loading.value = true;
            const response = await axios.get('/api/genres');
            GetGenres.value = response.data;
        } catch (error) {
            console.error('Error fetching genres:', error);
        } finally {
            loading.value = false;
        }
    };
    

    return { GetGenres, loading, fetchGenres };
}