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

       
    });

    $routes->get('logout', 'AuthController::logout', ['as' => 'home.logout']);
});

$routes->group('frontend/cart', ['namespace' => 'App\Controllers'], function($routes) {

    // after Login
    $routes->group('', ['filter' => 'authfilter:auth'], function($routes) {

        // cartcontroller
        $routes->get('/', 'CartController::index', ['as' => 'cart.index']); // View the cart
        $routes->get('add/(:num)', 'CartController::add/$1', ['as' => 'cart.add/(:num)']); // Add product to cart
        $routes->get('cart/remove/(:num)', 'CartController::remove/$1');
        $routes->get('/cart/increase/(:num)', 'CartController::increaseQuantity/$1');
        $routes->get('/cart/decrease/(:num)', 'CartController::decreaseQuantity/$1');
        $routes->get('clear', 'CartController::clear');

    });
});

$routes->group('frontend/order',['namespace' => 'App\Controllers'], function($routes) {
    // Route for checkout page with product ID
    $routes->get('checkout/(:num)', 'OrderController::checkout/$1'); // Route for checkout

    $routes->get('confirmation/(:num)', 'OrderController::confirmation/$1'); // Route for order confirmation

   

    // $routes->get('frontend/order/checkout', 'OrderController::checkout')->setName('order.checkout');

    $routes->get('order_history', 'OrderController::order_history');


    // Route to place an order
    $routes->post('place-order', 'OrderController::placeOrder');

    // Route for payment page
    $routes->get('payment/(:num)', 'OrderController::payment/$1');

    // Route for successful payment
    $routes->post('payment-success/(:num)', 'OrderController::paymentSuccess/$1');

    // Route for order success page
    $routes->get('success/(:num)', 'OrderController::success/$1');

    // Route for viewing order history
    $routes->get('history', 'OrderController::orderHistory');

    // Route for viewing order details
    $routes->get('detail/(:num)', 'OrderController::orderDetail/$1');

    // Route for generating QR code for payment
    $routes->get('generate-qr/(:any)/(:num)', 'OrderController::generateQrCode/$1/$2');

    // 
    $routes->post('/create', 'OrderController::createRazorpayOrder');

    // Route for processing payment
    $routes->post('processPayment', 'OrderController::processPayment');
});

    
$routes->group('frontend/product', ['namespace' => 'App\Controllers'], function($routes) {

    $routes->get('product', 'ProductController::index', ['as' => 'home.product']);

    $routes->get('show/(:num)', 'ProductController::show/$1', ['as' => 'home.show']); // Product detail route

    
});


$routes->group('frontend/category', ['namespace' => 'App\Controllers'], function($routes) {
//categoryController
$routes->get('categories', 'CategoryController::index', ['as' => 'home.categories']);

$routes->post('submitcategory', 'CategoryController::submitCategory');


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
