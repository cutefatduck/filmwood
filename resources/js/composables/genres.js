// composables/genres.js
import { ref } from 'vue';
import axios from 'axios';

export function useGetGenres() {
    const Getgenres = ref([]);
    const loading = ref(false);

    const fetchGenres = async () => {
        try {
            loading.value = true;
            const response = await axios.get('/api/genres');
            Getgenres.value = response.data;
        } catch (error) {
            console.error('Error fetching genres:', error);
        } finally {
            loading.value = false;
        }
    };
    

    return { Getgenres, loading, fetchGenres };
}