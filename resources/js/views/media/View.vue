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
        <button type="valoration" @click="showDialog" class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover button-valoration">
          <img src="/images/favorite.svg" alt="VALORAR">
          <p class="mt-1 titulo-interactuar-media-show">VALORAR</p>
        </button>
        <Dialog v-model:visible="visible"  modal responsive>
          <template #container="{ closeCallback }">
            <router-view />
          </template>
        </Dialog>
        <div class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover" @click="mediaShowFavorite(Getmedia.nombre, Getmedia.id)">
          <img :src="getFavoriteImageSrc()" alt="FAVORITOS">
          <p class="mt-1 titulo-interactuar-media-show">FAVORITOS</p>
        </div>
        <div class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover" @click="mediaShowWatched(Getmedia.id)">
          <img :src="getWatchetImageSrc()" alt="VISUALIZAR">
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
        <div class="details col-lg-12 ">
          <div class="reviews-container row justify-content-between">
            <div class="review-card col-md-2 col-xs-12">
              <p class="username">Usuario 1</p>
              <img src="/images/cinco_estrellas.svg" alt="Star" class="mb-2">
              <p class="opinion">Esta es la opinión del usuario sobre el producto. Puede ser larga o corta, según lo que el usuario quiera expresar.</p>
            </div>
            <div class="review-card col-md-2 col-xs-12">
              <p class="username">Usuario 2</p>
              <img src="/images/tres_estrellas.svg" alt="Star" class="mb-2">
              <p class="opinion">Otra opinión de otro usuario. En esta ocasión, la valoración no es tan alta como la anterior.</p>
            </div>
            <div class="review-card col-md-2 col-xs-12">
              <p class="username">Usuario 3</p>
              <img src="/images/cero_estrellas.svg" alt="Star" class="mb-2">
              <p class="opinion">Otra opinión de otro usuario. En esta ocasión, la valoración no es tan alta como la anterior.</p>
            </div>
            <div class="review-card col-md-2 col-xs-12">
              <p class="username">Usuario 4</p>
              <img src="/images/cero_estrellas.svg" alt="Star" class="mb-2">
              <p class="opinion">Otra opinión de otro usuario. En esta ocasión, la valoración no es tan alta como la anterior.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <AppFooter />
  </div>
</template>
<style>

  .review-card {
    border: 1px solid #ffffff;
    border-radius: 5px;
    padding: 20px;
  }

</style>

