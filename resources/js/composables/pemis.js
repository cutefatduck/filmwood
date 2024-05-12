import { ref } from 'vue';
import axios from 'axios';

export function useGetPemi() {
    const pemis = ref([]);
    const loading = ref(false);

    const fetchPemi = async () => {
        try {
            loading.value = true;
            const response = await axios.get('/api/pemis');
            pemis.value = response.data;
        } catch (error) {
            console.error('Error fetching pemis:', error);
        } finally {
            loading.value = false;
        }
    };

    fetchPemi();

    return { pemis, loading, fetchPemi };
}
