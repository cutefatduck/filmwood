<template>
  <div class="grid">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
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
                  <button class="btn btn-success mr-1" @click="viewMedia(media.id, index)">Ver</button>
                  <button class="btn btn-warning mr-1" @click="editMedia(media.id)">Edit</button>
                  <button class="btn btn-danger" @click="deleteMedia(media.id, index)">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

  import { ref, onMounted, inject } from "vue";
  import { useRouter } from "vue-router";
  import { useDeleteMedia, useGetMedia } from '@/composables/media';

  const { Getmedias, fetchMedia } = useGetMedia();
  const { deleteMedia } = useDeleteMedia(Getmedias);
  const router = useRouter();

  const editMedia = async (id) => {
    try {
      const response = await axios.get(`/api/media/${id}/edit`);
      const mediaData = response.data.data;
      // Redirige a la ruta de edición pasando los datos del media show
      router.push({ name: 'media.edit', params: { mediaId: id, mediaData: mediaData } });
    } catch (error) {
      console.error('Error fetching media data:', error);
    }
  };

  // Función para redirigir a la vista de ver media show
  const viewMedia = async (id) => {
    try {
      const response = await axios.get(`/api/media/${id}/details`);
      const mediaData = response.data.data;
      // Redirigir a la vista de ver media show
      router.push({ name: 'admin.media.view', params: { mediaId: id, mediaData: mediaData } });
    }catch (error) {
      console.error('Error fetching media data:', error);
    }
  };

  onMounted(() => {
    fetchMedia();
  });
</script>