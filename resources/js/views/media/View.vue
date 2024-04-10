<template>
  <div id="media-show-view" class="contenedor-general-movie">
    <div class="row">
    <div class="col-xxl-7">
        <div class="movie-details row">
          <img alt="Portada del Media Show" class="poster-image col-sm-4">
          <div class="details-right col-sm-8">
            <h1 class="movie-title">{{ Getmedias.nombre }}</h1>
            <p><span v-for="(genre, index) in Getmedias.genres_name" :key="index" class="movie-genre">{{ genre }}<span v-if="index !== Getmedias.genres_name.length - 1">, </span></span></p>
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
        <p class="movie-synopsis">{{ Getmedias.sinopsis_corta}}</p>
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
          <p>Directores: {{ Getmedias.directores }}</p>
          <p>Actores: {{ Getmedias.actores }}</p>
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
          <p>Pais de Origen: {{Getmedias.country_name}}</p>
        </div>
        <div class="details col-lg-3">
          <h2>Géneros y Edad</h2>
          <p>Géneros: {{ Getmedias.genres_name }}</p>
          <p>Edad: {{ Getmedias.pemi_name }}</p>
        </div>
      </div>
    </div>
    <AppFooter />
  </div>
</template>

<style>

.contenedor-general-movie {
  height: 100vh;
  width: 100%;
  padding-left: 10%;
  padding-right: 10%;
  padding-top: 5%;
}

.movie-details {
  display: flex;
  align-items: center;
}

.poster-image {
  max-width: 400px;
  max-height: 400px;
}

.details-right {
  margin-left: 50px;
  padding: 20px;
}

.movie-title {
  font-size: 50px;
  font-weight: bold;
  color: white;
}

.movie-genre {
  font-size: 30px;
  margin-bottom: 10px;
}

.meta-container {
  display: flex;
  align-items: center;
}

.meta-item {
  font-size: 16px;
  margin-bottom: 10px;
  margin-right: 20px;
}

/* Botón de reproducción */

.watch-button {
  margin-top: 40px;
}

.introduccion{
  font-size: 30px;
  white-space: pre-wrap; /* Esta propiedad permite el salto de línea */
}

.movie-synopsis{
  font-size: 20px;
}

.play-button-trailer {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 200px;
  height: 80px;
  border-radius: 20px;
  background-color: #0b0918;
  color: #fff;
  border: none;
  cursor: pointer;
  text-align: center;
  border: 2px solid white;
  margin-bottom: 50px;
  margin-top: 50px;
}

.play-button-trailer:hover {
  background-color: white;
}

/* Invertir los colores del icono al hacer hover */
.play-button-trailer:hover .play-icon {
  filter: invert(1); 
}

.play-button-trailer span {
  font-size: 18px;
  font-weight: bold;
}

/* Cambiar el color del texto al hacer hover */
.play-button-trailer:hover span {
  color: black; 
}

.movie-trailer {
  max-width: 800px;
  margin-top: 20px;
}

.movie-info {
  flex: 1;
}

.details {
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 20px;
  margin-top: 20px;
}

.details h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

.details p {
  font-size: 16px;
  margin-bottom: 10px;
}

.movie-trailer {
  max-width: 50%;
  max-height: 50%;
}

</style>

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