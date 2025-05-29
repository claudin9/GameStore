<!-- Auth Header -->
<div class="auth-header">
    <div class="container">
        <h1 class="page-title">Login</h1>
    </div>
</div>

<!-- Auth Content -->
<div class="auth-content">
    <div class="container">
        <div class="auth-layout">
            <!-- Login Form -->
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

                <form action="/gamestore/login" method="POST">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" name="email" value="<?= $_POST['email'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Senha</label>
                        <div class="password-input">
                            <input type="password" name="password" required>
                            <button type="button" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember">
                            Lembrar-me
                        </label>
                        <a href="/gamestore/recuperar-senha" class="forgot-password">
                            Esqueceu sua senha?
                        </a>
                    </div>

                    <button type="submit" class="btn btn-primary">Entrar</button>
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
                    <p>Não tem uma conta? <a href="/gamestore/registro">Registre-se</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector('input[type="password"]');
    const eyeIcon = togglePassword.querySelector('i');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        eyeIcon.classList.toggle('fa-eye');
        eyeIcon.classList.toggle('fa-eye-slash');
    });

    // Social login handlers
    document.querySelector('.btn-google').addEventListener('click', function() {
        window.location.href = '/gamestore/auth/google';
    });

    document.querySelector('.btn-facebook').addEventListener('click', function() {
        window.location.href = '/gamestore/auth/facebook';
    });
});
</script> 