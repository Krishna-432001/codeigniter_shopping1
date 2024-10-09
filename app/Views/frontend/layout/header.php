<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Website</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #282c34;
            color: white;
            padding: 10px;
        }

        nav {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            position: relative;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
        }

        /* Dropdown styles */
        nav ul li ul {
            display: none; /* Hide dropdown by default */
            position: absolute; /* Position it relative to the parent */
            left: 0;
            top: 100%; /* Position it below the parent */
            background-color: #3b3f45; /* Background for dropdown */
            border-radius: 5px;
            padding: 0; /* Reset padding */
            margin: 0; /* Reset margin */
            z-index: 1; /* Ensure it appears above other content */
        }

        nav ul li:hover ul {
            display: block; /* Show dropdown on hover */
        }

        nav ul li ul li {
            margin: 0; /* Reset margin for dropdown items */
        }

        nav ul li ul li a {
            padding: 10px; /* Add padding for dropdown items */
        }
    </style>
</head>
<body>

<header>
    <nav>
        <h1 style="font-size: 2.5em;">Welcome to Our Website</h1>
        <ul>
            <?php if(session()->has('user')): ?>
                <!-- User is logged in -->
                  <!-- Profile Dropdown -->
                <li>
                    <a href="#">Profile</a>
                    <ul>
                        <li><a href="<?= base_url('frontend/auth/my_profile') ?>">My Profile</a></li>
                        <li><a href="<?= base_url('frontend/cart/cart') ?>">Cart</a></li>
                        <li><a href="<?= base_url('frontend/order/orders') ?>">Orders</a></li>
                        <li><a href="<?= base_url('frontend/order/order_items') ?>">Order Items</a></li>
                        <li><a href="<?= base_url('frontend/order/order_history') ?>">Order History</a></li>
                        <li><a href="<?= base_url('frontend/auth/logout') ?>">Logout</a></li>
                        <li><a href="<?= base_url('frontend/auth/settings') ?>">Settings</a></li>
                        <li><a href="<?= base_url('frontend/auth/address') ?>">Address</a></li>
                    </ul>
                </li>
            <?php else: ?>
                <!-- User is not logged in -->
                <li><a href="<?= base_url('frontend/auth/login') ?>">Login</a></li>
                <li><a href="<?= base_url('frontend/auth/register') ?>">Register</a></li>
            <?php endif; ?>
            <li><a href="<?= base_url('/') ?>">Home</a></li>
            <li><a href="<?= base_url('frontend/auth/about') ?>">About Us</a></li>
            <li><a href="<?= base_url('frontend/auth/services') ?>">Services</a></li>
            <li><a href="<?= base_url('frontend/auth/contact') ?>">Contact Us</a></li>
            <li><a href="<?= base_url('frontend/product/product') ?>">Products</a></li>
            <li><a href="<?= base_url('frontend/category/category_screen') ?>">Categories</a></li>
           
        </ul>
    </nav>
</header>

</body>
</html>
