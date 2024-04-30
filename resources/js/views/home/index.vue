<template>
    <div class="banner-container">
        <div class="banner-img relative">
            <div class="sombra"></div>
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
                                <router-link :to="{ name: 'media.view', params: { id: data.id } }">
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
                                <div class="id-pemi-box color-pemi text-light px-2 py-1 rounded">
                                    <p class="m-0">+{{ data.pemi_name }}</p>
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
                    <div class="genre-card" v-for="genre in GetGenres" :key="genre.id">
                        <h4>{{ genre.name_genre }}</h4>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div v-for="genrebymedia in GetMediaShowByGenre">
                <h3 class="titulo_slider">Género {{genrebymedia.name_genre}}</h3>
                <Carousel :value="genrebymedia.media_shows" :numVisible="3" :numScroll="3" :responsiveOptions="responsiveOptions" :showIndicators="false">
                    <template #item="{ data }">
                        <div class="card-slider p-5" @mouseover="handleMouseOver" @mouseleave="handleMouseLeave">
                            <div class="mb-1">
                                <div class="font-medium mt-1">
                                    <h3>{{ data.nombre }}</h3>
                                </div>
                                <div class="d-flex align-items-center mt-5">
                                    <router-link :to="{ name: 'media.view', params: { id: data.id } }">
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
                                    <div class="id-pemi-box color-pemi text-light px-2 py-1 rounded">
                                        <p class="m-0">+{{ data.pemi.number_pemi }}</p>
                                    </div>
                                </div>
                                <div class="mt-3"><p>{{ data.sinopsis_corta }}</p></div>
                            </div>
                        </div>
                    </template>
                </Carousel>
            </div>
        </section>
        <button v-if="showScrollButton" class="scroll-top-button" @click="scrollToTop" title="Subir hacia arriba"></button>
    <AppFooter />
</template>

<script setup>

    import { ref, onMounted, onBeforeUnmount } from 'vue';
    import { useGetMedia } from '@/composables/media';
    import { useGetGenres } from '@/composables/genres';
    import AppFooter from '@/layouts/AppFooter.vue';
    import { useRouter } from "vue-router";

    const showScrollButton = ref(false);

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

    // Obtenemos todas las media shows:
    const { Getmedias, loading: loadingMedia, fetchMediaInverse } = useGetMedia();
    const { GetGenres, loading: loadingGenre, fetchGenres } = useGetGenres();
    const { GetMediaShowByGenre, fetchMediaShowByGenre } = useGetGenres();

    console.log(GetMediaShowByGenre)
    // Variable que al darle clic al botón de play, nos lleve a la vista de la media show en particular:
    const router = useRouter();

    // Función para redirigir a la vista de ver una media show en concreto:
    const viewMedia = async (id) => {
        try {
            // Redirigir a la vista de ver media show
            router.push({ name: 'media.view', params: { id: id } });
        } catch (error) {
            console.error('Error fetching media data:', error);
        }
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

    onMounted(async () => {
        try {
            await fetchMediaInverse();
            await fetchGenres();
            await fetchMediaShowByGenre();
            window.addEventListener('scroll', handleScroll);
        } catch (error) {
            console.error('Error fetching media:', error);
        }
    });

    // Eliminaremos el listener del evento de scroll cuando el componente es destruido:
    onBeforeUnmount(() => {
        window.removeEventListener('scroll', handleScroll);
    });

</script>