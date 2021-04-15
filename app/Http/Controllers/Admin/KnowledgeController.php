<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KnowledgeController extends Controller
{
    //防水知识

    public function index()
    {
        return view('admin.knowledge.index');
    }
}
