<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCountry extends Model
{
    use HasFactory;

    protected $table = 'galleries_countries';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function galleriesCountriesTranslations()
    {
        return $this->hasMany('App\Models\Gallery\GalleryCountryTranslation','country_id','id');
    }


    public function getGalleriesCount()
    {
        return $this->hasMany('App\Models\Gallery\GalleryCountryList','country_id','id');
    }

}
