<?php

namespace App\Models\Faq;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faqs';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function faqsTranslations()
    {
        return $this->hasMany('App\Models\Faq\FaqTranslation','faq_id','id');
    }

}
