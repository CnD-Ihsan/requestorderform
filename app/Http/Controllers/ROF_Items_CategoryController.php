<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ROF_Items_Category;

class ROF_Items_CategoryController extends Controller
{
    public function index(){
        $categories = ROF_Items_Category::all();


        return view('rof', [
            'categories' => $categories
        ]);
    }

    public function show(){
        $categories = ROF_Items_Category::all();


        return view('rof', [
            'categories' => $categories
        ]);
    }
} 
