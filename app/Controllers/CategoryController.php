<?php

namespace App\Controllers;

use App\Models\Category;
use CodeIgniter\Controller;

class CategoryController extends Controller
{
    public function category()
    {
        // Instantiate the model
        $category = new Category();
        
        // Fetch all categories
        $data['categories'] = $category->findAll();

        // Load the view and pass the categories
        return view('frontend/categorycategory_screen', $data);
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
