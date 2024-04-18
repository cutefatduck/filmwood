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
        <router-link :to="{ name: 'media.valoration'/*, params: { id: Getmedia.id, mediaValoration: Getmedia.nombre } */}" class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover">
          <img src="/images/favorite.svg" alt="VALORAR">
          <p class="mt-1 titulo-interactuar-media-show">VALORAR</p>
        </router-link>
        <router-link :to="{ name: 'media.like', params: { id: Getmedia.id } }" class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover">
          <img src="/images/like.svg" alt="FAVORITOS">
          <p class="mt-1 titulo-interactuar-media-show">FAVORITOS</p>
        </router-link>
        <router-link :to="{ name: 'media.visualization', params: { id: Getmedia.id } }" class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover">
          <img src="/images/visualization.svg" alt="VISUALIZAR">
          <p class="mt-1 titulo-interactuar-media-show">VISUALIZADA</p>
        </router-link>
        <router-link :to="{ name: 'media.share', params: { id: Getmedia.id } }" class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover">
          <img src="/images/share.svg" alt="COMPARTIR">
          <p class="mt-1 titulo-interactuar-media-show">COMPARTIR</p>
        </router-link>
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
        <h2 class="titulo-detalles-valoraciones linea-hover-detalles-valoraciones" @click="switchToDetailsTab">Detalles</h2>
        <h2 class="titulo-detalles-valoraciones linea-hover-detalles-valoraciones" @click="switchToReviewsTab">Valoraciones</h2>
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
          <h2 v-if="Getmedia.mediashowtype_name == 'Pelicula'">Películas relacionadas</h2>
          <h2 v-if="Getmedia.mediashowtype_name == 'Serie'">Episodios y temporadas</h2>
          <p class="meta-item" v-if="Getmedia.saga != null">{{Getmedia.saga}}</p>
          <p class="meta-item" v-if="Getmedia.mediashowtype_name == 'Pelicula' && Getmedia.saga == null">No hay películas relacionadas</p>
          <p class="meta-item" v-if="Getmedia.mediashowtype_name == 'Serie'">{{Getmedia.temporadas}} temporadas</p>
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
          <p>Edad: {{ Getmedia.pemi_name }}</p>
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

  import { ref, onMounted, onUpdated } from 'vue';
  import { useRouter } from 'vue-router';
  import AppFooter from '@/layouts/AppFooter.vue';
  import { useGetMedia } from '@/composables/media';

  const { Getmedia, loading, fetchMedia, fetchMediaById } = useGetMedia();

  const router = useRouter();


  const imageURL = ref('');

  const navigateToValoration = () => {
    router.push({ name: 'media.valoration', params: { mediaId: Getmedia.value.id } });
  };

  const onLikeClicked = () => {
    router.push({ name: 'media.like', params: { mediaId: Getmedia.id } });
  };

  const onVisualizeClicked = () => {
    router.push({ name: 'media.visualization', params: { mediaId: Getmedia.id } });
  };

  const onShareClicked = () => {
    router.push({ name: 'media.share', params: { mediaId: Getmedia.id } });
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
    trailerUrl.value = ''; // Limpiar la URL del trailer al cerrar el popup
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

  // Definimos dos variables para mostrar una pestaña u otra:
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

  let mediaIdAux =  router.currentRoute.value.params.id;
  onMounted(async () => {
    try {
      await fetchMediaById(mediaIdAux);
      imageURL.value = Getmedia.value.portada_img;
    } catch (error) {
      console.error('Error al cargar los datos del medio show:', error);
      strError.value = 'Error al cargar los datos del medio show';
    }
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