<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore - Sua Loja de Games</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #7952b3;
            --secondary-color: #61428f;
        }

        .navbar-custom {
            background-color: var(--primary-color);
        }

        .btn-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .btn-custom:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
        }

        .card-game {
            transition: transform 0.2s;
        }

        .card-game:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 3rem 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="/gamestore">
                <i class="fas fa-gamepad"></i> GameStore
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/gamestore/produtos">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/gamestore/categorias">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/gamestore/promocoes">Promoções</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/gamestore/contato">Contato</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/gamestore/carrinho">
                            <i class="fas fa-shopping-cart"></i> Carrinho
                            <span class="badge bg-danger">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/gamestore/login">
                            <i class="fas fa-user"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-4">
        <!-- Hero Section -->
        <div class="bg-dark text-white py-5 mb-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="display-4 fw-bold">Bem-vindo à GameStore</h1>
                        <p class="lead">Sua loja especializada em games e acessórios para gamers.</p>
                        <a href="/gamestore/produtos" class="btn btn-primary btn-lg">Ver Produtos</a>
                    </div>
                    <div class="col-md-6">
                        <img src="https://via.placeholder.com/600x400" alt="Games" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Products -->
        <section class="mb-5">
            <div class="container">
                <h2 class="mb-4">Produtos em Destaque</h2>
                <div class="row">
                    <!-- Product Card 1 -->
                    <div class="col-md-3 mb-4">
                        <div class="card card-game h-100">
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Game 1">
                            <div class="card-body">
                                <h5 class="card-title">God of War Ragnarök</h5>
                                <p class="card-text text-muted">PlayStation 5</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 mb-0">R$ 299,90</span>
                                    <button class="btn btn-custom">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Card 2 -->
                    <div class="col-md-3 mb-4">
                        <div class="card card-game h-100">
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Game 2">
                            <div class="card-body">
                                <h5 class="card-title">Elden Ring</h5>
                                <p class="card-text text-muted">PC/Steam</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 mb-0">R$ 249,90</span>
                                    <button class="btn btn-custom">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Card 3 -->
                    <div class="col-md-3 mb-4">
                        <div class="card card-game h-100">
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Game 3">
                            <div class="card-body">
                                <h5 class="card-title">Zelda: Tears of the Kingdom</h5>
                                <p class="card-text text-muted">Nintendo Switch</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 mb-0">R$ 349,90</span>
                                    <button class="btn btn-custom">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Card 4 -->
                    <div class="col-md-3 mb-4">
                        <div class="card card-game h-100">
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Game 4">
                            <div class="card-body">
                                <h5 class="card-title">Starfield</h5>
                                <p class="card-text text-muted">Xbox Series X</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 mb-0">R$ 299,90</span>
                                    <button class="btn btn-custom">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories -->
        <section class="bg-light py-5 mb-5">
            <div class="container">
                <h2 class="mb-4">Categorias</h2>
                <div class="row">
                    <!-- Category 1 -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-gamepad fa-3x mb-3 text-primary"></i>
                                <h4>Jogos</h4>
                                <p class="text-muted">PC, PlayStation, Xbox, Nintendo</p>
                                <a href="/gamestore/categorias/jogos" class="btn btn-outline-primary">Ver Jogos</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Category 2 -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-desktop fa-3x mb-3 text-primary"></i>
                                <h4>Hardware</h4>
                                <p class="text-muted">Consoles, Acessórios, Periféricos</p>
                                <a href="/gamestore/categorias/hardware" class="btn btn-outline-primary">Ver Hardware</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Category 3 -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-tshirt fa-3x mb-3 text-primary"></i>
                                <h4>Merchandising</h4>
                                <p class="text-muted">Camisetas, Action Figures, Colecionáveis</p>
                                <a href="/gamestore/categorias/merchandising" class="btn btn-outline-primary">Ver Produtos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter -->
        <section class="mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <h3>Fique por dentro das novidades!</h3>
                        <p class="text-muted">Cadastre-se para receber ofertas exclusivas e lançamentos.</p>
                        <form class="row g-3 justify-content-center">
                            <div class="col-md-8">
                                <input type="email" class="form-control" placeholder="Seu melhor e-mail">
                            </div>
                            <div class="col-md-auto">
                                <button type="submit" class="btn btn-custom">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Sobre a GameStore</h5>
                    <p>Sua loja especializada em games, oferecendo os melhores produtos para gamers.</p>
                </div>
                <div class="col-md-4">
                    <h5>Links Úteis</h5>
                    <ul class="list-unstyled">
                        <li><a href="/gamestore/sobre" class="text-white">Sobre Nós</a></li>
                        <li><a href="/gamestore/politica-privacidade" class="text-white">Política de Privacidade</a></li>
                        <li><a href="/gamestore/termos" class="text-white">Termos de Uso</a></li>
                        <li><a href="/gamestore/faq" class="text-white">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contato</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope"></i> contato@gamestore.com</li>
                        <li><i class="fas fa-phone"></i> (11) 1234-5678</li>
                        <li><i class="fas fa-map-marker-alt"></i> São Paulo, SP</li>
                    </ul>
                    <div class="social-links mt-3">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-4 bg-light">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2024 GameStore. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 