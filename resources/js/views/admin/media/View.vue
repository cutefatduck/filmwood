<template>
    <div class="card">
        <div class="card-body">
            <form>
                <div class="form-group mb-2">
                    <label>Titulo</label>
                    <input :value="Getmedia.nombre" type="text" class="input-formulario" disabled>
                </div>

                <div class="form-group mb-2">
                    <label>Tipo de Media Show</label>
                    <input :value="Getmedia.mediashowtype_name" type="text" class="input-formulario" disabled>
                </div>

                <div class="form-group mb-2">
                    <label>Género</label>
                    <input :value="Getmedia.genres_name" type="text" class="input-formulario" disabled>
                </div>

                <div class="form-group mb-2">
                    <label>Sinopsis corta</label>
                    <textarea v-model="Getmedia.sinopsis_corta" class="input-formulario" disabled></textarea>
                </div>

                <div class="form-group mb-2">
                    <label>Sinopsis larga</label>
                    <textarea v-model="Getmedia.sinopsis" rows="3" class="input-formulario" disabled></textarea>
                </div>

                <div class="form-group mb-2">
                    <label>Duración (HH:MM:SS)</label>
                    <input v-model="Getmedia.duracion" class="input-formulario" type="text" name="duration" pattern="^([0-9]{2}):([0-5][0-9]):([0-5][0-9])$" disabled/>
                </div>

                <div class="form-group mb-2">
                    <label>Actores</label>
                    <input v-model="Getmedia.actores" class="input-formulario" type="text" name="actors" disabled/>
                </div>

                <div class="form-group mb-2">
                    <label>Portada</label>
                    <img :src="Getmedia.portada_img" alt="Portada del Media Show" class="img-fluid mt-2" style="max-height: 400px;" disabled>
                </div>

                <div class="form-group mb-2">
                    <label>Idioma</label>
                    <input v-model="Getmedia.idioma" class="input-formulario" type="text" name="language" disabled/>
                </div>

                <div class="form-group mb-2">
                    <label>Directores</label>
                    <input v-model="Getmedia.directores" class="input-formulario" type="text" name="directors" disabled/>
                </div>

                <div class="form-group mb-2">
                    <label>Trailer</label>
                    <video v-if="Getmedia.trailer" controls class="mt-2" style="max-width: 50%; max-height: 20%">
                        <source :src="Getmedia.trailer" type="video/mp4">
                    </video><br>
                </div>

                <div class="form-group mb-2">
                    <label>Fecha de estreno</label>
                    <input v-model="Getmedia.fecha_media_show" class="input-formulario" type="text" name="release_date" disabled/>
                </div>

                <div v-if="Getmedia.id_media_show_type === 'Pelicula'">
                    <div class="form-group mb-2">
                        <label>Saga</label>
                        <input v-model="Getmedia.saga" class="input-formulario" type="text" name="saga" disabled/>
                    </div>
                </div>

                <div v-else-if="Getmedia.id_media_show_type === 2">
                    <div class="form-group mb-2">
                        <label>Temporadas</label>
                        <input v-model="Getmedia.temporadas" class="input-formulario" type="number" name="seasons" disabled/>
                    </div>
                    <div class="form-group mb-2">
                        <label>Episodios</label>
                        <input v-model="Getmedia.episodios" class="input-formulario" type="number" name="episodes" disabled/>
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
    import { useGetMedia } from '@/composables/media';
    const { Getmedia, fetchMediaById } = useGetMedia();
    const router = useRouter();

    let mediaID = router.currentRoute.value.params.id

    onMounted (() =>{
        try{
            console.log(mediaID)
            fetchMediaById(mediaID);
        }catch (error){
            console.error('Error al cargar los datos del medio show:', error);
        }
    })


</script>