<template>
  <div class="contenedor-general-mi-lista">
    <div class="card-header">
      <div class="titulo-container">
        <button @click="showFavorites" class="boton-favoritos-visualizadas me-1 col-lg-2">FAVORITOS</button>
        <button @click="showVisualizadas" class="boton-favoritos-visualizadas me-1 col-lg-2">VISUALIZADAS</button>
      </div>
    </div>
    <div v-if="activeTab === 'favoritos'" class="row col-xxl-12 col-md-6 mb-4">
      <div class="card-slider p-5 col-xxl-3 col-md-12 col-lg-3 col-sm-3" v-for="mediaShow in GetFavorites" :key="mediaShow.id" @mouseover="handleMouseOver" @mouseleave="handleMouseLeave">
        <div class="mb-1">
          <div class="font-medium mt-1">
            <h3>{{ mediaShow.media_show.nombre }}</h3>
          </div>
          <div class="d-flex align-items-center mt-5">
            <router-link :to="{ name: 'media.view', params: { id: mediaShow.media_show.id } }">
              <button class="play-button me-3" @click="viewMedia(mediaShow.media_show.id)"></button>
            </router-link>
            <span class="me-5 visitar">Visitar</span>
            <div class="ms-auto">
              <button class="star-button me-3"></button>
              <button class="plus-button"></button>
            </div>
          </div>
          <div class="d-flex align-items-center mt-5">
            <div class="me-3">
              <p>{{ mediaShow.media_show.fecha_media_show }}</p>
            </div>
            <div class="me-3">
              <p>{{ formateoDuracion(mediaShow.media_show.duracion) }}</p>
            </div>
            <div class="id-pemi-box color-pemi text-light px-2 py-1 rounded">
              <p class="m-0">+{{ mediaShow.media_show.pemi.number_pemi }}</p>
            </div>
          </div>
          <div class="mt-3"><p>{{ mediaShow.media_show.sinopsis_corta }}</p></div>
        </div>
      </div>
    </div>
    <div v-if="activeTab === 'favoritos' && GetFavorites.length === 0" class="adios-container">
      <div class="adios">
        <div class="text-center">
          <router-link to="/">
            <img src="/images/mascota_404.svg" alt="Filmwood Logo" class="logo mb-3" />
          </router-link>
          <p class="fs-3"> <span class="text-danger">Oops!</span> No hay favoritos guardados.</p>
          <router-link to="/" class="btn btn-primary boton-principal mt-2">Ir al inicio</router-link>
        </div>
      </div>
    </div>
    <div v-if="activeTab === 'visualizadas'" class="row col-xxl-12 col-md-6 mb-4">
      <div class="card-slider p-5 col-xxl-3" v-for="mediaShow in GetVisualizated" :key="mediaShow.id" @mouseover="handleMouseOver" @mouseleave="handleMouseLeave">
        <div class="mb-1">
          <div class="font-medium mt-1">
            <h3>{{ mediaShow.media_show.nombre }}</h3>
          </div>
          <div class="d-flex align-items-center mt-5">
            <router-link :to="{ name: 'media.view', params: { id: mediaShow.media_show.id } }">
              <button class="play-button me-3" @click="viewMedia(mediaShow.media_show.id)"></button>
            </router-link>
            <span class="me-5 visitar">Visitar</span>
            <div class="ms-auto">
              <button class="star-button me-3"></button>
              <button class="plus-button"></button>
            </div>
          </div>
          <div class="d-flex align-items-center mt-5">
            <div class="me-3">
              <p>{{ mediaShow.media_show.fecha_media_show }}</p>
            </div>
            <div class="me-3">
              <p>{{ formateoDuracion(mediaShow.media_show.duracion) }}</p>
            </div>
            <div class="id-pemi-box color-pemi text-light px-2 py-1 rounded">
               <p class="m-0">+{{ mediaShow.media_show.pemi.number_pemi }}</p>
            </div>
          </div>
          <div class="mt-3"><p>{{ mediaShow.media_show.sinopsis_corta }}</p></div>
        </div>
      </div>
    </div>
    <div v-if="activeTab === 'visualizadas' && GetVisualizated.length === 0" class="adios-container">
      <div class="adios">
        <div class="text-center">
          <router-link to="/">
            <img src="/images/mascota_404.svg" alt="Filmwood Logo" class="logo mb-3" />
          </router-link>
          <p class="fs-3"> <span class="text-danger">Oops!</span> No hay visualizadas guardadas.</p>
          <router-link to="/" class="btn btn-primary boton-principal mt-2">Ir al inicio</router-link>
        </div>
      </div>
    </div>
    <AppFooter />
  </div>
</template>


<style scoped>

.contenedor-general-mi-lista{
  width: 100%;
    padding-left: 7%;
    padding-right: 7%;
    padding-top: 5%;
}

.adios-container {
  margin-top: 100px; /* Ajusta el margen superior según tu preferencia */
  padding: 60px;
  overflow: hidden;
}
 
  .titulo-container {
    display: flex;
  }

  .boton-favoritos-visualizadas {
    margin-left: 20px;
    margin: 0px;
    font-size: 40px;
    background-color: transparent;
    font-weight: bold;
    border: none;
    color: white;
  }

  .boton-favoritos-visualizadas::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0;
    height: 3px;
    background-color: white;
    transition: width 0.3s ease;
  }

  .boton-favoritos-visualizadas:hover::after,
  .boton-favoritos-visualizadas.activo::after {
    width: 100%;
  }


</style>

<script setup>

  import { ref, onMounted, onUpdated, computed } from 'vue';
  import { useRouter } from 'vue-router';
  import { useGetFavorites } from '@/composables/favorites';
  import { useGetMedia } from '@/composables/media';
  import { useGetVisualizated } from '@/composables/visualizated';
  import { useStore } from 'vuex';
  import AppFooter from '@/layouts/AppFooter.vue';

  const mediaShowsFavorites = ref([]);
  const { GetFavorites, fetchFavoritesByUserId } = useGetFavorites();

  const mediaShowsVisualizated = ref([]);
  const { GetVisualizated, fetchVisualizatedByUserId } = useGetVisualizated();

  const { Getmedia, fetchMedia, fetchMediaById } = useGetMedia();
  
  const store = useStore();
  const router = useRouter();
  const activeTab = ref('favoritos');

  const user = computed(() => store.getters["auth/user"]);
  const userID = user.value.id;

  const showFavorites = () => {
    activeTab.value = 'favoritos';
  };

  const showVisualizadas = () => {
    activeTab.value = 'visualizadas';
  };

  // Función para ver un medio
  const viewMedia = (id) => {
    // Lógica para ver un medio
  };

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

  onMounted(() => {
    fetchFavoritesByUserId(userID);
    fetchVisualizatedByUserId(userID);
 
  });
</script>