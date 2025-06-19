<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $table = 'galleries_categories';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function galleriesCategoriesTranslations()
    {
        return $this->hasMany('App\Models\Gallery\GalleryCategoryTranslation','category_id','id');
    }

    public function childrens()
    {
        return $this->hasMany(GalleryCategory::class,'parent')
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->where('status', 1)
            ->where('galleries_categories_translations.language_id',request('languageID')? request('languageID'):cache('language-defaultID'))
            ->orderBy('galleries_categories_translations.name','ASC');
    }


    public function getGalleriesCount()
    {
        return $this->hasMany('App\Models\Gallery\GalleryCategoryList','category_id','id');
    }

}
