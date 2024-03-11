// composables/countries.js
import { ref } from 'vue';
import axios from 'axios';

export function useGetCountries() {
    const countries = ref([]);
    const loading = ref(false);

    const fetchCountries = async () => {
        try {
            loading.value = true;
            const response = await axios.get('/api/countries');
            countries.value = response.data;
        } catch (error) {
            console.error('Error fetching countries:', error);
        } finally {
            loading.value = false;
        }
    };

    return { countries, loading, fetchCountries };
}
