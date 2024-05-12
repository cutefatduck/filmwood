<template>
  <div id="perfil-user" class="contenedor-global-perfil-user mt-5 mb-5">
    <div class="row col-xxl-6 mb-4 mt-5">
      <div class="card">
        <div class="card-header">
          <h1 class="titulo-principal-cuenta">MI CUENTA</h1>
          <hr>
        </div>
        <div class="card-body">
          <ul class="list-unstyled row col-lg-12 mb-5">
            <h2 class="subtitulo-datos col-xxl-4">DATOS</h2>
            <div class="col-xxl-8">
              <li class="row justify-content-between align-items-center">
                <input  v-model="information.email" class="dato col-md-6 input-formulario-user" type="text" :disabled="!emailFieldEnabled" />
                <a href="#" class="modificar-campo col-md-4">
                  <template v-if="emailFieldEnabled"><div @click="cancelar('email')">Cancelar</div></template>
                  <template v-else><div @click="activeField('email')">Modificar</div></template>
                </a>
              </li>
              <li class="row mt-5 justify-content-between align-items-center">
                <input v-model="information.name" class="dato col-md-6 input-formulario-user" type="text" :disabled="!nameFieldEnabled" />
                <a href="#" class="modificar-campo col-md-4">
                  <template v-if="nameFieldEnabled"><div @click="cancelar('name')">Cancelar</div></template>
                  <template v-else><div @click="activeField('name')">Modificar</div></template>
                </a>
              </li>
              <li class="row mt-5 justify-content-between align-items-center">
                <input v-model="information.password" placeholder="*****" class="dato col-md-6 input-formulario-user" type="password" :disabled="!passwordFieldEnabled" />
                <a href="#" class="modificar-campo col-md-4">
                  <template v-if="passwordFieldEnabled"><div @click="cancelar('password')">Cancelar</div></template>
                  <template v-else><div @click="activeField('password')">Modificar</div></template>
                </a>
              </li>
            </div>
          </ul>
          <hr>
          <ul class="list-unstyled row mb-3 mt-5 mb-5">
            <h2 class="subtitulo-datos col-xxl-4">PERFIL SOCIAL</h2>
            <div class="col-xxl-8">
              <li class="row justify-content-between align-items-center">
                <input v-model="information.name_user" class="dato col-md-6 input-formulario-user" type="text" :disabled="!nameUserFieldEnabled" />
                <a href="#" class="modificar-campo col-md-4">
                  <template v-if="nameUserFieldEnabled"><div @click="cancelar('name_user')">Cancelar</div></template>
                  <template v-else><div @click="activeField('name_user')">Modificar</div></template>
                </a>
              </li>
            </div>
          </ul>
          <div class="container-button justify-content-center mt-2 mb-4">
            <button class="btn btn-primary boton-principal buton-guardar" @click="updateUser">Guardar Cambios</button>
          </div>
          
          <hr>
          <ul class="list-unstyled row mt-5">
            <h2 class="subtitulo-datos col-xxl-3">CONFIGURACIÓN</h2>
            <div class="col-xxl-8">
              <li class="row justify-content-between align-items-center">
                <button class="eliminar-cuenta col-4" @click="deleteUserAccount()">Eliminar cuenta</button>
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
  import { useGetUser} from '@/composables/users';
  import AppFooter from '@/layouts/AppFooter.vue';
  import Swal from 'sweetalert2';
 
  const { Getusers, loading, fetchUser, fetchUserById,deleteUser } = useGetUser();
  const router = useRouter();
  const store = useStore();
  const userId = router.currentRoute.value.params.userId;
  const user = computed(() => store.getters["auth/user"]);

  const emailFieldEnabled = ref(false);
  const nameFieldEnabled = ref(false);
  const passwordFieldEnabled = ref(false);
  const nameUserFieldEnabled = ref(false);

  const emailUsuario = user.value.email;
  const nombreUsuario = user.value.name;
  const passwordUsuario = user.value.password;
  const perfilUsuario = user.value.name_user;

  const cancelar = (campo) => {
    switch (campo) {
      case "email":
        information.value.email = emailUsuario;
        emailFieldEnabled.value = false;
        break;
      case "name":
        information.value.name = nombreUsuario;
        nameFieldEnabled.value = false;
        break;
      case "password":
        information.value.password = passwordUsuario;
        passwordFieldEnabled.value = false;
        break;
      case "name_user":
        information.value.name_user = perfilUsuario;
        nameUserFieldEnabled.value = false;
        break;
      default:
        break;
    }
  };

  const information = ref({ 
    email: emailUsuario, 
    name: nombreUsuario,
    password: '',
    name_user: perfilUsuario,
  });

  // Crearemos una función para controlar que campo está activo:
  const activeField = (field) => {
    // Activar solo el campo seleccionado
    switch (field) {
      case 'email':
        emailFieldEnabled.value = true;
        break;
      case 'name':
        nameFieldEnabled.value = true;
        break;
      case 'password':
        passwordFieldEnabled.value = true;
        break;
      case 'name_user':
        nameUserFieldEnabled.value = true;
        break;
      default:
        break;
    }
  };

  const deleteUserAccount = async () => {
    try {
      await deleteUser(user.value.id);
    } catch (error) {
      console.error('Error al eliminar la cuenta:', error);
    }
  };

  const updateUser = async () => {
    await axios.put('/api/user', information.value);
    emailFieldEnabled.value = false;
    nameFieldEnabled.value = false;
    passwordFieldEnabled.value = false;
    nameUserFieldEnabled.value = false;
    Swal.fire('Guardado!', 'Se han guardado los cambios correctamente.', 'success');
  };

  onMounted(async () => {
    try {
      await fetchUserById(userId);
    } catch (error) {
      console.error('Error al cargar los datos del user:', error);
      strError.value = 'Error al cargar los datos del user';
    }
  });
  
</script>