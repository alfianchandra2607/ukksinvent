<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
         $category = Kategori::all();
         return view('demo', compact('category'));


    }
}
