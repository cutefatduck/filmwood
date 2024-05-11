<template>
  <div class="position-box">
    <div class="search-box" ref="searchBox">
        <form @submit.prevent="submitSearch">
            <input class="search-input" v-model="searchTerm" @input="submitSearch" @keydown.enter.prevent="submitSearch" @keydown.esc="clearSearch" autocomplete="off" type="text" name="search" placeholder="Descubre una joya">
            <div class="search-results-box">
              <div v-if="showNoResultsMessage && searchTerm" class="search-results">
                <li>No hay resultados</li>
              </div>
              <div v-else-if="searchTerm && SearchReturn.length > 0">
                <div v-for="result in SearchReturn" :key="result.id" class="search-results">
                  <router-link :to="{ name: 'media.view', params: { id: result.id } }" @click="clearSearchTerm">
                    <div class="row">
                      <div class="col-3">
                        <img class="search-results-image" :src="result?.portada_img" alt="" srcset="">
                      </div>
                      <div class="col-9">
                        <li>
                          {{ result.nombre }}
                          <div class="result-type mt-2">
                            {{ result.media_show_type.type }}
                          </div>
                        </li>
                      </div>
                    </div>
                  </router-link>
                </div>
              </div>
            </div>
        </form>
    </div>
  </div>
</template>

<script setup>
  import { onMounted, ref, watch, onBeforeUnmount } from 'vue';
  import { useGetMedia } from '@/composables/media';
  import { useGetGenres } from '@/composables/genres';

  const { fetchMediaIndex, fetchsubmitSearch, SearchReturn } = useGetMedia();
  const searchTerm = ref('');
  const showNoResultsMessage = ref(false);

  const submitSearch = () => {
    fetchsubmitSearch(searchTerm);
  };

  const onClickOutside = (event) => {
    if (!event.target.closest('.search-box')) {
      searchTerm.value = '';
      SearchReturn.value = [];
      showNoResultsMessage.value = false;
    }
  };

  const clearSearchTerm = () => {
    searchTerm.value = '';
    SearchReturn.value = [];
    showNoResultsMessage.value = false;
  };

  const clearSearch = () => {
    searchTerm.value = '';
    SearchReturn.value = [];
    showNoResultsMessage.value = false;
  };

  onMounted(() => {
    fetchMediaIndex();
    document.addEventListener('click', onClickOutside);
  });

  // Watcher para verificar si no hay resultados en la búsqueda
  watch(SearchReturn, () => {
    if (searchTerm.value !== '') {
      showNoResultsMessage.value = SearchReturn.value.length === 0;
    } else {
      showNoResultsMessage.value = false;
    }
  });

  onBeforeUnmount(() => {
    document.removeEventListener('click', onClickOutside);
  });
</script>
