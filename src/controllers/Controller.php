<?php

namespace App\Controllers;

class Controller {
    protected function view($name, $data = []) {
        extract($data);
        
        ob_start();
        require __DIR__ . "/../views/{$name}.php";
        $content = ob_get_clean();
        
        require __DIR__ . "/../views/layouts/main.php";
    }

    protected function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }

    protected function back() {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        $this->redirect($referer);
    }

    protected function setFlashMessage($message, $type = 'info') {
        $_SESSION['flash_message'] = $message;
        $_SESSION['flash_type'] = $type;
    }

    protected function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }

    protected function requireAuth() {
        if (!$this->isAuthenticated()) {
            $this->setFlashMessage('Você precisa estar logado para acessar esta página.', 'error');
            $this->redirect('/gamestore/login');
        }
    }

    protected function isAdmin() {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }

    protected function requireAdmin() {
        if (!$this->isAdmin()) {
            $this->setFlashMessage('Você não tem permissão para acessar esta página.', 'error');
            $this->redirect('/gamestore');
        }
    }

    protected function validateRequest($rules) {
        $errors = [];
        
        foreach ($rules as $field => $rule) {
            $value = $_POST[$field] ?? null;
            
            if (strpos($rule, 'required') !== false && empty($value)) {
                $errors[$field] = "O campo {$field} é obrigatório.";
            }
            
            if (strpos($rule, 'email') !== false && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$field] = "O campo {$field} deve ser um email válido.";
            }
            
            if (strpos($rule, 'min:') !== false) {
                $min = substr($rule, strpos($rule, 'min:') + 4);
                if (strlen($value) < $min) {
                    $errors[$field] = "O campo {$field} deve ter no mínimo {$min} caracteres.";
                }
            }
            
            if (strpos($rule, 'max:') !== false) {
                $max = substr($rule, strpos($rule, 'max:') + 4);
                if (strlen($value) > $max) {
                    $errors[$field] = "O campo {$field} deve ter no máximo {$max} caracteres.";
                }
            }
        }
        
        return $errors;
    }

    protected function sanitizeInput($data) {
        if (is_array($data)) {
            return array_map([$this, 'sanitizeInput'], $data);
        }
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    protected function generateSlug($text) {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        return $text;
    }
} 