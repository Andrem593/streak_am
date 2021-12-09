<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class webController extends Controller
{
    public function index()
    {
        return view('giras.index');
    }
    public function create()
    {
        return view('giras.create');
    }
}
