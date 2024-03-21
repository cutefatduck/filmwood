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
                    <label class="mb-2">Tipo de Media Show</label>
                    <div class="form-check form-check-inline">
                        <input v-model="media.tipo" class="form-check-input" type="radio" id="pelicula" value="pelicula">
                        <label class="form-check-label" for="pelicula">Película</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="media.tipo" class="form-check-input" type="radio" id="serie" value="serie">
                        <label class="form-check-label" for="serie">Serie</label>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label>Titulo pelicula</label>
                    <input v-model="media.nombre" type="text" class="input_formulario" placeholder="Titulo pelicula">
                </div>

                <div class="form-group mb-2">
                    <label>Sinopsis corta</label>
                    <input v-model="media.sinopsis_corta" class="input_formulario" placeholder="Sinopsis corta">
                </div>

                <div class="form-group mb-2">
                    <label>Sinopsis larga</label>
                    <textarea v-model="media.sinopsis" rows="3" class="input_formulario" placeholder="Sinopsis larga"></textarea>
                </div>

                <div class="form-group mb-2">
                    <label>Pemi</label>
                    <select v-model="media.pemi_id">
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

                <div class="form-group mb-2" v-if="media.tipo === 'pelicula'">
                    <label>Saga</label>
                    <input v-model="media.saga" class="input_formulario" type="text" name="saga"/>
                </div>

                <div class="form-group mb-2" v-if="media.tipo === 'serie'">
                    <label>Temporadas</label>
                    <input v-model="media.temporadas" class="input_formulario" type="number" name="seasons"/>
                </div>
                <div class="form-group mb-2" v-if="media.tipo === 'serie'">
                    <label>Episodios</label>
                    <input v-model="media.episodios" class="input_formulario" type="number" name="episodes"/>
                </div>

                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir Media Show</button>
            </form>
        </div>
    </div>
</template>

<script setup>
    import axios from 'axios';
    import { onMounted, ref } from 'vue';
    import { useGetCountries } from '@/composables/countries';
    import { useGetPemis } from '@/composables/pemis';
    import { useGetGenres } from '@/composables/genres';

    const { countries, loading: loadingCountries, fetchCountries } = useGetCountries();
    const selectedCountry = ref(null);

    const { pemis, loading: loadingPemis, fetchPemis } = useGetPemis();
    const selectedPemi = ref(null);

    const { genres, loading: loadingGenres, fetchGenres } = useGetGenres();
    const selectedGenre = ref(null);

    const media = ref({ tipo: '', pemi_id: null, genre_id: null, duracion: '', actores: '', portada_img: '', idioma: '', directores: '', trailer: '', fecha_estreno: '', saga: '', temporadas: null, episodios: null, pais_origen: '' });
    const strError = ref('');
    const strSuccess = ref('');

    // Función para agregar un nuevo medio show
    const addMedia = () => {
        axios.post('/api/media', media.value)
            .then(response => {
                strSuccess.value = response.data.success;
                strError.value = '';
            }).catch(error => {
                strError.value = error.response.data.message;
                strSuccess.value = '';
            });
    };

    onMounted(() => {
        fetchCountries();
        fetchPemis();
        fetchGenres();
    });

    const handleFileChange = (event, fileType) => {
        const file = event.target.files[0];
        if (file) {
            if (fileType === 'image') {
                const allowedFormats = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!allowedFormats.includes(file.type)) {
                    console.error('Formato de imagen no válido');
                    return;
                }
            } else if (fileType === 'video') {
                const allowedFormat = 'video/mp4';
                if (file.type !== allowedFormat) {
                    console.error('Formato de video no válido');
                    return;
                }
            }

            if (fileType === 'image') {
                media.portada_img = file;
            } else if (fileType === 'video') {
                media.trailer = file;
            }
        }
    };

    
    
</script>
