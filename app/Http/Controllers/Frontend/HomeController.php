<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Language\Languages;
use App\Models\Post;
use App\Models\PostTranslation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\AbstractList;
use PhpParser\Node\Stmt\DeclareDeclare;

class HomeController extends Controller
{
    public function index(Request $request)
    {

//        @dd(now()->addMonth(1));
//@dd($request->all());


        return view('welcome');
    }

    public function pageList(Request $request)
    {
        return view('welcome');
    }

    public function page(Request $request)
    {
        return view('welcome');
    }

    public function postStore(Request $request)
    {



        $rules = [
            'ad.*' => 'required'
        ];

        $customMessages = [
            'ad.*.required' => 'Title mutleq olmalidir'
        ];

        $this->validate($request, $rules, $customMessages);

        $post =  Post::create([
            'status' => $request->status
        ]);

        foreach ($request->ad as $key => $item):
           PostTranslation::create([
               'post_id' => $post->id,
               'language' => $key,
               'title' => $item,
               'sef_link'=> Str::slug($item)
           ]);
        endforeach;







        return redirect()->back();

    }

    public function item(Request $request)
    {




        $posts = Post::where('posts.id',$request->slug)
            ->where('language',$request->languageID)
            ->join('post_translations','posts.id','=','post_translations.post_id')
            ->first();

        return view('item',compact('posts'));


    }


}

