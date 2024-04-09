<template>
    <div class="contenedor-global">
      <div class="row col-xxl-6">
        <div class="card">
          <div class="card-header">
            <h1 class="titulo-principal-cuenta">MI CUENTA</h1>
            <hr>
          </div>
          <div class="card-body">
            <ul class="list-unstyled row ">
              <h2 class="subtitulo-datos col-5 col-sm-12">DATOS</h2>
              <div class="col-7">
                <li class="row justify-content-between">
                  <input class="dato col-8 input-formulario" value="ejemplo@ejemplo.com" />
                  <a href="#" class="modificar-campo col-4">Modificar</a>
                </li>
                <li class="row mt-5 justify-content-between">
                    <input class="dato col-8 input-formulario" value="usuario" />
                  <a href="#" class="modificar-campo col-4">Modificar</a>
                </li>
                <li class="row mt-5 justify-content-between">
                    <input class="dato col-8 input-formulario" value="*********" />
                  <a href="#" class="modificar-campo col-4">Modificar</a>
                </li>
              </div>
            </ul>
            <hr>
            <ul class="list-unstyled row mt-2">
              <h2 class="subtitulo-datos col-5">PERFIL SOCIAL</h2>
              <div class="col-7">
                <li class="row justify-content-between">
                  <input class="dato col-8 input-formulario" value="usuario@nombre" />
                  <a href="#" class="modificar-campo col-4">Modificar</a>
                </li>
              </div>
            </ul>
            <hr>
            <ul class="list-unstyled row mt-5">
              <h2 class="subtitulo-datos col-5">CONFIGURACIÓN</h2>
              <div class="col-7">
                <li class="row">
                  <a href="#" class="eliminar-cuenta col-8">Eliminar cuenta</a>
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
  

</style>