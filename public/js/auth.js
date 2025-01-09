document.addEventListener('DOMContentLoaded', () => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })

    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        toggleIcon.classList.toggle('bi-eye-slash');
    });

    // Toggle password confirmation visibility
    const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
    const passwordConfirmationField = document.getElementById('password_confirmation');
    const toggleIconConfirmation = document.getElementById('toggleIconConfirmation');

    if (togglePasswordConfirmation) {
        togglePasswordConfirmation.addEventListener('click', function () {
            const type = passwordConfirmationField.type === 'password' ? 'text' : 'password';
            passwordConfirmationField.type = type;
            toggleIconConfirmation.classList.toggle('bi-eye-slash');
        });
    }

});

