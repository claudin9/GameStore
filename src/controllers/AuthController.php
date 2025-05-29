<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $this->sanitizeInput($_POST['email']);
            $password = $_POST['password'];

            $user = $this->userModel->findByEmail($email);

            if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'] ?? 'user';

                $this->setFlashMessage('Login realizado com sucesso!', 'success');
                $this->redirect('/gamestore');
            } else {
                $this->setFlashMessage('Email ou senha inválidos.', 'error');
            }
        }

        $this->view('auth/login', [
            'title' => 'Login - GameStore'
        ]);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rules = [
                'name' => 'required|min:3|max:100',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'confirm_password' => 'required'
            ];

            $errors = $this->validateRequest($rules);

            if (empty($errors)) {
                if ($_POST['password'] !== $_POST['confirm_password']) {
                    $errors['confirm_password'] = 'As senhas não coincidem.';
                } else {
                    $existingUser = $this->userModel->findByEmail($_POST['email']);
                    if ($existingUser) {
                        $errors['email'] = 'Este email já está cadastrado.';
                    }
                }
            }

            if (empty($errors)) {
                $userData = [
                    'name' => $this->sanitizeInput($_POST['name']),
                    'email' => $this->sanitizeInput($_POST['email']),
                    'password' => $_POST['password'],
                    'cpf' => $this->sanitizeInput($_POST['cpf'] ?? ''),
                    'phone' => $this->sanitizeInput($_POST['phone'] ?? ''),
                    'address' => $this->sanitizeInput($_POST['address'] ?? '')
                ];

                $userId = $this->userModel->create($userData);

                if ($userId) {
                    $_SESSION['user_id'] = $userId;
                    $_SESSION['user_name'] = $userData['name'];
                    $_SESSION['user_role'] = 'user';

                    $this->setFlashMessage('Cadastro realizado com sucesso!', 'success');
                    $this->redirect('/gamestore');
                } else {
                    $this->setFlashMessage('Erro ao cadastrar usuário.', 'error');
                }
            }
        }

        $this->view('auth/register', [
            'title' => 'Cadastro - GameStore',
            'errors' => $errors ?? []
        ]);
    }

    public function logout() {
        session_destroy();
        $this->redirect('/gamestore');
    }

    public function profile() {
        $this->requireAuth();

        $user = $this->userModel->find($_SESSION['user_id']);
        $orders = $this->userModel->getOrders($_SESSION['user_id']);

        $this->view('auth/profile', [
            'title' => 'Meu Perfil - GameStore',
            'user' => $user,
            'orders' => $orders
        ]);
    }

    public function updateProfile() {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rules = [
                'name' => 'required|min:3|max:100',
                'email' => 'required|email',
                'cpf' => 'required|min:11|max:14',
                'phone' => 'required|min:10|max:20',
                'address' => 'required|min:10'
            ];

            $errors = $this->validateRequest($rules);

            if (empty($errors)) {
                $userData = [
                    'name' => $this->sanitizeInput($_POST['name']),
                    'email' => $this->sanitizeInput($_POST['email']),
                    'cpf' => $this->sanitizeInput($_POST['cpf']),
                    'phone' => $this->sanitizeInput($_POST['phone']),
                    'address' => $this->sanitizeInput($_POST['address'])
                ];

                if (!empty($_POST['password'])) {
                    if ($_POST['password'] !== $_POST['confirm_password']) {
                        $errors['confirm_password'] = 'As senhas não coincidem.';
                    } else {
                        $userData['password'] = $_POST['password'];
                    }
                }

                if (empty($errors)) {
                    if ($this->userModel->update($_SESSION['user_id'], $userData)) {
                        $_SESSION['user_name'] = $userData['name'];
                        $this->setFlashMessage('Perfil atualizado com sucesso!', 'success');
                        $this->redirect('/gamestore/perfil');
                    } else {
                        $this->setFlashMessage('Erro ao atualizar perfil.', 'error');
                    }
                }
            }
        }

        $user = $this->userModel->find($_SESSION['user_id']);

        $this->view('auth/update-profile', [
            'title' => 'Atualizar Perfil - GameStore',
            'user' => $user,
            'errors' => $errors ?? []
        ]);
    }
} 