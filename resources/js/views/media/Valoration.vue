<template>
    <div class="row">
        <div class="col-12 col-md-8 col-lg-12 mb-0 pt-2 d-flex justify-content-center mb-3">
            <form @submit.prevent="submitValoration" class= "formulario-valoracion-wrapper">
                <h1 class="titulo-valoracion mb-4">¡Valora! {{ $route.params.mediaName }}</h1>
                <a @click="goBack" class="volver-valoracion mt-5 mb-4">Volver atrás</a>
                <label class="valoracion mb-2 mt-4" for="valoration">Tu valoración</label>
                <textarea cols="35" rows="10" style="resize: none;" class="input-formulario" name="opinionComentario" id="opinionComentario" placeholder="¿Qué opinas?"></textarea>
                <p class="valoracion">¿Qué valoración le das?</p>
                <template v-for="i in 5">
                    <img
                        :src="highlightedStars >= i ? '/images/estrella_marcada.svg' : '/images/estrella_vacia.svg'"
                        class="estrella_valoracion"
                        @mouseover="highlightStar(i)"
                        @click="setHighlightedStars(i)"
                    />
                </template>
                <div class="flex items-center justify-end mt-3 mb-2">
                    <button class="btn btn-primary boton-principal" :class="{ 'opacity-25': processing }">Dános tu opinión</button>
                </div>
            </form>
        </div> 
    </div>
    <AppFooter />
</template>
<style>

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

    .formulario-valoracion-wrapper {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 32px;
    }

    .valoracion_texto {
        display: flex;
        margin-top: 10px;
    }

    .valoracion {
        font-size: 20px;
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
  
    // const { Getusers, loading, fetchUser, fetchUserById } = useGetUser();
    const router = useRouter();
    
    // Retrocede una página en el historial del navegador
    const goBack = () => {
        router.go(-1); 
    };

    // Marcamos la estrella cuando el usuario se ubique encima de ella:
    const highlightedStars = ref(0);

    const highlightStar = (starIndex) => {
        highlightedStars.value = starIndex;
    };

    const setHighlightedStars = (starIndex) => {
        highlightedStars.value = starIndex;
    };


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