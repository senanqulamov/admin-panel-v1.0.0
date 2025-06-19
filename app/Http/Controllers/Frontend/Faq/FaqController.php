<?php

namespace App\Http\Controllers\Frontend\Faq;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Faq\Faq;
use App\Models\Post\Post;
use App\Models\Faq\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{


    public function index(Request $request)
    {
        $faqs = Faq::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('faqs_translations', 'faqs.id', '=', 'faqs_translations.faq_id')
            ->orderBy('sort', 'ASC')
            ->get();



        return view('frontend.faq.index', compact(
            'faqs',
        ));
    }




}
