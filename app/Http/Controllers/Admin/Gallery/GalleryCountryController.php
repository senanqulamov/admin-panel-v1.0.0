<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gallery\GalleryCountryAddRequest;
use App\Http\Requests\Gallery\GalleryCountryEditRequest;
use App\Models\Language\Languages;
use App\Models\Gallery\GalleryCountry;
use App\Models\Gallery\GalleryCountryTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GalleryCountryController extends Controller
{
    public $defaultLanguage;
    public $validatorCheck;


    public function __construct()
    {

        //Hansi dil defaultdursa onu caqir
        $this->defaultLanguage = cache('language-defaultID') == null ? Languages::where('default', 1)
            ->first()->id : cache('language-defaultID');

    }

    public function index(Request $request)
    {


        $galleryCountries= GalleryCountry::where('language_id',  $this->defaultLanguage)
            ->with('getGalleriesCount')
            ->orderBy('id', 'DESC')
            ->join('galleries_countries_translations', 'galleries_countries_translations.country_id', '=', 'galleries_countries.id')
            ->paginate(10);
        $defaultLanguage = $this->defaultLanguage;


        return view('admin.gallery.country.index', compact('galleryCountries','defaultLanguage'));
    }

    public function add(Request $request)
    {


        return view('admin.gallery.country.add',['defaultLanguage' => $this->defaultLanguage]);
    }

    public function store(GalleryCountryAddRequest $request)
    {

        $status = $request->status;
        $image = $request->image;
        $slug = $request->slug;




        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();




        $galleryCountry = GalleryCountry::create([
            'status' => $status,
            'slug' => $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Gallery\GalleryCountry'):uniqueSlug($slug,'\App\Models\Gallery\GalleryCountry'),
            'image' => str_replace(env('APP_URL'), '', $image),
        ]);


        foreach ($request->name as $key => $name):

            GalleryCountryTranslation::create([
                'name' => $name,
                'text' => $request->text[$key],
                'icon' => $request->icon[$key],
                'title' => $request->title[$key],
                'keyword' => $request->keyword[$key],
                'description' => $request->description[$key],
                'country_id' => $galleryCountry->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.gallery.country.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $galleryCountry = GalleryCountry::where('id', $id)
            ->with('galleriesCountriesTranslations')->first();




        $defaultLanguage = $this->defaultLanguage;

        return view('admin.gallery.country.edit', compact('galleryCountry','defaultLanguage'));
    }

    public function update(GalleryCountryEditRequest $request)
    {
        $id = $request->id;
        $status = $request->status;
        $image = $request->image;
        $slug = $request->slug;


        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        //Eger gonderilen ID sehfdirse
        $refererError = CommonService::refererError($id);
        if ($refererError) {
            $this->validateCheck('refererID', 'Səhf ID istifadə etdiniz!');
        }


        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }


        $this->validatorCheck->validate();



        $galleryCountry = GalleryCountry::where('id', $id)->first();
        if($galleryCountry->slug != $slug){
            $galleryCountry->slug = $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Gallery\GalleryCountry'):uniqueSlug($slug,'\App\Models\Gallery\GalleryCountry');
        }

        $galleryCountry->status = $status;
        $galleryCountry->image = str_replace(env('APP_URL'), '', $image);
        $galleryCountry->updated_at = date('Y-m-d H:i:s');
        $galleryCountry->save();


        foreach ($request->name as $key => $name):
            GalleryCountryTranslation::where('country_id', $id)
                ->where('language_id', $key)
                ->update([
                    'name' => $name,
                    'text' => $request->text[$key],
                    'icon' => $request->icon[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'language_id' => $key,
                ]);



            //Eger yeni dil elave olunubsa bura ishleyecek.
            //Cunki databasede hemen tablede bele bir dil yoxdur update etmediyi ucun create etmelidir
            $galleryCountryTranslation = GalleryCountryTranslation::where('country_id', $id)
                ->where('language_id', $key)->first();

            if(!$galleryCountryTranslation){
                GalleryCountryTranslation::create([
                    'name' => $name,
                    'text' => $request->text[$key],
                    'icon' => $request->icon[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'country_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;




        return redirect()->route('admin.gallery.country.index');


    }

    public function search(Request $request)
    {
        $search = $request->search;


        $galleryCountries = GalleryCountry::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('galleries_countries_translations','galleries_countries.id','=','galleries_countries_translations.country_id')
            ->orderBy('id', 'DESC')
            ->select(
                '*',
                'galleries_countries.updated_at as updated_at',
            )
            ->paginate(10);


        $defaultLanguage = $this->defaultLanguage;

        return view('admin.gallery.country.search', compact('galleryCountries','defaultLanguage'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $page = GalleryCountry::where('id', $id)->first();
        $data = '';
        $success = '';

        if ($page) {
            $page->status = $statusActive;
            $page->save();

            if ($statusActive == 1) {
                $data = 1;
            } else {
                $data = 0;
            }

            $success = true;
        } else {
            $success = false;

        }


        return response()->json(['success' => $success, 'data' => $data]);
    }

    public function deleteAjax(Request $request)
    {
        $id = $request->id;
        $country = GalleryCountry::where('language_id',  $this->defaultLanguage)
            ->where('galleries_countries.id',$id)
            ->join('galleries_countries_translations', 'galleries_countries_translations.country_id', '=', 'galleries_countries.id')
            ->join('galleries_countries_lists','galleries_countries_lists.country_id','=','galleries_countries.id')
            ->first();


        $error = '';
        $name = '';
        if(is_null($country)){
            $error = null;
        }else{
            $name = $country->name;
        }


        return response()->json(['success' => true,'error' => $error,'name' => $name], 200);

    }

    public function delete(Request $request)
    {

        $id = intval($request->id);

        GalleryCountry::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            GalleryCountry::where('id', $id)->delete();
        endforeach;

        return response()->json(['success' => true], 200);

    }


    public function validateCheck($inputName, $text)
    {
        $this->validatorCheck->after(function ($validator) use ($inputName, $text) {
            $validator->errors()->add($inputName, $text);
        });
    }
}
