<template>
  <div id="perfil-user" class="contenedor-global-perfil-user mb-5">
    <div class="row col-sm-6">
      <div class="card">
        <div class="card-header">
          <h1 class="titulo-principal-cuenta">MI CUENTA</h1>
          <hr>
        </div>
        <div class="card-body">
          <ul class="list-unstyled row col-lg-12 mb-5">
            <h2 class="subtitulo-datos col-xxl-3">DATOS</h2>
            <div class="col-xxl-8">
              <li class="row justify-content-between align-items-center">
                <input class="dato col-md-6 input-formulario-user" type="text" :value="`${user.email}`" :disabled="!emailFieldEnabled" />
                <a href="#" class="modificar-campo col-md-4" @click="activeField('email')">
                  <template v-if="emailFieldEnabled">Guardar</template>
                  <template v-else>Modificar</template>
                </a>
              </li>
              <li class="row mt-5 justify-content-between align-items-center">
                <input class="dato col-md-6 input-formulario-user" type="text" :value="`${user.name}`" :disabled="!nameFieldEnabled" />
                <a href="#" class="modificar-campo col-md-4" @click="activeField('name')">
                  <template v-if="nameFieldEnabled">Guardar</template>
                  <template v-else>Modificar</template>
                </a>
              </li>
              <li class="row mt-5 justify-content-between align-items-center">
                <input class="dato col-md-6 input-formulario-user" type="password" :value="`${user.password}`" :disabled="!passwordFieldEnabled" />
                <a href="#" class="modificar-campo col-md-4" @click="activeField('password')">
                  <template v-if="passwordFieldEnabled">Guardar</template>
                  <template v-else>Modificar</template>
                </a>
              </li>
            </div>
          </ul>
          <hr>
          <ul class="list-unstyled row mb-3 mt-5 mb-5">
            <h2 class="subtitulo-datos col-xxl-3">PERFIL SOCIAL</h2>
            <div class="col-xxl-8">
              <li class="row justify-content-between align-items-center">
                <input class="dato col-md-6 input-formulario-user" type="text" :value="`${user.name_user}`" :disabled="!nameUserFieldEnabled" />
                <a href="#" class="modificar-campo col-md-4" @click="activeField('name_user')">
                  <template v-if="nameUserFieldEnabled">Guardar</template>
                  <template v-else>Modificar</template>
                </a>
              </li>
            </div>
          </ul>
          <hr>
          <ul class="list-unstyled row mt-5">
            <h2 class="subtitulo-datos col-xxl-3">CONFIGURACIÓN</h2>
            <div class="col-xxl-8">
              <li class="row">
                <a href="#" class="eliminar-cuenta">Eliminar cuenta</a>
              </li>
            </div>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <AppFooter />
</template>

<script setup>

  import { ref, onMounted, computed } from 'vue';
  import { useStore } from "vuex";
  import { useRouter } from 'vue-router';
  import useAuth from "@/composables/auth";
  import { useGetUser } from '@/composables/users';
  import AppFooter from '@/layouts/AppFooter.vue';

  const { Getusers, loading, fetchUser, fetchUserById } = useGetUser();
  const router = useRouter();
  const store = useStore();
  const userId = router.currentRoute.value.params.userId;
  const user = computed(() => store.getters["auth/user"]);

  const emailFieldEnabled = ref(false);
  const nameFieldEnabled = ref(false);
  const passwordFieldEnabled = ref(false);
  const nameUserFieldEnabled = ref(false);

  // Crearemos una función para controlar que campo está activo:
  const activeField = (field) => {
    switch (field) {
      case 'email':
        emailFieldEnabled.value = !emailFieldEnabled.value;
        break;
      case 'name':
        nameFieldEnabled.value = !nameFieldEnabled.value;
        break;
      case 'password':
        passwordFieldEnabled.value = !passwordFieldEnabled.value;
        break;
      case 'name_user':
        nameUserFieldEnabled.value = !nameUserFieldEnabled.value;
        break;
      default:
        break;
    }
  };

  const updateUser = async () => {
    try {
      const response = await fetch(`/api/users/${userId}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${yourAccessToken}`, // Si es necesario
        },
        body: JSON.stringify({
          name: user.value.name,
          email: user.value.email,
          name_user: user.value.name_user,
          password: user.value.password,
        }),
      });
      const userData = await response.json();
      console.log('Usuario actualizado:', userData);
    } catch (error) {
      console.error('Error al actualizar usuario:', error);
    }
  };

  // Función para obtener el ID del usuario desde la ruta:
  onMounted(async () => {
    try {
      await fetchUserById(userId);
    } catch (error) {
      console.error('Error al cargar los datos del user:', error);
      strError.value = 'Error al cargar los datos del user';
    }
  });

</script>