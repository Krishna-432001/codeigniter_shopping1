<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

$routes->get('/frontend/about', 'HomeController::about');

$routes->get('/frontend/services', 'HomeController::services');

$routes->get('/frontend/contact', 'HomeController::contact');



// Frontend
$routes->group('frontend', ['namespace' => 'App\Controllers'], function($routes) {

    $routes->get('login', 'AuthController::login');

    $routes->post('login', 'AuthController::authenticate');

    $routes->get('register', 'AuthController::register');


    $routes->post('store', 'AuthController::store');

    $routes->get('product', 'ProductController::index');

    $routes->get('product_detail/(:num)', 'ProductController::detail/$1'); // Product detail route

    // cartcontroller
    $routes->get('cart', 'CartController::index');
    $routes->post('cart/add/(:num)', 'CartController::add/$1');
    $routes->post('cart/update/(:num)', 'CartController::update/$1');
    $routes->get('cart/remove/(:num)', 'CartController::remove/$1');
    $routes->get('cart/clear', 'CartController::clear');

});

//categoryController
$routes->get('categories', 'CategoryController::index');

$routes->post('submit-category', 'CategoryController::submitCategory');




// cartcontroller
$routes->get('cart', 'CartController::index');
$routes->post('cart/add/(:num)', 'CartController::add/$1');
$routes->post('cart/update/(:num)', 'CartController::update/$1');
$routes->get('cart/remove/(:num)', 'CartController::remove/$1');
$routes->get('cart/clear', 'CartController::clear');





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
