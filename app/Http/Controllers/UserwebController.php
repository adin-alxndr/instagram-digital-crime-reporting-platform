<?php
// app/Http/Controllers/UserwebController.php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserwebController extends Controller
{
    /**
     * Display home page
     */
    public function home()
    {
        return view('user-web.home');
    }

    /**
     * Display contact page
     */
    public function contact()
    {
        return view('user-web.contact');
    }
}