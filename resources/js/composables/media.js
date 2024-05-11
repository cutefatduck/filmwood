// composables/media.js
import { ref } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

export function useGetMedia() {

  const Getmedias = ref([]);
  const Getmedia = ref('');
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

  const fetchMediaIndex = async () => {
    try {
      loading.value = true;
      const response = await axios.get('/api/mediaIndex');
      Getmedias.value = response.data;
    } catch (error) {
      console.error('Error fetching media:', error);
    } finally {
      loading.value = false;
    }
  };

  const fetchMediaById = async (id) => {
    try {
      loading.value = true;
      const response = await axios.get(`/api/media/${id}`);
      Getmedia.value = response.data.data; // Asignamos el resultado a un array para mantener la consistencia con la lista de medios
    } catch (error) {
      console.error(`Error fetching media with ID ${id}:`, error);
    } finally {
      loading.value = false;
    }
  };

  const fetchMediaByGenre = async (genre) => {
    try {
      loading.value = true;
      const response = await axios.get(`/api/media/${genre}`);
      Getmedias.value = response.data; // Asignamos el resultado a un array para mantener la consistencia con la lista de medios
    } catch (error) {
      console.error(`Error fetching media with ID ${genre}:`, error);
    } finally {
      loading.value = false;
    }
  };

  const SearchReturn = ref('')
  const fetchsubmitSearch = async (searchTerm) => {
    try {
      const response = await axios.get('/api/media/search', {
        params: {
        search: searchTerm.value
        },
      });
      SearchReturn.value = response.data
    } catch (error) {
      console.error('Error al realizar la búsqueda:', error);
    }
  };

  const randomMedia = ref(null);
  const fetchRandomMedia = async () => {
    try {
      const response = await axios.get('/api/media');
      if (response.data && Array.isArray(response.data) && response.data.length > 0) {
        // Obtenemos un ID aleatorio dentro del rango de la longitud del array de media shows
        const randomIndex = Math.floor(Math.random() * response.data.length);
        // Obtenemos la media show aleatoria utilizando el ID aleatorio dentro
        randomMedia.value = response.data[randomIndex];
      } else {
        console.error('No se encontraron datos de media shows disponibles.');
      }
    } catch (error) {
      console.error('Error fetching random media:', error);
    }
  };

  const deleteMedia = async (id, index) => {
    try {
      const result = await Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
      });
  
      if (result.isConfirmed) {
        // Primero elimina los géneros asociados a la media show
        const mediaResponse = await axios.delete(`/api/media/${id}`);
        Getmedias.value.splice(index, 1);
        Swal.fire({
          icon: 'success',
          title: '¡La media show ha sido eliminada correctamente!', 
          showConfirmButton: false,
          timer: 1500
        });
      }
    } catch (error) {
      console.log(error);
      Swal.fire({
        icon: 'error',
        title: '¡La media show no ha podido eliminarse!', 
        showConfirmButton: false,
        timer: 1500
      });
    }
  };

  const addMedia = async (media) => {
    try {
      const serializedMedia = new FormData();
      for (const key in media) {
        if (media.hasOwnProperty(key)) {
          serializedMedia.append(key, media[key]);
        }
      }
      const response = await axios.post('/api/media', serializedMedia, {
        headers: {
          'content-type': 'multipart/form-data'
        }
      });
      Swal.fire({
        icon: 'success',
        title:'¡La nueva media show ha sido creada correctamente!', 
        showConfirmButton: false,
        timer: 1500
      })
    } catch (error) {
      console.error('Error al agregar nuevo medio show:', error);
      Swal.fire({
        icon: 'error',
        title:'¡La media show no ha podido crearse!', 
        showConfirmButton: false,
        timer: 1500
      })
    }
  };

  const editMedia = async (media, id) => {
    try {const serializedMedia = new FormData();
      for (const key in media) {
        if (media.hasOwnProperty(key)) {
          serializedMedia.append(key, media[key]);
        }
      }
      const response = await axios.post('/api/media', serializedMedia, {
        headers: {
          'content-type': 'multipart/form-data'
        }
      });
      Swal.fire({
        icon: 'success',
        title:'¡La media show ha sido modificada correctamente!', 
        showConfirmButton: false,
        timer: 1500
      })
    } catch (error) {
      console.error('Error al actualizar los datos del medio show:', error);
      Swal.fire({
        icon: 'error',
        title:'¡La media show no ha podido modificarse!', 
        showConfirmButton: false,
        timer: 1500
      })
    }
  };

  return { 
    Getmedias, 
    Getmedia, 
    loading, 
    fetchMedia, 
    fetchMediaIndex, 
    fetchMediaById, 
    fetchMediaByGenre, 
    fetchsubmitSearch, 
    SearchReturn, 
    randomMedia, 
    fetchRandomMedia, 
    deleteMedia, 
    addMedia, 
    editMedia 
  };
}