<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministrativeController extends Controller
{
    public function index()
    {
        return view('administrative.index');
    }
}
