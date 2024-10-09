<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Libraries\OwnAuth;
use App\Models\User;

use CodeIgniter\API\ResponseTrait;

class AuthController extends BaseController
{

    use ResponseTrait; 

    public function index()
    {
        return view('admin/dashboard');
    }

    public function login()
    {
        return view('admin/auth/login');
    }

    // public function authenticate(){
    //     $fieldType = filter_var($this->request->getVar('login_id'), FILTER_VALIDATE_EMAIL) ? 'email' :
    //     'username';
         
    //     if( $fieldType == 'email') {
    //         $isValid = $this->validate([
    //             'login_id'=>[
    //                 'rules'=>'required|valid_email|is_not_unique[Users.email]',
    //                 'errors'=>[
    //                     'required'=>'Email is required',
    //                     'valid_email'=>'Please , check the email field. It does not appears to be vaild.',
    //                     'is_not_unique'=>'Email is not Exists in our system.'

    //                 ]
    //             ],
    //             'password'=>[
    //                 'rules'=>'required|min_length[5]|max_length[45]',
    //                 'min_length'=>'password must have atleast 5 characters in length.',
    //                 'max_length'=>'password must not have characters more than 45 in length.'
    //             ]
    //             ]);

    //     }else{

    //         $isValid = $this->validate([
    //             'login_id'=>[
    //                 'rules'=>'required|is_not_unique[Users.username]',
    //                 'errors'=>[
    //                     'required'=>'username is required',
    //                     'is_not_unique'=>'username is not Exists in our system.'

    //                 ]
    //             ],
    //             'password'=>[
    //                 'rules'=>'required|min_length[5]|max_length[45]',
    //                 'min_length'=>'password must have atleast 5 characters in length.',
    //                 'max_length'=>'password must not have characters more than 45 in length.'
    //             ]
    //             ]);


    //     }
    //     if (!$isValid){
    //         return view('admin/auth/login',[
    //             'pageTitle'=>'login',
    //             'validation'=>$this->validator
    //         ]);
    //     }else{
    //         echo 'from validated....';
    //     }
    // }
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

            // Redirect to dashboard or home page
            return redirect()->to('/admin/dashboard');
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
        return redirect()->to('/admin/login')->with('error', 'You have been logged out.');
    }
  
}
