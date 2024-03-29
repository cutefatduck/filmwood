<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade un nuevo medio show</h5>
            </div>

            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strSuccess }}</strong>
            </div>

            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strError }}</strong>
            </div>

            <form @submit.prevent="addMedia">

                <div class="form-group mb-2">
                    <label>Tipo de Media Show</label>
                    <select v-model="media.id_media_show_type">
                        <option v-for="mediaShowType in mediaShowTypes" :key="mediaShowType.id" :value="mediaShowType.id">{{ mediaShowType.type }}</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label>Titulo pelicula</label>
                    <input v-model="media.nombre" type="text" class="input_formulario">
                </div>

                <div class="form-group mb-2">
                    <label>Sinopsis corta</label>
                    <input v-model="media.sinopsis_corta" class="input_formulario">
                </div>

                <div class="form-group mb-2">
                    <label>Sinopsis larga</label>
                    <textarea v-model="media.sinopsis" rows="3" class="input_formulario"></textarea>
                </div>

                <div class="form-group mb-2">
                    <label>Pemi</label>
                    <select v-model="media.pemi_id">
                        <option v-for="pemi in pemis" :key="pemi.id" :value="pemi.id">{{ pemi.number_pemi }}</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label>Género</label>
                    <select v-model="media.genre_id">
                        <option v-for="genre in genres" :key="genre.id" :value="genre.id">{{ genre.name_genre }}</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label>País de origen</label>
                    <select v-model="media.pais_origen">
                        <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label>Duración (HH:MM:SS)</label>
                    <input v-model="media.duracion" class="input_formulario" type="text" name="duration" pattern="^([0-9]{2}):([0-5][0-9]):([0-5][0-9])$" title="Ingrese la duración en el formato HH:MM:SS"/>
                </div>

                <div class="form-group mb-2">
                    <label>Actores</label>
                    <input v-model="media.actores" class="input_formulario" type="text" name="actors"/>
                </div>

                <div class="form-group mb-2">
                    <label>Portada</label>
                    <input class="input_formulario" type="file" name="cover_image" accept=".jpg, .png, .jpeg" @change="handleFileChange($event, 'image')"/>
                </div>

                <div class="form-group mb-2">
                    <label>Idioma</label>
                    <input v-model="media.idioma" class="input_formulario" type="text" name="language"/>
                </div>

                <div class="form-group mb-2">
                    <label>Directores</label>
                    <input v-model="media.directores" class="input_formulario" type="text" name="directors"/>
                </div>

                <div class="form-group mb-2">
                    <label>Trailer</label>
                    <input class="input_formulario" type="file" name="trailer" accept=".mp4" @change="handleFileChange($event, 'video')"/>
                </div>

                <div class="form-group mb-2">
                    <label>Fecha estreno</label>
                    <input v-model="media.fecha_estreno" class="input_formulario" type="datetime-local" name="release_date"/>
                </div>

                <div class="form-group mb-2" v-if="media.id_media_show_type === 1">
                    <label>Saga</label>
                    <input v-model="media.saga" class="input_formulario" type="text" name="saga"/>
                </div>

                <div v-else-if="media.id_media_show_type === 2">
                    <div class="form-group mb-2">
                        <label>Temporadas</label>
                        <input v-model="media.temporadas" class="input_formulario" type="number" name="seasons"/>
                    </div>
                    <div class="form-group mb-2">
                        <label>Episodios</label>
                        <input v-model="media.episodios" class="input_formulario" type="number" name="episodes"/>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir Media Show</button>
            </form>
        </div>
    </div>
</template>

<script setup>
    import axios from 'axios';
    import { onMounted, ref } from 'vue';
    import { useAddMedia } from '@/composables/media';

    const media = ref({ pemi_id: null, genre_id: null, duracion: '', actores: '', portada_img: '', idioma: '', directores: '', trailer: '', fecha_estreno: '', saga: '', temporadas: null, episodios: null, pais_origen: '' });
    const strError = ref('');
    const strSuccess = ref('');

    const addMedia = () => {
    console.log('Intentando agregar un nuevo media show...');
    console.log('Datos del medio:', media.value);
    axios.post('/api/media', media.value)
        .then(response => {
            strSuccess.value = response.data.success;
            strError.value = '';
        }).catch(error => {
            strError.value = error.response.data.message;
            strSuccess.value = '';
        });
};

    const genres = ref([]);
    const countries = ref([]);
    const mediaShowTypes = ref([]);
    const pemis = ref([]);  

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