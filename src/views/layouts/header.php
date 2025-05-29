<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: #0a0a0a;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(to right, #4a148c, #7b1fa2);
            padding: 0.5rem 0;
        }

        .navbar-brand {
            color: white !important;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 1rem !important;
        }

        .nav-link:hover {
            color: white !important;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: white;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 80%;
        }

        .btn-cart {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white !important;
            border-radius: 50px;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
        }

        .btn-cart:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff4081;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 10px rgba(255, 64, 129, 0.5);
        }

        .btn-login {
            background: linear-gradient(45deg, #ff4081, #7c4dff);
            border: none;
            color: white !important;
            border-radius: 50px;
            padding: 0.5rem 1.5rem !important;
            transition: all 0.3s ease;
            box-shadow: 0 0 20px rgba(124, 77, 255, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(124, 77, 255, 0.5);
        }

        .main-content {
            min-height: calc(100vh - 72px);
        }
    </style>
</head>
<body>
    <main class="main-content"> 