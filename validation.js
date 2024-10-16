<script>
    document.getElementById('signupForm').addEventListener('submit', function(e) {
        var password = document.getElementById('password').value;
        var passwordError = document.getElementById('password-error');
        
        // Password complexity regex: minimum 8 characters, 1 uppercase, 1 number, 1 special character
        var passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/;
        
        if (!passwordRegex.test(password)) {
            e.preventDefault();
            passwordError.textContent = 'Password must be at least 8 characters, with one uppercase letter, one number, and one special character.';
        } else {
            passwordError.textContent = '';
        }
    });
</script>
