document.addEventListener("DOMContentLoaded", function () {
    // ---------------------------------------------
    // 1. CONFIGURACIÓN DEL CARRUSEL PRINCIPAL INFINITO
    // ---------------------------------------------
    document.addEventListener('DOMContentLoaded', () => {
        const track = document.getElementById('carousel');
        const images = document.querySelectorAll('.carouselc-track img');
        const imageWidth = images[0].clientWidth; // Ancho de una imagen
        let currentIndex = 0;

        // Función para desplazar el carrusel automáticamente
        function moveCarousel() {
            currentIndex++;
            track.style.transform = `translateX(-${currentIndex * imageWidth}px)`;

            // Reinicia el carrusel al llegar al final
            if (currentIndex === images.length - 1) {
                setTimeout(() => {
                    track.style.transition = 'none';
                    currentIndex = 0;
                    track.style.transform = `translateX(0)`;
                    setTimeout(() => {
                        track.style.transition = 'transform 0.5s ease-in-out';
                    });
                }, 500);
            }
        }

        // Configurar el intervalo para mover el carrusel cada 3 segundos
        setInterval(moveCarousel, 3000);

        // Ajustar el ancho dinámicamente si se redimensiona la ventana
        window.addEventListener('resize', () => {
            const newWidth = images[0].clientWidth;
            track.style.transform = `translateX(-${currentIndex * newWidth}px)`;
        });
    });

    // ---------------------------------------------
    // 2. SLIDER DE OFERTAS CON NAVEGACIÓN MANUAL
    // ---------------------------------------------
    const slider = document.querySelector(".ofertas-container .hero-slider");
    const ofertaSlides = document.querySelectorAll(".ofertas-container .hero-slide");
    const prevBtn = document.querySelector(".ofertas-container .hero-nav-prev");
    const nextBtn = document.querySelector(".ofertas-container .hero-nav-next");
    let ofertaIndex = 0;

    const updateSlider = () => {
        const offset = ofertaIndex * -100;
        slider.style.transform = `translateX(${offset}%)`;
    };

    prevBtn.addEventListener("click", () => {
        ofertaIndex = (ofertaIndex > 0) ? ofertaIndex - 1 : ofertaSlides.length - 1;
        updateSlider();
    });

    nextBtn.addEventListener("click", () => {
        ofertaIndex = (ofertaIndex < ofertaSlides.length - 1) ? ofertaIndex + 1 : 0;
        updateSlider();
    });

    updateSlider();

    
        // ---------------------------------------------
        // 1. CONFIGURACIÓN DEL CARRUSEL DE IMÁGENES
        // ---------------------------------------------
        const grande = document.querySelector(".grande");
        const punto = document.querySelectorAll(".punto");
    
        // Inicializa el carrusel en la primera imagen (no mover)
        grande.style.transform = `translateX(0%)`; // Primer imagen visible al cargar
    
        // Asegura que el primer punto tenga la clase activa
        punto[0].classList.add("activoc");
    
        // Recorremos todos los puntos
        punto.forEach((cadaPunto, i) => {
            // Asignamos un clic a cada punto
            cadaPunto.addEventListener("click", () => {
    
                // Calculamos el espacio que debe desplazarse el contenedor grande
                let operacion = i * -50; // El valor de desplazamiento será 100% por cada imagen
                grande.style.transform = `translateX(${operacion}%)`;
    
                // Recorremos todos los puntos
                punto.forEach((cadaPunto) => {
                    // Quitamos la clase activa de todos los puntos
                    cadaPunto.classList.remove("activoc");
                });
    
                // Añadimos la clase activa al punto seleccionado
                punto[i].classList.add("activoc");
            });
        });
    
        // ---------------------------------------------
        // 2. TOGGLE BOTÓN ACTIVO (si existe en tu HTML)
        // ---------------------------------------------
        const toggleButton = document.querySelector(".nav-toggle");
        if (toggleButton) {
            toggleButton.addEventListener("click", () => {
                toggleButton.classList.toggle("activo");
            });
        }
    


   // ---------------------------------------------
        // 6. Tslider
        // ---------------------------------------------

// Código existente para las clases 'long-text'
document.querySelectorAll('.product-title').forEach(el => {
    const threshold = el.clientWidth * 0.15; // 10% del ancho visible
  
    if (el.scrollWidth - el.clientWidth > threshold) {
      el.classList.add('long-text');
      console.log(`Clase long-text añadida a: ${el.textContent}`);
    }
  });
  
  // Código añadido para inicializar Swiper
  const swiper = new Swiper(".swiper-container", {
    slidesPerView: 3,
    spaceBetween: 20,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        3000:{ slidesPerView: 5, spaceBetween: 20 },
        2395:{ slidesPerView: 5, spaceBetween: 20 },
        1731:{ slidesPerView: 5, spaceBetween: 20 },
        1395: { slidesPerView: 4, spaceBetween: 20 }, // Pantallas grandes
      1007:{ slidesPerView: 3, spaceBetween: 20 }, 
      768: { slidesPerView: 2, spaceBetween: 15 }, // Tablets
      636:{ slidesPerView: 2, spaceBetween: 15 }, 
      500: { slidesPerView: 1, spaceBetween: 10 }, // Móviles

      200:{ slidesPerView: 1, spaceBetween: 10 }, // Móviles}
    },
    loop: true, // Para un desplazamiento continuo
  });
  




});
