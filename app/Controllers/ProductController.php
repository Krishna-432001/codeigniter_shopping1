<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
        $product = new Product();
        $data['products'] = $product->findAll(); // Fetch all products from the database

        return view('frontend/product/product', $data); // Load the product screen view
    }

    public function show($productId)
    {
        // Load your model
        $product = new Product();

        // Fetch the product details
        $product = $product->find($productId);

        // Check if the product exists
        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Product not found");
        }

        // // Fetch the related category
        // $category = $product->getCategory();
            
        // // Fetch the related brand
        // $brand = $product->getBrand();


        // Prepare data to pass to the view (or for output)
            $data = [
                'product'  => $product,
                // 'category' => $category,
                // 'brand'    => $brand,
            ];
        // Pass the product data to the view
        return view('frontend/product/show', $data);
    }
}
