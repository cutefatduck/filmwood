<template>
  <div>
    <div class="tabs">
      <button @click="activeTab = 'favoritos'" :class="{ 'active': activeTab === 'favoritos' }">Favoritos</button>
      <button @click="activeTab = 'visualizados'" :class="{ 'active': activeTab === 'visualizados' }">Visualizados</button>
    </div>
    <div v-if="activeTab === 'favoritos'" class="media-container">
      <div v-for="(media, index) in mediosFavoritos" :key="index" class="card-slider p-5">
        <div class="media-card">
          <h3>{{ media.nombre }}</h3>
          <router-link :to="{ name: 'media.view', params: { id: media.id } }">
            <button class="play-button" @click="viewMedia(media.id)"></button>
          </router-link>
          <span class="visitar">Visitar</span>
          <div class="icons">
            <button class="star-button"></button>
            <button class="plus-button"></button>
          </div>
          <div class="info">
            <p>{{ media.fecha_media_show }}</p>
            <p>{{ formateoDuracion(media.duracion) }}</p>
            <div class="id-pemi-box color-pemi text-light px-2 py-1 rounded">
              <p>+{{ media.pemi.number_pemi }}</p>
            </div>
          </div>
          <p>{{ media.sinopsis_corta }}</p>
        </div>
      </div>
    </div>
    <div v-else-if="activeTab === 'visualizados'" class="media-container">
      <div v-for="(media, index) in mediosVisualizados" :key="index" class="card-slider p-5">
        <div class="media-card">
          <h3>{{ media.nombre }}</h3>
          <router-link :to="{ name: 'media.view', params: { id: media.id } }">
            <button class="play-button" @click="viewMedia(media.id)"></button>
          </router-link>
          <span class="visitar">Visitar</span>
          <div class="icons">
            <button class="star-button"></button>
            <button class="plus-button"></button>
          </div>
          <div class="info">
            <p>{{ media.fecha_media_show }}</p>
            <p>{{ formateoDuracion(media.duracion) }}</p>
            <div class="id-pemi-box color-pemi text-light px-2 py-1 rounded">
              <p>+{{ media.pemi.number_pemi }}</p>
            </div>
          </div>
          <p>{{ media.sinopsis_corta }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

  import { ref, onMounted } from 'vue';
  import axios from 'axios';

  // Definir variables reactivas
  const activeTab = ref('favoritos');
  const mediaShowsFavorites = ref([]);
  const mediaShowsVisualizated = ref([]);

  // Función para obtener los medios favoritos de un usuario
  const getFavoritesMediaShowsByUser = async (userID) => {
    try {
      const response = await axios.get(`api/user/favorites/${userID}`);
      mediaShowsFavorites.value = response.data;
    } catch (error) {
      console.error('Error al obtener los favoritos:', error);
    }
  };

  // Función para obtener los medios visualizados de un usuario
  const getVisualizatedMediaShowsByUser = async (userID) => {
    try {
      const response = await axios.get(`api/'user/visualizated/${userID}`);
      mediaShowsVisualizated.value = response.data;
    } catch (error) {
      console.error('Error al obtener los favoritos:', error);
    }
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
    //const userID =
    getFavoritesMediaShowsByUser(userID);
    getVisualizatedMediaShowsByUser(userID);
  });
</script>


<style scoped>
  /* Estilos para las pestañas */
  .tabs {
    display: flex;
  }

  .tabs button {
    border: none;
    background-color: transparent;
    cursor: pointer;
    padding: 10px 20px;
  }

  .tabs button.active {
    background-color: #ddd;
  }

  /* Estilos para los medios */
  .media-container {
    display: flex;
    flex-wrap: wrap;
  }

  .card-slider {
    width: 25%; /* 4 columnas por fila */
    padding: 10px;
  }

  .media-card {
    border: 1px solid #ddd;
    padding: 20px;
    margin-bottom: 20px;
  }

  .play-button,
  .star-button,
  .plus-button {
    /* Estilos para los botones */
  }

  .info {
    display: flex;
    justify-content: space-between;
  }

  .id-pemi-box {
    /* Estilos para la caja de identificación */
  }
</style>