// composables/visualizated.js
import { ref } from 'vue';
import axios from 'axios';
import store from '../store';
import Swal from 'sweetalert2';

export function useGetVisualizated() {

  const GetVisualizated = ref([]);
  const loading = ref(false);

  const fetchVisualizatedByUserId = async () => {
    try {
      loading.value = true;
      const response = await axios.get(`/api/visualizated`);
      GetVisualizated.value = response.data;
    } catch (error) {
      console.error(`Error fetching visualizated for media with ID user ${userID}`, error);
    } finally{
      loading.value = false;
    }
  };

  const fetchVisualizatedByMedia = async () => {
    try {
      loading.value = true;
      const response = await axios.get(`/api/user/visualizated`);
      GetVisualizated.value = response.data;
    } catch (error) {
      console.error(`Error fetching visualizated for media with ID user ${userID}`, error);
    } finally{
      loading.value = false;
    }
  };


  // Función para verificar la autenticación del usuario antes de ejecutar una acción
  const checkAuthentication = async (actionCallback) => {
    if (store.state.auth.authenticated) {
      // Si está autenticado, realizamos la acción que desee:
      await actionCallback();
    } else {
      // Si no,mostramos un mensaje indicando al usuario que inicie sesión
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

  // Variable para almacenar el estado del botón "Visualizada"
  const isWatched = ref(false);

  // Función para obtener la ruta de la imagen de visualizada:
  const getWatchedImageSrc = () => {
    if (isWatched.value) {
      return '/images/visualization.svg';
    } else {
      return '/images/no_visualization.svg';
    }
  };

  // Agregaremos una función para verificar si la media show actual ya se encuentra en visualizadas por el usuario o no:
  const fetchMediaVisualizedStatus = async (mediaId) => {
    try {
      const response = await axios.get(`/api/visualizated/${mediaId}`);
      return response.data.isWatched;
    } catch (error) {
      console.error('Error al verificar el estado de visualizadas:', error);
      return false;
    }
  };

  // Verificamos si el usuario está autenticado antes de agregar a visualizadas:
  const handleWatchedAction = async (mediaId) => {
    // Verificamos si el usuario está autenticado
    const actionCallback = async () => {
      await mediaShowWatched(mediaId);
      // Actualizamos el estado de visualizadas reactivamente
      isWatched.value = await fetchMediaVisualizedStatus(mediaId);
    }

    // Verificamos la autenticación antes de ejecutar la acción
    await checkAuthentication(actionCallback);
  };

  // Función que es llamada en la anterior función:
  const mediaShowWatched = (mediaId) => {

    // Guardamos la ID de la media show en concreto en una variable:
    const mediaShowId = mediaId;

    // Llama a esta función para agregar a visualizadas:
    const manageToVisualizated = async (mediaShowId) => {
      try {
          
        const response = await axios.post('/api/visualizated/' + mediaShowId);
          
      } catch (error) {
        console.error("No se ha podido agregar la media show a visualizadas:", error);
      }
    };
      
    // Llamamos a la función para agregar a favoritos, pasando el ID de media show:
    manageToVisualizated(mediaShowId);
  };

  // Exportar todas las funciones necesarias
  return {
    GetVisualizated,
    loading,
    fetchVisualizatedByUserId,
    fetchMediaVisualizedStatus,
    fetchVisualizatedByMedia,
    isWatched,
    getWatchedImageSrc,
    handleWatchedAction,
    mediaShowWatched
  };
}