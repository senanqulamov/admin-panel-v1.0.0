<?php

namespace App\Http\Requests\Faq;

use Illuminate\Foundation\Http\FormRequest;

class FaqAddRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            /*   TITLE   */
            'title.*' => 'required|max:255',

        ];
    }


    public function messages()
    {
        return [

            /*   TITLE   */
            'title.*.required' => 'Title <span>[[@:attribute@]]</span> boş buraxıla bilməz',
            'title.*.max' => 'Title <span>[[@:attribute@]]</span> maximum 255 simvol olmalıdır',

        ];
    }




}
