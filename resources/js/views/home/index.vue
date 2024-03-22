<template>
    <div class="banner-container">
        <div class="banner-img"></div>
    </div>
    <div class="relative flex items-top justify-center fondo-pagina">
        <Carousel :value="Getmedias" :numVisible="3" :numScroll="1" :responsiveOptions="responsiveOptions">
            <template #item="{ data }">
                <div class="card-slider">
                    <div class="mb-3">
                        <div class="font-medium"><h3>{{ data.nombre }}</h3></div>
                        <div><p>{{ data.sinopsis }}</p></div>
                    </div>
                </div>
            </template>
        </Carousel>
    </div>
</template>

<script setup>
import { ref, onMounted, inject } from "vue";
import { useGetMedia } from '@/composables/media';

const { Getmedias, loading: loadingMedia, fetchMedia } = useGetMedia();
const swal = inject('$swal');

onMounted(() => {
    fetchMedia();
});



const responsiveOptions = ref([
    {
        breakpoint: '1300px',
        numVisible: 2,
        numScroll: 1
    },
    {
        breakpoint: '730px',
        numVisible: 1,
        numScroll: 1
    }
]);
</script>