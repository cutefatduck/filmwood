<template>
    <div class="grid">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
              <h5 class="card-title">Todas las Media Shows</h5>
            </div>
            <div>
              <router-link :to="{ name: 'media.create' }" class="btn btn-success mb-4">Nueva Media Show</router-link>
            </div>
            <table class="table table-hover table-sm mb-3">
              <thead class="bg-dark text-light">
                <tr>
                  <th width="50" class="text-center">ID</th>
                  <th width="100">Nombre</th>
                  <th class="text-center" width="200">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(media, index) in Getmedias" :key="media.id">
                  <td class="text-center">{{ media.id }}</td>
                  <td>{{ media.nombre }}</td>
                  <td class="text-center">
                    <a class="btn btn-warning mr-1" @click="editMedia(media.id)">Edit</a>
                    <button class="btn btn-danger" @click="deleteMedia(media.id, index)">Delete</button>
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
  import { ref, onMounted, inject } from "vue";
  import { useDeleteMedia, useGetMedia } from '@/composables/media';
  
  const medias = ref();
  const swal = inject('$swal');
  
  const { Getmedias, loading: loadingMedia, fetchMedia } = useGetMedia();
  const { deleteMedia } = useDeleteMedia(Getmedias);

  const editMedia = (id) => {
    // Redirige a la ruta de edición pasando el ID de la media show
    router.push({ name: 'media.edit', params: { id: id } });
  };
  
  onMounted(() => {
    fetchMedia();
});

  </script>
  