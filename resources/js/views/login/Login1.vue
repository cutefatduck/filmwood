<template>
<div class="container"></div>
</template>

<script setup>

import useAuth from '@/composables/auth'

const { loginForm, validationErrors, processing, submitLogin } = useAuth();

</script>
