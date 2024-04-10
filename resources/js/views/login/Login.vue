<template>
    <div id="login" class="background-pagina">
        <div class="row">
            <div class="col-4 col-md-4 my-0 py-0">
                <div class="background-image-login-register">
                    <div class="background-image-shadow-login-register"></div>
                </div>
            </div>
            <div class="col-8 col-md-8 col-lg-12 mb-0 pt-6 formulario">
                <form @submit.prevent="submitLogin" class="container-form-login-register mb-2 pt-5 mt-5">
                    <h1>Iniciar sesión</h1>
                    <label class="mb-2" for="user">Tu email</label>
                    <InputText v-model="loginForm.email" class="input-formulario" id="user" placeholder="Tu email" required/>
                    <div class="mb-3">
                        <label class="mt-3 mb-2" for="password">Tu contraseña</label>
                        <InputText v-model="loginForm.password" class="input-formulario" type="password" id="password" placeholder="Tu contraseña" required/>
                    </div>
                    <div class="mb-3">
                        <a href="#">¿Olvidaste la contraseña?</a>
                    </div>
                    <div class="text-danger mt-3">
                        <div v-for="message in validationErrors?.email">
                            {{ message }}
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-3 mb-2">
                        <button class="btn btn-primary boton-login-registro" :class="{ 'opacity-25': processing }">INICIAR SESIÓN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>

    import { ref } from 'vue';
    import useAuth from '@/composables/auth'
    import InputText from 'primevue/inputtext';

    const { loginForm, validationErrors, processing, submitLogin } = useAuth();

</script>