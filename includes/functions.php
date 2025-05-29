<?php

/**
 * Funções auxiliares para a aplicação
 */

/**
 * Redireciona para uma URL específica
 */
function redirect($url) {
    header("Location: " . APP_URL . $url);
    exit;
}

/**
 * Retorna a URL base da aplicação
 */
function base_url($path = '') {
    return APP_URL . '/' . ltrim($path, '/');
}

/**
 * Retorna o caminho base da aplicação
 */
function base_path($path = '') {
    return APP_ROOT . '/' . ltrim($path, '/');
}

/**
 * Formata um valor monetário
 */
function format_money($value) {
    return 'R$ ' . number_format($value, 2, ',', '.');
}

/**
 * Formata uma data
 */
function format_date($date, $format = 'd/m/Y') {
    return date($format, strtotime($date));
}

/**
 * Gera um token aleatório
 */
function generate_token($length = 32) {
    return bin2hex(random_bytes($length));
}

/**
 * Verifica se o usuário está autenticado
 */
function is_authenticated() {
    return isset($_SESSION['user_id']);
}

/**
 * Verifica se o usuário é administrador
 */
function is_admin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

/**
 * Requer autenticação para acessar uma página
 */
function require_auth() {
    if (!is_authenticated()) {
        redirect('/login');
    }
}

/**
 * Requer privilégios de administrador
 */
function require_admin() {
    if (!is_admin()) {
        redirect('/');
    }
}

/**
 * Define uma mensagem flash
 */
function set_flash_message($type, $message) {
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

/**
 * Obtém e remove a mensagem flash
 */
function get_flash_message() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

/**
 * Valida um email
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Sanitiza uma string
 */
function sanitize($string) {
    return htmlspecialchars(strip_tags($string));
}

/**
 * Verifica se uma requisição é AJAX
 */
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

/**
 * Retorna uma resposta JSON
 */
function json_response($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

/**
 * Faz upload de um arquivo
 */
function upload_file($file, $destination) {
    if (!isset($file['error']) || is_array($file['error'])) {
        throw new RuntimeException('Parâmetros inválidos.');
    }

    switch ($file['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('Nenhum arquivo enviado.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Arquivo excede o tamanho permitido.');
        default:
            throw new RuntimeException('Erro desconhecido.');
    }

    if ($file['size'] > MAX_UPLOAD_SIZE) {
        throw new RuntimeException('Arquivo excede o tamanho máximo permitido.');
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($file['tmp_name']);

    if (!in_array($mime_type, ALLOWED_IMAGE_TYPES)) {
        throw new RuntimeException('Tipo de arquivo não permitido.');
    }

    $extension = array_search($mime_type, [
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif'
    ], true);

    $filename = sprintf('%s.%s', generate_token(), $extension);
    $filepath = $destination . '/' . $filename;

    if (!move_uploaded_file($file['tmp_name'], $filepath)) {
        throw new RuntimeException('Falha ao mover o arquivo enviado.');
    }

    return $filename;
}

/**
 * Gera um slug a partir de uma string
 */
function generate_slug($string) {
    $string = strtolower($string);
    $string = preg_replace('/[áàãâä]/ui', 'a', $string);
    $string = preg_replace('/[éèêë]/ui', 'e', $string);
    $string = preg_replace('/[íìîï]/ui', 'i', $string);
    $string = preg_replace('/[óòõôö]/ui', 'o', $string);
    $string = preg_replace('/[úùûü]/ui', 'u', $string);
    $string = preg_replace('/[ýÿ]/ui', 'y', $string);
    $string = preg_replace('/[ñ]/ui', 'n', $string);
    $string = preg_replace('/[^a-z0-9]+/', '-', $string);
    $string = trim($string, '-');
    return $string;
}

/**
 * Retorna o caminho para um asset
 */
function asset($path) {
    return base_url('assets/' . ltrim($path, '/'));
}

/**
 * Retorna o caminho para uma imagem
 */
function image($path) {
    return asset('images/' . ltrim($path, '/'));
}

/**
 * Retorna o caminho para um arquivo CSS
 */
function css($path) {
    return asset('css/' . ltrim($path, '/'));
}

/**
 * Retorna o caminho para um arquivo JavaScript
 */
function js($path) {
    return asset('js/' . ltrim($path, '/'));
} 