document.addEventListener("DOMContentLoaded", function () {
    const mobileNav = document.querySelector('.mobile-nav');
    const menuToggle = document.querySelector('.menu-toggle');

    menuToggle.addEventListener('click', () => {
        mobileNav.classList.toggle('menu-open');
        menuToggle.classList.toggle('menu-open');
    });

    document.addEventListener('click', (event) => {
        if (!mobileNav.contains(event.target) && !menuToggle.contains(event.target)) {
            mobileNav.classList.remove('menu-open');
            menuToggle.classList.remove('menu-open');
        }
    });


});
