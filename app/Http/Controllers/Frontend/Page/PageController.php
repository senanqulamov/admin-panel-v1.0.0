<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Http\Controllers\Controller;
use App\Mail\Frontend\CalculatorSendMail;
use App\Mail\Frontend\SendMail;
use App\Models\Gallery\Gallery;
use App\Models\Language\LanguagePhrases;
use App\Models\Language\LanguagePhraseTranslations;
use App\Models\Page\Page;
use App\Models\Partner\Partner;
use App\Models\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{


    public function page(Request $request)
    {

        $page = Page::where('language_id', $request->languageID)
            ->where('status', 1)
            ->where('slug', $request->slug)
            ->join('pages_translations', 'pages.id', '=', 'pages_translations.page_id')
            ->select(
                '*',
                'pages.updated_at as updated_at',
            )
            ->first();

        if (!$page) {
            abort(404);
        }


        return view('frontend.page.index', compact('page'));
    }

    public function aboutUs(Request $request)
    {

        $services = Service::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('services_translations', 'services.id', '=', 'services_translations.service_id')
            ->orderBy('sort', 'ASC')
            ->limit(3)
            ->get();


        $galleries = Gallery::where('language_id', $request->languageID)
            ->with('galleriesCategoriesCheck')
            ->where('status', 1)
            ->where('show_home', 1)
            ->join('galleries_translations', 'galleries.id', '=', 'galleries_translations.gallery_id')
            ->orderBy('galleries.sort', 'ASC')
            ->limit(20)
            ->get();

        $partners = Partner::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('partners_translations', 'partners.id', '=', 'partners_translations.partner_id')
            ->orderBy('sort', 'ASC')
            ->limit(8)
            ->get();



        return view('frontend.page.about_us', compact(
            'services',
            'galleries',
            'partners',
        ));
    }


    public function mobileApp(Request $request)
    {

        $projects = Gallery::where('galleries_categories_lists.category_id',59)
            ->join('galleries_categories_lists', 'galleries_categories_lists.gallery_id', '=', 'galleries.id')
            ->orderBy('galleries.sort', 'DESC')
            ->where('status', 1)
            ->first();




        return view('frontend.page.mobile_app',compact(
            'projects'
        ));
    }


    public function evisitcard(Request $request)
    {

        $projects = Gallery::where('galleries_categories_lists.category_id',60)
            ->join('galleries_categories_lists', 'galleries_categories_lists.gallery_id', '=', 'galleries.id')
            ->orderBy('galleries.sort', 'DESC')
            ->where('status', 1)
            ->first();




        return view('frontend.page.evisitcard',compact(
            'projects'
        ));
    }


    public function attendanceTracking(Request $request)
    {

        $projects = Gallery::where('galleries_categories_lists.category_id',61)
            ->join('galleries_categories_lists', 'galleries_categories_lists.gallery_id', '=', 'galleries.id')
            ->orderBy('galleries.sort', 'DESC')
            ->where('status', 1)
            ->first();




        return view('frontend.page.attendance_tracking',compact(
            'projects'
        ));
    }

    public function jobhbn(Request $request)
    {

        $projects = Gallery::where('galleries_categories_lists.category_id',62)
            ->join('galleries_categories_lists', 'galleries_categories_lists.gallery_id', '=', 'galleries.id')
            ->orderBy('galleries.sort', 'DESC')
            ->where('status', 1)
            ->first();




        return view('frontend.page.jobhbn',compact(
            'projects'
        ));
    }

    public function gpsTracking(Request $request)
    {


        $projects = Gallery::where('galleries_categories_lists.category_id',63)
            ->join('galleries_categories_lists', 'galleries_categories_lists.gallery_id', '=', 'galleries.id')
            ->orderBy('galleries.sort', 'DESC')
            ->where('status', 1)
            ->first();




        return view('frontend.page.gps_tracking',compact(
            'projects'
        ));

    }

    public function diller(Request $request)
    {


        /*   BIRINCI BUNU KOCUR SONRA BUNU SONDUR    */
//        $langPhr = LanguagePhrases::where(
//            'language_group_id' ,82,
//        )->get();
//
//        foreach ($langPhr as $lnPr){
//            $id = $lnPr->id;
//            $key = str_replace('mobile_app','jobhbn',$lnPr->key);
//            $editor = $lnPr->editor;
//            $language_group_id = $lnPr->language_group_id;
//            echo $key.PHP_EOL;
//            echo $editor.PHP_EOL;
//            echo $language_group_id.PHP_EOL;
//
//            LanguagePhrases::create([
//                'key' => $key,
//                'editor' => $editor,
//                'language_group_id' => 88,
//            ]);
//        }




        /*   YUXARIDAKILARI SONDURDUYDEN SONRA  BURANI YANDIR    */
//        $hansiDilGroupId = 82;
//        $hansi_dil_group_id_kocurulecek = 88;
//        $az_dili_id = 1;
//        $rus_dili_id = 2;
//        $eng_dili_id = 51;
//        $langPhr = LanguagePhrases::where(
//            'language_group_id' ,$hansiDilGroupId,
//        )->select('id')->get();
//
//        $langPhrTest = LanguagePhrases::where(
//            'language_group_id' ,$hansi_dil_group_id_kocurulecek,
//        )->select('id')->get();
//
//        foreach ($langPhr as $testKey => $lnPr){
//            $id = $lnPr->id;
////            echo $id.PHP_EOL;
//
//
//            $langPhrTrs = LanguagePhraseTranslations::where(
//                'phrase_id', '>=', $id,
//
//            )
//                ->where('language_id',$az_dili_id)
//                ->first();
//
//            $menimIDIM = $langPhrTest[$testKey]->id;
//            $langID = $langPhrTrs->language_id;
//            $value = $langPhrTrs->value ?? '';
//
//            echo $menimIDIM.PHP_EOL;
//            echo $langID.PHP_EOL;
//            echo $value.PHP_EOL;
//
//            LanguagePhraseTranslations::create(
//                [
//                    'phrase_id' => $menimIDIM,
//                    'language_id' => $langID,
//                    'value' => $value,
//                ]
//
//            );
//
//
//            $langPhrTrs2 = LanguagePhraseTranslations::where(
//                'phrase_id', '>=', $id,
//
//            )
//                ->where('language_id',$rus_dili_id)
//                ->first();
//
//            $langID2 = $langPhrTrs2->language_id;
//            $value2 = $langPhrTrs2->value ?? '';
//
//            echo $menimIDIM.PHP_EOL;
//            echo $langID2.PHP_EOL;
//            echo $value2.PHP_EOL;
//
//            LanguagePhraseTranslations::create(
//                [
//                    'phrase_id' => $menimIDIM,
//                    'language_id' => $langID2,
//                    'value' => $value2,
//                ]
//
//            );
//
//
//            $langPhrTrs3 = LanguagePhraseTranslations::where(
//                'phrase_id', '>=', $id,
//
//            )
//                ->where('language_id',$eng_dili_id)
//                ->first();
//
//            $langID3 = $langPhrTrs3->language_id;
//            $value3 = $langPhrTrs3->value ?? '';
//
//            echo $menimIDIM.PHP_EOL;
//            echo $langID3.PHP_EOL;
//            echo $value3.PHP_EOL;
//
//            LanguagePhraseTranslations::create(
//                [
//                    'phrase_id' => $menimIDIM,
//                    'language_id' => $langID3,
//                    'value' => $value3,
//                ]
//
//            );
//
//
//
//
//        }

        @dd('Kocuruldu');
    }

}
