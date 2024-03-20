// composables/pemis.js
import { ref } from 'vue';
import axios from 'axios';

export function useGetPemis() {
    const pemis = ref([]);
    const loading = ref(false);

    const fetchPemis = async () => {
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

    return { pemis, loading, fetchPemis };
}
