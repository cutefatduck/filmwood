<template>
  <div class="contenedor-general-mi-lista ">
    <div class="row mx-6 mx-sm-0">
      <div class="titulo-container col-sm-12 col-xxl-12">
        <h2 class="titulo-detalles-valoraciones linea-hover-detalles-valoraciones" :class="{ 'active-tab': showFavoritesTab, 'inactive-tab': !showFavoritesTab }" @click="switchToFavorites">FAVORITAS</h2>
        <h2 class="titulo-detalles-valoraciones linea-hover-detalles-valoraciones" :class="{ 'active-tab': showWatchedTab, 'inactive-tab': !showWatchedTab }" @click="switchToVisualizated">VISUALIZADAS</h2>
      </div>
    </div>
    <div v-if="showFavoritesTab" class="row">
      <template v-for="mediaShow in GetFavorites">
        <div v-if="activeTab === 'favoritos'" class="col-xxl-4 col-md-6 col-lg-6 d-flex contenedor-guardadas-visualizadas">
          <div class="card-slider p-5">
            <div class="mb-1">
              <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="d-flex justify-content-center justify-content-md-start">
                        <router-link :to="{ name: 'media.view', params: { id: mediaShow.media_show.id } }">
                            <img :src="mediaShow.media_show?.portada_img" alt="Portada del Media Show" class="poster-image-home">
                        </router-link>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="d-flex flex-column justify-content-center mt-3">
                        <div class="titulo-card"><h3>{{ mediaShow.media_show.nombre }}</h3></div>
                        <div class="d-flex align-items-center mt-3 mb-3">
                            <router-link :to="{ name: 'media.view', params: { id: mediaShow.media_show.id } }">
                                <img class="play-button me-3" src="/images/play-button.svg">
                            </router-link>
                            <span class="me-4 visitar">Visitar</span>
                        </div>
                        <div v-if="mediaShow.media_show.genres && mediaShow.media_show.genres.length">
                            <span class="visitar movie-genre-details" v-for="(genre, index) in mediaShow.media_show.genres" :key="index">
                                <Tag value="secondary">{{ genre.name_genre }}</Tag>
                            </span>
                        </div>
                    </div>
                </div>
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
      </template>
    </div>
    <div v-if="activeTab === 'favoritos' && GetFavorites.length === 0" class="sin-contenido-container">
      <div class="text-center">
        <router-link to="/">
          <img src="/images/mascota_404.svg" alt="Filmwood Logo" class="logo mb-3" />
        </router-link>
        <p class="fs-3"> <span class="text-danger">Oops!</span> No hay favoritas guardadas.</p>
        <button class="btn btn-primary boton-principal mt-2" @click="redirectToRandomView()">Descubre una joya oculta</button>
      </div>
    </div>    
    <div v-if="showWatchedTab" class="row">
      <template v-for="mediaShow in GetVisualizated">
        <div v-if="activeTab === 'visualizadas'" class="col-xxl-4 col-md-6 col-lg-6 d-flex contenedor-guardadas-visualizadas">
          <div class="card-slider p-5">
            <div class="mb-1">
              <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="d-flex justify-content-center justify-content-md-start">
                        <router-link :to="{ name: 'media.view', params: { id: mediaShow.media_show.id } }">
                            <img :src="mediaShow.media_show?.portada_img" alt="Portada del Media Show" class="poster-image-home">
                        </router-link>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="d-flex flex-column justify-content-center mt-3">
                        <div class="titulo-card"><h3>{{ mediaShow.media_show.nombre }}</h3></div>
                        <div class="d-flex align-items-center mt-3 mb-3">
                            <router-link :to="{ name: 'media.view', params: { id: mediaShow.media_show.id } }">
                                <img class="play-button me-3" src="/images/play-button.svg">
                            </router-link>
                            <span class="me-4 visitar">Visitar</span>
                        </div>
                        <div v-if="mediaShow.media_show.genres && mediaShow.media_show.genres.length">
                            <span class="visitar movie-genre-details" v-for="(genre, index) in mediaShow.media_show.genres" :key="index">
                                <Tag value="secondary">{{ genre.name_genre }}</Tag>
                            </span>
                        </div>
                    </div>
                </div>
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
      </template>
    </div>
    <div v-if="activeTab === 'visualizadas' && GetVisualizated.length === 0" class="sin-contenido-container">
      <div class="text-center">
        <router-link to="/">
          <img src="/images/mascota_404.svg" alt="Filmwood Logo" class="logo mb-3" />
        </router-link>
        <p class="fs-3"> <span class="text-danger">Oops!</span> No hay visualizadas guardadas.</p>
        <button class="btn btn-primary boton-principal mt-2" @click="redirectToRandomView()">Descubre una joya oculta</button>
        </div>
    </div>
    <AppFooter />
  </div>
</template>

<script setup>

  import { ref, onMounted, computed } from 'vue';
  import { useRouter } from 'vue-router';
  import { useGetFavorites } from '@/composables/favorites';
  import { useGetVisualizated } from '@/composables/visualizated';
  import { useStore } from 'vuex';
  import AppFooter from '@/layouts/AppFooter.vue';
  import { useGetMedia } from '@/composables/media';

  const { randomMedia, fetchRandomMedia } = useGetMedia();

  const showFavoritesTab = ref(true);
  const showWatchedTab = ref(false);
  const activeTab = ref('favoritos');
  
  const switchToFavorites = () => {
    showFavoritesTab.value = true;
    showWatchedTab.value = false;
    activeTab.value = 'favoritos';
  };

  const switchToVisualizated = () => {
    showFavoritesTab.value = false;
    showWatchedTab.value = true;
    activeTab.value = 'visualizadas';
  };

  // Recuperamos las media shows en favoritos y en visualizadas:
  const { GetFavorites, fetchFavoritesByMedia } = useGetFavorites();
  const { GetVisualizated, fetchVisualizatedByMedia } = useGetVisualizated();

  const store = useStore();
  const router = useRouter();
  const user = computed(() => store.getters["auth/user"]);
  const userID = user.value.id;

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

  const redirectToRandomView = async () => {
    await fetchRandomMedia();
    if (randomMedia.value) {
      router.push({ name: 'media.view', params: { id: randomMedia.value.id.toString() } });
    } else {
      console.error('No se encontraron datos de media shows disponibles.');
    }
  };

  onMounted(() => {
    fetchFavoritesByMedia();
    fetchVisualizatedByMedia();
  });

</script>