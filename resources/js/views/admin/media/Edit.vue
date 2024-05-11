<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h1 class="titulo-media">Edita este medio show</h1>
            </div>

            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strSuccess }}</strong>
            </div>

            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strError }}</strong>
            </div>

            <form @submit.prevent="editMedia(media)" enctype="multipart/form-data">
                {{ Getmedia }}
                <div class="form-group mb-2">
                    <label class="mb-3">Tipo de Media Show</label>
                    <Dropdown v-model="Getmedia.mediashowtype" :modelValue="selected" :options="mediaShowTypes" optionLabel="type" op placeholder="Select a City" checkmark :highlightOnSelect="false" class="w-full md:w-14rem" />
                </div>
                {{ Getmedia.genres }}
                <div class="form-group mb-2">
                    <label class="mb-3">Género</label>

                    <!--optionValue="id"-->
                    <MultiSelect multiple v-model="Getmedia.genres" :options="GetGenres" filter optionLabel="name_genre" dataKey="id" placeholder="Select genres" :maxSelectedLabels="3" objeclass="w-full md:w-20rem" />
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">País de origen</label>
                    <Dropdown v-model="Getmedia.country" :options="countries" optionLabel="name" op placeholder="Select a City" checkmark :highlightOnSelect="false" class="w-full md:w-14rem" />
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Pemi</label>
                    <Dropdown v-model="Getmedia.pemi" :options="pemis" optionLabel="number_pemi" op placeholder="Select a City" checkmark :highlightOnSelect="false" class="w-full md:w-14rem" />
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Sinopsis corta</label>
                    <textarea v-model="Getmedia.sinopsis_corta" class="input-formulario"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Sinopsis larga</label>
                    <textarea v-model="Getmedia.sinopsis" rows="3" class="input-formulario"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Duración (HH:MM:SS)</label>
                    <input v-model="Getmedia.duracion" class="input-formulario" type="text" name="duration" pattern="^([0-9]{2}):([0-5][0-9]):([0-5][0-9])$"/>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Actores</label>
                    <input v-model="Getmedia.actores" class="input-formulario" type="text" name="actors"/>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Portada</label>
                    <img :src="Getmedia.portada_img" alt="Portada del Media Show" class="img-fluid mt-2" >
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Idioma</label>
                    <input v-model="Getmedia.idioma" class="input-formulario" type="text" name="language"/>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Directores</label>
                    <input v-model="Getmedia.directores" class="input-formulario" type="text" name="directors"/>
                </div>
                <!-- <div class="form-group mb-2">
                    <label class="mb-3">Trailer</label>
                    <video v-if="Getmedia.trailer" controls class="mt-2" style="max-width: 50%; max-height: 20%">
                        <source :src="Getmedia.trailer" type="video/mp4">
                    </video><br>
                </div> -->
                <div class="form-group mb-2">
                    <label class="mb-3">Fecha de estreno</label>
                    <input v-model="media.fecha_media_show" class="input-formulario" type="text" name="release_date"/>
                </div>
                <div v-if="Getmedia.id_media_show_type === 'Pelicula'">
                    <div class="form-group mb-2">
                        <label class="mb-3">Saga</label>
                        <input v-model="media.saga" class="input-formulario" type="text" name="saga"/>
                    </div>
                </div>
                <div v-else-if="Getmedia.id_media_show_type === 2">
                    <div class="form-group mb-2">
                        <label class="mb-3">Temporadas</label>
                        <input v-model="media.temporadas" class="input-formulario" type="number" name="seasons"/>
                    </div>
                    <div class="form-group mb-2">
                        <label class="mb-3">Episodios</label>
                        <input v-model="media.episodios" class="input-formulario" type="number" name="episodes"/>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary boton-principal mt-4 mb-4">Edita esta media show</button>
            </form>
        </div>
    </div>
</template>

<script setup>

    import { ref, onMounted } from 'vue';
    import { useRouter } from 'vue-router';
    import { useGetMedia } from '@/composables/media';
    import { useGetMediaShowType } from '@/composables/mediaShowType';
    import { useGetGenres } from '@/composables/genres';
    import { useGetCountries } from '@/composables/countries';
    import { useGetPemi } from '@/composables/pemis';

    const { Getmedia, fetchMediaById, editMedia } = useGetMedia();
    const { GetGenres, loading: loadingGenre, fetchGenres } = useGetGenres();
    const { mediaShowTypes, loading: loadingTypes, fetchMediaShowType } = useGetMediaShowType();
    const { countries, fetchCountries } = useGetCountries();
    const { pemis, fetchPemi } = useGetPemi();
    
    const router = useRouter();
    const strError = ref('');
    const strSuccess = ref('');
    const selected = ref('');

    let mediaID = router.currentRoute.value.params.id
    
    const media = ref({ 
        nombre: Getmedia.mediashowtype,
        id_pemi: Getmedia.sinopsis_corta, 
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
        genres: Getmedia.genres,
        episodios: '' 
    });

    onMounted (() =>{
        try{
            console.log(selected)
            fetchMediaById(mediaID);
            fetchGenres();
            fetchMediaShowType();
            fetchCountries();
            fetchPemi();
        }catch (error){
            console.error('Error al cargar los datos del medio show:', error);
        }
    })

</script>