<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class ShowController extends Controller
{
    public function index(Request $request)
    {
    $show = Post::oldest()->get();
    return view('create-post', compact('show'));
    }
}
