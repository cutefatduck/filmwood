<template>
  <div id="media-show-view" class="contenedor-general-movie">
    <div class="row">
      <div class="col-xxl-7">
        <div class="movie-details row">
          <img :src="Getmedia?.portada_img" alt="Portada del Media Show" class="poster-image col-sm-4">
          <div class="details-right col-sm-8">
            <h1 class="movie-title">{{ Getmedia.nombre }}</h1>
            <span v-for="genre in Getmedia.genres" class="movie-genre-details">
              <Tag value="secondary">{{ genre.name_genre }}</Tag>
            </span>
            <div class="meta-container mt-2">
              <p class="meta-item">{{Getmedia.fecha_media_show}}</p>
              <p class="meta-item" v-if="Getmedia.mediashowtype_name == 'Serie'">{{Getmedia.temporadas}} temporadas</p>
              <p class="meta-item" v-if="Getmedia.mediashowtype_name == 'Serie'">{{Getmedia.episodios}} episodios</p>
              <p class="meta-item">{{formateoDuracion(Getmedia.duracion)}}</p>
              <div class="id-pemi-box color-pemi text-light px-2 py-1 rounded mb-3">
                <p class="m-0">+{{ Getmedia.pemi }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-5 col-xs-12 d-flex align-items-center contenedor-interactuar-media-show">
        <button type="button" @click="handleValorationAction(Getmedia.id)" class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover button-valoration">
          <img :src="getValorationImageSrc()" alt="VALORAR">
          <p class="mt-1 titulo-interactuar-media-show">VALORAR</p>
        </button>
        <Dialog v-model:visible="visible" modal responsive>
          <template #container="{ closeCallback }">
            <div class="row">
              <div class="col-12 col-md-8 col-lg-12 mb-0 pt-2 d-flex justify-content-center mb-3 ">
                <form id="valorationForm" @submit.prevent=submitValorationView class="formulario-valoracion-wrapper background-valoration">
                  <input type="hidden" v-model="valoration.id_media_show">
                  <h1 class="titulo-valoracion mb-4">¡Valora!</h1>
                  <button @click="closeValorationDialog" class="volver-valoracion">
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
                    <button type="submit" id="submitButton" @click="submitButtonClicked = true" class="btn btn-primary boton-principal">Dános tu opinión</button>
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
        <div class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover" @click="handleWatchedAction(Getmedia.id)">
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
          <h2 v-if="Getmedia.mediashowtype === 'Pelicula'">Películas relacionadas</h2>
          <h2 v-if="Getmedia.mediashowtype === 'Serie'">Episodios y temporadas</h2>
          <template v-if="Getmedia.saga">
            <template v-for="movie in Getmedia.saga.split('/')">
              <p class="meta-item">{{ movie.trim() }}</p>
            </template>
          </template>
          <p class="meta-item" v-else-if="Getmedia.mediashowtype === 'Pelicula'">No hay películas relacionadas</p>
          <p class="meta-item" v-if="Getmedia.mediashowtype == 'Serie'">{{ Getmedia.temporadas }} temporadas</p>
          <p class="meta-item" v-if="Getmedia.mediashowtype == 'Serie'">{{Getmedia.episodios}} episodios</p>
        </div>
        <div class="details col-lg-4">
          <h2>Audio y Región</h2>
          <p>Idioma: {{ Getmedia.idioma }}</p>
          <p>Pais de Origen: {{Getmedia.country}}</p>
        </div>
        <div class="details col-lg-3">
          <h2>Géneros y Edad</h2>
          <p>Géneros: <span v-for="(genre, index) in Getmedia.genres" :key="index" class="movie-genre-details">{{ genre.name_genre }}<span v-if="index !== Getmedia.genres.length - 1">, </span></span></p>
          <p>Edad: {{ Getmedia.pemi }} años</p>
        </div>
      </div>
      
      <div v-if="showReviewsTab" class="row justify-content-between">
        <div :class="{ 'details': showDetailsTab, 'valorations': !showDetailsTab }" class="col-lg-12">
          <div class="reviews-container row">
            <div v-if="!GetValorations || GetValorations.length === 0" class="container-no-valorations">
              <p class="no-valorations">Todavía no hay valoraciones sobre {{ Getmedia.nombre }}</p>
              <p class="no-valorations">Sé el primero en hacerlo.</p>
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
                  <p class="review-content mt-3">¿La recomiendo?
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
  import { useStore } from 'vuex';
  import AppFooter from '@/layouts/AppFooter.vue';
  import { useGetMedia } from '@/composables/media';
  import { useGetValorations } from '@/composables/valorations'
  import { useGetFavorites } from '@/composables/favorites';
  import { useGetVisualizated } from '@/composables/visualizated';
  import { useGetShare } from '@/composables/share';
  import Swal from 'sweetalert2';

  const { isFavorite, getFavoriteImageSrc, handleFavoriteAction, fetchMediaFavoriteStatus } = useGetFavorites();
  const { isWatched, getWatchedImageSrc, handleWatchedAction, fetchMediaVisualizedStatus } = useGetVisualizated();
  const { isValoration, GetValorations, getValorationImageSrc, handleValorationAction, fetchMediaValorationStatus, fetchValorationsByMediaId, closeDialog, handlePopState, getStarImage, visible, submitValoration } = useGetValorations();
  const { Getmedia, fetchMediaById } = useGetMedia();
  const { copyURL } = useGetShare();
  
  const router = useRouter();
  const store = useStore();
  const mediaId = ref('');
  const user = computed(() => store.getters["auth/user"]);
  const userID = ref('');

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

  const starsCount = 5;
  const highlightedStars = ref(0);
  const valoration = ref({ 
    id_user: userID, 
    id_media_show: mediaId, 
    puntuacion: null, 
    valoracion: '',
    recomendacion: ''
  });

  // Referencia reactiva para controlar si se ha hecho clic en el botón de enviar
  const submitButtonClicked = ref(false);

  const submitValorationView = async () => {
    // Verificamos si el botón de enviar ha sido pulsado
    if (submitButtonClicked.value) {
      try {
        // Verificamos si todos los campos están llenos
        if (valoration.value.id_user && valoration.value.id_media_show && valoration.value.puntuacion && valoration.value.valoracion && valoration.value.recomendacion !== null) {
          // Envíamos la valoración
          const valorationData = {
            id_user: userID.value,
            id_media_show: mediaId.value,
            puntuacion: valoration.value.puntuacion,
            valoracion: valoration.value.valoracion,
            recomendacion: valoration.value.recomendacion
          };
          await submitValoration(valorationData);
          // Limpiaremos los valores del formulario
          valoration.value = {
            id_user: userID,
            id_media_show: mediaId,
            puntuacion: null,
            valoracion: '',
            recomendacion: null
          };
        } else {
          // Avisaremos al usuario si algún campo está incompleto:
          Swal.fire({
            icon: 'warning',
            title: 'Por favor, completa todos los campos del formulario de valoración.',
            showConfirmButton: false,
            timer: 2000 
          });
          return;
        }
      } catch (error) {
        console.error('Error al enviar la valoración:', error);
        Swal.fire({
          icon: 'error',
          title: 'Error al enviar la valoración',
          text: 'No hemos podido subir tu valoración. Por favor, inténtalo de nuevo más tarde.',
          showConfirmButton: true
        });
      }
      // Restableceremos el estado del botón de enviar
      submitButtonClicked.value = false;
    }
  };

  // Funcion para cerrar el popapp de valorar al pulsar el botón de cerrar:
  const closeValorationDialog = () => {
    visible.value = false;
    valoration.value = { 
      id_user: userID, 
      id_media_show: mediaId, 
      puntuacion: null, 
      valoracion: '',
      recomendacion: null
    };
    // Restablece el estado del botón de enviar
    submitButtonClicked.value = false;
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

  // Agregaremos un listener para limpiar el formulario si presionamos la tecla de escape:
  document.addEventListener('keydown', (event) => {
    if (event.keyCode === 27) {
      closeValorationDialog();
    }
  });

  onUpdated( async() => {
    // Comprueba si el ID del medio show ha cambiado
    if(mediaIdAux !=router.currentRoute.value.params.id){
      mediaIdAux = router.currentRoute.value.params.id;
      mediaId.value = mediaIdAux;
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
