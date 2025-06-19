<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gallery\GalleryActivityAddRequest;
use App\Http\Requests\Gallery\GalleryActivityEditRequest;
use App\Models\Language\Languages;
use App\Models\Gallery\GalleryActivity;
use App\Models\Gallery\GalleryActivityTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GalleryActivityController extends Controller
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


        $galleryActivities= GalleryActivity::where('language_id',  $this->defaultLanguage)
            ->with('getGalleriesCount')
            ->orderBy('id', 'DESC')
            ->join('galleries_activities_translations', 'galleries_activities_translations.activity_id', '=', 'galleries_activities.id')
            ->paginate(10);
        $defaultLanguage = $this->defaultLanguage;


        return view('admin.gallery.activity.index', compact('galleryActivities','defaultLanguage'));
    }

    public function add(Request $request)
    {


        return view('admin.gallery.activity.add',['defaultLanguage' => $this->defaultLanguage]);
    }

    public function store(GalleryActivityAddRequest $request)
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




        $galleryActivity = GalleryActivity::create([
            'status' => $status,
            'slug' => $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Gallery\GalleryActivity'):uniqueSlug($slug,'\App\Models\Gallery\GalleryActivity'),
            'image' => str_replace(env('APP_URL'), '', $image),
        ]);


        foreach ($request->name as $key => $name):

            GalleryActivityTranslation::create([
                'name' => $name,
                'text' => $request->text[$key],
                'icon' => $request->icon[$key],
                'title' => $request->title[$key],
                'keyword' => $request->keyword[$key],
                'description' => $request->description[$key],
                'activity_id' => $galleryActivity->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.gallery.activity.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $galleryActivity = GalleryActivity::where('id', $id)
            ->with('galleriesActivitiesTranslations')->first();




        $defaultLanguage = $this->defaultLanguage;

        return view('admin.gallery.activity.edit', compact('galleryActivity','defaultLanguage'));
    }

    public function update(GalleryActivityEditRequest $request)
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



        $galleryActivity = GalleryActivity::where('id', $id)->first();
        if($galleryActivity->slug != $slug){
            $galleryActivity->slug = $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Gallery\GalleryActivity'):uniqueSlug($slug,'\App\Models\Gallery\GalleryActivity');
        }

        $galleryActivity->status = $status;
        $galleryActivity->image = str_replace(env('APP_URL'), '', $image);
        $galleryActivity->updated_at = date('Y-m-d H:i:s');
        $galleryActivity->save();


        foreach ($request->name as $key => $name):
            GalleryActivityTranslation::where('activity_id', $id)
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
            $galleryActivityTranslation = GalleryActivityTranslation::where('activity_id', $id)
                ->where('language_id', $key)->first();

            if(!$galleryActivityTranslation){
                GalleryActivityTranslation::create([
                    'name' => $name,
                    'text' => $request->text[$key],
                    'icon' => $request->icon[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'activity_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;




        return redirect()->route('admin.gallery.activity.index');


    }

    public function search(Request $request)
    {
        $search = $request->search;


        $galleryActivities = GalleryActivity::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('galleries_activities_translations','galleries_activities.id','=','galleries_activities_translations.activity_id')
            ->orderBy('id', 'DESC')
            ->select(
                '*',
                'galleries_activities.updated_at as updated_at',
            )
            ->paginate(10);


        $defaultLanguage = $this->defaultLanguage;

        return view('admin.gallery.activity.search', compact('galleryActivities','defaultLanguage'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $page = GalleryActivity::where('id', $id)->first();
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
        $activity = GalleryActivity::where('language_id',  $this->defaultLanguage)
            ->where('galleries_activities.id',$id)
            ->join('galleries_activities_translations', 'galleries_activities_translations.activity_id', '=', 'galleries_activities.id')
            ->join('galleries_activities_lists','galleries_activities_lists.activity_id','=','galleries_activities.id')
            ->first();


        $error = '';
        $name = '';
        if(is_null($activity)){
            $error = null;
        }else{
            $name = $activity->name;
        }


        return response()->json(['success' => true,'error' => $error,'name' => $name], 200);

    }

    public function delete(Request $request)
    {

        $id = intval($request->id);

        GalleryActivity::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            GalleryActivity::where('id', $id)->delete();
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
