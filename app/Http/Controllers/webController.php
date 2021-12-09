<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class webController extends Controller
{
    public function index()
    {
        return view('giras.index');
    }
    public function show()
    {
        return view('giras.show');
    }
}
