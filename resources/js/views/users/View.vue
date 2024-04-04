<template>

<div class="edit-profile-container">
    <h1>Editar perfil</h1>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input id="name" type="text" name="name" value="{{ $user->name }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ $user->email }}" required>
        </div>
        <!-- Aquí puedes incluir más campos de edición según sea necesario -->
        <button type="submit">Guardar cambios</button>
    </form>
</div>
</template>

<style>
/* Estilos generales */
.profile-container, .edit-profile-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.profile-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.profile-header h1 {
    font-size: 24px;
    font-weight: bold;
    margin: 0;
}

.profile-header p {
    font-size: 16px;
    margin: 0;
    color: #888;
}

.edit-profile-container form {
    display: grid;
    gap: 20px;
}

.edit-profile-container label {
    font-size: 16px;
    font-weight: bold;
}

.edit-profile-container input[type="text"],
.edit-profile-container input[type="email"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.edit-profile-container button {
    padding: 10px 20px;
    background-color: #0070f3;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.edit-profile-container button:hover {
    background-color: #005bb5;
}

</style>