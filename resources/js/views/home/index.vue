<template>
    <div class="banner-container">
        <div class="banner-img relative">
        <div class="sombra"></div>
        <div :class="searchBarClass">
            <InputText placeholder="Search" type="text" class="custom-search-input" />
            <div class="search-icon">
                <button @click="search" class="search-button">
                    <i class="pi pi-search"></i>
                </button>
            </div>
        </div>
        </div>
    </div>
    <section>   
        <h3 class="titulo_slider mt-6">Nuevo en Filmwood</h3>
            <Carousel :value="Getmedias" :numVisible="3" :numScroll="3" :responsiveOptions="responsiveOptions" :showIndicators="false">
                <template #item="{ data }">
                    <div class="card-slider p-5" @mouseover="handleMouseOver" @mouseleave="handleMouseLeave">
                        <div class="mb-1">
                            <div class="font-medium mt-1">
                                <h3>{{ data.nombre }}</h3>
                            </div>
                            <div class="d-flex align-items-center mt-5">
                                <router-link :to="{ name: 'media.view', params: { mediaId: data.id } }">
                                    <button class="play-button me-3" @click="viewMedia(data.id)"></button>
                                </router-link>
                                <span class="me-5 visitar">Visitar</span>
                                <div class="ms-auto">
                                    <button class="star-button me-3"></button>
                                    <button class="plus-button"></button>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-5">
                                <div class="me-3">
                                    <p>{{ data.fecha_media_show }}</p>
                                </div>
                                <div class="me-3">
                                    <p>{{ formateoDuracion(data.duracion) }}</p>
                                </div>
                                <div class="id-pemi-box fondo_pemi text-light px-2 py-1 rounded">
                                    <p class="m-0">{{ getPemiText(data.id_pemi) }}</p>
                                </div>
                            </div>
                            <div class="mt-3"><p>{{ data.sinopsis_corta }}</p></div>
                        </div>
                    </div>
                </template>
            </Carousel>
        </section>
        <section>
            <h3 class="titulo_slider">Géneros</h3>
            <div class="genres-wrapper" :responsiveOptions="responsiveOptions" :showIndicators="false">
                <div class="genres-container">
                    <div class="genre-card" v-for="genre in genres" :key="genre.id">
                        <h4>{{ genre.name_genre }}</h4>
                    </div>
                </div>
            </div>
        </section>
        <section> 
            <h3 class="titulo_slider">Peliculas de terror</h3>
            <Carousel :value="terrorMovies" :numVisible="3" :numScroll="3" :responsiveOptions="responsiveOptions" :showIndicators="false">
                <template #item="{ data }">
                    <div class="card-slider p-5" @mouseover="handleMouseOver" @mouseleave="handleMouseLeave">
                        <div class="mb-1">
                            <div class="font-medium mt-1">
                                <h3>{{ data.nombre }}</h3>
                            </div>
                            <div class="d-flex align-items-center mt-5">
                                <router-link :to="{ name: 'media.view', params: { mediaId: data.id } }">
                                    <button class="play-button me-3" @click="viewMedia(data.id)"></button>
                                </router-link>
                                <span class="me-5 visitar">Visitar</span>
                                <div class="ms-auto">
                                    <button class="star-button me-3"></button>
                                    <button class="plus-button"></button>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-5">
                                <div class="me-3">
                                    <p>{{ data.fecha_media_show }}</p>
                                </div>
                                <div class="me-3">
                                    <p>{{ formateoDuracion(data.duracion) }}</p>
                                </div>
                                <div class="id-pemi-box fondo_pemi text-light px-2 py-1 rounded">
                                    <p class="m-0">{{ getPemiText(data.id_pemi) }}</p>
                                </div>
                            </div>
                            <div class="mt-3"><p>{{ data.sinopsis_corta }}</p></div>
                        </div>
                    </div>
                </template>
            </Carousel>
        </section>
        <section> 
            <h3 class="titulo_slider">Peliculas de Western</h3>
            <Carousel :value="westernMovies" :numVisible="3" :numScroll="3" :responsiveOptions="responsiveOptions" :showIndicators="false">
                <template #item="{ data }">
                    <div class="card-slider p-5" @mouseover="handleMouseOver" @mouseleave="handleMouseLeave">
                        <div class="mb-1">
                            <div class="font-medium mt-1">
                                <h3>{{ data.nombre }}</h3>
                            </div>
                            <div class="d-flex align-items-center mt-5">
                                <router-link :to="{ name: 'media.view', params: { mediaId: data.id } }">
                                    <button class="play-button me-3" @click="viewMedia(data.id)"></button>
                                </router-link>
                                <span class="me-5 visitar">Visitar</span>
                                <div class="ms-auto">
                                    <button class="star-button me-3"></button>
                                    <button class="plus-button"></button>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-5">
                                <div class="me-3">
                                    <p>{{ data.fecha_media_show }}</p>
                                </div>
                                <div class="me-3">
                                    <p>{{ formateoDuracion(data.duracion) }}</p>
                                </div>
                                <div class="id-pemi-box fondo_pemi text-light px-2 py-1 rounded">
                                    <p class="m-0">{{ getPemiText(data.id_pemi) }}</p>
                                </div>
                            </div>
                            <div class="mt-3"><p>{{ data.sinopsis_corta }}</p></div>
                        </div>
                    </div>
                </template>
            </Carousel>
        </section>
    <AppFooter />
