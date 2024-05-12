<template>
    <div class="contenedor-general-movie">
        <div class="filtros">
            <Dropdown class="filter-dropdown w-full md:w-14rem me-4 ms-lg-5 offset-sm-1" v-model="filters.selectedType" :options="mediaShowTypes" optionLabel="type" placeholder="Tipo" />
            <Dropdown class="filter-dropdown w-full md:w-14rem me-4" v-model="filters.selectedGenre" filter :options="GetGenres" optionLabel="name_genre" placeholder="Genero" />
            <Dropdown class="filter-dropdown w-full md:w-14rem me-4" v-model="filters.selectedValoration" filter :options="GetGenres" optionLabel="name_genre" placeholder="Valoraciones" />
        </div>
        <div class="row"> 
            <div class="col-xxl-4 col-lg-6 col-sm-12" v-for="media in Getmedias" :key="media.id">
                <div class="card-slider p-5">
                    <div class="mb-1">
                        <div class="font-medium mt-1">
                            <h3>{{ media.nombre }}</h3>
                        </div>
                        <div class="d-flex align-items-center mt-5">
                            <router-link :to="{ name: 'media.view', params: { id: media.id } }">
                                <img class="play-button me-3" src="/images/play-button.svg">
                            </router-link>
                            <span class="me-5 visitar">Visitar</span>
                            <div class="ms-auto">
                                <div v-if="media.genres && media.genres.length">
                                    <span class="visitar movie-genre-details" v-for="(genre, index) in media.genres" :key="index">
                                        <Tag value="p-tag2 secondary">{{ genre.name_genre }}</Tag>
                                     </span>
                                </div>
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
                        <div class="mt-3">
                            <p>{{ media.sinopsis_corta }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <AppFooter />
    </div>
</template>

<script setup>

    import { ref, onMounted, watch, computed } from 'vue';
    import AppFooter from '@/layouts/AppFooter.vue';
    import { useGetMedia } from '@/composables/media';
    import { useGetMediaShowType } from '@/composables/mediaShowType';
    import { useGetGenres } from '@/composables/genres';

    const { GetGenres, loading: loadingGenre, fetchGenres } = useGetGenres();
    const { Getmedias, loading: loadingMedia, fetchMedia } = useGetMedia();
    const { mediaShowTypes, loading: loadingTypes, fetchMediaShowType } = useGetMediaShowType();

    // const selectedGenre = ref();
    // const selectedType = ref();
    // const selectedDate = ref([new Date().getFullYear(), new Date().getFullYear()]); // Rango de fechas por defecto

    const today = new Date();
    const currentYear = today.getFullYear();
    const lastYear = 1910;

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

    const filters = ref({
        selectedGenre: '',
        selectedType: '',
        selectedValoration: ''
    });

    onMounted(() => {
        fetchMedia();
        fetchGenres();
        fetchMediaShowType();
    });
    
</script>