<?php

$route = $_GET['route'] ?? '/';

require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/CategoryController.php';

$homeController = new HomeController();
$productController = new ProductController();
$categoryController = new CategoryController();

switch ($route) {
    case '/':
        $homeController->index();
        break;
        
    case 'products':
        $productController->index();
        break;
        
    case (preg_match('/^product\/(\d+)$/', $route, $matches) ? true : false):
        $productController->show($matches[1]);
        break;
        
    case 'categories':
        $categoryController->index();
        break;
        
    default:
        header('HTTP/1.0 404 Not Found');
        require_once __DIR__ . '/views/404.php';
        break;
} 