<template>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center">
            <router-link to="/">
                <img src="/images/mascota_404.svg" alt="Filmwood Logo" class="logo mb-3" />
            </router-link>
            <p class="fs-3"> <span class="text-danger">Opps!</span> No hemos encontrado tu página.</p>
            <p class="lead">
                ¿Qué dijo la palomita de maíz al hervir? ¡No puedo soportar la presión! 🍿
            </p>
            <router-link to="/" class="btn btn-primary boton_login_registro mt-2">Ir al inicio</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "404"
}
</script>

<style scoped>

</style>
