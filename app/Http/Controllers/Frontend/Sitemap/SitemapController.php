<?php

namespace App\Http\Controllers\Frontend\Sitemap;

use App\Http\Controllers\Controller;
use App\Models\Faq\Faq;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\GalleryCategory;
use App\Models\Page\Page;
use App\Models\Post\Post;
use App\Models\Service\Service;
use App\Models\Team\Team;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index(Request $request)
    {

//        ///Faqs
//        $faqs = Faq::where('language_id', $request->languageID)
//            ->where('status', 1)
//            ->join('faqs_translations', 'faqs.id', '=', 'faqs_translations.faq_id')
//            ->orderBy('sort', 'ASC')
//            ->get();
//
////        dd($faqs);

        //Services
        $services = Service::select(
            'id',
            'image',
            'slug',
            'status',
            'created_at',
            'updated_at'
        )
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

//        dd($services);


        //galleryCategories
        $gallery_categories = GalleryCategory::select(
            'id',
            'image',
            'slug',
            'status',
            'created_at',
            'updated_at'
        )
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

//        dd($services);


        $galleries = Gallery::select(
            'id',
            'image',
            'slug',
            'status',
            'created_at',
            'updated_at'
        )
            ->with('galleriesCategoriesCheck')
            ->where('status', 1)
            ->orderBy('galleries.id', 'ASC')
            ->get();

//        dd($galleries);


        //Posts
        $posts = Post::select(
            'id',
            'image',
            'slug',
            'status',
            'created_at',
            'updated_at'
        )
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

//        dd($posts);


        //Pages
        $pages = Page::select(
            'id',
            'image',
            'slug',
            'status',
            'created_at',
            'updated_at'
        )
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

//        dd($pages);


        return response()->view('frontend.sitemap.index', compact(
            'services',
            'gallery_categories',
            'galleries',
            'posts',
            'pages',
        ))
            ->header('Content-Type', 'text/xml');


    }

    public function rss(Request $request)
    {
//
//        ///Services
//        $services = Service::with(array('servicesTranlations' => function ($query) use ($request) {
//            $query->where('language_id', $request->languageID);
//
//        }))
//            ->with('servicesCategoriesCheck')
//            ->join('services_categories_lists', 'services_categories_lists.service_id', '=', 'services.id')
//            ->join('services_categories', function ($join) {
//                $join->on('services_categories_lists.category_id', '=', 'services_categories.id')->where('services_categories.status', 1);
//            })
//            ->select(
//                'services.id as id',
//                'services.image as image',
//                'services.images as images',
//                'services.slug as slug',
//
//                'services.status as status',
//                'services.created_at as created_at',
//                'services.updated_at as updated_at',
//            )
//            ->where('services.status', 1)
//            ->groupBy('services_categories_lists.service_id')
//            ->orderBy('sort', 'ASC')
//            ->get();
//
//
//
//        //Posts
//        $posts = Post::with(array('postsTranlations' => function ($query) use ($request) {
//            $query->where('language_id', $request->languageID);
//
//        }))
//            ->with('postsCategoriesCheck')
//            ->join('posts_categories_lists', 'posts_categories_lists.post_id', '=', 'posts.id')
//            ->join('posts_categories', function ($join) {
//                $join->on('posts_categories_lists.category_id', '=', 'posts_categories.id')->where('posts_categories.status', 1);
//            })
//            ->select(
//                'posts.id as id',
//                'posts.image as image',
//                'posts.images as images',
//                'posts.slug as slug',
//
//                'posts.status as status',
//                'posts.created_at as created_at',
//                'posts.updated_at as updated_at',
//            )
//            ->where('posts.status', 1)
//            ->groupBy('posts_categories_lists.post_id')
//            ->orderBy('id', 'DESC')
//            ->get();
//
//        $teams = Team::with(array('teamsTranlations' => function ($query) use ($request) {
//            $query->where('language_id', $request->languageID);
//
//        }))->where('status', 1)
//            ->orderBy('sort', 'ASC')
//            ->get();
//
//
//
//
//
//        $pages = Page::with(array('pagesTranlations' => function ($query)  use ($request) {
//            $query->where('language_id', $request->languageID);
//
//        }))->where('status', 1)
//            ->orderBy('id', 'DESC')
//            ->get();


        return response()->view('frontend.sitemap.rss')
            ->header('Content-Type', 'text/xml');


    }
}
