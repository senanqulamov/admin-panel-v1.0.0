<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function servicesTranslations()
    {
        return $this->hasMany('App\Models\Service\ServiceTranslation','service_id','id');
    }

    public function servicesCategories()
    {
        return $this->hasMany('App\Models\Service\ServiceCategoryList','service_id','id');
    }

    public function servicesCategoriesCheck()
    {
        return $this->hasMany('App\Models\Service\ServiceCategoryList','service_id','id')
            ->join('services_categories','services_categories.id','=','services_categories_lists.category_id')
            ->join('services_categories_translations','services_categories.id','=','services_categories_translations.category_id')
            ->where('status',1)
            ->where('services_categories_translations.language_id',request('languageID')? request('languageID'):cache('language-defaultID'));
    }


}
