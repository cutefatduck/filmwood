<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h1 class="titulo-slider">Edita este medio show</h1>
            </div>

            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strSuccess }}</strong>
            </div>

            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strError }}</strong>
            </div>

            <p>{{ media }}</p>

            <form @submit.prevent="editMedia(media)" enctype="multipart/form-data">
                <div class="form-group mb-2">
                    <label class="mb-3">Titulo</label>
                    <input :value="Getmedia.nombre"  type="text" class="input-formulario">
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Tipo de Media Show</label>
                    <input :value="Getmedia.mediashowtype_name" type="text" class="input-formulario">
                    <input v-value="Getmedia.id_media_show_type" type="hidden">
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Género</label>
                    <input :value="Getmedia.genres_name" type="text" class="input-formulario">
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">País de procedencia</label>
                    <input :value="Getmedia.country_name" type="text" class="input-formulario">
                    <input v-model="Getmedia.id_country" type="hidden">
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Pemi</label>
                    <input :value="Getmedia.pemi_name" type="text" class="input-formulario">
                    <input v-model="Getmedia.id_pemi" type="hidden">
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
                    <input v-model="Getmedia.fecha_media_show" class="input-formulario" type="text" name="release_date"/>
                </div>
                <div v-if="Getmedia.id_media_show_type === 'Pelicula'">
                    <div class="form-group mb-2">
                        <label class="mb-3">Saga</label>
                        <input v-model="Getmedia.saga" class="input-formulario" type="text" name="saga"/>
                    </div>
                </div>
                <div v-else-if="Getmedia.id_media_show_type === 2">
                    <div class="form-group mb-2">
                        <label class="mb-3">Temporadas</label>
                        <input v-model="Getmedia.temporadas" class="input-formulario" type="number" name="seasons"/>
                    </div>
                    <div class="form-group mb-2">
                        <label class="mb-3">Episodios</label>
                        <input v-model="Getmedia.episodios" class="input-formulario" type="number" name="episodes"/>
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
    import { useEditMedia } from '@/composables/media';

    const { Getmedia, fetchMediaById } = useGetMedia();
    const { editMedia } = useEditMedia();
    const router = useRouter();
    let mediaID = router.currentRoute.value.params.id

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
        idioma: '',
        // trailer: '', 
        fecha_media_show: '', 
        saga: '', 
        temporadas: '',
        genres: '',
        episodios: '' 
    });

    onMounted (() =>{
        try{
            fetchMediaById(mediaID);
        }catch (error){
            console.error('Error al cargar los datos del medio show:', error);
        }
    })

</script>