<div class="contact-page min-vh-100">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="contact-info bg-dark p-4 rounded-3 h-100">
                    <h2 class="text-primary mb-4">Fale Conosco</h2>
                    
                    <div class="contact-items">
                        <div class="contact-item mb-4">
                            <div class="icon-box">
                                <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                            </div>
                            <div class="info-box">
                                <h5 class="text-white">Localização</h5>
                                <p class="text-light mb-0">R. Manoel da Nóbrega, 1000</p>
                                <p class="text-light">Diadema, SP</p>
                            </div>
                        </div>

                        <div class="contact-item mb-4">
                            <div class="icon-box">
                                <i class="fas fa-envelope fa-2x text-primary"></i>
                            </div>
                            <div class="info-box">
                                <h5 class="text-white">Email</h5>
                                <p class="text-light">dinho.remi@gmail.com</p>
                            </div>
                        </div>

                        <div class="contact-item mb-4">
                            <div class="icon-box">
                                <i class="fas fa-phone fa-2x text-primary"></i>
                            </div>
                            <div class="info-box">
                                <h5 class="text-white">Telefone</h5>
                                <p class="text-light">(11) 986159827</p>
                            </div>
                        </div>

                        <div class="social-links mt-5">
                            <h5 class="text-white mb-3">Siga-nos</h5>
                            <div class="d-flex gap-3">
                                <a href="https://www.facebook.com/suaPagina" class="social-icon" target="_blank" rel="noopener">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/seuPerfil" class="social-icon" target="_blank" rel="noopener">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.instagram.com/seuPerfil" class="social-icon" target="_blank" rel="noopener">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="https://discord.gg/seuServidor" class="social-icon" target="_blank" rel="noopener">
                                    <i class="fab fa-discord"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-8">
                <div class="contact-form bg-dark p-4 rounded-3">
                    <h2 class="text-primary mb-4">Envie sua Mensagem</h2>
                    <form id="contactForm">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-dark text-light" id="name" placeholder="Seu Nome">
                                    <label for="name" class="text-light">Seu Nome</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control bg-dark text-light" id="email" placeholder="Seu Email">
                                    <label for="email" class="text-light">Seu Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-dark text-light" id="subject" placeholder="Assunto">
                                    <label for="subject" class="text-light">Assunto</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control bg-dark text-light" id="message" style="height: 150px" placeholder="Sua Mensagem"></textarea>
                                    <label for="message" class="text-light">Sua Mensagem</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Enviar Mensagem
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.contact-page {
    background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
}

.contact-info, .contact-form {
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 0 20px rgba(0, 123, 255, 0.1);
}

.contact-item {
    display: flex;
    align-items: start;
    gap: 1rem;
}

.icon-box {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 123, 255, 0.1);
    border-radius: 10px;
}

.form-control {
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.form-control:focus {
    background-color: #1a1a1a;
    border-color: #007bff;
    box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
}

.social-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-icon:hover {
    background: #007bff;
    color: #fff;
    transform: translateY(-3px);
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label {
    color: #007bff;
}

.btn-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
}
</style>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Mensagem enviada com sucesso!');
    this.reset();
});
</script>
