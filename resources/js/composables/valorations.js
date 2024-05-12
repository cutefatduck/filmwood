// composables/valorations.js
import { ref, computed } from 'vue';
import axios from 'axios';
import store from '../store';
import Swal from 'sweetalert2';

export function useGetValorations() {

  const GetValorations = ref([]);
  const loading = ref(false);

  const fetchValorationsByMediaId = async (mediaId) => {
    try {
      loading.value = true;
      const response = await axios.get(`/api/media/valorations/${mediaId}`);
      GetValorations.value = response.data;
    } catch (error) {
      console.error(`Error fetching valuations for media with ID ${mediaId}:`, error);
    } finally{
      loading.value = false;
    }
  };

  const submitValoration = async (valorationData) => {
   
    // Obtenemos el usuario:
    const usuario = user.value;

    // Añadir el objeto de usuario a los datos de valoración:
    valorationData.user = usuario;

    try {
      const response = await axios.post('/api/media/valoration', valorationData);
      if (response.data.success) {

        // Daremos las gracias al usuario:
        const nombreUsuario = user.value.name_user;

        // Clonar el array actual de valoraciones y agregar la nueva valoración
        const updatedValorations = [...GetValorations.value, valorationData];

        // Actualizar el array de valoraciones
        GetValorations.value = updatedValorations;

        // La marcamos como valorada:
        isValoration.value = true;
  
        // Cerrar el diálogo después de actualizar los valores del formulario
        closeDialog(); 
  
        // Mostrar el mensaje de éxito después de cerrar el diálogo
        Swal.fire({
          icon: 'success',
          title: `¡${nombreUsuario}, agradecemos tu opinión!`,
          showConfirmButton: false,
          timer: 2000 
        });
        
      } else {
        isValoration.value = false;
        console.error('Error al enviar la valoración: ', response.data.error);
        Swal.fire({
          icon: 'error',
          title: `No hemos podido subir tu valoración!`,
          showConfirmButton: false,
          timer: 2000 
        });
      }
    } catch (error) {
      // Mostrar el mensaje de error
      console.error('No hemos subido tu valoración:', error);
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

  const mediaId = ref('');
  const user = computed(() => store.getters["auth/user"]);
  const userID = ref('');
  const starsCount = 5;
  const highlightedStars = ref(0);
  const valoration = ref({ 
    id_user: userID, 
    id_media_show: mediaId, 
    puntuacion: '', 
    valoracion: '',
    recomendacion: ''
  });

  const visible = ref(false);
  // Función para abrir el diálogo de valoración
  const openDialog = () => {
    visible.value = true;
  };

  // Variable para almacenar el estado del botón "Valorar"
  const isValoration = ref(false);

  // Función para obtener la ruta de la imagen de visualizada:
  const getValorationImageSrc = () => {
    if (isValoration.value) {
      return '/images/valoration.svg';
    } else {
      return '/images/no_valoration.svg';
    }
  };

  // Agregaremos una función para verificar si la media show actual ya se encuentra en valoradas por el usuario o no:
  const fetchMediaValorationStatus = async (mediaId) => {
    try {
      const response = await axios.get(`/api/valorations/${mediaId}`);
      return response.data.isValoration;
    } catch (error) {
      console.error('Error al verificar el estado de valoradas:', error);
      return false;
    }
  };

  // Verificamos si el usuario está autenticado antes de agregar a valoraciones:
  const handleValorationAction = async (mediaId) => {
    const actionCallback = async () => {
      // Asignaremos el ID de la media show actual al objeto de valoración
      valoration.value.id_media_show = mediaId;
      // Si ha iniciado sesión, entonces le mostramos el panel de valorar:
      openDialog();
      // Actualizamos el estado de valoración reactivamente:
      isValoration.value = await fetchMediaValorationStatus(mediaId);
    };
  
    // Verificamos la autenticación antes de ejecutar la acción:
    await checkAuthentication(actionCallback);
  };

  const lastRoute = ref(null); 

  // Función para cerrar el popapp de valorar:
  const closeDialog = () => {
    visible.value = false;
    // Restablecer los valores del formulario de valoración
    valoration.value = { 
      id_user: userID, 
      id_media_show: mediaId, 
      puntuacion: null, 
      valoracion: '',
      recomendacion: null
    };
    if (lastRoute.value) {
      router.push(lastRoute.value);
      lastRoute.value = null;
    }
  };

  // Funcion para abrir el popapp de valorar:
  const openValorationDialog = () => {
    visible.value = true;
  };

  // Funcion para cerrar el popup cuando se vaya hacia atras
  const handlePopState = () => {
    if (visible) {
      closeDialog();
    }
  };

  // Función para imprimir las estrellas según la puntuación que le haya dado el usuario:
  const getStarImage = (star, rating) => {
    if (star <= rating) {
      return '/images/estrella_marcada.svg';
    } else {
      return '/images/estrella_vacia.svg';
    }
  };

  // Exportar todas las funciones necesarias
  return {
    fetchValorationsByMediaId,
    fetchMediaValorationStatus,
    submitValoration,
    loading,
    isValoration,
    getValorationImageSrc,
    handleValorationAction,
    closeDialog,
    handlePopState,
    getStarImage,
    openValorationDialog,
    visible,
    lastRoute,
    GetValorations
  };
}