<script setup>

  import { ref, onMounted, onUpdated, computed } from 'vue';
  import { useRouter } from 'vue-router';
  import AppFooter from '@/layouts/AppFooter.vue';
  import { useGetMedia } from '@/composables/media';
  import Swal from 'sweetalert2';
  import axios from 'axios';
  import { useStore } from 'vuex';

  const { Getmedia, fetchMedia, fetchMediaById } = useGetMedia();
  const router = useRouter();
  const store = useStore();

  const imageURL = ref('');
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

  // Función para obtener la ruta de la imagen de favoritos
  const getFavoriteImageSrc = () => {
    if (isFavorite.value) {
      return '/images/like.svg';
    } else {
      return '/images/no_like.svg';
    }
  };

  const visible = ref(false);
  const lastRoute = ref(null); // Variable para almacenar la última ruta

  const showDialog = () => {
    lastRoute.value = router.currentRoute.value.fullPath;
    router.push({ name: 'media.valoration', params: { mediaId: Getmedia.value.id } });
    visible.value = true;
  };
  const closeDialog = () => {
    visible.value = false;
    console.log(1)
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

  // Variable para almacenar el estado del botón "Favoritos"
  const isFavorite = ref(false);

  // Función que se ejecuta al pulsar el botón de "Favoritos":
  const mediaShowFavorite = async (mediaNombre, mediaId) => {

    // Verificaremos si el usuario está autenticado:
    if (store.state.auth.authenticated) {
      
      // Guardamos la ID de la media show en concreto en una variable:
      const mediaShowId = mediaId;

      // Alternamos el valor entre true y false
      isFavorite.value = !isFavorite.value;

      // Llama a esta función para agregar a favoritos
      const manageToFavorites = async (mediaShowId) => {
        try {
          const response = await axios.post('/api/favorites/' + mediaShowId);
          console.log(response);
          
        } catch (error) {
          console.error("No se ha podido agregar la media show a favoritos:", error);
        }
      };

      // Llamamos a la función para agregar a favoritos, pasando el ID de media show:
      manageToFavorites(mediaShowId);
      
      // Si el botón está activado mostramos un mensaje de éxito:
      if (isFavorite.value) {
        Swal.fire({
          icon: 'success',
          title: `¡${mediaNombre} agregada a favoritos!`,
          showConfirmButton: false,
          timer: 1500 
        });

      } else {
        // Si no, mostraremos el mensaje de que ha eliminado la media show de favoritos:
        Swal.fire({
          icon: 'error',
          title: `¡${mediaNombre} eliminada de favoritos!`,
          showConfirmButton: false,
          timer: 1500 
        });
      }

    } else {

      // Si no ha iniciado sesión, mostraremos un mensaje de información pidiendo que inicie sesión:
      Swal.fire({
        icon: 'info',
        title: 'Inicia sesión para agregar a favoritos',
        showConfirmButton: false,
        timer: 1500
      });
    }
  };

  // Variable para almacenar el estado del botón "Visualizada"
  const isWatched = ref(false);

  // Función que se ejecuta al pulsar el botón de "Visualizada":
  const mediaShowWatched = (mediaId) => {

    // Verificaremos si el usuario está autenticado:
    if (store.state.auth.authenticated) {

    // Cambiamos el estado de la imagen:
    isWatched.value = !isWatched.value;

    // Guardamos la ID de la media show en concreto en una variable:
    const mediaShowId = mediaId;

    // Llama a esta función para agregar a visualizadas:
    const manageToVisualizated = async (mediaShowId) => {
      try {
        const response = await axios.post('/api/visualizated/add/' + mediaShowId);
        console.log(response);
        
      } catch (error) {
        console.error("No se ha podido agregar la media show a visualizadas:", error);
      }
    };

    // Llamamos a la función para agregar a favoritos, pasando el ID de media show:
    manageToVisualizated(mediaShowId);

    } else {

      // Si no ha iniciado sesión, mostraremos un mensaje de información pidiendo que inicie sesión:
      Swal.fire({
        icon: 'info',
        title: 'Inicia sesión para agregar a visualizadas',
        showConfirmButton: false,
        timer: 2000
      });
    }
  };

  // Función para obtener la ruta de la imagen de visualizada:
  const getWatchetImageSrc = () => {
    if (isWatched.value) {
      return '/images/visualization.svg';
    } else {
      return '/images/no_visualization.svg';
    }
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
      const response = await axios.get(`/api/favorites/check/${mediaId}`);
      return response.data.isFavorite;
    } catch (error) {
      console.error('Error al verificar el estado de favoritos:', error);
      return false;
    }
  };

  // Agregaremos una función para verificar si la media show actual ya se encuentra en visualizadas o no:
  const fetchMediaVisualizedStatus = async (mediaId) => {
    try {
      const response = await axios.get(`/api/visualizated/check/${mediaId}`);
      return response.data.isWatched;
    } catch (error) {
      console.error('Error al verificar el estado de visualizadas:', error);
      return false;
    }
  };

  onMounted(async () => {
    try {
      await fetchMediaById(mediaIdAux);
      imageURL.value = Getmedia.value.portada_img;
      const favoriteStatus = await fetchMediaFavoriteStatus(mediaIdAux);
      const visualizatedStatus = await fetchMediaVisualizedStatus(mediaIdAux);
      isFavorite.value = favoriteStatus;
      isWatched.value = visualizatedStatus;
    } catch (error) {
      console.error('Error al cargar los datos del medio show:', error);
      strError.value = 'Error al cargar los datos del medio show';
    }
    //Funcion para cerrar el popup cuando se vaya hacia atras
    window.addEventListener('popstate', handlePopState);
  });

  onUpdated( async() => {

    if(mediaIdAux !=router.currentRoute.value.params.id){
      mediaIdAux = router.currentRoute.value.params.id;
      try {
        await fetchMediaById(mediaIdAux);
      } catch (error) {
        console.error('Error al cargar los datos del medio show:', error);
        strError.value = 'Error al cargar los datos del medio show';
      }
    }
  });

</script>