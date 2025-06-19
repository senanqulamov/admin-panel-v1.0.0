<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];




    public static function getProduct()
    {


        return Product::where('slug', request('slug'))
            ->where('status', 1)
            ->with(['productsTranslations' => function ($query) {
                $query->where('language_id', request('languageID')? request('languageID'):cache('language-defaultID'));
            }])

            ->leftJoin('products_specials_prices_lists', function ($join) {
                $join->on('products_specials_prices_lists.product_id', '=', 'products.id');
            })
            ->select(
                'products.id as id',
                'products.parent as parent',
                'products.image as image',
                'products.images as images',
                'products.slug as slug',
                'products.price as price',
                'products.status as status',
                'products.length as length',
                'products.width as width',
                'products.height as height',
                'products_specials_prices_lists.special_price as special_price',
                'products_specials_prices_lists.start_date as start_date',
                'products_specials_prices_lists.end_date as end_date',
            )
            ->with('getProductCategories2')
            ->with('getProductModel2')
            ->with('getProductCollections2')
            ->with('getProductManufacturer2')
            ->with('getProductGallery2')
            ->with('getProductColors')
            ->with('getProductColorsGroupBy')
            ->first();
    }

    public function productsTranslations()
    {
        return $this->hasMany('App\Models\Product\ProductTranslation','product_id','id');
    }

    public function children()
    {
        return $this->belongsTo(Product::class,'parent');
    }


    public function childrens()
    {
        return $this->hasMany(Product::class,'parent');
    }

    public function getProductModel()
    {
        return $this->hasOne('App\Models\Product\ProductModelList','product_id','id');
    }

    public function getProductModel2()
    {
        return $this->hasOne('App\Models\Product\ProductModelList','product_id','id')
            ->join('products_models','products_models.id','=','products_models_lists.model_id')
            ->join('products_models_translations','products_models.id','=','products_models_translations.model_id')
            ->where('status',1)
            ->where('products_models_translations.language_id',request('languageID')? request('languageID'):cache('language-defaultID'));
    }

    public function getProductColors()
    {
        return $this->hasMany('App\Models\Product\ProductOptionList','product_id','id')
            ->select(
                '*',
                'options_values.image as thumbnail',
                'products_options_lists.image as images',
                'products_options_lists.id as id',
            )
            ->join('options_values','options_values.id','=','products_options_lists.option_value_id')
            ->join('options_values_translations','options_values.id','=','options_values_translations.option_value_id')
            ->where('products_options_lists.option_id',42)
            ->where('options_values_translations.language_id',request('languageID')? request('languageID'):cache('language-defaultID'))
            ->orderBy('products_options_lists.sort','ASC');
    }

    public function getProductColorsGroupBy()
    {
        return $this->hasMany('App\Models\Product\ProductOptionList','product_id','id')
            ->select(
                '*',
                'options_values.image as thumbnail',
                'products_options_lists.image as images',
                'products_options_lists.id as id',
            )
            ->join('options_values','options_values.id','=','products_options_lists.option_value_id')
            ->join('options_values_translations','options_values.id','=','options_values_translations.option_value_id')
            ->where('products_options_lists.option_id',42)
            ->where('options_values_translations.language_id',request('languageID')? request('languageID'):cache('language-defaultID'))
            ->groupBy('products_options_lists.option_value_id')
            ->orderBy('options_values.sort','ASC');
    }

    public function getProductCollection()
    {
        return $this->hasOne('App\Models\Product\ProductCollectionList','product_id','id');
    }

    public function getProductCollections2()
    {

        return $this->hasMany('App\Models\Product\ProductCollectionList','product_id','id')
            ->join('products_collections','products_collections.id','=','products_collections_lists.collection_id')
            ->join('products_collections_translations','products_collections.id','=','products_collections_translations.collection_id')
            ->where('status',1)
            ->where('products_collections_translations.language_id',request('languageID')? request('languageID'):cache('language-defaultID'));
    }

    public function getProductGallery()
    {
        return $this->hasOne('App\Models\Product\ProductGalleryList','product_id','id');
    }

    public function getProductGallery2()
    {
        return $this->hasOne('App\Models\Product\ProductGalleryList','product_id','id')
            ->join('galleries','galleries.id','=','products_galleries_lists.gallery_id')
            ->join('galleries_translations','galleries.id','=','galleries_translations.gallery_id')
            ->where('status',1)
            ->where('galleries_translations.language_id',request('languageID')? request('languageID'):cache('language-defaultID'));
    }

    public function getProductManufacturer()
    {
        return $this->hasOne('App\Models\Product\ProductManufacturerList','product_id','id');
    }

    public function getProductManufacturer2()
    {
        return $this->hasOne('App\Models\Product\ProductManufacturerList','product_id','id')
            ->join('products_manufacturers','products_manufacturers.id','=','products_manufacturers_lists.manufacturer_id')
            ->join('products_manufacturers_translations','products_manufacturers.id','=','products_manufacturers_translations.manufacturer_id')
            ->where('status',1)
            ->where('products_manufacturers_translations.language_id',request('languageID')? request('languageID'):cache('language-defaultID'));
    }

    public function productsCategories()
    {
        return $this->hasMany('App\Models\Product\ProductCategoryList','product_id','id');
    }

    public function productsCollections()
    {
        return $this->hasMany('App\Models\Product\ProductCollectionList','product_id','id');
    }

    public function productsCategoriesCheck()
    {
        return $this->hasMany('App\Models\Product\ProductCategoryList','product_id','id')
            ->join('products_categories','products_categories.id','=','products_categories_lists.category_id')
            ->join('products_categories_translations','products_categories.id','=','products_categories_translations.category_id')
            ->where('status',1)
            ->where('products_categories_translations.language_id',request('languageID')? request('languageID'):cache('language-defaultID'));
    }


    public function getProductCategories2()
    {
        return $this->hasMany('App\Models\Product\ProductCategoryList','product_id','id')
            ->join('products_categories','products_categories.id','=','products_categories_lists.category_id')
            ->join('products_categories_translations','products_categories.id','=','products_categories_translations.category_id')
            ->where('status',1)
            ->where('products_categories.parent','!=',0)
            ->where('products_categories_translations.language_id',request('languageID')? request('languageID'):cache('language-defaultID'));
    }

    public function productSpecialPriceList()
    {
        return $this->hasOne('App\Models\Product\ProductSpecialPriceList','product_id','id');
    }

    public function getProductAttributeList()
    {
        return $this->hasMany('App\Models\Product\ProductAttributeList','product_id','id');
    }

    public function getProductAttributeListAll()
    {
        return $this->hasMany('App\Models\Product\ProductAttributeList','product_id','id');
    }




}
