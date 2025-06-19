<?php

namespace App\Http\Requests\Gallery;

use Illuminate\Foundation\Http\FormRequest;

class GalleryActivityEditRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            /*   NAME   */
            'name.*' => 'required|max:255|unique:galleries_activities_translations,name,'.$this->id.',activity_id'

            /*   IMAGE   */
//            'image' => 'required',
        ];
    }


    public function messages()
    {
        return [

            /*   NAME   */
            'name.*.required' => 'Ad <span>[[@:attribute@]]</span> boş buraxıla bilməz',
            'name.*.unique' => 'Ad <span>[[@:attribute@]]</span> xanasındakı söz bazada mövcuddur.Zəhmət olmasa başqa bir ad seçin',
            'name.*.max' => 'Ad <span>[[@:attribute@]]</span> maximum 255 simvol olmalıdır',


            /*   IMAGE   */
//            'image.required' => 'Foto boş buraxıla bilməz',
        ];
    }




}
