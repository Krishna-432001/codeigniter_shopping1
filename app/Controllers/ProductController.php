<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
        $product = new Product();
        $data['products'] = $product->findAll(); // Fetch all products from the database

        return view('frontend/product', $data); // Load the product screen view
    }

    public function detail($id)
{
    // Load your model
    $product = new Product();

    // Fetch the product details
    $product = $product->find($id);

    // Check if the product exists
    if (!$product) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Product not found");
    }
    $data['product'] = $product;
    // Pass the product data to the view
    return view('frontend/product_detail', $data);
}
}
