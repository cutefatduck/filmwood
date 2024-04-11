<template>
  <div id="perfil-usuario" class="contenedor-global">
    <div class="row col-sm-6">
      <div class="card">
        <div class="card-header">
          <h1 class="titulo-principal-cuenta">MI CUENTA</h1>
          <hr>
        </div>
        <div class="card-body">
          <ul class="list-unstyled row col-lg-12">
            <h2 class="subtitulo-datos col-xxl-3">DATOS</h2>
            <div class=" col-xxl-8">
              <li class="row justify-content-between">
                <input class="dato col-md-6 input-formulario-user" type="text" :value="`${user.email}`" disabled />
                <a href="#" class="modificar-campo col-md-4">Modificar</a>
              </li>
              <li class="row mt-5 justify-content-between">
                <input class="dato  col-md-6 input-formulario-user" type="text" :value="`${user.name}`" disabled />
                <a href="#" class="modificar-campo col-md-4">Modificar</a>
              </li>
              <li class="row mt-5 justify-content-between">
                <input class="dato col-md-6 input-formulario-user" type="password" :value="`${user.password}`" disabled />
                <a href="#" class="modificar-campo col-md-4">Modificar</a>
              </li>
            </div>
          </ul>
          <hr>
          <ul class="list-unstyled row">
            <h2 class="subtitulo-datos col-xxl-3">PERFIL SOCIAL</h2>
            <div class="col-xxl-8">
              <li class="row justify-content-between">
                <input class="dato col-md-6 input-formulario-user" type="text" :value="`${user.name_user}`" disabled />
                <a href="#" class="modificar-campo col-md-4">Modificar</a>
              </li>
            </div>
          </ul>
          <hr>
          <ul class="list-unstyled row">
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
</template>
<style>


  .contenedor-global {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 50px;
  }
    
.titulo-principal-cuenta {
  font-size: 40px;
  color: white;
  font-weight: bold;
}
    
.subtitulo-datos {
  font-size: 22px;
  margin-top: 20px;
  color: white;
  font-weight: normal;
}
    
.list-unstyled {
  padding: 0;
  list-style: none;
}
    
.dato, .modificar-campo {
  color: white;
  font-size: 20px;
}

.eliminar-cuenta {
  color: red;
  font-size: 20px;
}

.modificar-campo:hover,
.eliminar-cuenta:hover {
  text-decoration: underline !important;
}

.input-formulario-user {
    font-size: 1rem;
    background-color: #0c0c1d !important;
    background: #fff;
    padding: .75rem .75rem;
    border: 1px solid #000000;
    color: #fff !important;
    transition: background-color .2s, color .2s, border-color .2s, box-shadow .2s;
    appearance: none;
    border-radius: 6px
}

.input-formulario-user :hover{
    border-color: var(--color-boton-hover) !important;
}

.input-formulario-user ::placeholder {
    color: #828282;
}

.input-formulario-user :focus {
    border-color: #0c0c1d !important;
}


</style>

<script setup>
  import { ref, onMounted, computed } from 'vue';
  import { useStore } from "vuex";
  import { useRouter } from 'vue-router';
  import useAuth from "@/composables/auth";
  import { useGetUser } from '@/composables/users';

  const { Getusers, loading, fetchUser, fetchUserById } = useGetUser();
  const router = useRouter();
  const store = useStore();
  const userId = router.currentRoute.value.params.userId;
  const user = computed(() => store.getters["auth/user"]);
  
  const togglePasswordVisibility = () => {
        const passwordField = document.querySelector('.dato[type="password"]');
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
    };

  const userData = ref({
    email: '',
    name: '',
    password: ''
  });


  // Función para obtener el ID del usuario desde la ruta, ajusta según sea necesario
  onMounted(async () => {
    try {
      await fetchUserById(userId);
      console.log(Getusers.value)
    } catch (error) {
      console.error('Error al cargar los datos del user:', error);
      strError.value = 'Error al cargar los datos del user';
    }
  });

</script>