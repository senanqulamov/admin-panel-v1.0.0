<?php

namespace App\Http\Controllers\Frontend\Language;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class LanguageController extends Controller
{


    public function change(Request $request)
    {

        $urlTrimCurrentLang = "";
        $requestScheme = $_SERVER['REQUEST_SCHEME'];
        $httpHost = $_SERVER['HTTP_HOST'];
        $hostUrl =  $requestScheme.'://'.$httpHost;

        $fullUrl = $request->fullUrl;
//        $urlAfter = Str::after($fullUrl, trim(env('APP_URL'), '/'));
        $urlAfter = Str::after($fullUrl, trim($hostUrl, '/'));


        if($request->currentLang == cache('language-default')){
            $urlTrimCurrentLang = $urlAfter;
        }else{
            $urlTrimCurrentLang = Str::after($urlAfter, $request->currentLang);
        }

        //Ajaxla gelir
        $lang = $request->changeLange;

        $language = [];
        foreach (Cache::get('key-all-languages') as $languages):
            $language[] = $languages->code;
        endforeach;

        if (in_array($lang, $language)) {

            //Dili cookie -ye yazdim admin panelde ana
            // sehife tikladiqda hansi dildirse ora yoneldsin
            setcookie('current_language', $lang, time() + (86400 * 30), "/");

            $urlResult = '';
            if (Cache::get('language-default') == $lang) {
//                $urlResult = trim(env('APP_URL'), '/') . $urlTrimCurrentLang;
                $urlResult = trim($hostUrl, '/') . $urlTrimCurrentLang;
            } else {
//                $urlResult = trim(env('APP_URL'), '/') . '/' . $lang . $urlTrimCurrentLang;
                $urlResult = trim($hostUrl, '/') . '/' . $lang . $urlTrimCurrentLang;
            }
            return response()->json(['success' => true, 'data' => $urlResult], 200);
        } else {
            return response()->json(['success' => false], 200);
        }


    }
}
