<?php

namespace App\Models;

use App\QueryFielters\Active;
use App\QueryFielters\MaxCount;
use App\QueryFielters\Sort;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pipeline\Pipeline;

class Post extends Model
{
    use HasFactory,SoftDeletes;


    public static function allPosts()
    {
//        return $posts = app(Pipeline::class)->send(Post::query())
//            ->send(Post::query())->through([
//                Active::class,
//                Sort::class,
//                MaxCount::class,
//            ])->thenReturn()->get();

        return $posts = app(Pipeline::class)->send(Post::query())
            ->send(Post::query())->through([
                Active::class,
                Sort::class,
                MaxCount::class,
            ])->thenReturn()->paginate(5);

    }

}
