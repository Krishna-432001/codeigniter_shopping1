<?php

namespace App\Controllers;

use App\Models\Brand;
use CodeIgniter\Controller;

class BrandController extends Controller
{
    protected $brandModel;

    public function __construct()
    {
        $this->brand = new Brand();
    }

    // Display a list of brands
    public function brand()
    {
        $data['brands'] = $this->brand->findAll();
        return view('brands/index', $data);
    }

    // Show a single brand
    public function show($id)
    {
        $data['brand'] = $this->brand->find($id);
        if (!$data['brand']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Brand not found');
        }
        return view('brands/show', $data);
    }

    // Display the form to create a new brand
    public function create()
    {
        return view('brands/create');
    }

    // Store a new brand
    public function store()
    {
        $this->validate([
            'name' => 'required|min_length[3]|max_length[50]',
            'description' => 'required|max_length[255]',
        ]);

        $this->brand->save([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/brands');
    }

    // Display the form to edit a brand
    public function edit($id)
    {
        $data['brand'] = $this->brand->find($id);
        if (!$data['brand']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Brand not found');
        }
        return view('brands/edit', $data);
    }

    // Update a brand
    public function update($id)
    {
        $this->validate([
            'name' => 'required|min_length[3]|max_length[50]',
            'description' => 'required|max_length[255]',
        ]);

        $this->brand->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/brands');
    }

    // Delete a brand
    public function delete($id)
    {
        $this->brand->delete($id);
        return redirect()->to('/brands');
    }
}
