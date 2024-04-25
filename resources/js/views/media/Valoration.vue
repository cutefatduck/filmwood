<template>
    <div class="row">
      <div class="col-12 col-md-8 col-lg-12 mb-0 pt-2 d-flex justify-content-center mb-3 ">
        <form @submit.prevent="submitValoration" class="formulario-valoracion-wrapper background-valoration">
            {{ valoration }}
          <h1 class="titulo-valoracion mb-4">¡Valora! {{ $route.params.mediaValoration }}</h1>
          <label class="valoracion-pregunta mb-3 mt-4" for="opinionComentario">Tu valoración</label>
          <textarea v-model="opinionComentario" cols="35" rows="10" class="input-formulario-valorar" id="opinionComentario" placeholder="¿Qué opinas?"></textarea>
          <p class="valoracion-pregunta">¿Qué valoración le das?</p>
          <div class="valoracion-estrellas">
            <template v-for="star in starsCount" :key="star">
              <img
                :src="star <= highlightedStars ? '/images/estrella_marcada.svg' : '/images/estrella_vacia.svg'"
                class="estrella_valoracion"
                @mouseover="highlightStar(star)"
                @click="setHighlightedStars(star)"
              />
            </template>
          </div>
          <div class="flex items-center justify-end mt-3 mb-2">
            <button type="submit" class="btn btn-primary boton-principal">Dános tu opinión</button>
          </div>
        </form>
      </div>
    </div>
  </template>
<style>

    .background-valoration{
        background-color: #0b0918;
    }
    .titulo-valoracion{
        font-size: 40px;
    }
    .volver-valoracion{
        cursor: pointer;
        font-size: 16px;
        position: relative;
        overflow: hidden;
    }

    .volver-valoracion::before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background-color: var(--color-boton-hover);
        transition: width 0.5s ease;
    }

    .volver-valoracion:hover::before {
        width: 100%;
    }

    .input-formulario-valorar{
      font-size: 1rem;
      width: 400px;
      background-color: #0c0c1d !important;
      background: #fff;
      padding: .75rem .75rem;
      border: 1px solid #000000;
      color: #fff !important;
      transition: background-color .2s, color .2s, border-color .2s, box-shadow .2s;
      appearance: none;
      border-radius: 6px;
      resize: none;
    }

    .formulario-valoracion-wrapper {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 32px;
    }

    .valoracion_texto {
        display: flex;
        margin-top: 10px;
    }

    .valoracion-pregunta {
        font-size: 20px;
        margin-top: 10px !important;
    }

    .valoracion-estrellas{

      margin-bottom: 22px;
    }

    .estrella_valoracion{
        width: 25px;
        height: 25px;
    }

    .estrella_valoracion.resaltada {
        background-color: white;
    }

</style>
  
  <script setup>
  
    import { ref, onMounted, computed } from 'vue';
    //import { useStore } from "vuex";
    import { useRouter } from 'vue-router';
    // import useAuth from "@/composables/auth";
    // import { useGetUser } from '@/composables/users';
    import AppFooter from '@/layouts/AppFooter.vue';
    
  
    const opinionComentario = ref('');
    const starsCount = 5;
    const highlightedStars = ref(0);

    const valoration = ref({ 
        id_user: 3, 
        id_media_show: 2, 
        puntuacion: 3, 
        valoracion: 'Buenas tardes'
    });

    const highlightStar = (starCount) => {
        highlightedStars.value = starCount;
    };

    const setHighlightedStars = (starCount) => {
    // Aquí podrías enviar el valor de las estrellas al servidor u otra acción necesaria
    console.log(`Valoración seleccionada: ${starCount}`);
    };
    
    const submitValoration = () => {
    // Aquí podrías enviar el formulario al servidor u otra acción necesaria
    axios.post('/api/media/valoration', valoration.value)
        .then(response => {
            strSuccess.value = response.data.success;
            strError.value = '';
        }).catch(error => {
            strError.value = error.response.data.message;
            console.log(error.response.data.error)
            strSuccess.value = '';
        });

    console.log('Formulario enviado');
    };

    // const store = useStore();
    // const userId = router.currentRoute.value.params.userId;
    // const user = computed(() => store.getters["auth/user"]);
  
  
  </script>