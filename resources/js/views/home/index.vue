<template>
    <div class="banner-container">
        <div class="banner-img relative">
            <div class="sombra"></div>
        </div>
    </div>
    <section class="row">
        <div class="col-lg-6 ms-lg-5 offset-sm-1">
            <h2 class="titulo-slider mt-6 mx-6">Lo más nuevo</h2>
        </div>
        <Carousel :value="Getmedias.data" :numVisible="3" :numScroll="3" :responsiveOptions="responsiveOptions" :showIndicators="false">
            <template #item="{ data }">
                <div class="card-slider p-5" @mouseover="handleMouseOver" @mouseleave="handleMouseLeave">
                    <div class="mb-1">
                        <div class="mb-1">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-center justify-content-md-start">
                                        <router-link :to="{ name: 'media.view', params: { id: data.id } }">
                                            <img :src="data?.portada_img" alt="Portada del Media Show" class="poster-image-home">
                                        </router-link>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex flex-column justify-content-center mt-3">
                                        <div class="titulo-card"><h3>{{ data.nombre }}</h3></div>
                                        <div class="d-flex align-items-center mt-3 mb-3">
                                            <router-link :to="{ name: 'media.view', params: { id: data.id } }">
                                                <img class="play-button me-3" src="/images/play-button.svg">
                                            </router-link>
                                            <span class="me-4 visitar">Visitar</span>
                                        </div>
                                        <div v-if="data.genres && data.genres.length">
                                            <span class="visitar movie-genre-details" v-for="(genre, index) in data.genres" :key="index">
                                                <Tag value="secondary">{{ genre.name_genre }}</Tag>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-5">
                            <div class="me-3">
                                <p>{{ data.fecha_media_show }}</p>
                            </div>
                            <div class="me-3">
                                <p>{{ formateoDuracion(data.duracion) }}</p>
                            </div>
                            <div class="id-pemi-box color-pemi text-light px-2 py-1 rounded">
                                <p class="m-0">+{{ data.pemi }}</p>
                            </div>
                        </div>
                        <div class="mt-3"><p>{{ data.sinopsis_corta }}</p></div>
                    </div>
                </div>
            </template>
        </Carousel>
    </section>
    <section class="row">
        <div class="col-lg-6 ms-lg-5 offset-sm-1">
            <h2 class="titulo-slider mt-3 mb-2 mx-6">Géneros</h2>
        </div>
        <div class="row mx-auto mb-3 mt-3 generos-container col-xxl-3 col-md-6 col-lg-4 col-sm-6 col-xl-4">
            <div class="col-xxl-2 col-md-6 col-lg-4 mx-0 px-0 mt-4 col-sm-6 col-xl-4" v-for="genre in GetGenres" :key="genre.id">
                <div class="genre-card mx-0 px-0">
                    <h4 class="mx-0 px-0">{{ genre.name_genre }}</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="row">
        <div v-for="genrebymedia in GetMediaShowByGenre" :key="genrebymedia.name_genre">
            <div class="col-lg-6 ms-lg-5 offset-sm-1">
                <h2 class="titulo-slider mt-4 mx-6">Género de {{genrebymedia.name_genre}}</h2>
            </div>
            <Carousel :value="genrebymedia.media_shows" :numVisible="3" :numScroll="3" :responsiveOptions="responsiveOptions" :showIndicators="false">
                <template #item="{ data }">
                    <div class="card-slider p-5" @mouseover="handleMouseOver" @mouseleave="handleMouseLeave">
                        <div class="mb-1">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-center justify-content-md-start">
                                        <router-link :to="{ name: 'media.view', params: { id: data.id } }">
                                            <img :src="data?.portada_img" alt="Portada del Media Show" class="poster-image-home">
                                        </router-link>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex flex-column justify-content-center mt-3">
                                        <div class="titulo-card"><h3>{{ data.nombre }}</h3></div>
                                        <div class="d-flex align-items-center mt-3 mb-3">
                                            <router-link :to="{ name: 'media.view', params: { id: data.id } }">
                                                <img class="play-button me-3" src="/images/play-button.svg">
                                            </router-link>
                                            <span class="me-4 visitar">Visitar</span>
                                        </div>
                                        <div v-if="data.genres && data.genres.length">
                                            <span class="visitar movie-genre-details" v-for="(genre, index) in data.genres" :key="index">
                                                <Tag value="secondary">{{ genre.name_genre }}</Tag>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-5">
                            <div class="me-3">
                                <p>{{ data.fecha_media_show }}</p>
                            </div>
                            <div class="me-3">
                                <p>{{ formateoDuracion(data.duracion) }}</p>
                            </div>
                            <div class="id-pemi-box color-pemi text-light px-2 py-1 rounded">
                                <p class="m-0">+{{ data.pemi.number_pemi }}</p>
                            </div>
                        </div>
                        <div class="mt-3"><p>{{ data.sinopsis_corta }}</p></div>
                    </div>
                </template>
            </Carousel>
        </div>
    </section>
    <button v-if="showScrollButton" class="scroll-top-button" @click="scrollToTop" title="Subir hacia arriba"></button>
    <AppFooter />
</template>

<script setup>

    import { ref, computed, onMounted, onUpdated, onBeforeUnmount } from 'vue';
    import { useGetMedia } from '@/composables/media';
    import { useGetGenres } from '@/composables/genres';
    import AppFooter from '@/layouts/AppFooter.vue';
    import { useRouter } from "vue-router";

    const { Getmedias, loading: loadingMedia, fetchMediaIndex } = useGetMedia();
    const { GetMediaShowByGenre, fetchMediaShowByGenre, fetchGenres, GetGenres } = useGetGenres();

    const showScrollButton = ref(false);
    const user = computed(() => store.getters["auth/user"]);

    let true1 = []
    
    // Función para mostrar u ocultar el botón de scroll según la posición del usuario:
    const handleScroll = () => {
        const scrollPosition = window.scrollY || document.documentElement.scrollTop;
        // Mostrar el botón cuando el usuario ha scrollado más allá de cierta posición:
        showScrollButton.value = scrollPosition > 300;
    };


    // Función para hacer scroll hacia arriba
    const scrollToTop = () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    };

    // Función para hacer el responsive de los carruseles:
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

    // Variable que al darle clic al botón de play, nos lleve a la vista de la media show en particular:
    const router = useRouter();

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
            await fetchMediaIndex();
            await fetchGenres();
            await fetchMediaShowByGenre();
            window.addEventListener('scroll', handleScroll);
        } catch (error) {
            console.error('Error fetching media:', error);
        }
    });

    onUpdated( async() => {
      try {

      } catch (error) {
        console.error('Error al cargar los datos del medio show:', error);
      }
    });

    // Eliminaremos el listener del evento de scroll cuando el componente es destruido:
    onBeforeUnmount(() => {
        window.removeEventListener('scroll', handleScroll);
    });

</script>