</template>

<script setup>
    import { ref, onMounted, computed } from 'vue';
    import axios from 'axios';
    import { useGetMedia } from '@/composables/media';
    import { useGetGenres } from '@/composables/genres';
    import AppFooter from '@/layouts/AppFooter.vue';
    import { useRouter } from "vue-router";

    // Obtenemos todas las media shows:
    const { Getmedias, loading: loadingMedia, fetchMedia } = useGetMedia();

    // Al darle clic al botón de play, nos lleve a la vista de la media show en particular:
    const router = useRouter();

    // Función para redirigir a la vista de ver media show
    const viewMedia = async (id) => {
        try {
            // Redirigir a la vista de ver media show
            router.push({ name: 'media.view', params: { mediaId: id } });
        } catch (error) {
            console.error('Error fetching media data:', error);
        }
    };

    // Buscador
    const searchBarFixed = ref(false);
    window.addEventListener('scroll', () => {
        // Verificamos si el usuario ha hecho scroll hacia abajo
        searchBarFixed.value = window.scrollY > 0;
    });
    const searchBarClass = computed(() => ({
        'search-bar': true,
        'search-bar-fixed': searchBarFixed.value,
    }));
    const search = () => {
        // Lógica para realizar la búsqueda
    };

    // Sección de géneros:
    const genres = ref([
        { id: 1, name_genre: 'Acción' },
        { id: 2, name_genre: 'Aventura' },
        { id: 3, name_genre: 'Animación' },
        { id: 4, name_genre: 'Terror' },
        { id: 5, name_genre: 'Ciencia Ficción' },
        { id: 6, name_genre: 'Comedia' },
        { id: 7, name_genre: 'Drama' },
        { id: 8, name_genre: 'Bélico' },
        { id: 9, name_genre: 'Thriller' },
        { id: 10, name_genre: 'Western' },
        { id: 11, name_genre: 'Suspense' },
        { id: 12, name_genre: 'Familiar' },
    ]);

    // Variable para almacenar las películas de género terror:
    const terrorMovies = ref([]);
    const westernMovies = ref([]);

    // Función para cargar las películas de terror
    const loadTerrorMovies = async () => {
        try {
            const response = await axios.get('api/terror-media');
            terrorMovies.value = response.data;
        } catch (error) {
            console.error('Error fetching terror movies:', error);
        }
    };

    // Función para cargar las películas de género western:
    const loadWesternMovies = async () => {
        try {
            const response = await axios.get('api/western-media');
            westernMovies.value = response.data;
        } catch (error) {
            console.error('Error fetching western movies:', error);
        }
    };

    // Formateamos el pemi que mostraremos:
    const getPemiText = (id_pemi) => {
        switch (id_pemi) {
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

    // Responsive de los elementos:
    const responsiveOptions = ref([
        {
            breakpoint: '1100px',
            numVisible: 2,
            numScroll: 1,
        },
        {
            breakpoint: '900px',
            numVisible: 1,
            numScroll: 1,
        },
    ]);

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
            await fetchMedia();
            await loadTerrorMovies();
            await loadWesternMovies();
        } catch (error) {
            console.error('Error fetching media:', error);
        }
    });

</script>