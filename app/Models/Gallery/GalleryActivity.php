<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryActivity extends Model
{
    use HasFactory;

    protected $table = 'galleries_activities';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function galleriesActivitiesTranslations()
    {
        return $this->hasMany('App\Models\Gallery\GalleryActivityTranslation','activity_id','id');
    }


    public function getGalleriesCount()
    {
        return $this->hasMany('App\Models\Gallery\GalleryActivityList','activity_id','id');
    }

}
