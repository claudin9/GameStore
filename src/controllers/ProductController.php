<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Config\Database;
use PDO;

class ProductController extends Controller {
    private $productModel;
    private $categoryModel;
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }

    public function index() {
        $category = isset($_GET['category']) ? $_GET['category'] : null;
        
        $query = "SELECT p.*, c.name as category_name, c.slug as category_slug 
                 FROM products p 
                 LEFT JOIN categories c ON p.category_id = c.id";
        
        if ($category) {
            $query .= " WHERE c.slug = ?";
        }
        
        $stmt = $this->db->prepare($query);
        
        if ($category) {
            $stmt->execute([$category]);
        } else {
            $stmt->execute();
        }
        
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $stmt = $this->db->query("SELECT * FROM categories");
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $this->view('products/index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category
        ]);
    }

    public function show($id) {
        $query = "SELECT p.*, c.name as category_name, c.slug as category_slug 
                 FROM products p 
                 LEFT JOIN categories c ON p.category_id = c.id 
                 WHERE p.id = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$product) {
            $this->redirect('/products');
            return;
        }

        $query = "SELECT r.*, u.name as user_name 
                 FROM reviews r 
                 LEFT JOIN users u ON r.user_id = u.id 
                 WHERE r.product_id = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $this->view('product/show', [
            'product' => $product,
            'reviews' => $reviews
        ]);
    }

    public function byCategory($slug) {
        // Aqui você pode buscar produtos por categoria
        // $products = Product::whereCategory($slug);
        require_once __DIR__ . '/../views/products/category.php';
    }

    public function create() {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rules = [
                'name' => 'required|min:3|max:100',
                'description' => 'required|min:10',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|numeric|min:0',
                'category_id' => 'required|numeric'
            ];

            $errors = $this->validateRequest($rules);

            if (empty($errors)) {
                $productData = [
                    'name' => $this->sanitizeInput($_POST['name']),
                    'slug' => $this->generateSlug($_POST['name']),
                    'description' => $this->sanitizeInput($_POST['description']),
                    'price' => floatval($_POST['price']),
                    'stock' => intval($_POST['stock']),
                    'category_id' => intval($_POST['category_id'])
                ];

                // Handle image upload
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/../../public/uploads/products/';
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    $fileName = uniqid() . '.' . $fileExtension;
                    $targetPath = $uploadDir . $fileName;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                        $productData['image_url'] = '/gamestore/uploads/products/' . $fileName;
                    }
                }

                if ($this->productModel->create($productData)) {
                    $this->setFlashMessage('Produto cadastrado com sucesso!', 'success');
                    $this->redirect('/gamestore/produtos');
                } else {
                    $this->setFlashMessage('Erro ao cadastrar produto.', 'error');
                }
            }
        }

        $categories = $this->categoryModel->all();

        $this->view('products/create', [
            'title' => 'Novo Produto - GameStore',
            'categories' => $categories,
            'errors' => $errors ?? []
        ]);
    }

    public function edit($id) {
        $this->requireAdmin();

        $product = $this->productModel->find($id);
        
        if (!$product) {
            $this->setFlashMessage('Produto não encontrado.', 'error');
            $this->redirect('/gamestore/produtos');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rules = [
                'name' => 'required|min:3|max:100',
                'description' => 'required|min:10',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|numeric|min:0',
                'category_id' => 'required|numeric'
            ];

            $errors = $this->validateRequest($rules);

            if (empty($errors)) {
                $productData = [
                    'name' => $this->sanitizeInput($_POST['name']),
                    'slug' => $this->generateSlug($_POST['name']),
                    'description' => $this->sanitizeInput($_POST['description']),
                    'price' => floatval($_POST['price']),
                    'stock' => intval($_POST['stock']),
                    'category_id' => intval($_POST['category_id'])
                ];

                // Handle image upload
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/../../public/uploads/products/';
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    $fileName = uniqid() . '.' . $fileExtension;
                    $targetPath = $uploadDir . $fileName;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                        // Delete old image if exists
                        if ($product['image_url']) {
                            $oldImagePath = __DIR__ . '/../../public' . $product['image_url'];
                            if (file_exists($oldImagePath)) {
                                unlink($oldImagePath);
                            }
                        }
                        $productData['image_url'] = '/gamestore/uploads/products/' . $fileName;
                    }
                }

                if ($this->productModel->update($id, $productData)) {
                    $this->setFlashMessage('Produto atualizado com sucesso!', 'success');
                    $this->redirect('/gamestore/produtos');
                } else {
                    $this->setFlashMessage('Erro ao atualizar produto.', 'error');
                }
            }
        }

        $categories = $this->categoryModel->all();

        $this->view('products/edit', [
            'title' => 'Editar Produto - GameStore',
            'product' => $product,
            'categories' => $categories,
            'errors' => $errors ?? []
        ]);
    }

    public function delete($id) {
        $this->requireAdmin();

        $product = $this->productModel->find($id);
        
        if (!$product) {
            $this->setFlashMessage('Produto não encontrado.', 'error');
            $this->redirect('/gamestore/produtos');
        }

        // Delete product image if exists
        if ($product['image_url']) {
            $imagePath = __DIR__ . '/../../public' . $product['image_url'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($this->productModel->delete($id)) {
            $this->setFlashMessage('Produto excluído com sucesso!', 'success');
        } else {
            $this->setFlashMessage('Erro ao excluir produto.', 'error');
        }

        $this->redirect('/gamestore/produtos');
    }

    public function review($id) {
        $this->requireAuth();

        $product = $this->productModel->find($id);
        
        if (!$product) {
            $this->setFlashMessage('Produto não encontrado.', 'error');
            $this->redirect('/gamestore/produtos');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rules = [
                'rating' => 'required|numeric|min:1|max:5',
                'comment' => 'required|min:10'
            ];

            $errors = $this->validateRequest($rules);

            if (empty($errors)) {
                $reviewData = [
                    'user_id' => $_SESSION['user_id'],
                    'product_id' => $id,
                    'rating' => intval($_POST['rating']),
                    'comment' => $this->sanitizeInput($_POST['comment'])
                ];

                if ($this->productModel->createReview($reviewData)) {
                    $this->setFlashMessage('Avaliação enviada com sucesso!', 'success');
                    $this->redirect("/gamestore/produtos/{$product['slug']}");
                } else {
                    $this->setFlashMessage('Erro ao enviar avaliação.', 'error');
                }
            }
        }

        $this->view('products/review', [
            'title' => "Avaliar {$product['name']} - GameStore",
            'product' => $product,
            'errors' => $errors ?? []
        ]);
    }
} 