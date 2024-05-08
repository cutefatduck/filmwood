<template>
  <div class="position-box">
    <div class="search-box" v-click-outside="onClickOutside" >
        <form @submit.prevent="submitSearch">
            
            <input class="search-input" v-model="searchTerm" @input="submitSearch"  autocomplete="off" type="text" name="search" placeholder="Buscar entretenimento">
            
            <div class="search-results-box">
              <div v-for="result in SearchReturn" :key="result.id" class="search-results">
                  <div v-if="SearchReturn == ''">
                      <li>No hay resultados</li>
                  </div>
                  <div v-else>
                      <router-link :to="{ name: 'media.view', params: { id: result.id } }">

                        <div class="row">
                          <div class="col-3">
                            <img class="search-results-image" :src="result?.portada_img" alt="" srcset="">
                          </div>
                          <div class="col-9">
                            <li>
                            {{ result.nombre }}
                            <div class="result-type">
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
import { onMounted, ref } from 'vue';
import { useGetMedia, useSearchMedia } from '@/composables/media';
import { useGetGenres } from '@/composables/genres';
// Obtenemos todas las media shows:
const { Getmedias, loading: loadingMedia, fetchMediaIndex } = useGetMedia();
const { GetGenres, loading: loadingGenre, fetchGenres } = useGetGenres();
const { SearchReturn, fetchsubmitSearch } = useSearchMedia();

const searchTerm = ref('');
  const submitSearch = () => {
    fetchsubmitSearch(searchTerm);
  };

  const onClickOutside = () => {
    SearchReturn.value = [];
  }

const showTrailer = ref(false); // Para controlar la visibilidad del reproductor
const trailerSrc = ref(''); // URL del tráiler

onMounted(()=>{
      fetchMediaIndex();
      fetchGenres();
  })
</script>