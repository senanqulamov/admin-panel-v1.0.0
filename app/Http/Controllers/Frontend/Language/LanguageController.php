<?php

namespace App\Http\Controllers\Frontend\Language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class LanguageController extends Controller
{
    public function change(Request $request)
    {
        $lang = $request->input('changeLange');
        $currentLang = $request->input('currentLang');

        $availableLanguages = Cache::get('key-all-languages')->pluck('code')->toArray();
        $defaultLang = Cache::get('language-default');

        if (!in_array($lang, $availableLanguages)) {
            return response()->json(['success' => false], 200);
        }

        setcookie('current_language', $lang, time() + (86400 * 30), "/");

        $host = $request->getSchemeAndHttpHost();
        $fullUrl = $request->input('fullUrl');
        $uri = Str::after($fullUrl, $host);

        if ($currentLang !== $defaultLang) {
            $uri = Str::replaceFirst('/' . $currentLang, '', $uri);
        }

        if ($lang !== $defaultLang) {
            $uri = '/' . $lang . $uri;
        }

        $uri = preg_replace('#/+#', '/', $uri);
        $urlResult = $host . $uri;

        return response()->json(['success' => true, 'data' => $urlResult], 200);
    }

}
