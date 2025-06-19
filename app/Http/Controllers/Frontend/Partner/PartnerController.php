<?php

namespace App\Http\Controllers\Frontend\Partner;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Partner\Partner;
use App\Models\Post\Post;
use App\Models\Partner\PartnerCategory;
use Illuminate\Http\Request;

class PartnerController extends Controller
{


    public function index(Request $request)
    {
        $partners = Partner::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('partners_translations', 'partners.id', '=', 'partners_translations.partner_id')
            ->orderBy('sort', 'ASC')
            ->get();



        return view('frontend.partner.index', compact(
            'partners',
        ));
    }




}
