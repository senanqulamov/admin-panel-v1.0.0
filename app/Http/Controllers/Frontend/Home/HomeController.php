<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slide\ContactSendRequest;
use App\Mail\Frontend\SendMail;
use App\Models\Banner\Banner;
use App\Models\Gallery\Gallery;
use App\Models\OnlineCatalog\OnlineCatalog;
use App\Models\Partner\Partner;
use App\Models\Post\Post;
use App\Models\Review\Review;
use App\Models\Service\Service;
use App\Models\Slide\Slide;
use App\Models\Team\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Display the home page with various sections.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {


        $slides = Slide::where('language_id', '1')
            ->where('status', 1)
            ->join('slides_translations', 'slides.id', '=', 'slides_translations.slide_id')
            ->orderBy('sort', 'ASC')
            ->get();


        $services = Service::where('language_id', '1')
            ->where('status', 1)
            ->join('services_translations', 'services.id', '=', 'services_translations.service_id')
            ->orderBy('sort', 'ASC')
            ->limit(8)
            ->get();


        $galleries = Gallery::where('language_id', $request->languageID)
            ->with('galleriesCategoriesCheck')
            ->where('status', 1)
            ->where('show_home', 1)
            ->join('galleries_translations', 'galleries.id', '=', 'galleries_translations.gallery_id')
            ->orderBy('galleries.sort', 'ASC')
            ->orderBy('galleries.id', 'DESC')
            ->limit(20)
            ->get();


        $partners = Partner::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('partners_translations', 'partners.id', '=', 'partners_translations.partner_id')
            ->orderBy('sort', 'ASC')
            ->limit(8)
            ->get();

        $blogs = Post::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('posts_translations', 'posts.id', '=', 'posts_translations.post_id')
            ->orderBy('posts.id', 'DESC')
            ->limit(3)
            ->get();


        return view('frontend.home.index', compact(
            'slides',
            'services',
            'galleries',
            'partners',
            'blogs',
        ));
    }

    public function contact(Request $request)
    {

        return view('frontend.home.contact');
    }

    public function contactSendAjax(Request $request)
    {
        $name = $request->name;
        $subject = $request->subject;
        $email = $request->email;
        $mobil = $request->mobil;
        $text = $request->text;


        if (isset($subject)) {
            $subject = $subject;
        } else {
            $subject = language('general.title');
        }

        $data = [
            'name' => $name,
            'subject' => $subject,
            'email' => $email,
            'mobil' => $mobil,
            'text' => $text,
        ];

        $responseData = [];

        if (empty($data['name'])) {
            array_push($responseData, language('frontend.contact.form_error_name'));

        }

//        if (empty($data['email'])) {
//            array_push($responseData, language('frontend.contact.form_error_email'));
//        } else {
//            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
//                array_push($responseData, language('frontend.contact.form_error_email_invalid'));
//            }
//        }


        if (empty($data['email'])) {
            array_push($responseData, language('frontend.contact.form_error_email'));
        } else {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                array_push($responseData, language('frontend.contact.form_error_email_invalid'));
            }
        }


        if (empty($data['mobil'])) {
            array_push($responseData, language('frontend.contact.form_error_tel'));
        }

        if (empty($data['text'])) {
            array_push($responseData, language('frontend.contact.form_error_text'));
        }

        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return response()->json(['error' => true, 'data' => $responseData]);
        }

        if (!empty($data['name']) && !empty($data['subject']) && !empty($data['mobil']) && !empty($data['text'])) {

            $toMail = setting('email');


            Mail::to($toMail)
                ->send(new SendMail($data));

            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true, 'data' => $responseData]);
        }


    }


}
