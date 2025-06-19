<?php

namespace App\Http\Controllers\Frontend\Post;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Partner\Partner;
use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function index(Request $request)
    {



        $blogs = Post::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('posts_translations', 'posts.id', '=', 'posts_translations.post_id')
            ->orderBy('posts.id', 'DESC')
            ->paginate(9);



        return view('frontend.post.index', compact(
            'blogs',
        ));
    }


    public function detail(Request $request)
    {


        $blog = Post::where('language_id', $request->languageID)
            ->where('status', 1)
            ->where('slug', $request->slug)
            ->join('posts_translations', 'posts.id', '=', 'posts_translations.post_id')
            ->first();

        if(!$blog){
            abort(404);
        }

        $blogs = Post::where('language_id', $request->languageID)
            ->where('status', 1)
            ->where('posts.id','!=', $blog->id)
            ->join('posts_translations', 'posts.id', '=', 'posts_translations.post_id')
            ->inRandomOrder()
            ->limit(3)
            ->get();




        return view('frontend.post.detail', compact(
            'blogs',
            'blog',
        ));

    }


}
