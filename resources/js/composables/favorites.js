// composables/favorites.js
import { ref } from 'vue';
import axios from 'axios';
import store from '../store';
import Swal from 'sweetalert2';

export function useGetFavorites() {

  const GetFavorites = ref([]);
  const loading = ref(false);

  const fetchFavoritesByUserId = async () => {
    try {
      loading.value = true;
      const response = await axios.get(`/api/favorites`);
      GetFavorites.value = response.data;
    } catch (error) {
      console.error(`Error fetching favorites for media with ID user :`, error);
    } finally {
      loading.value = false;
    }
  };


  const fetchFavoritesByMedia = async () => {
    try {
      loading.value = true;
      const response = await axios.get(`/api/user/favorites`);
      GetFavorites.value = response.data;
    } catch (error) {
      console.error(`Error fetching favorites for media with ID user :`, error);
    } finally {
      loading.value = false;
    }
  };

  // Función para verificar la autenticación del usuario antes de ejecutar una acción
  const checkAuthentication = async (actionCallback) => {
    if (store.state.auth.authenticated) {
      // Si está autenticado, realizamos la acción que desee:
      await actionCallback();
    } else {
      // Si no, mostramos un mensaje indicando al usuario que inicie sesión
      loginRequired();
    }
  };
  
  // Función para mostrar un mensaje de que se requiere un inicio de sesión
  const loginRequired = () => {
    Swal.fire({
      icon: 'info',
      title: 'Inicia sesión para realizar esta acción',
      showConfirmButton: false,
      timer: 1500
    });
  };

  // Variable para almacenar el estado del botón "Favoritos"
  const isFavorite = ref(false);
  

  // Función para obtener la ruta de la imagen de favoritos
  const getFavoriteImageSrc = () => {
    if (isFavorite.value) {
      return '/images/like.svg';
    } else {
      return '/images/no_like.svg';
    }
  };

  // Agregaremos una función para verificar si la media show actual ya se encuentra en favoritos o no para el usuario actual:
  const fetchMediaFavoriteStatus =  async (mediaId) => {
    try {
      const response = await axios.get(`/api/favorites/${mediaId}`);
      const hasData = Array.isArray(response.data) && response.data.length > 0;
      return hasData;
    } catch (error) {
      console.error('Error al verificar el estado de favoritos:', error);
      return false;
    } finally {
        loading.value = false;
      }
  };
  const favoritesStatus = ref([]);
  const fetchMediaFavoriteStatusArray = async (mediaIds) => {
    try {
      // Array para almacenar las promesas de las llamadas a la API
      const promises = mediaIds.map(mediaId => axios.get(`/api/favorites/${mediaId}`));
  
      // Esperar a que todas las promesas se resuelvan
      const responses = await Promise.all(promises);
  
      // Mapear las respuestas para obtener el estado de favoritos de cada elemento
      favoritesStatus.value = responses.map(response => response.data);
  
    } catch (error) {
      console.error('Error al verificar el estado de favoritos:', error);
      return [];
    }
  };

  // Función para manejar la acción de agregar a favoritos
  const handleFavoriteAction = async (mediaNombre, mediaId) => {
    const actionCallback = async () => {
      await mediaShowFavorite(mediaNombre, mediaId);
      // Actualizamos el estado de favoritos reactivamente
      isFavorite.value = await fetchMediaFavoriteStatus(mediaId);
    };

    // Verificamos la autenticación antes de ejecutar la acción
    await checkAuthentication(actionCallback);
  };

  // Función que es llamada en la anterior función:
  const mediaShowFavorite = async (mediaNombre, mediaId) => {
    // Guardamos la ID de la media show en concreto en una variable:
    const mediaShowId = mediaId;

    // Llama a esta función para agregar a favoritos
    const manageToFavorites = async (mediaShowId) => {
      try {
        const response = await axios.post('/api/favorites/' + mediaShowId);
        // Mostramos un mensaje de éxito si se agrega correctamente
        if (!(isFavorite.value)) {
          Swal.fire({
            icon: 'success',
            title: `¡${mediaNombre} agregada a favoritos!`,
            showConfirmButton: false,
            timer: 1500 
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: `¡${mediaNombre} eliminada de favoritos!`,
            showConfirmButton: false,
            timer: 1500 
          });
        }
      } catch (error) {
        console.error("No se ha podido agregar la media show a favoritos:", error);
      }
    };

    // Llamamos a la función para agregar a favoritos, pasando el ID de media show:
    manageToFavorites(mediaShowId);
  };

  // Exportar todas las funciones necesarias
  return {
    GetFavorites,
    loading,
    favoritesStatus,
    fetchFavoritesByMedia,
    fetchFavoritesByUserId,
    fetchMediaFavoriteStatusArray,
    fetchMediaFavoriteStatus,
    isFavorite,
    getFavoriteImageSrc,
    handleFavoriteAction,
    mediaShowFavorite
  };
}