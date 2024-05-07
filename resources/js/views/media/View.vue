<template>
  <div id="media-show-view" class="contenedor-general-movie">
    <div class="row">
      <div class="col-xxl-7">
        <div class="movie-details row">
          <img :src="Getmedia?.portada_img" alt="Portada del Media Show" class="poster-image col-sm-4">
          <div class="details-right col-sm-8">
            <h1 class="movie-title">{{ Getmedia.nombre }}</h1>
            <p><span v-for="(genre, index) in Getmedia.genres_name" :key="index" class="movie-genre">{{ genre }}<span v-if="index !== Getmedia.genres_name.length - 1">, </span></span></p>
            <div class="meta-container">
              <p class="meta-item">{{Getmedia.fecha_media_show}}</p>
              <p class="meta-item" v-if="Getmedia.mediashowtype_name == 'Serie'">{{Getmedia.temporadas}} temporadas</p>
              <p class="meta-item" v-if="Getmedia.mediashowtype_name == 'Serie'">{{Getmedia.episodios}} episodios</p>
              <p class="meta-item">{{formateoDuracion(Getmedia.duracion)}}</p>
              <div class="id-pemi-box color-pemi text-light px-2 py-1 rounded mb-3">
                <p class="m-0">+{{ Getmedia.pemi_name }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4 col-xs-12 d-flex align-items-center contenedor-interactuar-media-show">
        <button type="valoration" @click="handleValorationAction(Getmedia.id)" class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover button-valoration">
          <img :src="getValorationImageSrc()" alt="VALORAR">
          <p class="mt-1 titulo-interactuar-media-show">VALORAR</p>
        </button>
        <Dialog v-model:visible="visible" modal responsive>
          <template #container="{ closeCallback }">
            <div class="row">
              <div class="col-12 col-md-8 col-lg-12 mb-0 pt-2 d-flex justify-content-center mb-3 ">
                <form @submit.prevent="submitValoration" class="formulario-valoracion-wrapper background-valoration">
                  <input type="hidden" v-model="valoration.id_media_show">
                  <h1 class="titulo-valoracion mb-4">¡Valora!</h1>
                  <button @click="closeDialog" class="volver-valoracion">
                    <img src="/images/close.svg" alt="Cerrar">
                  </button>
                  <label class="valoracion-pregunta mb-4 mt-4" for="opinionComentario">Tu reseña de {{ Getmedia.nombre }}</label>
                  <textarea v-model="valoration.valoracion" cols="35" rows="10" style="resize: none;" class="input-formulario" id="opinionComentario" placeholder="¿Qué opinas?"></textarea>
                  <p class="valoracion-pregunta">¿Que puntuación le das?</p>
                  <div class="rating d-flex flex-row-reverse justify-content-end">
                    <template v-for="star in starsCount">
                      <input type="radio" :id="'estrella' + star" name="puntuacion" :value="(starsCount - star +1)" v-model="valoration.puntuacion">
                      <label :for="'estrella' + star" :class="{ 'resaltada': star <= highlightedStars }"></label>
                    </template>
                  </div>
                  <label class="valoracion-pregunta mt-4" for="recomendacion">¿Es recomendable?</label>
                  <div class="recomendacion-inputs mt-3">
                    <input type="radio" id="recomendacion_si" name="recomendacion" value="1" v-model="valoration.recomendacion">
                    <label for="recomendacion_si">Sí</label>
                    <input type="radio" id="recomendacion_no" name="recomendacion" value="0" v-model="valoration.recomendacion">
                    <label for="recomendacion_no">No</label>
                  </div>
                  <div class="flex items-center justify-end mt-4 mb-2">
                    <button type="submit" class="btn btn-primary boton-principal">Dános tu opinión</button>
                  </div>
                </form>
              </div>
            </div>
          </template>
        </Dialog>
        <div class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover" @click="handleFavoriteAction(Getmedia.nombre, Getmedia.id)">
          <img :src="getFavoriteImageSrc()" alt="FAVORITOS">
          <p class="mt-1 titulo-interactuar-media-show">FAVORITOS</p>
        </div>
        <div class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover"@click="handleWatchedAction(Getmedia.id)">
          <img :src="getWatchedImageSrc()" alt="VISUALIZAR">
          <p class="mt-1 titulo-interactuar-media-show">VISUALIZADA</p>
        </div>
        <div class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover" @click="copyURL">
          <img src="/images/share.svg" alt="COMPARTIR">
          <p class="mt-1 titulo-interactuar-media-show">COMPARTIR</p>
        </div>
      </div>
    </div>
    <div class="row watch-button">
      <div class="col-md-6">
        <h2 class="titulo-introduccion">Introducción</h2>
        <p class="movie-synopsis">{{ Getmedia.sinopsis_corta}}</p>
      </div>
      <div class="col-md-6 d-flex align-items-center justify-content-center">
        <button class="play-button-trailer" @click="openTrailerPopup">
          <span>VER TRAILER</span>
        </button>
      </div>
      <div v-if="showTrailer" class="popup-trailer">
        <div class="popup-content">
          <span class="close-button" @click="closeTrailerPopup" title="Salir del trailer">&times;</span>
          <iframe width="560" height="315" :src="Getmedia.trailer" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>
    </div>
    <div class="row movie-info">
      <div class="col-sm-3 d-flex mt-4">
        <h2 class="titulo-detalles-valoraciones linea-hover-detalles-valoraciones" :class="{ 'active-tab': showDetailsTab, 'inactive-tab': !showDetailsTab }" @click="switchToDetailsTab">Detalles</h2>
        <h2 class="titulo-detalles-valoraciones linea-hover-detalles-valoraciones" :class="{ 'active-tab': showReviewsTab, 'inactive-tab': !showReviewsTab }" @click="switchToReviewsTab">Valoraciones</h2>
      </div>
      <div v-if="showDetailsTab" class="row justify-content-between">
        <div class="details col-lg-8">
          <h2>Sinopsis</h2>
          <p>{{Getmedia.sinopsis}}</p>
        </div>
        <div class="details col-lg-3">
          <h2>Dirección y reparto</h2>
          <p>Directores: {{ Getmedia.directores }}</p>
          <p>Actores: {{ Getmedia.actores }}</p>
        </div>
        <div class="details col-lg-3">
          <h2 v-if="Getmedia.mediashowtype_name === 'Pelicula'">Películas relacionadas</h2>
          <h2 v-if="Getmedia.mediashowtype_name === 'Serie'">Episodios y temporadas</h2>
          <template v-if="Getmedia.saga">
            <template v-for="movie in Getmedia.saga.split('/')">
              <p class="meta-item">{{ movie.trim() }}</p>
            </template>
          </template>
          <p class="meta-item" v-else-if="Getmedia.mediashowtype_name === 'Pelicula'">No hay películas relacionadas</p>
          <p class="meta-item" v-if="Getmedia.mediashowtype_name == 'Serie'">{{ Getmedia.temporadas }} temporadas</p>
          <p class="meta-item" v-if="Getmedia.mediashowtype_name == 'Serie'">{{Getmedia.episodios}} episodios</p>
        </div>
        <div class="details col-lg-4">
          <h2>Audio y Región</h2>
          <p>Idioma: {{ Getmedia.idioma }}</p>
          <p>Pais de Origen: {{Getmedia.country_name}}</p>
        </div>
        <div class="details col-lg-3">
          <h2>Géneros y Edad</h2>
          <p>Géneros: <span v-for="(genre, index) in Getmedia.genres_name" :key="index" class="movie-genre-details">{{ genre }}<span v-if="index !== Getmedia.genres_name.length - 1">, </span></span></p>
          <p>Edad: {{ Getmedia.pemi_name }} años</p>
        </div>
      </div>
      <div v-if="showReviewsTab" class="row justify-content-between">
        <div :class="{ 'details': showDetailsTab, 'valorations': !showDetailsTab }" class="col-lg-12">
          <div class="reviews-container row">
            <div v-if="!GetValorations || GetValorations.length === 0" class="container-no-valorations">
              <p class="hola">Todavía no hay valoraciones sobre {{ Getmedia.nombre }}</p>
              <p class="hola">Sé el primero en hacerlo.</p>
              <button @click="handleValorationAction(Getmedia.id)" class="btn btn-primary boton-principal mt-2">VALORAR</button>
            </div>
            <template v-else>
              <div class="col-md-6 col-sm-6 col-lg-12 mb-4 container-valorations" v-for="(opinion, index) in GetValorations" :key="index"> 
                <div class="review-card"> 
                  <p class="username">{{ opinion.user.name_user }}</p>
                  <div class="star-rating">
                    <img v-for="star in 5" :key="star" :src="getStarImage(star, opinion.puntuacion)" class="star-icon" alt="Star">
                  </div>
                  <p class="review-content mt-3">{{ opinion.valoracion }}</p>
                  <p class="review-content mt-3">¿La recomienda?
                    <span v-if="opinion.recomendacion === 1">Sí</span>
                    <span v-else>No</span>
                  </p>
                </div>
              </div>
            </template>
          </div>
        </div>
      </div>
    </div>
    <AppFooter />
  </div>
</template>

<script setup>

  import { ref, onMounted, onUpdated, computed } from 'vue';
  import { useRouter } from 'vue-router';
  import AppFooter from '@/layouts/AppFooter.vue';
  import { useGetMedia } from '@/composables/media';
  import { useGetValorations } from '@/composables/valorations'
  import Swal from 'sweetalert2';
  import axios from 'axios';
  import { useStore } from 'vuex';

  const { Getmedia, fetchMediaById } = useGetMedia();
  const { GetValorations, fetchValorationsByMediaId, addValoration } = useGetValorations();
  const router = useRouter();
  const store = useStore();

  // Variable que definimos para imprimir la imagen de portada:
  const imageURL = ref('');
  
  // Variable que definimos para comprobar si se ha cambiado de media show:
  let mediaIdAux =  router.currentRoute.value.params.id;

  // Cargamos la vista por la parte superior de ella:
  window.scrollTo(0, 0);

  // Definimos dos variables para mostrar la pestaña de "Detalles" o la de "Valoraciones":
  const showDetailsTab = ref(true);
  const showReviewsTab = ref(false);

  // Si mostramos los detalles, ocultamos las valoraciones:
  const switchToDetailsTab = () => {
    showDetailsTab.value = true;
    showReviewsTab.value = false;
  };

  // Si mostramos las valoraciones, ocultamos los detalles:
  const switchToReviewsTab = () => {
    showDetailsTab.value = false;
    showReviewsTab.value = true;
  };

  // Variable para almacenar la URL del trailer
  const trailerUrl = ref('');
  const showTrailer = ref(false);

  // Función para abrir el popup del trailer
  const openTrailerPopup = () => {
    showTrailer.value = true;
    trailerUrl.value = Getmedia.trailer;
  };

  // Función para cerrar el popup del trailer
  const closeTrailerPopup = () => {
    showTrailer.value = false;
    trailerUrl.value = ''; 
  };

  // Variable para almacenar la última ruta
  const visible = ref(false);
  const lastRoute = ref(null); 

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

  const mediaId = ref('');
  const user = computed(() => store.getters["auth/user"]);
  const userID = ref('');
  const starsCount = 5;
  const highlightedStars = ref(0);
  const valoration = ref({ 
    id_user: userID, 
    id_media_show: mediaId, 
    puntuacion: null, 
    valoracion: '',
    recomendacion: ''
  });

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

  // Verificamos si el usuario está autenticado antes de agregar a valoraciones:
  const handleValorationAction = async (mediaId) => {
    const actionCallback = async () => {
      // Asignaremos el ID de la media show actual al objeto de valoración
      valoration.value.id_media_show = mediaId;
      // Si ha iniciado sesión, entonces le mostramos el panel de valorar:
      visible.value = true;
      // Actualizamos el estado de valoración reactivamente:
      isValoration.value = await fetchMediaValorationStatus(mediaId);
    };

    // Verificamos la autenticación antes de ejecutar la acción:
    await checkAuthentication(actionCallback);
  };

  // Creamos una función para agregar una nueva valoración en la base de datos:
  const submitValoration = async () => {
    try {
      const response = await axios.post('/api/media/valoration', valoration.value);
      const nombreUsuario = user.value.name;
      // Mostraremos un mensaje de éxito si conseguimos subir la valoración:
      if (response.data.success) {
        Swal.fire({
          icon: 'success',
          title: `¡${nombreUsuario}, agradecemos tu opinión!`,
          showConfirmButton: false,
          timer: 2000 
        });
        // Actualizaremos la lista de valoraciones después de enviarlo:
        await fetchValorationsByMediaId(mediaIdAux);
        // Restableceremos los valores del formulario de valoración después de enviarlo:
        valoration.value = { 
          id_user: userID, 
          id_media_show: mediaId, 
          puntuacion: null, 
          valoracion: '',
          recomendacion: null
        };
        visible.value = false;
        isValoration.value = true;
      } else {
        Swal.fire({
          icon: 'error',
          title: `No hemos podido subir tu valoración!`,
          showConfirmButton: false,
          timer: 2000 
        });
        visible.value = false;
        isValoration.value = false;
      }
    } catch (error) {
      console.error('Error al subir la valoración:', error);
    }
  };

  // Función para cerrar el popapp de valorar:
  const closeDialog = () => {
    // Restablecer los valores del formulario de valoración
    valoration.value = { 
      id_user: userID, 
      id_media_show: mediaId, 
      puntuacion: null, 
      valoracion: '',
      recomendacion: null
    };
    visible.value = false;
    if (lastRoute.value) {
      router.push(lastRoute.value);
      lastRoute.value = null;
    }
  };

  // Funcion para cerrar el popup cuando se vaya hacia atras
  const handlePopState = () => {
    if (visible.value) {
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

  // Verificamos si el usuario está autenticado antes de agregar a favoritos:
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
          // Restablecer los valores del formulario de valoración después de enviar con éxito
          valoration.value = { 
            id_user: userID, 
            id_media_show: mediaId, 
            puntuacion: null, 
            valoracion: '',
            recomendacion: null
          };
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

  // Variable reactiva para almacenar la URL
  const pageURL = ref('');

  // Función para obtener la URL de la página actual
  const getCurrentPageURL = () => {
    pageURL.value = window.location.href;
  };

  // Función que se ejecuta al pulsar el botón de "Compartir:":
  const copyURL = () => {
    // Obtenemos la URL actual
    getCurrentPageURL();
    const textarea = document.createElement('textarea');
    textarea.value = pageURL.value;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);
      
    // Mostraremos el mensaje de éxito:
    Swal.fire({
      icon: 'success',
      title: '¡URL copiada al portapapeles!',
      showConfirmButton: false,
      timer: 2000 
    });
  };

  // Formateamos la duración que mostraremos:
  const formateoDuracion = (duration) => {
    if (!duration) return '';
      const [hours, minutes, seconds] = duration.split(':');
      let formattedDuration = '';
      if (parseInt(hours) > 0) {
        formattedDuration += `${parseInt(hours)} h`;
      }
      if (parseInt(minutes) > 0) {
        formattedDuration += ` ${parseInt(minutes)} min`;
      }
      return formattedDuration.trim();
  };

  // Agregaremos una función para verificar si la media show actual ya se encuentra en favoritos o no para el usuario actual:
  const fetchMediaFavoriteStatus = async (mediaId) => {
    try {
      const response = await axios.get(`/api/favorites/${mediaId}`);
      return response.data.isFavorite;
    } catch (error) {
      console.error('Error al verificar el estado de favoritos:', error);
      return false;
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

  onMounted(async () => {
    try {
      await fetchMediaById(mediaIdAux);
      await fetchValorationsByMediaId(mediaIdAux);
      imageURL.value = Getmedia.value.portada_img;
      mediaId.value = Getmedia.value.id;
      userID.value = user.value.id;
      // Controlaremos el estado de cada imagen a mostrar según la media show:
      const valorationStatus = await fetchMediaValorationStatus(mediaIdAux);
      const favoriteStatus = await fetchMediaFavoriteStatus(mediaIdAux);
      const visualizatedStatus = await fetchMediaVisualizedStatus(mediaIdAux);
      isFavorite.value = favoriteStatus;
      isWatched.value = visualizatedStatus;
      isValoration.value = valorationStatus;
    } catch (error) {
      console.error('Error al cargar los datos del medio show:', error);
      strError.value = 'Error al cargar los datos del medio show';
    }
    //Función para cerrar el popup cuando se vaya hacia atrás
    window.addEventListener('popstate', handlePopState);
  });

  onUpdated( async() => {
    // Comprueba si el ID del medio show ha cambiado
    if(mediaIdAux !=router.currentRoute.value.params.id){
      mediaIdAux = router.currentRoute.value.params.id;
      try {
        await fetchMediaById(mediaIdAux);
        await fetchValorationsByMediaId(mediaIdAux);
        // Controlaremos el estado de cada imagen a mostrar cada vez que cambiemos de media show:
        const valorationStatus = await fetchMediaValorationStatus(mediaIdAux);
        const favoriteStatus = await fetchMediaFavoriteStatus(mediaIdAux);
        const visualizatedStatus = await fetchMediaVisualizedStatus(mediaIdAux);
        isFavorite.value = favoriteStatus;
        isWatched.value = visualizatedStatus;
        isValoration.value = valorationStatus;
      } catch (error) {
        console.error('Error al cargar los datos del medio show:', error);
        strError.value = 'Error al cargar los datos del medio show';
      }
    }
  });

</script>