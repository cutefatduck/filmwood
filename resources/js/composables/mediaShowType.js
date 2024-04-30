import { ref } from 'vue';
import axios from 'axios';

export function useGetMediaShowType() {
    const mediaShowTypes = ref([]);
    const loading = ref(false);

    const fetchMediaShowType = async () => {
        try {
            loading.value = true;
            const response = await axios.get('/api/mediaShowType');
            mediaShowTypes.value = response.data;
        } catch (error) {
            console.error('Error fetching media_show_type:', error);
        } finally {
            loading.value = false;
        }
    };

    return { mediaShowTypes, loading, fetchMediaShowType };
}
