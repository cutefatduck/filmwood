<template>
    <div class="background-pagina">
        <div class="row height-100">
                <div class="col-4">
                    <div class="background-image-login">
                        <div class="background-image-shadow-login"></div>
                    </div>
                    
                </div>
            <div class="col-8">
                <form @submit.prevent="submitLogin" class="container container-form-login">
                    <h2>Iniciar sesión</h2>

                        <label for="user">Usuario o email</label>
                        <InputText v-model="loginForm.email" id="user" placeholder="Usuario o email"/>

                        <label for="password">Contraseña</label>
                        <Password v-model="loginForm.password" :feedback="false" id="password" placeholder="Contraseña" toggleMask required/>

                    

                    <div class="text-danger-600 mt-1">
                        <div v-for="message in validationErrors?.email">
                            {{ message }}
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <button class="btn btn-primary" :class="{ 'opacity-25': processing }" :disabled="processing">login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>

import useAuth from '@/composables/auth'
import FloatLabel from 'primevue/floatlabel';
import Password from 'primevue/password';

const { loginForm, validationErrors, processing, submitLogin } = useAuth();

</script>
