<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    //材料展示

    public function index()
    {
        return view('admin.material.index');
    }
}
