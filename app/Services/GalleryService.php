<?php

namespace App\Services;

use App\Models\Gallery\Gallery;

class GalleryService
{


    public static function getGalleries($languageID,$limit)
    {

        return Gallery::with(array('galleriesTranslations' => function ($query) use ($languageID) {
            $query->where('language_id', $languageID);

        }))
            ->with('galleriesCategoriesCheck')
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit($limit)
            ->get();

    }


    public static function getGalleriesForFooter($languageID,$limit)
    {

        return Gallery::with(array('galleriesTranslations' => function ($query) use ($languageID) {
            $query->where('language_id', $languageID);

        }))
            ->join('galleries_categories_lists', 'galleries_categories_lists.gallery_id', '=', 'galleries.id')
            ->where('galleries_categories_lists.category_id','!=',59)
            ->where('galleries_categories_lists.category_id','!=',60)
            ->where('galleries_categories_lists.category_id','!=',61)
            ->where('galleries_categories_lists.category_id','!=',62)
            ->where('galleries_categories_lists.category_id','!=',63)
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit($limit)
            ->get();

    }

}
