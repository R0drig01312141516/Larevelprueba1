// mensaje.js

/**
 * Oculta mensajes con una clase específica después de un tiempo.
 * 
 * @param {string} clase - La clase de los mensajes que se deben ocultar.
 * @param {number} tiempo - Tiempo en milisegundos antes de ocultar el mensaje.
 * @param {number} duracionTransicion - Tiempo de transición para desvanecer (en milisegundos).
 */
function ocultarMensajes(clase = 'alert-message', tiempo = 5000, duracionTransicion = 1000) {
    setTimeout(() => {
        const mensajes = document.querySelectorAll(`.${clase}`);
        mensajes.forEach(mensaje => {
            mensaje.style.transition = `opacity ${duracionTransicion}ms`;
            mensaje.style.opacity = 0;

            setTimeout(() => {
                mensaje.style.display = 'none';
            }, duracionTransicion);
        });
    }, tiempo);
}

// Ejecutar cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', () => {
    ocultarMensajes('alert-message'); // Cambia esta clase según la que uses en tus componentes
});
