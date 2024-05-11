<template>
    <div id="register" class="background-pagina">
        <div class="row">
            <div class="col-4 col-md-4 my-0 py-0">
                <div class="background-image-login-register">
                    <div class="background-image-shadow-login-register"></div>
                </div>
            </div>
            <div class="col-8 col-md-8 col-lg-12 mb-0 pt-6 formulario">
                <form @submit.prevent="submitRegister" class="container container-form-login-register mb-2 pt-5 mt-5">
                    <h1 class="register">Crea tu cuenta</h1>
                    <div class="mb-3">
                        <label for="name" class="form-label">Tu nombre</label>
                        <InputText v-model="registerForm.name" id="name" type="text" class="input-formulario" required/>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.name" :key="message">
                                {{ message }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Tu email</label>
                        <InputText v-model="registerForm.email" id="email" type="email" class="input-formulario" placeholder="Lo usarás para entrar" required/>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.email" :key="message">
                                {{ message }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Tu nombre de usuario</label>
                        <InputText v-model="registerForm.name_user" id="username" type="text" class="input-formulario" required/>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.name_user" :key="message">
                                {{ message }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Elige una contraseña</label>
                        <InputText v-model="registerForm.password" id="password" type="password" class="input-formulario" placeholder="Al menos 8 caracteres" required/>
                        <div class="text-danger-600 mt-1">
                            <div v-for="message in validationErrors?.password" :key="message">
                                {{ message }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirma la contraseña</label>
                        <InputText v-model="registerForm.password_confirmation" id="password_confirmation" type="password" class="input-formulario" required/>
                        <div class="text-danger-600 mt-1">
                            <div v-for="message in validationErrors?.password_confirmation" :key="message">
                                {{ message }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <button class="btn btn-primary boton-principal" :class="{ 'opacity-25': processing }">¡Allá vamos!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
  
<script setup>

    import axios from 'axios';
    import useAuth from '@/composables/auth'

    const { registerForm, validationErrors, processing, submitRegister } = useAuth();

</script>