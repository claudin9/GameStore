<?php
namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller {
    private $categoryModel;
    private $productModel;
    
    public function __construct() {
        $this->categoryModel = new Category();
        $this->productModel = new Product();
    }
    
    public function index() {
        $categories = $this->categoryModel->all();
        $featuredProducts = $this->productModel->getFeatured();
        
        $this->view('categories/index', [
            'categories' => $categories,
            'featuredProducts' => $featuredProducts
        ]);
    }
    
    public function show($id) {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            $this->redirect('/gamestore/categories');
        }
        
        $products = $this->productModel->getByCategory($id);
        $this->view('categories/show', [
            'category' => $category,
            'products' => $products
        ]);
    }
} 