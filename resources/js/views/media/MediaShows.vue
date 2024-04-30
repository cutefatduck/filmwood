<template>
    <div class="contenedor-general-movie">
        <Dropdown v-model="selectedType" :options="mediaShowTypes" optionLabel="type" placeholder="Tipo" class="w-full md:w-14rem" />
        <Dropdown v-model="selectedGenre" filter :options="GetGenres" optionLabel="name_genre" placeholder="Genero" class="w-full md:w-14rem" />
        <Dropdown v-model="selectedGenre" filter :options="GetGenres" optionLabel="name_genre" placeholder="Valoraciones" class="w-full md:w-14rem" />
        <div class="card flex justify-content-center">
            <Slider v-model="selectedDate" :min="lastYear" :max="currentYear" range class="w-14rem" />
            <input type="number" v-model="selectedDate[0]"> <!-- Vinculamos el input al valor del rango -->
            <input type="number" v-model="selectedDate[1]"> <!-- Vinculamos el input al valor del rango -->
        </div>
    <div class="row ">
    <template v-for="media in Getmedias">
            <div class="col-4 d-flex">
                <div class="card-slider p-5">
                    <div class="mb-1">
                        <div class="font-medium mt-1">
                            <h3>{{ media.nombre }}</h3>
                        </div>
                        <div class="d-flex align-items-center mt-5">
                            <router-link :to="{ name: 'media.view', params: { id: media.id } }">
                                <button class="play-button me-3" @click="viewMedia(media.id)"></button>
                            </router-link>
                            <span class="me-5 visitar">Visitar</span>
                            <div class="ms-auto">
                                <button class="star-button me-3"></button>
                                <button class="plus-button"></button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-5">
                            <div class="me-3">
                                <p>{{ media.fecha_media_show }}</p>
                            </div>
                            <div class="me-3">
                                <p>{{ formateoDuracion(media.duracion) }}</p>
                            </div>
                            <div class="id-pemi-box color-pemi text-light px-2 py-1 rounded">
                                <p class="m-0">+{{ media.pemi.number_pemi }}</p>
                            </div>
                        </div>
                        <div class="mt-3"><p>{{ media.sinopsis_corta }}</p></div>
                    </div>
                </div>
            </div>
        </template>
    </div>
        <AppFooter />
</div>
</template>
<script setup>
import { ref, onMounted, watch } from 'vue';
import AppFooter from '@/layouts/AppFooter.vue';
import { useGetMedia } from '@/composables/media';
import { useGetMediaShowType } from '@/composables/mediaShowType';
import { useGetGenres } from '@/composables/genres';

const { GetGenres, loading: loadingGenre, fetchGenres } = useGetGenres();
const { Getmedias, loading: loadingMedia, fetchMedia } = useGetMedia();
const { mediaShowTypes, loading: loadingTypes, fetchMediaShowType } = useGetMediaShowType();

const selectedGenre = ref();
const selectedType = ref();
const selectedDate = ref([new Date().getFullYear(), new Date().getFullYear()]); // Rango de fechas por defecto

const sortOrder = ref(null);
const sortField = ref(null);
const sortKey = ref(null);
const sortOptions = [
  { label: 'Price Low to High', value: 'priceAsc' },
  { label: 'Price High to Low', value: 'priceDesc' },
];

const today = new Date();
const currentYear = today.getFullYear();
const lastYear = 1910;

const formateoDuracion = (duration) => {
  // Lógica de formateo de duración
};

const obtenerAnios = (anioFinal) => {
  // Lógica para obtener años
};

// Watcher para actualizar el rango del Slider cuando cambia selectedDate
watch(selectedDate, (newValue) => {
  // Lógica para actualizar el rango del Slider
  // Por ejemplo:
  // this.$refs.slider.updateValue(newValue);
});

onMounted(() => {
  fetchMedia();
  fetchGenres();
  fetchMediaShowType();
});
</script>