<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Todas las tareas</h5>
                    </div>
                    <div>
                        <router-link :to="{name: 'media.create'}" class="btn btn-success">Nueva Tarea</router-link>
                    </div>
                    <table class="table table-hover table-sm">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th width="50" class="text-center">#</th>
                                <th>Name</th>
                                <th>description</th>
                                <th>date_open</th>
                                <th>date_close</th>
                                <th class="text-center" width="200">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(media,index) in medias">
                                <td class="text-center">{{ media.id }}</td>
                                <td>{{ media.nombre }}</td>
                                <td class="text-center">
                                    <a class="btn btn-warning mr-1">Edit</a>
                                    <button class="btn btn-danger" @click="deleteTask(media.id, index)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ medias }}
    </div>
</template>

<script setup>

import axios from "axios";
import {ref, onMounted, inject} from "vue"
const medias = ref();
const swal = inject('$swal')
    onMounted(()=>{
       //console.log('Mi vista esta montada')
       axios.get('/api/media')
       .then(response => {
            medias.value = response.data;
       })
    });

</script>