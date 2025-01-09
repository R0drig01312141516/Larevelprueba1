const userDropdownButton = document.getElementById('user-dropdown-button');
        const userMenu = document.getElementById('user-menu');
        if (userDropdownButton && userMenu) {
            userDropdownButton.addEventListener('click', function() {
                userMenu.classList.toggle('hidden');
            });

            window.addEventListener('click', function(e) {
                if (!userDropdownButton.contains(e.target) && !userMenu.contains(e.target)) {
                    userMenu.classList.add('hidden');
                }
            });
        }
