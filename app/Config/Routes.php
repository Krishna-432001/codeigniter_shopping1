<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

$routes->get('/frontend/auth/about', 'HomeController::about');

$routes->get('/frontend/auth/services', 'HomeController::services');

$routes->get('/frontend/auth/contact', 'HomeController::contact');



// Frontend->auth
$routes->group('frontend/auth', ['namespace' => 'App\Controllers'], function($routes) {

    // Before Login
    $routes->group('', ['filter' => 'authfilter:guest'], function($routes) {

        $routes->get('login', 'AuthController::login', ['as' => 'home.login']);

        $routes->post('authenticate', 'AuthController::authenticate', ['as' => 'home.authenticate']);

        $routes->get('register', 'AuthController::register', ['as' => 'home.register']);


        $routes->post('store', 'AuthController::store', ['as' => 'home.store']);

        $routes->get('logout', 'AuthController::logout', ['as' => 'home.logout']);
    });
});

    $routes->group('frontend/cart', ['namespace' => 'App\Controllers'], function($routes) {

    // after Login
    $routes->group('', ['filter' => 'authfilter:auth'], function($routes) {

        // cartcontroller
        $routes->get('cart', 'CartController::index', ['as' => 'home.cart']); // View the cart
        $routes->post('add/(:num)', 'CartController::add/$1', ['as' => 'home.add/(:num)']); // Add product to cart
        $routes->post('update/(:num)', 'CartController::update/$1', ['as' => 'home.update/(:num)']); // Update cart item quantity
        $routes->get('remove/(:num)', 'CartController::remove/$1', ['as' => 'home.remove/(:num)']); // Remove product from cart
        $routes->get('clear', 'CartController::clear', ['as' => 'home.clear']); // Clear the cart
    
    });
});

    
$routes->group('frontend/product', ['namespace' => 'App\Controllers'], function($routes) {

    $routes->get('product', 'ProductController::index', ['as' => 'home.product']);

    $routes->get('show/(:num)', 'ProductController::show/$1', ['as' => 'home.show']); // Product detail route

    
});


$routes->group('frontend/category', ['namespace' => 'App\Controllers'], function($routes) {
//categoryController
$routes->get('categories', 'CategoryController::index', ['as' => 'home.categories']);

$routes->get('submit-category', 'CategoryController::submitCategory', ['as' => 'home.submit-category']);

});





// Admin dashboard

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {

    // Before Login
    $routes->group('', ['filter' => 'authfilter:guest'], function($routes) {

        $routes->get('login', 'AuthController::login', ['as' => 'admin.login']);

        $routes->post('auth/login', 'AuthController::authenticate', ['as' => 'admin.authenticate']);    
    
        $routes->get('register', 'AuthController::register', ['as' => 'admin.register']);
    });

    // after Login
    $routes->group('', ['filter' => 'authfilter:auth'], function($routes) {

        $routes->get('', 'AuthController::index', ['as' => 'admin.home']);

        $routes->get('dashboard', 'AuthController::index', ['as' => 'admin.dashboard']);
    
        $routes->get('logout', 'AuthController::logout', ['as' => 'admin.logout']);    
    
    });        

});





// API V1
$routes->group('api/v1', ['namespace' => 'App\Controllers\Api\V1'], function($routes) {
    
});


// API V2
$routes->group('api/v2', ['namespace' => 'App\Controllers\Api\V2'], function($routes) {
    // Define a route for the CategoryController index method
    $routes->get('categories', 'CategoryController::index');    
});
