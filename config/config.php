<?php

// Configurações do Banco de Dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'gamestore');
define('DB_USER', 'root');
define('DB_PASS', '');

// Configurações da Aplicação
define('APP_NAME', 'GameStore');
define('APP_URL', 'http://localhost/gamestore');
define('APP_ROOT', dirname(dirname(__FILE__)));

// Configurações de Email
define('MAIL_HOST', 'smtp.mailtrap.io');
define('MAIL_PORT', 2525);
define('MAIL_USER', 'null');
define('MAIL_PASS', 'null');
define('MAIL_ENCRYPTION', 'null');
define('MAIL_FROM_ADDRESS', 'null');
define('MAIL_FROM_NAME', APP_NAME);

// Configurações de Pagamento
define('STRIPE_KEY', 'your_stripe_key');
define('STRIPE_SECRET', 'your_stripe_secret');

// Configurações de Upload
define('UPLOAD_PATH', APP_ROOT . '/public/uploads');
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif']);

// Configurações de Sessão
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);

// Configurações de Timezone
date_default_timezone_set('America/Sao_Paulo');

// Configurações de Erro
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configurações de Cache
define('CACHE_PATH', APP_ROOT . '/public/cache');
define('CACHE_LIFETIME', 3600); // 1 hora 