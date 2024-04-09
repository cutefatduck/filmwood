
<template>
  <div id="media-show-view" class="contenedor-general-movie">
    <div class="row">
      <div class="col-xxl-7">
        <div class="movie-details row">
          <img class="poster-image col-sm-4" alt="Portada del Media Show">
          <div class="details-right col-sm-8">
            <h1 class="movie-title">{{ Getmedias.nombre }}</h1>
            <p class="movie-genre">{{ Getmedias.genres_name }}</p>
            <div class="meta-container">
              <p class="meta-item">{{Getmedias.fecha_media_show}}</p>
              <p class="meta-item" v-if="Getmedias.mediashowtype_name == 'Serie'">{{Getmedias.temporadas}} temporadas</p>
              <p class="meta-item" v-if="Getmedias.mediashowtype_name == 'Serie'">{{Getmedias.episodios}} episodios</p>
              <p class="meta-item">{{formateoDuracion(Getmedias.duracion)}}</p>
              <div class="id-pemi-box color-pemi text-light px-2 py-1 rounded mb-3">
                <p class="m-0">{{ Getmedias.pemi_name }} +</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4 col-xs-12 d-flex align-items-center contenedor-interactuar-media-show">
        <div class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover">
          <img src="/images/favorite.svg" alt="VALORAR">
          <p class="mt-1 titulo-interactuar-media-show">VALORAR</p>
        </div>  
        <div class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover">
          <img src="/images/like.svg" alt="FAVORITOS">
          <p class="mt-1 titulo-interactuar-media-show">FAVORITOS</p>
        </div>
        <div class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover">
          <img src="/images/visualization.svg" alt="VISUALIZAR">
          <p class="mt-1 titulo-interactuar-media-show">VISUALIZADA</p>
        </div>
        <div class="elemento-interactuar-media-show d-flex col-xs-12 linea-hover">
          <img src="/images/share.svg" alt="COMPARTIR">
          <p class="mt-1 titulo-interactuar-media-show">COMPARTIR</p>
        </div>
      </div>
    </div>
    <div class="row watch-button">
      <div class="col-md-6">
        <h2 class="titulo-introduccion">Introducción</h2>
        <p class="movie-synopsis">{{Getmedias.sinopsis_corta}}</p>
      </div>
      <div class="col-md-6 d-flex align-items-center justify-content-center">
        <button class="play-button-trailer" @click="openTrailerPopup">
          <span>VER TRAILER</span>
        </button>
      </div>
      <div v-if="showTrailerPopup" class="popup-trailer">
        <div class="popup-content">
          <span class="close-button" @click="closeTrailerPopup" title="Salir del trailer">&times;</span>
          <iframe width="560" height="315" :src="media.trailer" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3 d-flex mt-4">
        <h2 class="titulo-detalles-valoraciones linea-hover-detalles-valoraciones">Detalles</h2>
        <h2 class="titulo-detalles-valoraciones linea-hover-detalles-valoraciones">Valoraciones</h2>
      </div>
    </div>
    <div class="row movie-info">
      <div class="justify-content-between row">
        <div class="details col-lg-8">
          <h2>Sinopsis</h2>
          <p>{{Getmedias.sinopsis}}</p>
        </div>
        <div class="details col-lg-3">
          <h2>Dirección y reparto</h2>
          <p>Dirección: {{ Getmedias.directores }}</p>
          <p>Reparto: {{ Getmedias.actores }}</p>
        </div>
      </div>
      <div class=" justify-content-between row">
        <div class="details col-lg-3">
          <h2 v-if="Getmedias.mediashowtype_name == 'Pelicula'">Películas relacionadas</h2>
          <h2 v-if="Getmedias.mediashowtype_name == 'Serie'">Episodios y temporadas</h2>
          <p class="meta-item" v-if="Getmedias.mediashowtype_name == null">No hay películas relacionadas</p>
          <p class="meta-item" v-else>{{Getmedias.saga}}</p>
          <p class="meta-item" v-if="Getmedias.mediashowtype_name == 'Serie'">{{Getmedias.temporadas}} temporadas</p>
          <p class="meta-item" v-if="Getmedias.mediashowtype_name == 'Serie'">{{Getmedias.episodios}} episodios</p>
        </div>
        <div class="details col-lg-4">
          <h2>Audio y Región</h2>
          <p>Idioma: {{ Getmedias.idioma }}</p>
          <p>Pais de origen: {{Getmedias.country_name}}</p>
        </div>
        <div class="details col-lg-3">
          <h2>Géneros y Edad</h2>
          <p>{{ Getmedias.genres_name }}</p>
          <p>{{ Getmedias.pemi_name }}</p>
        </div>
      </div>
    </div>
    <AppFooter />
  </div>
</template>



<script setup>

  import { ref, onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  import AppFooter from '@/layouts/AppFooter.vue';
  import { useGetMedia } from '@/composables/media';

  const { Getmedias, loading, fetchMedia, fetchMediaById } = useGetMedia();

  const router = useRouter();
  const mediaId = router.currentRoute.value.params.mediaId;
  
  // Reproducir el trailer al pulsar el play:
  const showTrailer = ref(false);
  const playTrailer = () => {
    showTrailer.value = true;
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

  onMounted(async () => {
    try {
      await fetchMediaById(mediaId);
      console.log(Getmedias.value)
    } catch (error) {
      console.error('Error al cargar los datos del medio show:', error);
      strError.value = 'Error al cargar los datos del medio show';
    }
  });

</script>