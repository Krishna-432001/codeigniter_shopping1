<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shopping Website">
    <meta name="keywords" content="shop, e-commerce, online store">
    <meta name="author" content="Your Website Name">
    <title><?= isset($title) ? $title : 'Shopping Website'; ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/favicon.png'); ?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/fontawesome.min.css'); ?>">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url(); ?>">ShopLogo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('shop'); ?>">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('cart'); ?>">Cart <span class="badge badge-pill badge-danger"><?= $cartCount ?? 0; ?></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('orders'); ?>">Orders</a>
                    </li>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('profile'); ?>">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('logout'); ?>">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('login'); ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('register'); ?>">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Main Content -->
    <div class="container">
