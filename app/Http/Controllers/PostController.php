<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\QueryFielters\Active;
use App\QueryFielters\Sort;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\App;

class PostController extends Controller
{
    //

    public function index()
    {
        $posts = Post::allPosts();

//        $posts = app(Pipeline::class)->send(Post::query())
//            ->send(Post::query())->through([
//                Active::class,
//                Sort::class,
//            ])->thenReturn()->get();


//        if (request()->has('active')) {
//            $posts->where('isActive', request('active'));
//        }
//        if (request()->has('sort')) {
//
//            $posts->orderBy('title', request('sort'));
//        }
//        $posts = $posts->get();


        return view('posts.index', compact('posts'));
    }

    public function softDeleteIndex()
    {
        $posts = Post::all();
        return $posts;
    }

    public function localization($lang=null)
    {
        App::setLocale($lang);
        return view('localization');
    }

}
