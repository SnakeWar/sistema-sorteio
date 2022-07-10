<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SlideResource;
use App\Models\Slide;

class SlideController extends Controller
{
    public function index()
    {
        return SlideResource::collection(Slide::orderBy('created_at', 'desc')->get());
    }
}
