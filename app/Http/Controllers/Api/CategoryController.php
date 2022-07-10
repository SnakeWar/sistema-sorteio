<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::has('posts')->get());
    }
    public function post($category)
    {
        return CategoryResource::collection(Category::where('id', $category)->with('posts', function ($post){
            $post->whereStatus(true);
        })->get());
    }
}
