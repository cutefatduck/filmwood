<template>
    <div class="banner-container">
        <div class="banner-img"></div>
    </div>
    <div class="relative flex items-top justify-center fondo-pagina">
        <div class="">
            <Carousel :value="medias" :numVisible="3" :numScroll="1" :responsiveOptions="responsiveOptions">
                <template #item="{ data }">
                    <div class="card-slider">
                        <div class="mb-3">
                            <!-- Show media title and synopsis here -->
                            <div class="font-medium"><h3>{{ data.nombre }}</h3></div>
                            <div><p>{{ data.sinopsis }}</p></div>
                        </div>
                    </div>
                </template>
            </Carousel>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, inject } from "vue";
import axios from "axios";

const medias = ref([]);
const swal = inject('$swal');

onMounted(() => {
    axios.get('/api/media')
        .then(response => {
            medias.value = response.data;
        })
        .catch(error => {
            console.error('Error fetching media:', error);
        });
});
</script>