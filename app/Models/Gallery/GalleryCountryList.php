<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCountryList extends Model
{
    use HasFactory;

    protected $table = 'galleries_countries_lists';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
