<?php

require_once __DIR__ . '/vendor/autoload.php';

// Carrega as variáveis de ambiente
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Carrega as rotas
require_once __DIR__ . '/src/config/routes.php';

// Despacha a rota atual
App\Config\Router::dispatch();