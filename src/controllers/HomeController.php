<?php

namespace App\Controllers;

class HomeController {
    public function index() {
        // Por enquanto, vamos apenas carregar a view
        require_once __DIR__ . '/../views/home/index.php';
    }
} 