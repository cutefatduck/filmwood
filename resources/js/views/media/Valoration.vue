<template>

  <main>
      <section class="container mt-4">
          <div class="container col-12 col-sm-4">
              <div class="row d-flex justify-content-center align-items-center">
                  <h3 class="pregunta_login">¡Nuevo comentario!</h3>
                  <p class="beneficios_login mt-3">Siéntete libre de agregar un comentario a tu gusto.</p>
                  <a class="enlace_registro pb-3">Volver al panel de comentarios</a>
                  <div class="row">
                      <div class="col-md-6 text-center">
                          <form id="resenaForm">
                              <input type="text" class="contenedor_informacion_login" name="nombreUsuario" id="nombreUsuario" readonly>
                              <textarea cols="35" rows="4" style="resize: none;" class="contenedor_informacion_personal" name="opinionComentario" id="opinionComentario" placeholder="Tu opinión"></textarea>
                              <p class="valoracion_texto">¿Cómo nos valoras?</p>
                              <div class="valoracion d-flex flex-row-reverse justify-content-end">
                                  <input type="radio" id="estrella5" name="puntuacion" value="5">
                                  <label for="estrella5"></label>
                                  <input type="radio" id="estrella4" name="puntuacion" value="4">
                                  <label for="estrella4"></label>
                                  <input type="radio" id="estrella3" name="puntuacion" value="3">
                                  <label for="estrella3"></label>
                                  <input type="radio" id="estrella2" name="puntuacion" value="2">
                                  <label for="estrella2"></label>
                                  <input type="radio" id="estrella1" name="puntuacion" value="1" checked>
                                  <label for="estrella1"></label>
                              </div>
                              <button type="button" class="boton_comentario">¡Agrega tu comentario!</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
          <AppFooter />
      </section>
  </main>
</template>
  
  
  <script setup>
  
    // import { ref, onMounted, computed } from 'vue';
    // import { useStore } from "vuex";
    // import { useRouter } from 'vue-router';
    // import useAuth from "@/composables/auth";
    // import { useGetUser } from '@/composables/users';
    // import AppFooter from '@/layouts/AppFooter.vue';
  
    // const { Getusers, loading, fetchUser, fetchUserById } = useGetUser();
    // const router = useRouter();
    // const store = useStore();
    // const userId = router.currentRoute.value.params.userId;
    // const user = computed(() => store.getters["auth/user"]);
  
    // // Función para obtener el ID del usuario desde la ruta, ajusta según sea necesario
    // onMounted(async () => {
    //   try {
    //     await fetchUserById(userId);
    //   } catch (error) {
    //     console.error('Error al cargar los datos del user:', error);
    //     strError.value = 'Error al cargar los datos del user';
    //   }
    // });
  
  </script>