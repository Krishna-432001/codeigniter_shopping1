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
        
        // Fetch categories ordered by name
        $categories = $category->orderBy('name', 'asc')->findAll();

        // Transform data
        $transformedCategory = array_map(function($category) {
            return [
                'id' => $category['id'],
                'name' => $category['name'],
                // 'image_path' => $this->getLogoImage($category['id']), // Assuming a method to get logo image
            ];
        }, $categories);

        // Return JSON response
        return $this->response->setJSON(['data' => $transformedCategory], 200);
    }

    // Example method to get logo image (you need to implement this based on your logic)
    // private function getLogoImage($categoryId)
    // {
    //     // Your logic to get image path for the category
    //     return base_url("uploads/categories/logo_$categoryId.png");
    // }

    public function submitCategory()
    {
        // Retrieve the category selected in the form
        $categoryId = $this->request->getPost('category');
        
        if ($categoryId) {
            // You can now use the selected category ID to process or filter products
            return "Selected Category ID: " . $categoryId;
        }

        // If no category is selected, redirect back with an error message
        return redirect()->back()->with('error', 'Please select a category');
    }
}
