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
                  <button class="btn btn-success mr-1 action-btn" @click="viewMedia(media.id, index)">View</button>
                  <button class="btn btn-warning mr-1 action-btn" @click="editMedia(media.id)">Edit</button>
                  <button class="btn btn-danger mr-1 action-btn" @click="deleteMedia(media.id, index)">Delete</button>
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
import { useGetMedia } from '@/composables/media';

const { Getmedias, fetchMedia, deleteMedia } = useGetMedia();
const router = useRouter();

// Función para redirigir a la vista de ver media show
const viewMedia = async (id) => {
  try {
    router.push({ name: 'admin.media.view', params: { id: id} });
  }catch (error) {
    console.error('Error fetching media data:', error);
  }
};
const editMedia = async (id) => {
    try {
      router.push({ name: 'admin.media.edit', params: { id: id} });
    } catch (error) {
      console.error('Error fetching media data:', error);
    }
  };

onMounted(() => {
  fetchMedia();
});
</script>
