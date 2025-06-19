<?php

namespace App\Http\Controllers\Admin\Faq;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\FaqAddRequest;
use App\Http\Requests\Faq\FaqEditRequest;
use App\Models\Language\Languages;
use App\Models\Faq\Faq;
use App\Models\Faq\FaqTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FaqController extends Controller
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


        $faqs = Faq::with(array('faqsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->orderBy('sort', 'ASC')
            ->paginate(15);


        return view('admin.faq.index', compact('faqs'));
    }

    public function add(Request $request)
    {
        return view('admin.faq.add');
    }

    public function store(FaqAddRequest $request)
    {


        $status = $request->status;

        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();

        $faq = Faq::create([
            'status' => $status,
        ]);

        foreach ($request->title as $key => $title):
            $faqTranslation = FaqTranslation::create([
                'title' => $title,
                'text' => $request->text[$key],
                'faq_id' => $faq->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.faq.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $faq = Faq::where('id', $id)
            ->with('faqsTranslations')->first();


        return view('admin.faq.edit', compact('faq'));
    }

    public function update(FaqEditRequest $request)
    {
        $id = $request->id;
        $status = $request->status;

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


        $faq = Faq::where('id', $id)
            ->update([
                'status' => $status,
            ]);

        foreach ($request->title as $key => $title):

            FaqTranslation::where('faq_id', $id)
                ->where('language_id', $key)
                ->update([
                    'title' => $title,
                    'text' => $request->text[$key],
                    'language_id' => $key,
                ]);

            //Eger yeni dil elave olunubsa bura ishleyecek.
            //Cunki databasede hemen tablede bele bir dil yoxdur update etmediyi ucun create etmelidir
            $faqTranslation = FaqTranslation::where('faq_id', $id)
                ->where('language_id', $key)->first();

            if(!$faqTranslation){
                FaqTranslation::create([
                    'title' => $title,
                    'text' => $request->text[$key],
                    'faq_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;

        return redirect()->route('admin.faq.index');


    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $faq = Faq::where('id', $id)->first();
        $data = '';
        $success = '';

        if ($faq) {
            $faq->status = $statusActive;
            $faq->save();

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


    public function sortAjax(Request $request)
    {
        foreach ($request->positions as $item):
            $id = $item[0];
            $sort = $item[1];
            $language = Faq::where('id', $id)->first();
            if ($language) {
                $language->sort = $sort;
                $language->save();
            }

        endforeach;


        return response()->json(['success' => true]);
    }

    public function deleteAjax(Request $request)
    {
        $id = $request->id;
        Faq::where('id', $id)
            ->first();

        return response()->json(['success' => true], 200);

    }


    public function delete(Request $request)
    {

        $id = intval($request->id);

        Faq::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }



    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            Faq::where('id', $id)->delete();
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
