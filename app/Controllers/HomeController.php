<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HomeController extends BaseController
{
    public function index()
    {
        return view('frontend/home');
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