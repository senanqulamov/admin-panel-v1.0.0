<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\SettingRequest;
use App\Models\Language\Languages;
use App\Models\Setting\Setting;
use App\Models\Setting\SettingTranslation;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{

    public function index(Request $request)
    {
        $languages = Languages::where('status', 1)->get();


        return view('admin.setting.index', compact('languages'));
    }


    public function update(SettingRequest $request)
    {

        /**
         * Logo,Logo tund ve favicon
         */

        //logo
        if ($request->hasFile('logo')) {

            $settingCheck = Setting::where('key', 'logo')->first();

            if (!empty($settingCheck->content)) {
                Storage::delete('public/' . $settingCheck->content);
            }


            $image = $request->file('logo');
            $manufacturerpath = "public";

            $imageExtension = $image->getClientOriginalExtension();
            $imageName = "logo_" . Str::random(15) . ".".$imageExtension;

            $path = $request->file('logo')->storeAs($manufacturerpath, $imageName);

            $key = 'logo';
            $setting = Setting::firstOrCreate(['key' => $key]);
            $setting->key = $key;
            $setting->content = $imageName;
            $setting->status = 1;
            $setting->save();

            if (Cache::has('setting-' . $key)) {
                Cache::forget('setting-' . $key);
            }

        }


        //dark_logo
        if ($request->hasFile('logo_dark')) {

            $settingCheck = Setting::where('key', 'logo_dark')->first();

            if (!empty($settingCheck->content)) {
                Storage::delete('public/' . $settingCheck->content);
            }

            $image = $request->file('logo_dark');
            $manufacturerpath = "public";

            $imageExtension = $image->getClientOriginalExtension();
            $imageName = "logo_dark_" . Str::random(15) . ".".$imageExtension;

            $path = $request->file('logo_dark')->storeAs($manufacturerpath, $imageName);

            $key = 'logo_dark';
            $setting = Setting::firstOrCreate(['key' => $key]);
            $setting->key = $key;
            $setting->content = $imageName;
            $setting->status = 1;
            $setting->save();

            if (Cache::has('setting-' . $key)) {
                Cache::forget('setting-' . $key);
            }

        }

        //favicon
        if ($request->hasFile('favicon')) {


            $settingCheck = Setting::where('key', 'favicon')->first();

            if (!empty($settingCheck->content)) {
                Storage::delete('public/' . $settingCheck->content);
            }

            $image = $request->file('favicon');
            $manufacturerpath = "public";

//            $imageExtension = $image->getClientOriginalExtension();
            $imageName = "favicon_" . Str::random(15) . ".png";

            $path = $request->file('favicon')->storeAs($manufacturerpath, $imageName);

            $key = 'favicon';
            $setting = Setting::firstOrCreate(['key' => $key]);
            $setting->key = $key;
            $setting->content = $imageName;
            $setting->status = 1;
            $setting->save();

            if (Cache::has('setting-' . $key)) {
                Cache::forget('setting-' . $key);
            }

        }


        /**
         * Json olan datalar
         */


        $data2 = [
            'tel',
            'social',
        ];


        foreach ($request->only($data2) as $key => $value):

            $setting = Setting::firstOrCreate(['key' => $key]);
            $setting->key = $key;
            $setting->content = json_encode(array_values($value), JSON_UNESCAPED_UNICODE);
            $setting->status = 1;
            $setting->save();

            if (Cache::has('setting-' . $key)) {
                Cache::forget('setting-' . $key);
            }

        endforeach;


        /**
         * Array ve tek olan datalar
         */

        $data = [
            'copyright',
            'created_by',
            'work_time',
            'address',
            'email',
            'map',
            'custom_code_css',
            'custom_code_js',
            'custom_code_header',
            'custom_code_footer',
        ];


        /**
         * Checkbox olanlar
         * Qeyd burani checkbox uchun ayri duzeltim eks halda 'on' qaytarir problem yaradir
         */

        $checkbox = [
            'disable_site_index' => $request->disable_site_index == 'on' ? 1 : null,
            'maintenance' => $request->maintenance == 'on' ? 1 : null,
        ];



        $merge = array_merge($request->only($data),$checkbox);

        foreach ($merge as $key => $value):

            if (is_array($value)) {

                //bunlar arraydir
                $onlyKeys = $request->only($key);
                $setting = Setting::updateOrCreate(['key' => $key]);
                $setting->key = $key;
                $setting->status = 2;
                $setting->save();


                //BUnu asahqida keshe elave ede bilmekcun yaratdim
                $keshKey = $key;

                SettingTranslation::where('setting_id', $setting->id)
                    ->delete();

                foreach ($onlyKeys as $key => $onlyKey):
                    foreach ($onlyKey as $key => $item):


                        SettingTranslation::create([
                            'setting_id' => $setting->id,
                            'language_id' => $key,
                            'content' => $item,
                        ]);

                        //Keshden sil
                        if (Cache::has('setting-' . $keshKey . '-' . $key)) {
                            Cache::forget('setting-' . $keshKey . '-' . $key);
                        }


                    endforeach;

                endforeach;


            } else {

//                bunlar array deyil
                $onlyKeyValue = $merge[$key];
                $setting = Setting::firstOrCreate(['key' => $key]);
                $setting->key = $key;
                $setting->content = $onlyKeyValue;
                $setting->status = 1;
                $setting->save();

                if (Cache::has('setting-' . $key)) {
                    Cache::forget('setting-' . $key);
                }


            }


        endforeach;

        return redirect()->back();

    }


    public function searchIcons(Request $request)
    {
        $text = $request->text;
        $isExists = 1;
        if(!empty($text)){
            $input = preg_quote($text, '~');
            $data = \App\Services\CommonService::socialIcons();
            $result = preg_grep('~' . $input . '~', $data);
        }else{
            $isExists = 0;
            $result = \App\Services\CommonService::socialIcons();
        }

        return response()->json(['success' => true, 'data' => array_values($result),'isExists' => $isExists],200);
    }


}
