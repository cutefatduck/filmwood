<template>
    <div class="card">
        <div class="card-body">
            <form>
                <div class="form-group mb-2">
                    <label>Titulo</label>
                    <input v-model="media.nombre" type="text" class="input_formulario" disabled>
                </div>

                <div class="form-group mb-2">
                    <label>Tipo de Media Show</label>
                    <input :value="getMediaShowTypeName(media.id_media_show_type)" type="text" class="input_formulario" disabled>
                </div>

                <div class="form-group mb-2">
                    <label>Género</label>
                    <input :value="getGenreName(media.genre_id)" type="text" class="input_formulario" disabled>
                </div>

                <div class="form-group mb-2">
                    <label>Sinopsis corta</label>
                    <textarea v-model="media.sinopsis_corta" class="input_formulario" disabled></textarea>
                </div>

                <div class="form-group mb-2">
                    <label>Sinopsis larga</label>
                    <textarea v-model="media.sinopsis" rows="3" class="input_formulario" disabled></textarea>
                </div>

                <div class="form-group mb-2">
                    <label>Duración (HH:MM:SS)</label>
                    <input v-model="media.duracion" class="input_formulario" type="text" name="duration" pattern="^([0-9]{2}):([0-5][0-9]):([0-5][0-9])$" disabled/>
                </div>

                <div class="form-group mb-2">
                    <label>Actores</label>
                    <input v-model="media.actores" class="input_formulario" type="text" name="actors" disabled/>
                </div>

                <div class="form-group mb-2">
                    <label>Portada</label>
                    <img :src="media.portada_img" alt="Portada del Media Show" class="img-fluid mt-2" style="max-height: 400px;" disabled>
                </div>

                <div class="form-group mb-2">
                    <label>Idioma</label>
                    <input v-model="media.idioma" class="input_formulario" type="text" name="language" disabled/>
                </div>

                <div class="form-group mb-2">
                    <label>Directores</label>
                    <input v-model="media.directores" class="input_formulario" type="text" name="directors" disabled/>
                </div>

                <div class="form-group mb-2">
                    <label>Trailer</label>
                    <video v-if="media.trailer" controls class="mt-2" style="max-width: 50%; max-height: 20%">
                        <source :src="media.trailer" type="video/mp4">
                    </video><br>
                </div>

                <div class="form-group mb-2">
                    <label>Fecha de estreno</label>
                    <input v-model="media.fecha_estreno" class="input_formulario" type="date" name="release_date" disabled/>
                </div>

                <!-- Campos específicos para películas -->
                <div v-if="media.id_media_show_type === 'Pelicula'">
                    <div class="form-group mb-2">
                        <label>Saga</label>
                        <input v-model="media.saga" class="input_formulario" type="text" name="saga" disabled/>
                    </div>
                </div>

                <div v-else-if="media.id_media_show_type === 2">
                    <div class="form-group mb-2">
                        <label>Temporadas</label>
                        <input v-model="media.temporadas" class="input_formulario" type="number" name="seasons" disabled/>
                    </div>
                    <div class="form-group mb-2">
                        <label>Episodios</label>
                        <input v-model="media.episodios" class="input_formulario" type="number" name="episodes" disabled/>
                    </div>
                </div>

            </form>
        </div>
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import axios from 'axios';
    import { useRouter } from 'vue-router';

    const router = useRouter();
    const mediaId = router.currentRoute.value.params.mediaId;

    const media = ref({
        id: '',
        nombre: '',
        id_media_show_type: null,
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

    const genres = ref([]);
    const countries = ref([]);
    const mediaShowTypes = ref([]);
    const pemis = ref([]); 

    const loading = ref(true);

    // Función para obtener el nombre del tipo de Media Show
    const getMediaShowTypeName = (id_media_show_type) => {
        switch (id_media_show_type) {
            case 1:
                return 'Película';
            case 2:
                return 'Serie';
            default:
                return 'Sin especificar';
        }
    };

    // Función para obtener el nombre del género
    const getGenreName = (genre_id) => {
        switch (genre_id) {
            case 1:
                return 'Acción';
            case 2:
                return 'Aventura';
            case 3:
                return 'Animación';
            case 4:
                return 'Terror';
            case 5:
                return 'Ciencia Ficción';
            case 6:
                return 'Comedia';
            case 7:
                return 'Drama';
            case 8:
                return 'Bélico';
            case 9:
                return 'Thriller';
            case 10:
                return 'Western';
            case 11:
                return 'Suspense';
            case 12:
                return 'Familiar';
            default:
                return 'Sin especificar';
        }
    };

    onMounted(async () => {
        try {
            const response = await axios.get(`/api/media/${mediaId}`);
            const data = response.data.data; 
            
            // Ajustar el formato de la fecha sin horas y minutos
            const fechaEstreno = new Date(data.fecha_media_show);
            const fechaSinHorasMinutos = new Date(fechaEstreno.getFullYear(), fechaEstreno.getMonth(), fechaEstreno.getDate());

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

            const genresResponse = await axios.get('/api/genres');
            genres.value = genresResponse.data;

            const countriesResponse = await axios.get('/api/countries');
            countries.value = countries.data;

            const mediaShowTypesResponse = await axios.get('/api/mediaShowType');
            mediaShowTypes.value = mediaShowTypesResponse.data;

            const pemisResponse = await axios.get('/api/pemis');
            pemis.value = pemisResponse.data;

        } catch (error) {
            console.error('Error al cargar los datos del medio show:', error);
            strError.value = 'Error al cargar los datos del medio show';
        }
    });

</script>