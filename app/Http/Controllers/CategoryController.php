<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all());
//        return new CategoryResource(Category::find(1));
    }
}
