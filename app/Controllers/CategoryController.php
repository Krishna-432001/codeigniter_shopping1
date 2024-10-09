<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        // Instantiate the model
        $category = new Category();
        
        // Fetch all categories
        $data['categories'] = $category->findAll();

        // Load the view and pass the categories
        return view('/', $data);
    }

    public function submitCategory()
    {
        // Handle form submission logic here (for example, search or save data)
        $categoryId = $this->request->getPost('category');
        
        if ($categoryId) {
            return "Selected Category ID: " . $categoryId;
        }

        return redirect()->back()->with('error', 'Please select a category');
    }
}
