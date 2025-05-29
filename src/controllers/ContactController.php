<?php

namespace App\Controllers;

class ContactController {
    public function index() {
        // Inclui o layout principal
        require_once __DIR__ . '/../views/layouts/main.php';
        
        // Define o conteúdo da página
        ob_start();
        require_once __DIR__ . '/../views/contact/index.php';
        $content = ob_get_clean();
        
        // Exibe o conteúdo
        echo $content;
    }
}
