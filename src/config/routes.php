<?php

use App\Config\Router;
use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
use App\Controllers\CartController;
use App\Controllers\UserController;
use App\Controllers\ContactController;

// Inicializa o router com o caminho base da aplicação
Router::init('/gamestore');

// Página inicial
Router::get('/', [HomeController::class, 'index']);

// Rotas de produtos
Router::get('/products', [ProductController::class, 'index']);
Router::get('/product/{id}', [ProductController::class, 'show']);
Router::get('/products/category/{slug}', [ProductController::class, 'byCategory']);

// Rotas de categorias
Router::get('/categories', [CategoryController::class, 'index']);
Router::get('/category/{slug}', [CategoryController::class, 'show']);

// Rotas do carrinho
Router::get('/cart', [CartController::class, 'index']);
Router::post('/cart/add', [CartController::class, 'add']);
Router::post('/cart/remove', [CartController::class, 'remove']);
Router::post('/cart/update', [CartController::class, 'update']);

// Rotas de usuário
Router::get('/login', [UserController::class, 'loginForm']);
Router::post('/login', [UserController::class, 'login']);
Router::get('/register', [UserController::class, 'registerForm']);
Router::post('/register', [UserController::class, 'register']);
Router::get('/profile', [UserController::class, 'profile']);
Router::post('/logout', [UserController::class, 'logout']);

// Rota de contato
Router::get('/contact', [ContactController::class, 'index']);