document.addEventListener('DOMContentLoaded', function () {
    /*
        Interpolar imagen secundaria y primaria al hacer click
    */
    const mainImgContainer = document.querySelector('.product-main-img img');
    const secondaryImgs = document.querySelectorAll('.product-secondary-images img');

    if (mainImgContainer && secondaryImgs.length > 0) {
        secondaryImgs.forEach(img => {
            img.addEventListener('click', function () {
                const mainImgSrc = mainImgContainer.src;
                const mainImgAlt = mainImgContainer.alt;

                mainImgContainer.src = this.src;
                mainImgContainer.alt = this.alt;

                this.src = mainImgSrc;
                this.alt = mainImgAlt;
            });
        });
    }

    /*
        Agregar funcionalidad de zoom
    */
    const zoomContainer = document.querySelector('.img-zoom-container');
    const mainImg = zoomContainer?.querySelector('img');

    if (zoomContainer && mainImg) {
        zoomContainer.addEventListener('mousemove', function (e) {
            const rect = zoomContainer.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const scale = 2; // Límite del zoom
            mainImg.style.transform = `scale(${scale})`;
            mainImg.style.transformOrigin = `${(x / zoomContainer.offsetWidth) * 100}% ${(y / zoomContainer.offsetHeight) * 100}%`;
        });

        zoomContainer.addEventListener('mouseleave', function () {
            mainImg.style.transform = 'scale(1)';
        });
    }

    /*
        Desactivar botón de agregar al carrito si no se ha seleccionado talla
    */
    const sizeInputs = document.querySelectorAll('.size-input');
    const sizeButtons = document.querySelectorAll('.size-btn');
    const addToCartBtn = document.querySelector('.add-to-cart');
    const quantityInput = document.querySelector('#quantity-input');

    let isSizeSelected = false;

    if (sizeButtons.length > 0 && addToCartBtn && quantityInput) {
        sizeButtons.forEach((button, index) => {
            button.addEventListener('click', function () {
                sizeButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                sizeInputs[index].checked = true;

                const stockDisponible = parseInt(sizeInputs[index].dataset.stock) || 0;
                const maxPermitido = stockDisponible;
                quantityInput.max = maxPermitido;

                if (parseInt(quantityInput.value) > maxPermitido) {
                    quantityInput.value = maxPermitido;
                }

                isSizeSelected = true;
                updateAddToCartButton();
            });
        });
    } else {
        disableAddToCart();
    }

    function updateAddToCartButton() {
        if (isSizeSelected) {
            addToCartBtn.disabled = false;
            addToCartBtn.classList.remove('disabled');
        } else {
            disableAddToCart();
        }
    }

    function disableAddToCart() {
        if (addToCartBtn) {
            addToCartBtn.disabled = true;
            addToCartBtn.classList.add('disabled');
        }
    }

    updateAddToCartButton();

    /*
        Ocultar mensajes después de un tiempo
    */
    function ocultarMensaje(id, tiempo = 5000, duracionTransicion = 1000) {
        setTimeout(function () {
            const mensaje = document.getElementById(id);
            if (mensaje) {
                mensaje.style.opacity = 0;
                setTimeout(function () {
                    mensaje.style.display = 'none';
                }, duracionTransicion);
            }
        }, tiempo);
    }

    // Ocultar mensaje con ID "mensaje" después de 5 segundos
    ocultarMensaje('mensaje');
});
