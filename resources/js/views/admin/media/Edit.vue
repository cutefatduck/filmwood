<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Edita este Media Show</h5>
            </div>

            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strSuccess }}</strong>
            </div>
            
            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strError }}</strong>
            </div>

            <form @submit.prevent="editMedia">

                <!-- Agregamos el ID del media show en concreto en oculto -->
                <input type="hidden" v-model="media.id">
                
                <div class="form-group mb-2">
                    <label>Titulo</label>
                    <input v-model="media.nombre" type="text" class="input_formulario">
                </div>

                <div class="form-group mb-2">
                    <label>Tipo de Media Show</label>
                    <select v-model="media.id_media_show_type" v-if="!loading" @change="updateFormFields">
                        <option v-for="mediaShowType in mediaShowTypes" :key="mediaShowType.id" :value="mediaShowType.id">{{ mediaShowType.type }}</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label>Sinopsis corta</label>
                    <textarea v-model="media.sinopsis_corta" class="input_formulario"></textarea>
                </div>

                <div class="form-group mb-2">
                    <label>Sinopsis larga</label>
                    <textarea v-model="media.sinopsis" rows="3" class="input_formulario"></textarea>
                </div>

                <div class="form-group mb-2">
                    <label>Pemi</label>
                    <select v-model="media.pemi_id" v-if="!loading">
                        <option v-for="pemi in pemis" :key="pemi.id" :value="pemi.id">{{ pemi.number_pemi }}</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label>Género</label>
                    <select v-model="media.genre_id" v-if="!loading">
                        <option v-for="genre in genres" :key="genre.id" :value="genre.id">{{ genre.name_genre }}</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label>País de origen</label>
                    <select v-model="media.pais_origen" v-if="!loading">
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
                    <img v-if="media.portada_img" :src="media.portada_img" alt="Portada del Media Show" class="img-fluid mt-2" style="max-height: 200px;">
                    <br>
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
                    
                    <video v-if="media.trailer" controls class="mt-2" style="max-width: 100%;">
                        <source :src="media.trailer" type="video/mp4">
                        Tu navegador no soporta el elemento de video.
                    </video><br>
                    <input class="input_formulario" type="file" name="trailer" accept=".mp4" @change="handleFileChange($event, 'video')"/>
                </div>

                <div class="form-group mb-2">
                    <label>Fecha de estreno</label>
                    <input v-model="media.fecha_estreno" class="input_formulario" type="date" name="release_date"/>
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

                <button type="submit" class="btn btn-primary mt-4 mb-4">Editar Media Show</button>
            </form>
        </div>
    </div>
    <AppFooter />
</template>

<script setup>

    import { onMounted, ref } from 'vue';
    import axios from 'axios';
    import { useRouter } from 'vue-router';
    import AppFooter from '@/layouts/AppFooter.vue';

    const router = useRouter();

    const mediaId = router.currentRoute.value.params.mediaId;

    const media = ref({
        id: '',
        nombre: '',
        id_media_show_type: '',
        sinopsis_corta: '',
        sinopsis: '',
        pemi_id: null,
        genre_id: null,
        duracion: '',
        actores: '',
        portada_img: '',
        idioma: '',
        directores: '',
        trailer: '',
        fecha_estreno: '',
        saga: '',
        temporadas: null,
        episodios: null,
        pais_origen:'',
    });

    const strError = ref('');
    const strSuccess = ref('');

    const loading = ref(true);

    onMounted(async () => {
        try {
            const response = await axios.get(`/api/media/${mediaId}`);
            const data = response.data.data;

            // Ajustar el formato de la fecha sin horas y minutos
            const fechaEstreno = new Date(data.fecha_media_show);
            const fechaSinHorasMinutos = new Date(fechaEstreno.getFullYear(), fechaEstreno.getMonth(), fechaEstreno.getDate());

            media.value.id_media_show_type = data.id_media_show_type;
            media.value.nombre = data.nombre;
            media.value.pemi_id = data.id_pemi;
            media.value.genre_id = data.id_genere;
            media.value.duracion = data.duracion;
            media.value.actores = data.actores;
            media.value.portada_img = data.portada_img;
            media.value.idioma = data.idioma;
            media.value.directores = data.directores;
            media.value.trailer = data.trailer;
            media.value.fecha_estreno = fechaSinHorasMinutos.toISOString().slice(0, 10);
            media.value.saga = data.saga;
            media.value.temporadas = data.temporadas;
            media.value.episodios = data.episodios;
            media.value.pais_origen = data.id_country;
            media.value.sinopsis_corta = data.sinopsis_corta;
            media.value.sinopsis = data.sinopsis;
            loading.value = false; // Indica que los datos han sido cargados
        } catch (error) {
            console.error('Error al cargar los datos del medio show:', error);
            strError.value = 'Error al cargar los datos del medio show';
        }
    });

    const editMedia = async () => {
        try {
            const response = await axios.put(`/api/media/${mediaId}`, media.value);
            console.log('Media Show editado:', response.data);
            strSuccess.value = 'Media Show editado correctamente';
        } catch (error) {
            console.error('Error al editar el Media Show:', error);
            strError.value = 'Error al editar el Media Show';
        }
    };

    const handleFileChange = (event, type) => {
        // Manejo del cambio de archivo
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