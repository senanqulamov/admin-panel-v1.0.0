<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return [
            'logo' => 'mimes:jpg,png,webp,svg',
            'logo_dark' => 'mimes:jpg,png,webp,svg',
            'favicon' => 'mimes:jpg,png',
        ];
    }


    public function messages()
    {
        return [
            'logo.mimes' => 'Siz logo üçün səhv şəkil formatı seçdiniz.İcazə verilən formatlar (jpg,jpeg,png,webp,svg)',
            'logo_dark.mimes' => 'Siz tünd logo üçün səhv şəkil formatı seçdiniz.İcazə verilən formatlar (jpg,jpeg,png,webp,svg)',
            'favicon.mimes' => 'Siz favicon üçün səhv şəkil formatı seçdiniz.İcazə verilən formatlar (jpg,jpeg,png)',
        ];
    }


}
