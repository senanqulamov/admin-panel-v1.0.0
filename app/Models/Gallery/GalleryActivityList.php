<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryActivityList extends Model
{
    use HasFactory;

    protected $table = 'galleries_activities_lists';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
