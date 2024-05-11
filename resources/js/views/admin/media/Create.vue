<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h1 class="titulo-media">Añade un nuevo medio show</h1>
            </div>

            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strSuccess }}</strong>
            </div>

            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strError }}</strong>
            </div>

            <!-- <p>{{ media }}</p> -->

            <form @submit.prevent="addMedia(media)" enctype="multipart/form-data">
                <div class="form-group mb-2">
                    <label class="mb-3">Tipo de Media Show</label>
                    <select v-model="media.id_media_show_type" class="mb-2">
                        <option v-for="mediaShowType in mediaShowTypes" :key="mediaShowType.id" :value="mediaShowType.id">{{ mediaShowType.type }}</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Titulo</label>
                    <input v-model="media.nombre" type="text" class="input-formulario">
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Sinopsis corta</label>
                    <input v-model="media.sinopsis_corta" class="input-formulario">
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Sinopsis larga</label>
                    <textarea v-model="media.sinopsis" rows="3" class="input-formulario"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Pemi</label>
                    <select v-model="media.id_pemi">
                        <option v-for="pemi in pemis" :key="pemi.id" :value="pemi.id">{{ pemi.number_pemi }}</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Género</label>
                    <MultiSelect multiple v-model="selectedGenres" :options="genres" filter optionLabel="name_genre" optionValue="id" placeholder="Select genres" :maxSelectedLabels="3" class="w-full md:w-20rem" />
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">País de origen</label>
                    <select v-model="media.id_country" class="mb-2">
                        <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Duración (HH:MM:SS)</label>
                    <input v-model="media.duracion" class="input-formulario" type="text" name="duration" pattern="^([0-9]{2}):([0-5][0-9]):([0-5][0-9])$" title="Ingrese la duración en el formato HH:MM:SS"/>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Actores</label>
                    <input v-model="media.actores" class="input-formulario" type="text" name="actors"/>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Portada</label>
                    <DropZone v-model="media.portada_img" />
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Idioma</label>
                    <input v-model="media.idioma" class="input-formulario" type="text" name="language"/>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Directores</label>
                    <input v-model="media.directores" class="input-formulario" type="text" name="directors"/>
                </div>
                <!-- <div class="form-group mb-2">
                    <label>Trailer</label>
                    <DropZone v-model="media.trailer" />
                </div> -->
                <div class="form-group mb-2">
                    <label class="mb-3">Fecha de estreno</label>
                    <input v-model="media.fecha_media_show" class="input-formulario" type="datetime-local" name="release_date"/>
                </div>
                <div class="form-group mb-2" v-if="media.id_media_show_type === 1">
                    <label class="mb-3">Saga</label>
                    <input v-model="media.saga" class="input-formulario" type="text" name="saga"/>
                </div>
                <div v-else-if="media.id_media_show_type === 2">
                    <div class="form-group mb-2">
                        <label class="mb-3">Temporadas</label>
                        <input v-model="media.temporadas" class="input-formulario" type="number" name="seasons"/>
                    </div>
                    <div class="form-group mb-2">
                        <label class="mb-3">Episodios</label>
                        <input v-model="media.episodios" class="input-formulario" type="number" name="episodes"/>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary boton-principal mt-4 mb-4">Añadir Media Show</button>
            </form>
        </div>
    </div>
</template>

<script setup>

    import axios from 'axios';
    import { onMounted, ref } from 'vue';
    import { useGetMedia } from '@/composables/media';
    import DropZone from "@/components/DropZone.vue";

    const selectedGenres = ref([]);
    const strError = ref('');
    const strSuccess = ref('');
    const genres = ref([]);
    const countries = ref([]);
    const mediaShowTypes = ref([]);
    const pemis = ref([]);  

    const { addMedia } = useGetMedia(); 

    const media = ref({ 
        nombre: '',
        id_pemi: '', 
        duracion: '', 
        id_country:'', 
        actores: '', 
        portada_img: '', 
        idioma: '', 
        directores: '',
        sinopsis:'',
        sinopsis_corta: '',
        id_media_show_type: '',
        // trailer: '', 
        fecha_media_show: '', 
        saga: '', 
        temporadas: '',
        genres: selectedGenres,
        episodios: '' 
    });
    
    onMounted(async () => {
        try {

            const genresResponse = await axios.get('/api/genres');
            genres.value = genresResponse.data;

            const countriesResponse = await axios.get('/api/countries');
            countries.value = countriesResponse.data;

            const mediaShowTypesResponse = await axios.get('/api/mediaShowType');
            mediaShowTypes.value = mediaShowTypesResponse.data;

            const pemisResponse = await axios.get('/api/pemis');
            pemis.value = pemisResponse.data;
           

        } catch (error) {
            console.error('Error al cargar los géneros y países:', error);
        }
    });

</script>