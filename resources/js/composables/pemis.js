// composables/pemis.js
import { ref } from 'vue';
import axios from 'axios';

export function useGetPemi() {
    const pemis = ref([]);
    const loading = ref(false);

    // Función para formatear el campo "pemi"
    const formatPemi = (pemis) => {
        pemis.forEach(pemi => {
            switch (pemi.id_pemi) {
                case 1:
                    pemi.formatted_pemi = '+0 años';
                    break;
                case 2:
                    pemi.formatted_pemi = '+7 años';
                    break;
                case 3:
                    pemi.formatted_pemi = '+12 años';
                    break;
                case 4:
                    pemi.formatted_pemi = '+16 años';
                    break;
                case 5:
                    pemi.formatted_pemi = '+18 años';
                    break;
                default:
                    pemi.formatted_pemi = 'Sin especificar';
                    break;
            }
        });

        return pemis;
    };

    const fetchPemi = async () => {
        try {
            loading.value = true;
            const response = await axios.get('/api/pemis');
            // Llama a la función formatPemi para formatear los datos antes de asignarlos a pemis.value
            pemis.value = formatPemi(response.data);
        } catch (error) {
            console.error('Error fetching pemis:', error);
        } finally {
            loading.value = false;
        }
    };

    fetchPemi();

    return { pemis, loading, fetchPemi };
}
