<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function galleriesTranslations()
    {
        return $this->hasMany('App\Models\Gallery\GalleryTranslation','gallery_id','id');
    }

    public function galleriesCategories()
    {
        return $this->hasMany('App\Models\Gallery\GalleryCategoryList','gallery_id','id');
    }

    public function galleriesCategoriesCheck()
    {
        return $this->hasMany('App\Models\Gallery\GalleryCategoryList','gallery_id','id')
            ->join('galleries_categories','galleries_categories.id','=','galleries_categories_lists.category_id')
            ->join('galleries_categories_translations','galleries_categories.id','=','galleries_categories_translations.category_id')
            ->where('status',1)
            ->where('galleries_categories_translations.language_id',request('languageID')? request('languageID'):cache('language-defaultID'));
    }

    public function getGalleryActivity()
    {
        return $this->hasOne('App\Models\Gallery\GalleryActivityList','gallery_id','id')
            ->join('galleries_activities','galleries_activities.id','=','galleries_activities_lists.activity_id')
            ->join('galleries_activities_translations','galleries_activities.id','=','galleries_activities_translations.activity_id')
            ->where('galleries_activities_translations.language_id',request('languageID')? request('languageID'):cache('language-defaultID'));
    }


    public function getGalleryCountry()
    {
        return $this->hasOne('App\Models\Gallery\GalleryCountryList','gallery_id','id')
            ->join('galleries_countries','galleries_countries.id','=','galleries_countries_lists.country_id')
            ->join('galleries_countries_translations','galleries_countries.id','=','galleries_countries_translations.country_id')
            ->where('galleries_countries_translations.language_id',request('languageID')? request('languageID'):cache('language-defaultID'));
    }



}
