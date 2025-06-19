<?php

namespace App\Http\Controllers\Frontend\Service;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Partner\Partner;
use App\Models\Post\Post;
use App\Models\Service\Service;
use App\Models\Service\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{


    public function index(Request $request)
    {
        $services = Service::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('services_translations', 'services.id', '=', 'services_translations.service_id')
            ->orderBy('sort', 'ASC')
            ->get();



        return view('frontend.service.index', compact(
            'services',
        ));
    }


    public function detail(Request $request)
    {


        $service = Service::where('language_id', $request->languageID)
            ->where('status', 1)
            ->where('slug', $request->slug)
            ->join('services_translations', 'services.id', '=', 'services_translations.service_id')
            ->orderBy('sort', 'ASC')
            ->first();

        $services = Service::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('services_translations', 'services.id', '=', 'services_translations.service_id')
            ->orderBy('sort', 'ASC')
            ->get();




        return view('frontend.service.detail', compact(
            'services',
            'service',
        ));

    }


}
