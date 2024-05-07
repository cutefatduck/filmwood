// composables/valorations.js
import { ref } from 'vue';
import Swal from 'sweetalert2';

export function useGetShare() {

  // Variable reactiva para almacenar la URL
  const pageURL = ref('');

  // Función para obtener la URL de la página actual
  const getCurrentPageURL = () => {
    pageURL.value = window.location.href;
  };

  // Función que se ejecuta al pulsar el botón de "Compartir:":
  const copyURL = () => {
    // Obtenemos la URL actual
    getCurrentPageURL();
    const textarea = document.createElement('textarea');
    textarea.value = pageURL.value;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);
      
    // Mostraremos el mensaje de éxito:
    Swal.fire({
      icon: 'success',
      title: '¡URL copiada al portapapeles!',
      showConfirmButton: false,
      timer: 2000 
    });
  };


  // Exportar todas las funciones necesarias
  return {
    getCurrentPageURL,
    copyURL
  };
}
