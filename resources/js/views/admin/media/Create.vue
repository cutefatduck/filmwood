<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade una tarea nueva</h5>
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
                    <label>Titulo pelicula</label><span class="text-danger"> *</span>
                    <input v-model="media.nombre" type="text" class="form-control" placeholder="Titulo pelicula">
                </div>

                <div class="form-group mb-2">
                    <label>Sinopsis corta</label><span class="text-danger"> *</span>
                    <input v-model="media.sinopsis_corta" class="form-control"  placeholder="Sinopsis corta">
                </div>

                <div class="form-group mb-2">
                    <label>Sinopsis larga</label><span class="text-danger"> *</span>
                    <textarea v-model="media.sinopsis" type="text" rows="3" class="form-control" placeholder="Sinopsis larga"></textarea>
                </div>

                <div class="form-group mb-2">
                    <label>Fecha estreno</label><span class="text-danger">*</span>
                    <input v-model="media.fecha_media_show" class="form-control" type="datetime-local" name="date_open"/>
                </div>

                <div>
        <select v-model="selectedCountry" v-if="!loading">
            <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
        </select>
        <p v-else>Loading countries...</p>
    </div>

                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir Tarea</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useGetCountries } from "@/composables/countries";

const { countries, loading, fetchCountries } = useGetCountries();
const selectedCountry = ref(null);

const media = ref({});
const strError = ref();
const strSuccess = ref();

function addMedia(){
    axios.post('/api/media' , media.value)
    .then(response =>{
        strSuccess.value = response.data.success;
        strError.value = "";
    }).catch(error => {
        strError.value = error.response.data.message;
        strSuccess.value = "";
    });
}

onMounted(() => {
    fetchCountries();
});
</script>

<style>
</style>

