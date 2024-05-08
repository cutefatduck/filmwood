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
                    <input v-model="media.nombre"  type="text" class="input-formulario">
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Tipo de Media Show</label>
                    <input :value="media.mediashowtype_name" type="text" class="input-formulario">
                    <input v-value="media.id_media_show_type" type="hidden">
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Género</label>
                    <input :value="media.genres_name" type="text" class="input-formulario">
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">País de procedencia</label>
                    <input :value="media.country_name" type="text" class="input-formulario">
                    <input v-model="media.id_country" type="hidden">
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Pemi</label>
                    <input :value="media.pemi_name" type="text" class="input-formulario">
                    <input v-model="media.id_pemi" type="hidden">
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Sinopsis corta</label>
                    <textarea v-model="media.sinopsis_corta" class="input-formulario"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Sinopsis larga</label>
                    <textarea v-model="media.sinopsis" rows="3" class="input-formulario"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Duración (HH:MM:SS)</label>
                    <input v-model="media.duracion" class="input-formulario" type="text" name="duration" pattern="^([0-9]{2}):([0-5][0-9]):([0-5][0-9])$"/>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Actores</label>
                    <input v-model="media.actores" class="input-formulario" type="text" name="actors"/>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-3">Portada</label>
                    <img :src="media.portada_img" alt="Portada del Media Show" class="img-fluid mt-2" >
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
    import { useEditMedia } from '@/composables/media';

    const { Getmedia, fetchMediaById } = useGetMedia();
    const { editMedia } = useEditMedia();
    const router = useRouter();
    let mediaID = router.currentRoute.value.params.id

    const nombreMedia = Getmedia.value.nombre;
    const pemiMedia = Getmedia.value.id_pemi;
    const duracionMedia = Getmedia.value.duracion;
    const id_countryMedia = Getmedia.value.id_country;
    const actoresMedia = Getmedia.value.actores;
    const portada_imgMedia = Getmedia.value.portada_img;
    const idiomaMedia = Getmedia.value.idioma;
    const directoresMedia = Getmedia.value.directores;
    const sinopsisMedia = Getmedia.value.sinopsis;
    const sinopsis_cortaMedia = Getmedia.value.sinopsis_corta;
    const id_media_show_typeMedia = Getmedia.value.id_media_show_type;
    const fecha_media_showMedia = Getmedia.value.fecha_media_show;
    const sagaMedia = Getmedia.value.saga;
    const temporadasMedia = Getmedia.value.temporadas;
    const genresMedia = Getmedia.value.genres;
    const episodiosMedia = Getmedia.value.episodios;


    const media = ref({ 
        nombre: nombreMedia,
        id_pemi: pemiMedia, 
        duracion: duracionMedia, 
        id_country: id_countryMedia, 
        actores: actoresMedia, 
        portada_img: portada_imgMedia, 
        idioma: idiomaMedia, 
        directores: directoresMedia,
        sinopsis: sinopsisMedia,
        sinopsis_corta: sinopsis_cortaMedia,
        id_media_show_type: id_media_show_typeMedia,
        // trailer: '', 
        fecha_media_show: fecha_media_showMedia, 
        saga: sagaMedia, 
        temporadas: temporadasMedia,
        genres: genresMedia,
        episodios: episodiosMedia 
    });

    onMounted (() =>{
        try{
            fetchMediaById(mediaID);
        }catch (error){
            console.error('Error al cargar los datos del medio show:', error);
        }
    })

</script>