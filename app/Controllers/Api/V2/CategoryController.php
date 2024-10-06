<?php

namespace App\Controllers\Api\V2;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use CodeIgniter\API\ResponseTrait;

use App\Models\Category;

class CategoryController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $categoryModel = new Category();

        // Fetch all categories
        $categories = $categoryModel->findAll();

        // Return response with categories
        return $this->respond([
            'status' => ResponseInterface::HTTP_OK,
            'message' => 'Categories retrieved successfully',
            'data' => $categories
        ], ResponseInterface::HTTP_OK);
    }
}