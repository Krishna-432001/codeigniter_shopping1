<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\User;

class AuthController extends BaseController
{
    public function login()
    {
        return view('frontend/auth/login');
    }

    public function authenticate()
    {
        $request = \Config\Services::request();

        // Validate inputs
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Return to login page with validation errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Get email and password from request
        $email = $request->getPost('email');
        $password = $request->getPost('password');

        // Check if the user exists
        $userModel = new User();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Log the user in
            session()->set('user', $user);

            echo "working";

            // Redirect to dashboard or home page
            return redirect()->to('/');
        }

        // Return back with error
        return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
    }

    public function logout()
    {
        // Destroy the session
        session()->destroy();

        // Set flash data for the success message
        session()->setFlashdata('success', 'You have been logged out..');

        // Redirect to the login page or any page
        return redirect()->to('/')->with('error', 'You have been logged out.');
    }

    public function register()
    {
        return view('frontend/auth/register');
    }

    public function store()
    {
        // Validate and store user registration data
        $validation = $this->validate([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Proceed to save the user data in the database and redirect
        session()->setFlashdata('success_message', 'Registration successful!');
        return redirect()->to('/login');
    }
}