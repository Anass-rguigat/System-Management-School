<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('Teacher.home');
    }
    public function create()
    {
        return view('Teacher.create');
    }
}
