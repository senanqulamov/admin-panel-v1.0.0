<?php

namespace App\Http\Controllers\Frontend\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\GalleryCategory;
use App\Models\Partner\Partner;
use App\Models\Project\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{

    public function index(Request $request)
    {



        $category = GalleryCategory::where('language_id',  $request->languageID)
            ->with('childrens')
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->where('slug', $request->category)
            ->where('status', 1)
            ->first();




        if(!$category){
            abort(404);
        }


        $parentCategory = [];
        if($category->parent != 0){

            $parentCategory = GalleryCategory::where('language_id',  $request->languageID)
                ->with('childrens')
                ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
                ->where('id', $category->parent)
                ->where('status', 1)
                ->first();

        }





        $galleries = Gallery::with(array('galleriesTranslations' => function ($query) use($request) {
            $query->where('language_id', $request->languageID);

        })) ->with('galleriesCategoriesCheck')
            ->with('getGalleryActivity')
            ->where('galleries_categories_lists.category_id', $category->id)
            ->join('galleries_categories_lists', 'galleries_categories_lists.gallery_id', '=', 'galleries.id')
            ->orderBy('galleries.created', 'DESC')
            ->orderBy('galleries.id', 'DESC')
            ->select('*', 'galleries.id as id')
            ->where('status', 1)
            ->paginate(10);







//        $breadcrupmCategories = GalleryCategory::where('language_id',  $request->languageID)
//            ->orderBy('id', 'DESC')
//            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
//            ->where('galleries_categories.status',1)
//            ->get();






        $partners = Partner::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('partners_translations', 'partners.id', '=', 'partners_translations.partner_id')
            ->orderBy('sort', 'ASC')
            ->limit(8)
            ->get();


        return view('frontend.gallery.index', compact(
            'galleries',
            'partners',
            'category',
            'parentCategory',
        ));
    }

    public function detail(Request $request)
    {

        $slug = $request->slug;
        $gallery = Gallery::with(['galleriesTranslations' => function ($query) use ($request) {
                $query->where('language_id', $request->languageID);
            }])
            ->with('galleriesCategoriesCheck')
            ->with('getGalleryActivity')
            ->with('getGalleryCountry')
            ->where('slug', $slug)
            ->where('status', 1)
            ->first();




        if (!$gallery) {
            abort(404);
        }


        $category = GalleryCategory::where('language_id',  $request->languageID)
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->where('slug', $request->category)
            ->where('status', 1)
            ->select(
                'id',
                'name',
                'slug'
            )
            ->first();




        $otherGalleries = Gallery::with(array('galleriesTranslations' => function ($query) use($request) {
            $query->where('language_id', $request->languageID);

        })) ->with('galleriesCategoriesCheck')
            ->join('galleries_categories_lists', 'galleries_categories_lists.gallery_id', '=', 'galleries.id')
            ->select('*', 'galleries.id as id')
            ->where('galleries_categories_lists.category_id', $category->id)
            ->where('galleries.status', 1)
            ->where('galleries.id','!=', $gallery->id)
            ->orderBy(DB::raw('RAND()'))
            ->limit(10)
            ->get();




        return view('frontend.gallery.detail', compact(
            'gallery',
            'otherGalleries',
            'category',
        ));

    }

    public function categories(Request $request)
    {



        $galleryCategories= GalleryCategory::where('language_id',  $request->languageID)
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->where('galleries_categories.status',1)
            ->where('galleries_categories.level',0)
            ->where('galleries_categories.id','!=',59)
            ->where('galleries_categories.id','!=',60)
            ->where('galleries_categories.id','!=',61)
            ->where('galleries_categories.id','!=',62)
            ->where('galleries_categories.id','!=',63)
            ->orderBy('galleries_categories.sort', 'ASC')
            ->get();


        $galleries = Gallery::where('language_id', $request->languageID)
            ->with('galleriesCategoriesCheck')
            ->where('status', 1)
            ->where('show_home', 1)
            ->join('galleries_translations', 'galleries.id', '=', 'galleries_translations.gallery_id')
            ->orderBy('galleries.sort', 'ASC')
            ->limit(20)
            ->get();



        return view('frontend.gallery.category.index',compact(
            'galleryCategories',
            'galleries',
        ));
    }



}
