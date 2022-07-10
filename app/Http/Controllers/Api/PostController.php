<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::whereStatus(true)->orderBy('created_at', 'desc')->paginate(6));
    }
    public function post_search($post)
    {
        return PostResource::collection(Post::whereStatus(true)->where('title', 'like', '%' . $post . '%')->get());
    }
}
