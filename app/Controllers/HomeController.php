<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\Category;

use App\Models\Product;

class HomeController extends BaseController
{
    public function index()
    {
        // Instantiate the model
        $category= new Category();
        
        // Fetch all categories
        $data['categories'] = $category->findAll(); 

        $product = new Product();

        $data['products'] = $product->findAll();

        return view('frontend/home', $data);
    }

    public function about()
    {
        return view('frontend/about');
    }

    public function services()
    {
        return view('frontend/services');
    }

    public function contact()
    {
        return view('frontend/contact');
    }
}