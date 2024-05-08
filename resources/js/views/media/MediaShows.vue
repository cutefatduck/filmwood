<template>
    <div class="contenedor-general-movie">
        <div class="filtros">
            {{ filters.selectedType }}
            {{ filters.selectedGenre }}
            <Dropdown class="filter-dropdown w-full md:w-14rem me-4 ms-lg-5 offset-sm-1" v-model="filters.selectedType" :options="mediaShowTypes" optionLabel="type" placeholder="Tipo" />
            <Dropdown class="filter-dropdown w-full md:w-14rem me-4" v-model="filters.selectedGenre" filter :options="GetGenres" optionLabel="name_genre" placeholder="Genero" />
            <Dropdown class="filter-dropdown w-full md:w-14rem me-4" v-model="filters.selectedValoration" filter :options="GetGenres" optionLabel="name_genre" placeholder="Valoraciones" />
        </div>
        <div class="row">
            <template v-for="media in Getmedias" :responsiveOptions="responsiveOptions" :showIndicators="false">
                <div class="col-4 d-flex">
                    <div class="card-slider p-5" @mouseover="handleMouseOver" @mouseleave="handleMouseLeave">
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
                                    <img class="favorite-button me-3" src="/images/no_like_home.svg">
                                    <img class="visualizated-button me-3" src="/images/no_visualization_home.svg">
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

    const responsiveOptions = ref([
        {
            breakpoint: '1300px',
            numVisible: 2,
            numScroll: 1,
        },
        {
            breakpoint: '925px',
            numVisible: 1,
            numScroll: 1,
        },
    ]);

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