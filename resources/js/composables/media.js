// composables/media.js
import { ref } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2'; // Importa SweetAlert2

export function useGetMedia() {
    const Getmedias = ref([]);
    const loading = ref(false);

    const fetchMedia = async () => {
        try {
            loading.value = true;
            const response = await axios.get('/api/media');
            Getmedias.value = response.data;
        } catch (error) {
            console.error('Error fetching media:', error);
        } finally {
            loading.value = false;
        }
    };

    return { Getmedias, loading, fetchMedia };
}

export function useDeleteMedia(medias) {
    const deleteMedia = async (id, index) => {
      try {
        const result = await Swal.fire({ // Usa Swal en lugar de swal
          title: '¿Estás seguro?',
          text: 'Esta acción no se puede deshacer.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sí, eliminar',
          cancelButtonText: 'Cancelar'
        });
  
        if (result.isConfirmed) {
          const response = await axios.delete(`/api/media/${id}`);
          medias.value.splice(index, 1); // Corregido: usar medias.value
          Swal.fire('¡Eliminado!', 'El registro ha sido eliminado.', 'success'); // Usa Swal en lugar de swal
        }
      } catch (error) {
        console.log(error)
        Swal.fire('Error', 'Hubo un problema al intentar eliminar el registro.', 'error'); // Usa Swal en lugar de swal
      }
    };
  
    return { deleteMedia };
}