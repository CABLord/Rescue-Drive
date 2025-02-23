// Toggle Password Visibility
const togglePassword = document.getElementById('togglePassword');
const passwordField = document.getElementById('password');

togglePassword.addEventListener('click', function() {
    // Überprüfen, ob das Passwortfeld sichtbar oder verborgen ist
    const type = passwordField.type === 'password' ? 'text' : 'password';
    passwordField.type = type;

    // Icon umschalten
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});