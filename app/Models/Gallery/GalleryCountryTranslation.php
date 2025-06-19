<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCountryTranslation extends Model
{
    use HasFactory;

    protected $table = 'galleries_countries_translations';
    protected $guarded = [];

}
