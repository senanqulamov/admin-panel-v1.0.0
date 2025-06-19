<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryActivityTranslation extends Model
{
    use HasFactory;

    protected $table = 'galleries_activities_translations';
    protected $guarded = [];

}
