<!-- Auth Header -->
<div class="auth-header">
    <div class="container">
        <h1 class="page-title">Criar Conta</h1>
    </div>
</div>

<!-- Auth Content -->
<div class="auth-content">
    <div class="container">
        <div class="auth-layout">
            <!-- Register Form -->
            <div class="auth-form">
                <?php if (isset($errors)): ?>
                    <div class="alert alert-error">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="/gamestore/registro" method="POST" id="registerForm">
                    <div class="form-group">
                        <label>Nome Completo</label>
                        <input type="text" name="name" value="<?= $_POST['name'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" name="email" value="<?= $_POST['email'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label>CPF</label>
                        <input type="text" name="cpf" value="<?= $_POST['cpf'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="tel" name="phone" value="<?= $_POST['phone'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Senha</label>
                        <div class="password-input">
                            <input type="password" name="password" required>
                            <button type="button" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar"></div>
                            <span class="strength-text">Força da senha: <span>Fraca</span></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Confirmar Senha</label>
                        <div class="password-input">
                            <input type="password" name="confirm_password" required>
                            <button type="button" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Endereço</label>
                        <input type="text" name="address" value="<?= $_POST['address'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="terms" required>
                            Eu concordo com os <a href="/gamestore/termos" target="_blank">Termos de Uso</a> e 
                            <a href="/gamestore/privacidade" target="_blank">Política de Privacidade</a>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="newsletter">
                            Desejo receber novidades e ofertas por e-mail
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Criar Conta</button>
                </form>

                <div class="auth-divider">
                    <span>ou</span>
                </div>

                <div class="social-login">
                    <button type="button" class="btn btn-google">
                        <i class="fab fa-google"></i>
                        Continuar com Google
                    </button>
                    <button type="button" class="btn btn-facebook">
                        <i class="fab fa-facebook-f"></i>
                        Continuar com Facebook
                    </button>
                </div>

                <div class="auth-footer">
                    <p>Já tem uma conta? <a href="/gamestore/login">Faça login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    togglePasswordButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    });

    // Password strength checker
    const passwordInput = document.querySelector('input[name="password"]');
    const strengthBar = document.querySelector('.strength-bar');
    const strengthText = document.querySelector('.strength-text span');

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        let strengthLabel = 'Fraca';

        // Length check
        if (password.length >= 8) strength += 25;

        // Contains number
        if (/\d/.test(password)) strength += 25;

        // Contains letter
        if (/[a-zA-Z]/.test(password)) strength += 25;

        // Contains special character
        if (/[^A-Za-z0-9]/.test(password)) strength += 25;

        // Update strength bar
        strengthBar.style.width = `${strength}%`;
        strengthBar.className = 'strength-bar';

        // Update strength text
        if (strength >= 75) {
            strengthLabel = 'Forte';
            strengthBar.classList.add('strong');
        } else if (strength >= 50) {
            strengthLabel = 'Média';
            strengthBar.classList.add('medium');
        } else {
            strengthLabel = 'Fraca';
            strengthBar.classList.add('weak');
        }

        strengthText.textContent = strengthLabel;
    });

    // Form validation
    const form = document.getElementById('registerForm');
    form.addEventListener('submit', function(e) {
        const password = document.querySelector('input[name="password"]').value;
        const confirmPassword = document.querySelector('input[name="confirm_password"]').value;

        if (password !== confirmPassword) {
            e.preventDefault();
            alert('As senhas não coincidem!');
        }
    });

    // Social login handlers
    document.querySelector('.btn-google').addEventListener('click', function() {
        window.location.href = '/gamestore/auth/google';
    });

    document.querySelector('.btn-facebook').addEventListener('click', function() {
        window.location.href = '/gamestore/auth/facebook';
    });

    // Input masks
    const masks = {
        cpf: '###.###.###-##',
        phone: '(##) #####-####'
    };

    Object.keys(masks).forEach(field => {
        const input = document.querySelector(`input[name="${field}"]`);
        if (input) {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                let result = '';
                let mask = masks[field];

                for (let i = 0, j = 0; i < mask.length && j < value.length; i++) {
                    if (mask[i] === '#') {
                        result += value[j];
                        j++;
                    } else {
                        result += mask[i];
                    }
                }

                e.target.value = result;
            });
        }
    });
});
</script> 