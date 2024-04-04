<template>
  <div class="contenedor-general-movie">
    <div class="movie-details">
      <img :src="media.portada_img" alt="Portada del Media Show" class="poster-image">
      <div class="details-right">
        <h1 class="movie-title">{{ media.nombre }}</h1>
        <p class="movie-genre">{{ getGenreName(media.genre_id) }}</p>
        <div class="meta-container">
          <p class="meta-item">{{ media.fecha_estreno }}</p>
          <p class="meta-item" v-if="media.id_media_show_type == 1">{{ media.saga }}</p>
          <p class="meta-item" v-if="media.id_media_show_type == 2">{{ media.episodios }} episodios</p>
          <p class="meta-item" v-if="media.id_media_show_type == 2"> {{ media.temporadas }} temporadas</p>
          <p class="meta-item">{{ formateoDuracion(media.duracion) }}</p>
          <div class="id-pemi-box fondo_pemi text-light px-2 py-1 rounded mb-3">
            <p class="m-0">{{ getPemiText(media.pemi_id) }}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="watch-button">
      <h2 class="introduccion">Introducción</h2>
      <p class="movie-synopsis">{{ media.sinopsis_corta }}</p>
      <button class="play-button-trailer" @click="playTrailer">
        <span>VER TRAILER</span>
      </button>
      <video v-if="showTrailer" class="movie-trailer" controls>
        <source :src="media.trailer" type="video/mp4">
      </video>
    </div>
    <div class="movie-info">
      <div class="details">
        <h2>Detalles</h2>
        <h2>Valoraciones</h2>
        <h2>Sinopsis</h2>
        <p>{{ media.sinopsis }}</p>
        <h2>Dirección y reparto</h2>
        <p>Directores: {{ media.directores }}</p>
        <p>Actores: {{ media.actores }}</p>
        <h2>Audio y Región</h2>
        <p>Idioma: {{ media.idioma }}</p>
        <p>Pais de Origen: {{ media.pais_origen }}</p>
        <h2>Géneros y Edad</h2>
        <p>Géneros: {{ getGenreName(media.genre_id) }}</p>
        <p>Edad: {{ getPemiText(media.pemi_id) }}</p>
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
  max-width: 450px;
  height: auto;
}

.details-right {
  margin-left: 50px;
  padding: 20px;
}

.movie-title {
  font-size: 70px;
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
  max-width: 80%;
  max-height: 80%;
}

</style>

<script setup>

  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  import { useGetMedia } from '@/composables/media';
  import { useGetCountries } from '@/composables/countries';
  import AppFooter from '@/layouts/AppFooter.vue';

  const router = useRouter();
  const mediaId = router.currentRoute.value.params.mediaId;

  const media = ref({
    id: '',
    nombre: '',
    id_media_show_type: null,
    sinopsis_corta: '',
    sinopsis: '',
    pemi_id: null,
    genre_id: null,
    duracion: '',
    actores: '',
    portada_img: '',
    idioma: '',
    directores: '',
    trailer: '',
    fecha_estreno: '',
    saga: '',
    temporadas: null,
    episodios: null,
    pais_origen:'',
  });

  const strError = ref('');
  const strSuccess = ref('');

  const genres = ref([]);
  const countries = ref([]);
  const mediaShowTypes = ref([]);
  const pemis = ref([]); 

  const loading = ref(true);

  // Función para obtener el nombre del tipo de Media Show
  const getMediaShowTypeName = (id_media_show_type) => {
    switch (id_media_show_type) {
      case 'Película':
        return 1;
      case 'Serie':
        return 2;
      default:
        return "Sin especificar";
    }
  };

  // Reproducir el trailer al pulsar el play:
  const showTrailer = ref(false);
  const playTrailer = () => {
    showTrailer.value = true;
  };

  // Formateamos el pemi que mostraremos:
  const getPemiText = (pemi_id) => {
    switch (pemi_id) {
      case 1:
        return '0+';
      case 2:
        return '7+';
      case 3:
        return '12+';
      case 4:
        return '16+';
      case 5:
        return '18+';
      default:
        return 'Sin especificar';
    }
  };

  // Función para obtener el nombre del género
  const getGenreName = (genre_id) => {
    switch (genre_id) {
      case 1:
        return 'Acción';
      case 2:
        return 'Aventura';
      case 3:
        return 'Animación';
      case 4:
        return 'Terror';
      case 5:
        return 'Ciencia Ficción';
      case 6:
        return 'Comedia';
      case 7:
        return 'Drama';
      case 8:
        return 'Bélico';
      case 9:
        return 'Thriller';
      case 10:
        return 'Western';
      case 11:
        return 'Suspense';
      case 12:
        return 'Familiar';
      default:
        return 'Sin especificar';
    }
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
      const response = await axios.get(`/api/media/${mediaId}`);
      const data = response.data.data; 
          
      // Ajustar el formato de la fecha sin horas y minutos
      const fechaEstreno = new Date(data.fecha_media_show);
      const fechaSinHorasMinutos = new Date(fechaEstreno.getFullYear(), fechaEstreno.getMonth(), fechaEstreno.getDate());
      media.value.nombre = data.nombre;
      media.value.pemi_id = data.id_pemi;
      media.value.genre_id = data.id_genere;
      media.value.duracion = data.duracion;
      media.value.id_media_show_type = data.id_media_show_type;
      media.value.actores = data.actores;
      media.value.portada_img = data.portada_img;
      media.value.idioma = data.idioma;
      media.value.directores = data.directores;
      media.value.trailer = data.trailer;
      media.value.fecha_estreno = fechaSinHorasMinutos.getFullYear();
      media.value.saga = data.saga;
      media.value.temporadas = data.temporadas;
      media.value.episodios = data.episodios;
      media.value.pais_origen = data.id_country;
      media.value.sinopsis_corta = data.sinopsis_corta;
      media.value.sinopsis = data.sinopsis;

      // Indicamos que los datos han sido cargados:
      loading.value = false; 

      const genresResponse = await axios.get('/api/genres');
      genres.value = genresResponse.data;

      const countriesResponse = await axios.get('/api/countries');
      countries.value = countries.data;

      const mediaShowTypesResponse = await axios.get('/api/mediaShowType');
      mediaShowTypes.value = mediaShowTypesResponse.data;

      const pemisResponse = await axios.get('/api/pemis');
      pemis.value = pemisResponse.data;

    } catch (error) {
      console.error('Error al cargar los datos del medio show:', error);
      strError.value = 'Error al cargar los datos del medio show';
    }
  });

</script>