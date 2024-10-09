<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductScreen extends BaseController
{
    public function index()
    {
        $product = new Product();
        $data['products'] = $model->findAll(); // Fetch all products from the database

        return view('frontend/products/product_screen', $data); // Load the product screen view
    }

    public function detail($id)
{
    // Load your model
    $productModel = new ProductModel();

    // Fetch the product details
    $product = $productModel->find($id);

    // Check if the product exists
    if (!$product) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Product not found");
    }

    // Pass the product data to the view
    return view('frontend/product/detail', ['product' => $product]);
}
}
