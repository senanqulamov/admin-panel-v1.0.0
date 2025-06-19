<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Mail\Frontend\OrderItSendMail;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Option\Option;
use App\Models\Option\OptionValue;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductCollection;
use App\Models\Product\ProductManufacturer;
use App\Models\Product\ProductModel;
use App\Models\Product\ProductOptionList;
use App\Services\CategoriesService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\Foreach_;

class ProductController extends Controller
{


    public function index(Request $request)
    {
        $filter_category = $request->category;
        $filter_category_arr = explode(",", $filter_category);
        $filter_collection = $request->collection;
        $filter_collection_arr = explode(",", $filter_collection);
        $filter_design = $request->design;
        $filter_design_arr = explode(",", $filter_design);
        $filter_manufacturer = $request->manufacturer;
        $filter_manufacturer_arr = explode(",", $filter_manufacturer);
        $filter_color = $request->color;
        $filter_color_arr = explode(",", $filter_color);
        $filter_type = $request->type;

        $filter_price_min = $request->price_min;
        $filter_price_max = $request->price_max;


        $filter_lengthMin = $request->lengthMin;
        $filter_lengthMax = $request->lengthMax;


        $filter_widthMin = $request->widthMin;
        $filter_widthMax = $request->widthMax;


        $filter_heightMin = $request->heightMin;
        $filter_heightMax = $request->heightMax;


        if (isset($filter_type)) {
            $filter_type = $filter_type;
        } else {
            $filter_type = 0;
        }

        if ($filter_category) {
            $categoryChildIDs = explode(",", $filter_category);
        } else {
            $categoryChildIDs = [];
        }

        $filter_url = "?filter=1";


        if ($filter_type) {
            $filter_url .= "&type=" . $filter_type;
        }

        if ($filter_category) {
            $filter_url .= "&category=" . $filter_category;
        }

        if ($filter_collection) {
            $filter_url .= "&collection=" . $filter_collection;
        }

        if ($filter_design) {
            $filter_url .= "&design=" . $filter_design;
        }

        if ($filter_manufacturer) {
            $filter_url .= "&manufacturer=" . $filter_manufacturer;
        }

        if ($filter_color) {
            $filter_url .= "&color=" . $filter_color;
        }

        if ($filter_price_min) {
            $filter_url .= "&price_min=" . $filter_price_min;
        }

        if ($filter_price_max) {
            $filter_url .= "&price_max=" . $filter_price_max;
        }


        $dimensionFilter = [];

        $lengthUrl = route('frontend.product.index') . $filter_url . "&lengthMin=MIN&lengthMax=MAX&widthMin=" . $filter_widthMin . "&widthMax=" . $filter_widthMax . "&heightMin=" . $filter_heightMin . "&heightMax=" . $filter_heightMax;
        $widthUrl = route('frontend.product.index') . $filter_url . "&lengthMin=" . $filter_lengthMin . "&lengthMax=" . $filter_lengthMax . "&widthMin=MIN&widthMax=MAX&heightMin=" . $filter_heightMin . "&heightMax=" . $filter_heightMax;
        $heightUrl = route('frontend.product.index') . $filter_url . "&lengthMin=" . $filter_lengthMin . "&lengthMax=" . $filter_lengthMax . "&widthMin=" . $filter_widthMin . "&widthMax=" . $filter_widthMax . "&heightMin=MIN&heightMax=MAX";


        //LENGTH
        $dimensionUrl = '';
        if (isset($filter_lengthMin) && isset($filter_lengthMax)) {
            $filter_url .= "&lengthMin=" . $filter_lengthMin . "&lengthMax=" . $filter_lengthMax;
            $dimensionFilter['length']['min'] = $filter_lengthMin;
            $dimensionFilter['length']['max'] = $filter_lengthMax;

        }


        //WITDH
        if (isset($filter_widthMin) && isset($filter_widthMax)) {
            $filter_url .= "&widthMin=" . $filter_widthMin . "&widthMax=" . $filter_widthMax;
            $dimensionFilter['width']['min'] = $filter_widthMin;
            $dimensionFilter['width']['max'] = $filter_widthMax;

        }


        //HEIGHT
        $filter_height_clear = [];
        if (isset($filter_heightMin) && isset($filter_heightMax)) {
            $filter_url .= "&heightMin=" . $filter_heightMin . "&heightMax=" . $filter_heightMax;
            $dimensionFilter['height']['min'] = $filter_heightMin;
            $dimensionFilter['height']['max'] = $filter_heightMax;

        }


        $currentUrl = route('frontend.product.index') . $filter_url;

        //length
        $filter_length_clear = [];
        if (isset($filter_lengthMin) && isset($filter_lengthMax)) {
            $parsedLength = parse_url($currentUrl);
            $queryLength = $parsedLength['query'];
            parse_str($queryLength, $paramsLength);
            unset($paramsLength['lengthMin']);
            unset($paramsLength['lengthMax']);
            $filter_length_clear['length']['url'] = route('frontend.product.index') . '?&' . http_build_query($paramsLength);
        }

        //width
        $filter_width_clear = [];
        if (isset($filter_widthMin) && isset($filter_widthMax)) {
            $parsedWidth = parse_url($currentUrl);
            $queryWidth = $parsedWidth['query'];
            parse_str($queryWidth, $paramsWidth);
            unset($paramsWidth['widthMin']);
            unset($paramsWidth['widthMax']);
            $filter_width_clear['width']['url'] = route('frontend.product.index') . '?&' . http_build_query($paramsWidth);
        }


        //height
        $filter_height_clear = [];
        if (isset($filter_heightMin) && isset($filter_heightMax)) {
            $parsedHeight = parse_url($currentUrl);
            $queryHeight = $parsedHeight['query'];
            parse_str($queryHeight, $paramsHeight);
            unset($paramsHeight['heightMin']);
            unset($paramsHeight['heightMax']);
            $filter_height_clear['height']['url'] = route('frontend.product.index') . '?&' . http_build_query($paramsHeight);
        }


        //PRICE
        $price_max_data = Product::where('status', 1)
            ->get()
            ->max('price');


        $price_filter = [];

        if ($filter_price_min || $filter_price_max) {
            $currentUrlForPrice = route('frontend.product.index') . str_replace([
                    '&price_min=' . $filter_price_min,
                    '&price_max=' . $filter_price_max
                ], [
                    '&price_min=' . $filter_price_min,
                    '&price_max=' . $filter_price_max
                ], $filter_url);

        } else {

            $currentUrlForPrice = route('frontend.product.index') . $filter_url;
        }


        $filter_price_clear = '';
        if (isset($filter_price_min) && isset($filter_price_max)) {

            $parsedPrice = parse_url($currentUrlForPrice);

            $queryPrice = $parsedPrice['query'];
            parse_str($queryPrice, $paramsPrice);
            unset($paramsPrice['price_min']);
            unset($paramsPrice['price_max']);
            $filter_price_clear = route('frontend.product.index') . '?&' . http_build_query($paramsPrice);
        }


        //CATEGORIES START
        $categories = [];
        $filter_categories_clear = [];
        $categoriesQuery = ProductCategory::select(
            'products_categories.id',
            'products_categories_translations.name'
        )
            ->join('products_categories_translations', function ($q) use ($request) {
                $q->on('products_categories.id', '=', 'products_categories_translations.category_id')
                    ->where('products_categories_translations.language_id', '=', $request->languageID);
            })
            ->where('products_categories.status', 1)
            ->where('products_categories.parent', $filter_type)
            ->orderBy('products_categories_translations.name', 'ASC')
            ->get();
        if ($categoriesQuery) {
            foreach ($categoriesQuery as $category) {
                $categories[$category->id]['id'] = $category->id;
                $categories[$category->id]['name'] = $category->name;


                if ($filter_category == null) {
                    $categories[$category->id]['url'] = route('frontend.product.index') . $filter_url . '&category=' . $category->id;
                } else {

                    if (in_array($category->id, $filter_category_arr)) {
                        $categoryArr = $filter_category_arr;
                        $categoryKey = array_search($category->id, $categoryArr);
                        unset($categoryArr[$categoryKey]);
                        $categoryArr2 = implode(',', $categoryArr);
                    } else {
                        $categoryArr = $filter_category_arr;
                        $categoryMerge = array_merge([$category->id], $categoryArr);
                        $categoryArr2 = implode(',', $categoryMerge);
                    }

                    $categories[$category->id]['url'] = route('frontend.product.index') .
                        str_replace('&category=' . $filter_category, '&category=' . $categoryArr2, $filter_url);
                }

                if (!$filter_type && $category->parent == 0) {
                    $categories[$category->id]['url'] = $categories[$category->id]['url'] . '&type=' . $category->id;
                }


                $categories[$category->id]['selected'] = (in_array($category->id, $filter_category_arr) ? true : false);


                foreach ($filter_category_arr as $categoryKey => $categoryID):
                    if ($categoryID == $category->id) {
                        $categoryArr = $filter_category_arr;
                        $categoryKey = array_search($category->id, $categoryArr);
                        unset($categoryArr[$categoryKey]);
                        $categoryArr2 = implode(',', $categoryArr);


                        $filter_categories_clear['id'][] = $category->id;
                        $filter_categories_clear['name'][] = $category->name;
                        $filter_categories_clear['url'][] = route('frontend.product.index') .
                            str_replace('&category=' . $filter_category, '&category=' . $categoryArr2, $filter_url);
                    }
                endforeach;

            }
        }


        //COLLECTION START
        $collections = [];
        $filter_collections_clear = [];
        $collectionsQuery = ProductCollection::select(
            'products_collections.id',
            'products_collections_translations.name'
        )
            ->join('products_collections_translations', function ($q) use ($request) {
                $q->on('products_collections.id', '=', 'products_collections_translations.collection_id')
                    ->where('products_collections_translations.language_id', '=', $request->languageID);
            })
            ->where('products_collections.status', 1)
            ->orderBy('products_collections_translations.name', 'ASC')
            ->get();
        if ($collectionsQuery) {
            foreach ($collectionsQuery as $collection) {
                $collections[$collection->id]['id'] = $collection->id;
                $collections[$collection->id]['name'] = $collection->name;

                if ($filter_collection == null) {
                    $collections[$collection->id]['url'] = route('frontend.product.index') . $filter_url . '&collection=' . $collection->id;
                } else {

                    if (in_array($collection->id, $filter_collection_arr)) {
                        $collectionArr = $filter_collection_arr;
                        $collectionKey = array_search($collection->id, $collectionArr);
                        unset($collectionArr[$collectionKey]);
                        $collectionArr2 = implode(',', $collectionArr);
                    } else {
                        $collectionArr = $filter_collection_arr;
                        $collectionMerge = array_merge([$collection->id], $collectionArr);
                        $collectionArr2 = implode(',', $collectionMerge);
                    }

                    $collections[$collection->id]['url'] = route('frontend.product.index') .
                        str_replace('collection=' . $filter_collection, 'collection=' . $collectionArr2, $filter_url);
                }


                $collections[$collection->id]['selected'] = (in_array($collection->id, $filter_collection_arr) ? true : false);


                foreach ($filter_collection_arr as $collectionKey => $collectionID):
                    if ($collectionID == $collection->id) {
                        $collectionArr = $filter_collection_arr;
                        $collectionKey = array_search($collection->id, $collectionArr);
                        unset($collectionArr[$collectionKey]);
                        $collectionArr2 = implode(',', $collectionArr);


                        $filter_collections_clear['id'][] = $collection->id;
                        $filter_collections_clear['name'][] = $collection->name;
                        $filter_collections_clear['url'][] = route('frontend.product.index') .
                            str_replace('collection=' . $filter_collection, '&collection=' . $collectionArr2, $filter_url);
                    }
                endforeach;
            }
        }


        //DESIGN START
        $designs = [];
        $filter_designs_clear = [];
        $designsQuery = ProductModel::select(
            'products_models.id',
            'products_models_translations.name'
        )
            ->join('products_models_translations', function ($q) use ($request) {
                $q->on('products_models.id', '=', 'products_models_translations.model_id')
                    ->where('products_models_translations.language_id', '=', $request->languageID);
            })
            ->where('products_models.status', 1)
            ->orderBy('products_models_translations.name', 'ASC')
            ->get();

        if ($designsQuery) {
            foreach ($designsQuery as $design) {
                $designs[$design->id]['id'] = $design->id;
                $designs[$design->id]['name'] = $design->name;

                if ($filter_design == null) {
                    $designs[$design->id]['url'] = route('frontend.product.index') . $filter_url . '&design=' . $design->id;
                } else {

                    if (in_array($design->id, $filter_design_arr)) {
                        $designArr = $filter_design_arr;
                        $designKey = array_search($design->id, $designArr);
                        unset($designArr[$designKey]);
                        $designArr2 = implode(',', $designArr);
                    } else {
                        $designArr = $filter_design_arr;
                        $designMerge = array_merge([$design->id], $designArr);
                        $designArr2 = implode(',', $designMerge);
                    }

                    $designs[$design->id]['url'] = route('frontend.product.index') .
                        str_replace('design=' . $filter_design, 'design=' . $designArr2, $filter_url);
                }


                $designs[$design->id]['selected'] = (in_array($design->id, $filter_design_arr) ? true : false);

                foreach ($filter_design_arr as $designKey => $designID):
                    if ($designID == $design->id) {
                        $designArr = $filter_design_arr;
                        $designKey = array_search($design->id, $designArr);
                        unset($designArr[$designKey]);
                        $designArr2 = implode(',', $designArr);


                        $filter_designs_clear['id'][] = $design->id;
                        $filter_designs_clear['name'][] = $design->name;
                        $filter_designs_clear['url'][] = route('frontend.product.index') .
                            str_replace('design=' . $filter_design, '&design=' . $designArr2, $filter_url);
                    }
                endforeach;
            }
        }


        //MANUFACTURER
        $manufacturers = [];
        $filter_manufacturers_clear = [];
        $manufacturersQuery = ProductManufacturer::select(
            'products_manufacturers.id',
            'products_manufacturers_translations.name'
        )
            ->join('products_manufacturers_translations', function ($q) use ($request) {
                $q->on('products_manufacturers.id', '=', 'products_manufacturers_translations.manufacturer_id')
                    ->where('products_manufacturers_translations.language_id', '=', $request->languageID);
            })
            ->where('products_manufacturers.status', 1)
            ->orderBy('products_manufacturers_translations.name', 'ASC')
            ->get();
        if ($manufacturersQuery) {
            foreach ($manufacturersQuery as $manufacturer) {
                $manufacturers[$manufacturer->id]['id'] = $manufacturer->id;
                $manufacturers[$manufacturer->id]['name'] = $manufacturer->name;

                if ($filter_manufacturer == null) {
                    $manufacturers[$manufacturer->id]['url'] = route('frontend.product.index') . $filter_url . '&manufacturer=' . $manufacturer->id;
                } else {

                    if (in_array($manufacturer->id, $filter_manufacturer_arr)) {
                        $manufacturerArr = $filter_manufacturer_arr;
                        $manufacturerKey = array_search($manufacturer->id, $manufacturerArr);
                        unset($manufacturerArr[$manufacturerKey]);
                        $manufacturerArr2 = implode(',', $manufacturerArr);
                    } else {
                        $manufacturerArr = $filter_manufacturer_arr;
                        $manufacturerMerge = array_merge([$manufacturer->id], $manufacturerArr);
                        $manufacturerArr2 = implode(',', $manufacturerMerge);
                    }

                    $manufacturers[$manufacturer->id]['url'] = route('frontend.product.index') .
                        str_replace('manufacturer=' . $filter_manufacturer, 'manufacturer=' . $manufacturerArr2, $filter_url);
                }


                $manufacturers[$manufacturer->id]['selected'] = (in_array($manufacturer->id, $filter_manufacturer_arr) ? true : false);


                foreach ($filter_manufacturer_arr as $manufacturerKey => $manufacturerID):
                    if ($manufacturerID == $manufacturer->id) {
                        $manufacturerArr = $filter_manufacturer_arr;
                        $manufacturerKey = array_search($manufacturer->id, $manufacturerArr);
                        unset($manufacturerArr[$manufacturerKey]);
                        $manufacturerArr2 = implode(',', $manufacturerArr);


                        $filter_manufacturers_clear['id'][] = $manufacturer->id;
                        $filter_manufacturers_clear['name'][] = $manufacturer->name;
                        $filter_manufacturers_clear['url'][] = route('frontend.product.index') .
                            str_replace('manufacturer=' . $filter_manufacturer, '&manufacturer=' . $manufacturerArr2, $filter_url);
                    }
                endforeach;

            }
        }


        //COLOR START
        $colors = [];
        $filter_colors_clear = [];
        $colorsQuery = OptionValue::select(
            '*'
        )
            ->join('options_values_translations', function ($q) use ($request) {
                $q->on('options_values.id', '=', 'options_values_translations.option_value_id')
                    ->where('options_values_translations.language_id', '=', $request->languageID);
            })
            ->orderBy('options_values.sort', 'ASC')
            ->where('options_values.option_id', 42)
            ->get();


        if ($colorsQuery) {
            foreach ($colorsQuery as $color) {
                $colors[$color->id]['id'] = $color->id;
                $colors[$color->id]['name'] = $color->text;

                if ($filter_color == null) {
                    $colors[$color->id]['url'] = route('frontend.product.index') . $filter_url . '&color=' . $color->id;
                } else {

                    if (in_array($color->id, $filter_color_arr)) {
                        $colorArr = $filter_color_arr;
                        $colorKey = array_search($color->id, $colorArr);
                        unset($colorArr[$colorKey]);
                        $colorArr2 = implode(',', $colorArr);
                    } else {
                        $colorArr = $filter_color_arr;
                        $colorMerge = array_merge([$color->id], $colorArr);
                        $colorArr2 = implode(',', $colorMerge);
                    }

                    $colors[$color->id]['url'] = route('frontend.product.index') .
                        str_replace('color=' . $filter_color, 'color=' . $colorArr2, $filter_url);
                }


                $colors[$color->id]['selected'] = (in_array($color->id, $filter_color_arr) ? true : false);


                foreach ($filter_color_arr as $colorKey => $colorID):
                    if ($colorID == $color->id) {
                        $colorArr = $filter_color_arr;
                        $colorKey = array_search($color->id, $colorArr);
                        unset($colorArr[$colorKey]);
                        $colorArr2 = implode(',', $colorArr);


                        $filter_colors_clear['id'][] = $color->id;
                        $filter_colors_clear['name'][] = $color->text;
                        $filter_colors_clear['url'][] = route('frontend.product.index') .
                            str_replace('color=' . $filter_color, '&color=' . $colorArr2, $filter_url);
                    }
                endforeach;
            }
        }


        $dimension = [];


        $width = Product::where('status', 1)
            ->get()
            ->max('width');

        $height = Product::where('status', 1)
            ->get()
            ->max('height');

        $length = Product::where('status', 1)
            ->get()
            ->max('length');

        $dimension['width'] = $width;
        $dimension['height'] = $height;
        $dimension['length'] = $length;


        $currentUrl = route('frontend.product.index') . $filter_url;
        $removeFilter = route('frontend.product.index');

        //Show REMOVE FILTER CONTAINER
        $showFilterBar = false;
        if ((isset($filter_categories_clear['name']) && $filter_categories_clear['name'] != null) ||
            (isset($filter_collections_clear['name']) && $filter_collections_clear['name'] != null) ||
            (isset($filter_designs_clear['name']) && $filter_designs_clear['name'] != null) ||
            (isset($filter_manufacturers_clear['name']) && $filter_manufacturers_clear['name'] != null) ||
            (isset($filter_colors_clear['name']) && $filter_colors_clear['name'] != null) ||
            (isset($filter_length_clear['length']['url'])) ||
            (isset($filter_width_clear['width']['url'])) ||
            (isset($filter_height_clear['height']['url'])) ||
            (!empty($filter_price_clear))
        ) {
            $showFilterBar = true;
        }


        if ($filter_category) {
            $parentCategories = ProductCategory::whereIn('parent', explode(',', $filter_category))
                ->where('status', 1)
                ->get();
            foreach ($parentCategories as $parentCategory):
                $categoryChildIDs[] = $parentCategory->id;
            endforeach;
        }


        $products = Product::with(array('productsTranslations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))
            ->with('productsCategoriesCheck')
            ->leftJoin('products_specials_prices_lists', function ($join) {
                $join->on('products_specials_prices_lists.product_id', '=', 'products.id');
            })
            ->select(
                'products.id as id',
                'products.image as image',
                'products.images as images',
                'products.slug as slug',
                'products.price as price',
                'products.status as status',
                'products_specials_prices_lists.special_price as special_price',
                'products_specials_prices_lists.start_date as start_date',
                'products_specials_prices_lists.end_date as end_date',
            )
            ->where('products.parent', 0)
            ->where('products.status', 1);
//            ->orderBy('id', 'DESC')
//            ->limit(12)
//            ->get();


        $products = $products->where('products.status', 1);

        if (isset($filter_category) && !empty($filter_category)) {
            $products = $products->join('products_categories_lists', 'products.id', '=', 'products_categories_lists.product_id')
                ->whereIn('products_categories_lists.category_id', $categoryChildIDs);
        }

        if (isset($filter_collection) && !empty($filter_collection)) {
            $products = $products->join('products_collections_lists', 'products.id', '=', 'products_collections_lists.product_id')
                ->whereIn('products_collections_lists.collection_id', explode(",", $filter_collection));
        }

        if (isset($filter_design) && !empty($filter_design)) {
            $products = $products->join('products_models_lists', 'products.id', '=', 'products_models_lists.product_id')
                ->whereIn('products_models_lists.model_id', explode(",", $filter_design));
        }

        if (isset($filter_manufacturer) && !empty($filter_manufacturer)) {
            $products = $products->join('products_manufacturers_lists', 'products.id', '=', 'products_manufacturers_lists.product_id')
                ->whereIn('products_manufacturers_lists.manufacturer_id', explode(",", $filter_manufacturer));
        }


        if (isset($filter_color) && !empty($filter_color)) {
            $products = $products->join('products_options_lists', 'products.id', '=', 'products_options_lists.product_id')
                ->whereIn('products_options_lists.option_value_id', explode(",", $filter_color));
        }


        if ($filter_lengthMin || $filter_lengthMax) {
            $products = $products->where(function ($q) use ($filter_lengthMin, $filter_lengthMax) {
                $q->where('products.length', '>', (int)$filter_lengthMin)
                    ->where('products.length', '<', (int)$filter_lengthMax);
            });
        }


        if ($filter_widthMin || $filter_widthMax) {
            $products = $products->where(function ($q) use ($filter_widthMin, $filter_widthMax) {
                $q->where('products.width', '>', (int)$filter_widthMin)
                    ->where('products.width', '<', (int)$filter_widthMax);
            });
        }


        if ($filter_heightMin || $filter_heightMax) {
            $products = $products->where(function ($q) use ($filter_heightMin, $filter_heightMax) {
                $q->where('products.height', '>', (int)$filter_heightMin)
                    ->where('products.height', '<', (int)$filter_heightMax);
            });
        }

        if ($filter_price_min || $filter_price_max) {
            $products = $products->where(function ($q) use ($filter_price_min, $filter_price_max) {
                $q->where('products.price', '>', (int)$filter_price_min)
                    ->where('products.price', '<=', (int)$filter_price_max);
            });
        }


        $products = $products->orderBy('products.id', 'DESC');
        $products = $products->groupBy('products.id');
        $products = $products->paginate(12);


        if ($filter_type) {
            $categoryName = ProductCategory::join('products_categories_translations', function ($q) use ($request) {
                $q->on('products_categories.id', '=', 'products_categories_translations.category_id')
                    ->where('products_categories_translations.language_id', '=', $request->languageID);
            })->where('status', 1)
                ->where('parent', 0)
                ->where('id', $filter_type)
                ->first();
        } else {
            $categoryName = '';
        }


        return response()->view('frontend.product.index', compact(
            'products',
            'categories',
            'collections',
            'designs',
            'manufacturers',
            'colors',
            'dimension',
            'dimensionFilter',
            'currentUrl',
            'lengthUrl',
            'widthUrl',
            'heightUrl',
            'removeFilter',
            'filter_categories_clear',
            'filter_collections_clear',
            'filter_designs_clear',
            'filter_manufacturers_clear',
            'filter_colors_clear',
            'filter_length_clear',
            'filter_width_clear',
            'filter_height_clear',
            'showFilterBar',
            'categoryName',
            'price_filter',
            'currentUrlForPrice',
            'filter_price_clear',
            'price_max_data',
        ));
    }

    public function category(Request $request)
    {


        $filter_category = $request->category;
        $filter_category_arr = explode(",", $filter_category);
        $filter_collection = $request->collection;
        $filter_collection_arr = explode(",", $filter_collection);
        $filter_design = $request->design;
        $filter_design_arr = explode(",", $filter_design);
        $filter_manufacturer = $request->manufacturer;
        $filter_manufacturer_arr = explode(",", $filter_manufacturer);
        $filter_color = $request->color;
        $filter_color_arr = explode(",", $filter_color);

        $filter_category_clug = $request->category_slug;

        $filter_price_min = $request->price_min;
        $filter_price_max = $request->price_max;


        $filter_lengthMin = $request->lengthMin;
        $filter_lengthMax = $request->lengthMax;


        $filter_widthMin = $request->widthMin;
        $filter_widthMax = $request->widthMax;


        $filter_heightMin = $request->heightMin;
        $filter_heightMax = $request->heightMax;


        $categoryQuery = ProductCategory::select(
            'products_categories.id',
            'products_categories.image',
            'products_categories_translations.name',
            'products_categories_translations.text',
            'products_categories.parent',
            'products_categories.slug',
            'products_categories.level',
        )
            ->join('products_categories_translations', function ($q) use ($request) {
                $q->on('products_categories.id', '=', 'products_categories_translations.category_id')
                    ->where('products_categories_translations.language_id', '=', $request->languageID);
            })
            ->where('products_categories.status', 1)
            ->where('products_categories.slug', $filter_category_clug)
            ->first();


        if ($categoryQuery == null) {
            abort(404);
        }

        $categoryParentID = 0;
        $categoryChildIDs[] = $categoryQuery->id;

        if ($categoryQuery->parent == 0) {
            $categoryParentID = $categoryQuery->id;
        } else {
            $categoryParentID = $categoryQuery->parent;

        }

        $filter_url = "?filter=1";

        if ($categoryParentID) {
            $filter_url .= '&type=' . $categoryParentID;
        }


        if ($filter_category) {
            $filter_url .= "&category=" . $filter_category;
        }

        if ($filter_collection) {
            $filter_url .= "&collection=" . $filter_collection;
        }

        if ($filter_design) {
            $filter_url .= "&design=" . $filter_design;
        }

        if ($filter_manufacturer) {
            $filter_url .= "&manufacturer=" . $filter_manufacturer;
        }

        if ($filter_color) {
            $filter_url .= "&color=" . $filter_color;
        }


        if ($filter_price_min) {
            $filter_url .= "&price_min=" . $filter_price_min;
        }

        if ($filter_price_max) {
            $filter_url .= "&price_max=" . $filter_price_max;
        }


        $dimensionFilter = [];

        $lengthUrl = route('frontend.product.category', $categoryQuery->slug) . $filter_url . "&lengthMin=MIN&lengthMax=MAX&widthMin=" . $filter_widthMin . "&widthMax=" . $filter_widthMax . "&heightMin=" . $filter_heightMin . "&heightMax=" . $filter_heightMax;
        $widthUrl = route('frontend.product.category', $categoryQuery->slug) . $filter_url . "&lengthMin=" . $filter_lengthMin . "&lengthMax=" . $filter_lengthMax . "&widthMin=MIN&widthMax=MAX&heightMin=" . $filter_heightMin . "&heightMax=" . $filter_heightMax;
        $heightUrl = route('frontend.product.category', $categoryQuery->slug) . $filter_url . "&lengthMin=" . $filter_lengthMin . "&lengthMax=" . $filter_lengthMax . "&widthMin=" . $filter_widthMin . "&widthMax=" . $filter_widthMax . "&heightMin=MIN&heightMax=MAX";


        //LENGTH
        $dimensionUrl = '';
        if (isset($filter_lengthMin) && isset($filter_lengthMax)) {
            $filter_url .= "&lengthMin=" . $filter_lengthMin . "&lengthMax=" . $filter_lengthMax;
            $dimensionFilter['length']['min'] = $filter_lengthMin;
            $dimensionFilter['length']['max'] = $filter_lengthMax;

        }


        //WITDH
        if (isset($filter_widthMin) && isset($filter_widthMax)) {
            $filter_url .= "&widthMin=" . $filter_widthMin . "&widthMax=" . $filter_widthMax;
            $dimensionFilter['width']['min'] = $filter_widthMin;
            $dimensionFilter['width']['max'] = $filter_widthMax;

        }


        //HEIGHT
        $filter_height_clear = [];
        if (isset($filter_heightMin) && isset($filter_heightMax)) {
            $filter_url .= "&heightMin=" . $filter_heightMin . "&heightMax=" . $filter_heightMax;
            $dimensionFilter['height']['min'] = $filter_heightMin;
            $dimensionFilter['height']['max'] = $filter_heightMax;

        }


        $currentUrl = route('frontend.product.category', $categoryQuery->slug) . $filter_url;

        //length
        $filter_length_clear = [];
        if (isset($filter_lengthMin) && isset($filter_lengthMax)) {
            $parsedLength = parse_url($currentUrl);
            $queryLength = $parsedLength['query'];
            parse_str($queryLength, $paramsLength);
            unset($paramsLength['lengthMin']);
            unset($paramsLength['lengthMax']);
            $filter_length_clear['length']['url'] = route('frontend.product.category', $categoryQuery->slug) . '?&' . http_build_query($paramsLength);
        }

        //width
        $filter_width_clear = [];
        if (isset($filter_widthMin) && isset($filter_widthMax)) {
            $parsedWidth = parse_url($currentUrl);
            $queryWidth = $parsedWidth['query'];
            parse_str($queryWidth, $paramsWidth);
            unset($paramsWidth['widthMin']);
            unset($paramsWidth['widthMax']);
            $filter_width_clear['width']['url'] = route('frontend.product.category', $categoryQuery->slug) . '?&' . http_build_query($paramsWidth);
        }


        //height
        $filter_height_clear = [];
        if (isset($filter_heightMin) && isset($filter_heightMax)) {
            $parsedHeight = parse_url($currentUrl);
            $queryHeight = $parsedHeight['query'];
            parse_str($queryHeight, $paramsHeight);
            unset($paramsHeight['heightMin']);
            unset($paramsHeight['heightMax']);
            $filter_height_clear['height']['url'] = route('frontend.product.category', $categoryQuery->slug) . '?&' . http_build_query($paramsHeight);
        }


        //PRICE
        $price_max_data = Product::where('status', 1)
            ->get()
            ->max('price');


        $price_filter = [];

        if ($filter_price_min || $filter_price_max) {
            $currentUrlForPrice = route('frontend.product.category', $categoryQuery->slug) . str_replace([
                    '&price_min=' . $filter_price_min,
                    '&price_max=' . $filter_price_max
                ], [
                    '&price_min=' . $filter_price_min,
                    '&price_max=' . $filter_price_max
                ], $filter_url);
        } else {

            $currentUrlForPrice = route('frontend.product.category', $categoryQuery->slug) . $filter_url;
        }


        $filter_price_clear = '';
        if (isset($filter_price_min) && isset($filter_price_max)) {

            $parsedPrice = parse_url($currentUrlForPrice);

            $queryPrice = $parsedPrice['query'];
            parse_str($queryPrice, $paramsPrice);
            unset($paramsPrice['price_min']);
            unset($paramsPrice['price_max']);
            $filter_price_clear = route('frontend.product.category', $categoryQuery->slug) . '?&' . http_build_query($paramsPrice);
        }


        //COLLECTION START
        $collections = [];
        $filter_collections_clear = [];
        $collectionsQuery = ProductCollection::select(
            'products_collections.id',
            'products_collections_translations.name'
        )
            ->join('products_collections_translations', function ($q) use ($request) {
                $q->on('products_collections.id', '=', 'products_collections_translations.collection_id')
                    ->where('products_collections_translations.language_id', '=', $request->languageID);
            })
            ->where('products_collections.status', 1)
            ->orderBy('products_collections_translations.name', 'ASC')
            ->get();
        if ($collectionsQuery) {
            foreach ($collectionsQuery as $collection) {
                $collections[$collection->id]['id'] = $collection->id;
                $collections[$collection->id]['name'] = $collection->name;

                if ($filter_collection == null) {
                    $collections[$collection->id]['url'] = route('frontend.product.category', $categoryQuery->slug) . $filter_url . '&collection=' . $collection->id;
                } else {

                    if (in_array($collection->id, $filter_collection_arr)) {
                        $collectionArr = $filter_collection_arr;
                        $collectionKey = array_search($collection->id, $collectionArr);
                        unset($collectionArr[$collectionKey]);
                        $collectionArr2 = implode(',', $collectionArr);
                    } else {
                        $collectionArr = $filter_collection_arr;
                        $collectionMerge = array_merge([$collection->id], $collectionArr);
                        $collectionArr2 = implode(',', $collectionMerge);
                    }

                    $collections[$collection->id]['url'] = route('frontend.product.category', $categoryQuery->slug) .
                        str_replace('collection=' . $filter_collection, 'collection=' . $collectionArr2, $filter_url);
                }


                $collections[$collection->id]['selected'] = (in_array($collection->id, $filter_collection_arr) ? true : false);


                foreach ($filter_collection_arr as $collectionKey => $collectionID):
                    if ($collectionID == $collection->id) {
                        $collectionArr = $filter_collection_arr;
                        $collectionKey = array_search($collection->id, $collectionArr);
                        unset($collectionArr[$collectionKey]);
                        $collectionArr2 = implode(',', $collectionArr);


                        $filter_collections_clear['id'][] = $collection->id;
                        $filter_collections_clear['name'][] = $collection->name;
                        $filter_collections_clear['url'][] = route('frontend.product.category', $categoryQuery->slug) .
                            str_replace('collection=' . $filter_collection, '&collection=' . $collectionArr2, $filter_url);
                    }
                endforeach;
            }
        }


        //DESIGN START
        $designs = [];
        $filter_designs_clear = [];
        $designsQuery = ProductModel::select(
            'products_models.id',
            'products_models_translations.name'
        )
            ->join('products_models_translations', function ($q) use ($request) {
                $q->on('products_models.id', '=', 'products_models_translations.model_id')
                    ->where('products_models_translations.language_id', '=', $request->languageID);
            })
            ->where('products_models.status', 1)
            ->orderBy('products_models_translations.name', 'ASC')
            ->get();

        if ($designsQuery) {
            foreach ($designsQuery as $design) {
                $designs[$design->id]['id'] = $design->id;
                $designs[$design->id]['name'] = $design->name;

                if ($filter_design == null) {
                    $designs[$design->id]['url'] = route('frontend.product.category', $categoryQuery->slug) . $filter_url . '&design=' . $design->id;
                } else {

                    if (in_array($design->id, $filter_design_arr)) {
                        $designArr = $filter_design_arr;
                        $designKey = array_search($design->id, $designArr);
                        unset($designArr[$designKey]);
                        $designArr2 = implode(',', $designArr);
                    } else {
                        $designArr = $filter_design_arr;
                        $designMerge = array_merge([$design->id], $designArr);
                        $designArr2 = implode(',', $designMerge);
                    }

                    $designs[$design->id]['url'] = route('frontend.product.category', $categoryQuery->slug) .
                        str_replace('design=' . $filter_design, 'design=' . $designArr2, $filter_url);
                }


                $designs[$design->id]['selected'] = (in_array($design->id, $filter_design_arr) ? true : false);

                foreach ($filter_design_arr as $designKey => $designID):
                    if ($designID == $design->id) {
                        $designArr = $filter_design_arr;
                        $designKey = array_search($design->id, $designArr);
                        unset($designArr[$designKey]);
                        $designArr2 = implode(',', $designArr);


                        $filter_designs_clear['id'][] = $design->id;
                        $filter_designs_clear['name'][] = $design->name;
                        $filter_designs_clear['url'][] = route('frontend.product.category', $categoryQuery->slug) .
                            str_replace('design=' . $filter_design, '&design=' . $designArr2, $filter_url);
                    }
                endforeach;
            }
        }


        //MANUFACTURER
        $manufacturers = [];
        $filter_manufacturers_clear = [];
        $manufacturersQuery = ProductManufacturer::select(
            'products_manufacturers.id',
            'products_manufacturers_translations.name'
        )
            ->join('products_manufacturers_translations', function ($q) use ($request) {
                $q->on('products_manufacturers.id', '=', 'products_manufacturers_translations.manufacturer_id')
                    ->where('products_manufacturers_translations.language_id', '=', $request->languageID);
            })
            ->where('products_manufacturers.status', 1)
            ->orderBy('products_manufacturers_translations.name', 'ASC')
            ->get();
        if ($manufacturersQuery) {
            foreach ($manufacturersQuery as $manufacturer) {
                $manufacturers[$manufacturer->id]['id'] = $manufacturer->id;
                $manufacturers[$manufacturer->id]['name'] = $manufacturer->name;

                if ($filter_manufacturer == null) {
                    $manufacturers[$manufacturer->id]['url'] = route('frontend.product.category', $categoryQuery->slug) . $filter_url . '&manufacturer=' . $manufacturer->id;
                } else {

                    if (in_array($manufacturer->id, $filter_manufacturer_arr)) {
                        $manufacturerArr = $filter_manufacturer_arr;
                        $manufacturerKey = array_search($manufacturer->id, $manufacturerArr);
                        unset($manufacturerArr[$manufacturerKey]);
                        $manufacturerArr2 = implode(',', $manufacturerArr);
                    } else {
                        $manufacturerArr = $filter_manufacturer_arr;
                        $manufacturerMerge = array_merge([$manufacturer->id], $manufacturerArr);
                        $manufacturerArr2 = implode(',', $manufacturerMerge);
                    }

                    $manufacturers[$manufacturer->id]['url'] = route('frontend.product.category', $categoryQuery->slug) .
                        str_replace('manufacturer=' . $filter_manufacturer, 'manufacturer=' . $manufacturerArr2, $filter_url);
                }


                $manufacturers[$manufacturer->id]['selected'] = (in_array($manufacturer->id, $filter_manufacturer_arr) ? true : false);


                foreach ($filter_manufacturer_arr as $manufacturerKey => $manufacturerID):
                    if ($manufacturerID == $manufacturer->id) {
                        $manufacturerArr = $filter_manufacturer_arr;
                        $manufacturerKey = array_search($manufacturer->id, $manufacturerArr);
                        unset($manufacturerArr[$manufacturerKey]);
                        $manufacturerArr2 = implode(',', $manufacturerArr);


                        $filter_manufacturers_clear['id'][] = $manufacturer->id;
                        $filter_manufacturers_clear['name'][] = $manufacturer->name;
                        $filter_manufacturers_clear['url'][] = route('frontend.product.category', $categoryQuery->slug) .
                            str_replace('manufacturer=' . $filter_manufacturer, '&manufacturer=' . $manufacturerArr2, $filter_url);
                    }
                endforeach;

            }
        }


        //COLOR START
        $colors = [];
        $filter_colors_clear = [];
        $colorsQuery = OptionValue::select(
            '*'
        )
            ->join('options_values_translations', function ($q) use ($request) {
                $q->on('options_values.id', '=', 'options_values_translations.option_value_id')
                    ->where('options_values_translations.language_id', '=', $request->languageID);
            })
            ->orderBy('options_values.sort', 'ASC')
            ->where('options_values.option_id', 42)
            ->get();


        if ($colorsQuery) {
            foreach ($colorsQuery as $color) {
                $colors[$color->id]['id'] = $color->id;
                $colors[$color->id]['name'] = $color->text;

                if ($filter_color == null) {
                    $colors[$color->id]['url'] = route('frontend.product.category', $categoryQuery->slug) . $filter_url . '&color=' . $color->id;
                } else {

                    if (in_array($color->id, $filter_color_arr)) {
                        $colorArr = $filter_color_arr;
                        $colorKey = array_search($color->id, $colorArr);
                        unset($colorArr[$colorKey]);
                        $colorArr2 = implode(',', $colorArr);
                    } else {
                        $colorArr = $filter_color_arr;
                        $colorMerge = array_merge([$color->id], $colorArr);
                        $colorArr2 = implode(',', $colorMerge);
                    }

                    $colors[$color->id]['url'] = route('frontend.product.category', $categoryQuery->slug) .
                        str_replace('color=' . $filter_color, 'color=' . $colorArr2, $filter_url);
                }


                $colors[$color->id]['selected'] = (in_array($color->id, $filter_color_arr) ? true : false);


                foreach ($filter_color_arr as $colorKey => $colorID):
                    if ($colorID == $color->id) {
                        $colorArr = $filter_color_arr;
                        $colorKey = array_search($color->id, $colorArr);
                        unset($colorArr[$colorKey]);
                        $colorArr2 = implode(',', $colorArr);


                        $filter_colors_clear['id'][] = $color->id;
                        $filter_colors_clear['name'][] = $color->text;
                        $filter_colors_clear['url'][] = route('frontend.product.category', $categoryQuery->slug) .
                            str_replace('color=' . $filter_color, '&color=' . $colorArr2, $filter_url);
                    }
                endforeach;
            }
        }


        $dimension = [];


        $width = Product::where('status', 1)
            ->get()
            ->max('width');

        $height = Product::where('status', 1)
            ->get()
            ->max('height');

        $length = Product::where('status', 1)
            ->get()
            ->max('length');

        $dimension['width'] = $width;
        $dimension['height'] = $height;
        $dimension['length'] = $length;


        $currentUrl = route('frontend.product.category', $categoryQuery->slug) . $filter_url;
        $removeFilter = route('frontend.product.category', $categoryQuery->slug);

        //Show REMOVE FILTER CONTAINER
        $showFilterBar = false;
        if ((isset($request->category) && $request->category != null) ||
            (isset($filter_collections_clear['name']) && $filter_collections_clear['name'] != null) ||
            (isset($filter_designs_clear['name']) && $filter_designs_clear['name'] != null) ||
            (isset($filter_manufacturers_clear['name']) && $filter_manufacturers_clear['name'] != null) ||
            (isset($filter_colors_clear['name']) && $filter_colors_clear['name'] != null) ||
            (isset($filter_length_clear['length']['url'])) ||
            (isset($filter_width_clear['width']['url'])) ||
            (isset($filter_height_clear['height']['url'])) ||
            (!empty($filter_price_clear))
        ) {
            $showFilterBar = true;
        }


        $products = Product::with(array('productsTranslations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))
            ->with('productsCategoriesCheck')
            ->leftJoin('products_specials_prices_lists', function ($join) {
                $join->on('products_specials_prices_lists.product_id', '=', 'products.id');
            })
            ->select(
                'products.id as id',
                'products.image as image',
                'products.images as images',
                'products.slug as slug',
                'products.price as price',
                'products.status as status',
                'products_specials_prices_lists.special_price as special_price',
                'products_specials_prices_lists.start_date as start_date',
                'products_specials_prices_lists.end_date as end_date',
            )
            ->where('products.parent', 0)
            ->where('products.status', 1);
//            ->orderBy('id', 'DESC')
//            ->limit(12)
//            ->get();


        $products = $products->where('products.status', 1);

        if (isset($filter_category) && !empty($filter_category)) {

//            dd($filter_category);

            $products = $products->join('products_categories_lists', 'products.id', '=', 'products_categories_lists.product_id')
                ->whereIn('products_categories_lists.category_id', explode(",", $filter_category));
        } else {
            $products = $products->join('products_categories_lists', 'products.id', '=', 'products_categories_lists.product_id')
                ->whereIn('products_categories_lists.category_id', [$categoryQuery->id]);
        }

        if (isset($filter_collection) && !empty($filter_collection)) {
            $products = $products->join('products_collections_lists', 'products.id', '=', 'products_collections_lists.product_id')
                ->whereIn('products_collections_lists.collection_id', explode(",", $filter_collection));
        }

        if (isset($filter_design) && !empty($filter_design)) {
            $products = $products->join('products_models_lists', 'products.id', '=', 'products_models_lists.product_id')
                ->whereIn('products_models_lists.model_id', explode(",", $filter_design));
        }

        if (isset($filter_manufacturer) && !empty($filter_manufacturer)) {
            $products = $products->join('products_manufacturers_lists', 'products.id', '=', 'products_manufacturers_lists.product_id')
                ->whereIn('products_manufacturers_lists.manufacturer_id', explode(",", $filter_manufacturer));
        }


        if (isset($filter_color) && !empty($filter_color)) {
            $products = $products->join('products_options_lists', 'products.id', '=', 'products_options_lists.product_id')
                ->whereIn('products_options_lists.option_value_id', explode(",", $filter_color));
        }


        if ($filter_lengthMin || $filter_lengthMax) {
            $products = $products->where(function ($q) use ($filter_lengthMin, $filter_lengthMax) {
                $q->where('products.length', '>', (int)$filter_lengthMin)
                    ->where('products.length', '<', (int)$filter_lengthMax);
            });
        }


        if ($filter_widthMin || $filter_widthMax) {
            $products = $products->where(function ($q) use ($filter_widthMin, $filter_widthMax) {
                $q->where('products.width', '>', (int)$filter_widthMin)
                    ->where('products.width', '<', (int)$filter_widthMax);
            });
        }


        if ($filter_heightMin || $filter_heightMax) {
            $products = $products->where(function ($q) use ($filter_heightMin, $filter_heightMax) {
                $q->where('products.height', '>', (int)$filter_heightMin)
                    ->where('products.height', '<', (int)$filter_heightMax);
            });
        }

        if ($filter_price_min || $filter_price_max) {
            $products = $products->where(function ($q) use ($filter_price_min, $filter_price_max) {
                $q->where('products.price', '>', (int)$filter_price_min)
                    ->where('products.price', '<=', (int)$filter_price_max);
            });
        }


        //CATEGORIES START
        $categories = [];
        $filter_categories_clear = [];


        $categoriesQuery = ProductCategory::select(
            'products_categories.id',
            'products_categories.slug',
            'products_categories_translations.name'
        )
            ->join('products_categories_translations', function ($q) use ($request) {
                $q->on('products_categories.id', '=', 'products_categories_translations.category_id')
                    ->where('products_categories_translations.language_id', '=', $request->languageID);
            })
            ->where('products_categories.status', 1);

//        if ($categoryQuery->level == 2) {
//            $categoriesQuery = $categoriesQuery->where('products_categories.parent', $categoryQuery->parent);
//        } else {
            $categoriesQuery = $categoriesQuery->where('products_categories.parent', $categoryQuery->id);
//        }

        $categoriesQuery = $categoriesQuery->orderBy('products_categories_translations.name', 'ASC')
            ->get();


        if ($categoriesQuery) {
            foreach ($categoriesQuery as $category) {
                $categories[$category->id]['id'] = $category->id;
                $categories[$category->id]['name'] = $category->name;
                $categoryChildIDs[] = $category->id;

                if ($filter_category == null) {

                    if ($categoryQuery->level == 0) {
                        $categories[$category->id]['url'] = route('frontend.product.category', $category->slug) . $filter_url;
                    } else {
                        $categories[$category->id]['url'] = route('frontend.product.category', $categoryQuery->slug) . $filter_url . '&category=' . $category->id;
//                        $categories[$category->id]['url'] = route('frontend.product.index') . $filter_url . '&category=' . $category->id;
                    }
                } else {

                    if (in_array($category->id, $filter_category_arr)) {
                        $categoryArr = $filter_category_arr;
                        $categoryKey = array_search($category->id, $categoryArr);
                        unset($categoryArr[$categoryKey]);
                        $categoryArr2 = implode(',', $categoryArr);
                    } else {
                        $categoryArr = $filter_category_arr;
                        $categoryMerge = array_merge([$category->id], $categoryArr);
                        $categoryArr2 = implode(',', $categoryMerge);
                    }

                    $categories[$category->id]['url'] = route('frontend.product.category', $categoryQuery->slug) .
                        str_replace('category=' . $filter_category, '&category=' . $categoryArr2, $filter_url);
//                    $categories[$category->id]['url'] = route('frontend.product.index') . str_replace('category=' . $filter_category, '&category=' . $categoryArr2, $filter_url);
                }


                if ($filter_category_arr[0] != "") {
                    $categories[$category->id]['selected'] = (in_array($category->id, $filter_category_arr) || $category->id == $categoryQuery->id ? true : false);
                } else {
//                    if ($categoryQuery->level == 2) {
                        $categories[$category->id]['selected'] = $category->id == $categoryQuery->id ? true : false;
//                    }
                }

                foreach ($filter_category_arr as $categoryKey => $categoryID):
                    if ($categoryID == $category->id) {
                        $categoryArr = $filter_category_arr;
                        $categoryKey = array_search($category->id, $categoryArr);
                        unset($categoryArr[$categoryKey]);
                        $categoryArr2 = implode(',', $categoryArr);


                        $filter_categories_clear['id'][] = $category->id;
                        $filter_categories_clear['name'][] = $category->name;
                        if ($categoryQuery->level == 0) {
                            $filter_categories_clear['url'][] = route('frontend.product.category', $category->slug) . $filter_url;
                        } else {
                            $filter_categories_clear['url'][] = route('frontend.product.category', $categoryQuery->slug) . str_replace('category=' . $filter_category, '&category=' . $categoryArr2, $filter_url);
//                            $filter_categories_clear['url'][] = route('frontend.product.index') . str_replace('category=' . $filter_category, '&category=' . $categoryArr2, $filter_url);
                        }
                    }
                endforeach;

            }
        }


//        $products = $products->join('products_categories_lists', 'products.id', '=', 'products_categories_lists.product_id')
//            ->whereIn('products_categories_lists.category_id', $categoryChildIDs);


        $products = $products->groupBy('products.id');
        $products = $products->paginate(12);
//        @dd($products);






        return response()->view('frontend.product.index', compact(
            'products',
            'categories',
            'collections',
            'designs',
            'manufacturers',
            'colors',
            'dimension',
            'dimensionFilter',
            'currentUrl',
            'lengthUrl',
            'widthUrl',
            'heightUrl',
            'removeFilter',
            'filter_categories_clear',
            'filter_collections_clear',
            'filter_designs_clear',
            'filter_manufacturers_clear',
            'filter_colors_clear',
            'filter_length_clear',
            'filter_width_clear',
            'filter_height_clear',
            'showFilterBar',
            'categoryQuery',
            'price_filter',
            'currentUrlForPrice',
            'filter_price_clear',
            'price_max_data',
        ));
    }

    public function search(Request $request)
    {
        $filter_category = $request->category;
        $filter_category_arr = explode(",", $filter_category);
        $filter_collection = $request->collection;
        $filter_collection_arr = explode(",", $filter_collection);
        $filter_design = $request->design;
        $filter_design_arr = explode(",", $filter_design);
        $filter_manufacturer = $request->manufacturer;
        $filter_manufacturer_arr = explode(",", $filter_manufacturer);
        $filter_color = $request->color;
        $filter_color_arr = explode(",", $filter_color);


        $filter_search_text = $request->q;


        $filter_price_min = $request->price_min;
        $filter_price_max = $request->price_max;


        $filter_lengthMin = $request->lengthMin;
        $filter_lengthMax = $request->lengthMax;


        $filter_widthMin = $request->widthMin;
        $filter_widthMax = $request->widthMax;


        $filter_heightMin = $request->heightMin;
        $filter_heightMax = $request->heightMax;


        $filter_url = "?filter=1";

        if ($filter_category) {
            $filter_url .= "&category=" . $filter_category;
        }

        if ($filter_collection) {
            $filter_url .= "&collection=" . $filter_collection;
        }

        if ($filter_design) {
            $filter_url .= "&design=" . $filter_design;
        }

        if ($filter_manufacturer) {
            $filter_url .= "&manufacturer=" . $filter_manufacturer;
        }

        if ($filter_color) {
            $filter_url .= "&color=" . $filter_color;
        }

        if ($filter_price_min) {
            $filter_url .= "&price_min=" . $filter_price_min;
        }

        if ($filter_price_max) {
            $filter_url .= "&price_max=" . $filter_price_max;
        }

        $dimensionFilter = [];

        $lengthUrl = route('frontend.product.index') . $filter_url . "&lengthMin=MIN&lengthMax=MAX&widthMin=" . $filter_widthMin . "&widthMax=" . $filter_widthMax . "&heightMin=" . $filter_heightMin . "&heightMax=" . $filter_heightMax;
        $widthUrl = route('frontend.product.index') . $filter_url . "&lengthMin=" . $filter_lengthMin . "&lengthMax=" . $filter_lengthMax . "&widthMin=MIN&widthMax=MAX&heightMin=" . $filter_heightMin . "&heightMax=" . $filter_heightMax;
        $heightUrl = route('frontend.product.index') . $filter_url . "&lengthMin=" . $filter_lengthMin . "&lengthMax=" . $filter_lengthMax . "&widthMin=" . $filter_widthMin . "&widthMax=" . $filter_widthMax . "&heightMin=MIN&heightMax=MAX";


        //LENGTH
        $dimensionUrl = '';
        if (isset($filter_lengthMin) && isset($filter_lengthMax)) {
            $filter_url .= "&lengthMin=" . $filter_lengthMin . "&lengthMax=" . $filter_lengthMax;
            $dimensionFilter['length']['min'] = $filter_lengthMin;
            $dimensionFilter['length']['max'] = $filter_lengthMax;

        }


        //WITDH
        if (isset($filter_widthMin) && isset($filter_widthMax)) {
            $filter_url .= "&widthMin=" . $filter_widthMin . "&widthMax=" . $filter_widthMax;
            $dimensionFilter['width']['min'] = $filter_widthMin;
            $dimensionFilter['width']['max'] = $filter_widthMax;

        }


        //HEIGHT
        $filter_height_clear = [];
        if (isset($filter_heightMin) && isset($filter_heightMax)) {
            $filter_url .= "&heightMin=" . $filter_heightMin . "&heightMax=" . $filter_heightMax;
            $dimensionFilter['height']['min'] = $filter_heightMin;
            $dimensionFilter['height']['max'] = $filter_heightMax;

        }


        $currentUrl = route('frontend.product.index') . $filter_url;

        //length
        $filter_length_clear = [];
        if (isset($filter_lengthMin) && isset($filter_lengthMax)) {
            $parsedLength = parse_url($currentUrl);
            $queryLength = $parsedLength['query'];
            parse_str($queryLength, $paramsLength);
            unset($paramsLength['lengthMin']);
            unset($paramsLength['lengthMax']);
            $filter_length_clear['length']['url'] = route('frontend.product.index') . '?&' . http_build_query($paramsLength);
        }

        //width
        $filter_width_clear = [];
        if (isset($filter_widthMin) && isset($filter_widthMax)) {
            $parsedWidth = parse_url($currentUrl);
            $queryWidth = $parsedWidth['query'];
            parse_str($queryWidth, $paramsWidth);
            unset($paramsWidth['widthMin']);
            unset($paramsWidth['widthMax']);
            $filter_width_clear['width']['url'] = route('frontend.product.index') . '?&' . http_build_query($paramsWidth);
        }


        //height
        $filter_height_clear = [];
        if (isset($filter_heightMin) && isset($filter_heightMax)) {
            $parsedHeight = parse_url($currentUrl);
            $queryHeight = $parsedHeight['query'];
            parse_str($queryHeight, $paramsHeight);
            unset($paramsHeight['heightMin']);
            unset($paramsHeight['heightMax']);
            $filter_height_clear['height']['url'] = route('frontend.product.index') . '?&' . http_build_query($paramsHeight);
        }


        //PRICE
        $price_max_data = Product::where('status', 1)
            ->get()
            ->max('price');


        $price_filter = [];

        if ($filter_price_min || $filter_price_max) {
            $currentUrlForPrice = route('frontend.product.index') . str_replace([
                    '&price_min=' . $filter_price_min,
                    '&price_max=' . $filter_price_max
                ], [
                    '&price_min=' . $filter_price_min,
                    '&price_max=' . $filter_price_max
                ], $filter_url);

        } else {

            $currentUrlForPrice = route('frontend.product.index') . $filter_url;
        }


        $filter_price_clear = '';
        if (isset($filter_price_min) && isset($filter_price_max)) {

            $parsedPrice = parse_url($currentUrlForPrice);

            $queryPrice = $parsedPrice['query'];
            parse_str($queryPrice, $paramsPrice);
            unset($paramsPrice['price_min']);
            unset($paramsPrice['price_max']);
            $filter_price_clear = route('frontend.product.index') . '?&' . http_build_query($paramsPrice);
        }


        //CATEGORIES START
        $categories = [];
        $filter_categories_clear = [];
        $categoriesQuery = ProductCategory::select(
            'products_categories.id',
            'products_categories_translations.name'
        )
            ->join('products_categories_translations', function ($q) use ($request) {
                $q->on('products_categories.id', '=', 'products_categories_translations.category_id')
                    ->where('products_categories_translations.language_id', '=', $request->languageID);
            })
            ->where('products_categories.status', 1)
            ->where('products_categories.parent', 0)
            ->orderBy('products_categories_translations.name', 'ASC')
            ->get();
        if ($categoriesQuery) {
            foreach ($categoriesQuery as $category) {
                $categories[$category->id]['id'] = $category->id;
                $categories[$category->id]['name'] = $category->name;


                if ($filter_category == null) {
                    $categories[$category->id]['url'] = route('frontend.product.index') . $filter_url . '&category=' . $category->id;
                } else {

                    if (in_array($category->id, $filter_category_arr)) {
                        $categoryArr = $filter_category_arr;
                        $categoryKey = array_search($category->id, $categoryArr);
                        unset($categoryArr[$categoryKey]);
                        $categoryArr2 = implode(',', $categoryArr);
                    } else {
                        $categoryArr = $filter_category_arr;
                        $categoryMerge = array_merge([$category->id], $categoryArr);
                        $categoryArr2 = implode(',', $categoryMerge);
                    }

                    $categories[$category->id]['url'] = route('frontend.product.index') .
                        str_replace('category=' . $filter_category, '&category=' . $categoryArr2, $filter_url);
                }

                if (!$request->type) {
                    $categories[$category->id]['url'] = $categories[$category->id]['url'] . '&type=' . $category->id;
                }


                $categories[$category->id]['selected'] = (in_array($category->id, $filter_category_arr) ? true : false);


                foreach ($filter_category_arr as $categoryKey => $categoryID):
                    if ($categoryID == $category->id) {
                        $categoryArr = $filter_category_arr;
                        $categoryKey = array_search($category->id, $categoryArr);
                        unset($categoryArr[$categoryKey]);
                        $categoryArr2 = implode(',', $categoryArr);


                        $filter_categories_clear['id'][] = $category->id;
                        $filter_categories_clear['name'][] = $category->name;
                        $filter_categories_clear['url'][] = route('frontend.product.index') .
                            str_replace('category=' . $filter_category, '&category=' . $categoryArr2, $filter_url);
                    }
                endforeach;

            }
        }


        //COLLECTION START
        $collections = [];
        $filter_collections_clear = [];
        $collectionsQuery = ProductCollection::select(
            'products_collections.id',
            'products_collections_translations.name'
        )
            ->join('products_collections_translations', function ($q) use ($request) {
                $q->on('products_collections.id', '=', 'products_collections_translations.collection_id')
                    ->where('products_collections_translations.language_id', '=', $request->languageID);
            })
            ->where('products_collections.status', 1)
            ->orderBy('products_collections_translations.name', 'ASC')
            ->get();
        if ($collectionsQuery) {
            foreach ($collectionsQuery as $collection) {
                $collections[$collection->id]['id'] = $collection->id;
                $collections[$collection->id]['name'] = $collection->name;

                if ($filter_collection == null) {
                    $collections[$collection->id]['url'] = route('frontend.product.index') . $filter_url . '&collection=' . $collection->id;
                } else {

                    if (in_array($collection->id, $filter_collection_arr)) {
                        $collectionArr = $filter_collection_arr;
                        $collectionKey = array_search($collection->id, $collectionArr);
                        unset($collectionArr[$collectionKey]);
                        $collectionArr2 = implode(',', $collectionArr);
                    } else {
                        $collectionArr = $filter_collection_arr;
                        $collectionMerge = array_merge([$collection->id], $collectionArr);
                        $collectionArr2 = implode(',', $collectionMerge);
                    }

                    $collections[$collection->id]['url'] = route('frontend.product.index') .
                        str_replace('collection=' . $filter_collection, 'collection=' . $collectionArr2, $filter_url);
                }


                $collections[$collection->id]['selected'] = (in_array($collection->id, $filter_collection_arr) ? true : false);


                foreach ($filter_collection_arr as $collectionKey => $collectionID):
                    if ($collectionID == $collection->id) {
                        $collectionArr = $filter_collection_arr;
                        $collectionKey = array_search($collection->id, $collectionArr);
                        unset($collectionArr[$collectionKey]);
                        $collectionArr2 = implode(',', $collectionArr);


                        $filter_collections_clear['id'][] = $collection->id;
                        $filter_collections_clear['name'][] = $collection->name;
                        $filter_collections_clear['url'][] = route('frontend.product.index') .
                            str_replace('collection=' . $filter_collection, '&collection=' . $collectionArr2, $filter_url);
                    }
                endforeach;
            }
        }


        //DESIGN START
        $designs = [];
        $filter_designs_clear = [];
        $designsQuery = ProductModel::select(
            'products_models.id',
            'products_models_translations.name'
        )
            ->join('products_models_translations', function ($q) use ($request) {
                $q->on('products_models.id', '=', 'products_models_translations.model_id')
                    ->where('products_models_translations.language_id', '=', $request->languageID);
            })
            ->where('products_models.status', 1)
            ->orderBy('products_models_translations.name', 'ASC')
            ->get();

        if ($designsQuery) {
            foreach ($designsQuery as $design) {
                $designs[$design->id]['id'] = $design->id;
                $designs[$design->id]['name'] = $design->name;

                if ($filter_design == null) {
                    $designs[$design->id]['url'] = route('frontend.product.index') . $filter_url . '&design=' . $design->id;
                } else {

                    if (in_array($design->id, $filter_design_arr)) {
                        $designArr = $filter_design_arr;
                        $designKey = array_search($design->id, $designArr);
                        unset($designArr[$designKey]);
                        $designArr2 = implode(',', $designArr);
                    } else {
                        $designArr = $filter_design_arr;
                        $designMerge = array_merge([$design->id], $designArr);
                        $designArr2 = implode(',', $designMerge);
                    }

                    $designs[$design->id]['url'] = route('frontend.product.index') .
                        str_replace('design=' . $filter_design, 'design=' . $designArr2, $filter_url);
                }


                $designs[$design->id]['selected'] = (in_array($design->id, $filter_design_arr) ? true : false);

                foreach ($filter_design_arr as $designKey => $designID):
                    if ($designID == $design->id) {
                        $designArr = $filter_design_arr;
                        $designKey = array_search($design->id, $designArr);
                        unset($designArr[$designKey]);
                        $designArr2 = implode(',', $designArr);


                        $filter_designs_clear['id'][] = $design->id;
                        $filter_designs_clear['name'][] = $design->name;
                        $filter_designs_clear['url'][] = route('frontend.product.index') .
                            str_replace('design=' . $filter_design, '&design=' . $designArr2, $filter_url);
                    }
                endforeach;
            }
        }


        //MANUFACTURER
        $manufacturers = [];
        $filter_manufacturers_clear = [];
        $manufacturersQuery = ProductManufacturer::select(
            'products_manufacturers.id',
            'products_manufacturers_translations.name'
        )
            ->join('products_manufacturers_translations', function ($q) use ($request) {
                $q->on('products_manufacturers.id', '=', 'products_manufacturers_translations.manufacturer_id')
                    ->where('products_manufacturers_translations.language_id', '=', $request->languageID);
            })
            ->where('products_manufacturers.status', 1)
            ->orderBy('products_manufacturers_translations.name', 'ASC')
            ->get();
        if ($manufacturersQuery) {
            foreach ($manufacturersQuery as $manufacturer) {
                $manufacturers[$manufacturer->id]['id'] = $manufacturer->id;
                $manufacturers[$manufacturer->id]['name'] = $manufacturer->name;

                if ($filter_manufacturer == null) {
                    $manufacturers[$manufacturer->id]['url'] = route('frontend.product.index') . $filter_url . '&manufacturer=' . $manufacturer->id;
                } else {

                    if (in_array($manufacturer->id, $filter_manufacturer_arr)) {
                        $manufacturerArr = $filter_manufacturer_arr;
                        $manufacturerKey = array_search($manufacturer->id, $manufacturerArr);
                        unset($manufacturerArr[$manufacturerKey]);
                        $manufacturerArr2 = implode(',', $manufacturerArr);
                    } else {
                        $manufacturerArr = $filter_manufacturer_arr;
                        $manufacturerMerge = array_merge([$manufacturer->id], $manufacturerArr);
                        $manufacturerArr2 = implode(',', $manufacturerMerge);
                    }

                    $manufacturers[$manufacturer->id]['url'] = route('frontend.product.index') .
                        str_replace('manufacturer=' . $filter_manufacturer, 'manufacturer=' . $manufacturerArr2, $filter_url);
                }


                $manufacturers[$manufacturer->id]['selected'] = (in_array($manufacturer->id, $filter_manufacturer_arr) ? true : false);


                foreach ($filter_manufacturer_arr as $manufacturerKey => $manufacturerID):
                    if ($manufacturerID == $manufacturer->id) {
                        $manufacturerArr = $filter_manufacturer_arr;
                        $manufacturerKey = array_search($manufacturer->id, $manufacturerArr);
                        unset($manufacturerArr[$manufacturerKey]);
                        $manufacturerArr2 = implode(',', $manufacturerArr);


                        $filter_manufacturers_clear['id'][] = $manufacturer->id;
                        $filter_manufacturers_clear['name'][] = $manufacturer->name;
                        $filter_manufacturers_clear['url'][] = route('frontend.product.index') .
                            str_replace('manufacturer=' . $filter_manufacturer, '&manufacturer=' . $manufacturerArr2, $filter_url);
                    }
                endforeach;

            }
        }


        //COLOR START
        $colors = [];
        $filter_colors_clear = [];
        $colorsQuery = OptionValue::select(
            '*'
        )
            ->join('options_values_translations', function ($q) use ($request) {
                $q->on('options_values.id', '=', 'options_values_translations.option_value_id')
                    ->where('options_values_translations.language_id', '=', $request->languageID);
            })
            ->orderBy('options_values.sort', 'ASC')
            ->where('options_values.option_id', 42)
            ->get();


        if ($colorsQuery) {
            foreach ($colorsQuery as $color) {
                $colors[$color->id]['id'] = $color->id;
                $colors[$color->id]['name'] = $color->text;

                if ($filter_color == null) {
                    $colors[$color->id]['url'] = route('frontend.product.index') . $filter_url . '&color=' . $color->id;
                } else {

                    if (in_array($color->id, $filter_color_arr)) {
                        $colorArr = $filter_color_arr;
                        $colorKey = array_search($color->id, $colorArr);
                        unset($colorArr[$colorKey]);
                        $colorArr2 = implode(',', $colorArr);
                    } else {
                        $colorArr = $filter_color_arr;
                        $colorMerge = array_merge([$color->id], $colorArr);
                        $colorArr2 = implode(',', $colorMerge);
                    }

                    $colors[$color->id]['url'] = route('frontend.product.index') .
                        str_replace('color=' . $filter_color, 'color=' . $colorArr2, $filter_url);
                }


                $colors[$color->id]['selected'] = (in_array($color->id, $filter_color_arr) ? true : false);


                foreach ($filter_color_arr as $colorKey => $colorID):
                    if ($colorID == $color->id) {
                        $colorArr = $filter_color_arr;
                        $colorKey = array_search($color->id, $colorArr);
                        unset($colorArr[$colorKey]);
                        $colorArr2 = implode(',', $colorArr);


                        $filter_colors_clear['id'][] = $color->id;
                        $filter_colors_clear['name'][] = $color->text;
                        $filter_colors_clear['url'][] = route('frontend.product.index') .
                            str_replace('color=' . $filter_color, '&color=' . $colorArr2, $filter_url);
                    }
                endforeach;
            }
        }


        $dimension = [];


        $width = Product::where('status', 1)
            ->get()
            ->max('width');

        $height = Product::where('status', 1)
            ->get()
            ->max('height');

        $length = Product::where('status', 1)
            ->get()
            ->max('length');

        $dimension['width'] = $width;
        $dimension['height'] = $height;
        $dimension['length'] = $length;


        $currentUrl = route('frontend.product.index') . $filter_url;
        $removeFilter = route('frontend.product.index');

        //Show REMOVE FILTER CONTAINER
        $showFilterBar = false;
        if ((isset($filter_categories_clear['name']) && $filter_categories_clear['name'] != null) ||
            (isset($filter_collections_clear['name']) && $filter_collections_clear['name'] != null) ||
            (isset($filter_designs_clear['name']) && $filter_designs_clear['name'] != null) ||
            (isset($filter_manufacturers_clear['name']) && $filter_manufacturers_clear['name'] != null) ||
            (isset($filter_colors_clear['name']) && $filter_colors_clear['name'] != null) ||
            (isset($filter_length_clear['length']['url'])) ||
            (isset($filter_width_clear['width']['url'])) ||
            (isset($filter_height_clear['height']['url']))
        ) {
            $showFilterBar = true;
        }


        if (isset($filter_search_text)) {

            $products = Product::with('productsCategoriesCheck')
                ->join('products_translations', function ($join) use ($request) {
                    $join->on('products_translations.product_id', '=', 'products.id')
                        ->where('language_id', $request->languageID)
                        ->where('name', 'like', '%' . $request->q . '%');
                })
                ->leftJoin('products_specials_prices_lists', function ($join) {
                    $join->on('products_specials_prices_lists.product_id', '=', 'products.id');
                })
                ->join('products_categories_lists', 'products_categories_lists.product_id', '=', 'products.id')
                ->join('products_categories', function ($join) {
                    $join->on('products_categories_lists.category_id', '=', 'products_categories.id')->where('products_categories.status', 1);
                })
                ->select(
                    'products.id as id',
                    'products.image as image',
                    'products.images as images',
                    'products.slug as slug',
                    'products.price as price',
                    'products.status as status',
                    'products_translations.name as name',
                    'products_specials_prices_lists.special_price as special_price',
                    'products_specials_prices_lists.start_date as start_date',
                    'products_specials_prices_lists.end_date as end_date',
                )
                ->where('products.status', 1)
                ->where('products.parent', 0)
                ->groupBy('products.id')
                ->orderBy('id', 'DESC')
                ->paginate(12);

        } else {
            abort('404');
        }


        return response()->view('frontend.product.index', compact(
            'products',
            'categories',
            'collections',
            'designs',
            'manufacturers',
            'colors',
            'dimension',
            'dimensionFilter',
            'currentUrl',
            'lengthUrl',
            'widthUrl',
            'heightUrl',
            'removeFilter',
            'filter_categories_clear',
            'filter_collections_clear',
            'filter_designs_clear',
            'filter_manufacturers_clear',
            'filter_colors_clear',
            'filter_length_clear',
            'filter_width_clear',
            'filter_height_clear',
            'showFilterBar',
            'filter_search_text',
            'price_filter',
            'currentUrlForPrice',
            'filter_price_clear',
            'price_max_data',

        ));
    }

    public function searchAjax(Request $request)
    {
        $products = Product::with('productsCategoriesCheck')
            ->join('products_translations', function ($join) use ($request) {
                $join->on('products_translations.product_id', '=', 'products.id')
                    ->where('language_id', $request->languageID)
                    ->where('name', 'like', '%' . $request->search . '%');
            })
            ->join('products_categories_lists', 'products_categories_lists.product_id', '=', 'products.id')
            ->join('products_categories', function ($join) {
                $join->on('products_categories_lists.category_id', '=', 'products_categories.id')->where('products_categories.status', 1);
            })
            ->leftJoin('products_specials_prices_lists', function ($join) {
                $join->on('products_specials_prices_lists.product_id', '=', 'products.id');
            })
            ->select(
                'products.id as id',
                'products.image as image',
                'products.slug as slug',
                'products.price as price',
                'products.status as status',
                'products_translations.name as name',
                'products_specials_prices_lists.special_price as special_price',
                'products_specials_prices_lists.start_date as start_date',
                'products_specials_prices_lists.end_date as end_date',
            )
            ->where('products.status', 1)
            ->where('products.parent', 0)
            ->groupBy('products.id')
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get()->toArray();

        foreach ($products as $key => $product):
            //img
            if (!empty($products[$key]['image'])) {
                $products[$key]['image'] = ImageService::customImageReSize($products[$key]['image'], 71, null);
            } else {
                $products[$key]['image'] = ImageService::customImageReSize('frontend/assets/images/no-image.png', 71, null);
            }

            //Price
            if (!empty($products[$key]['price'])) {
                $products[$key]['price'] = product_front_price(
                    $products[$key]['price'],
                    $products[$key]['special_price'],
                    $products[$key]['start_date'],
                    $products[$key]['end_date']);
            } else {
                $products[$key]['price'] = '';
            }

            //categories
            $categoryNameText = '';
            $counter = 0;
            if ($products[$key]['products_categories_check'] != null) {

                foreach ($products[$key]['products_categories_check'] as $categoryName):
                    $categoryNameText .= $categoryName['name'];

                    if ($counter != count($products[$key]['products_categories_check']) - 1) {
                        $categoryNameText .= ', ';
                    }

                    $counter = $counter + 1;
                endforeach;

                $products[$key]['category'] = $categoryNameText;
            } else {
                $products[$key]['category'] = '';
            }

            //slug
            if (!empty($products[$key]['slug'])) {
                $products[$key]['product_url'] = route('frontend.product.detail', $products[$key]['slug']);
            } else {
                $products[$key]['product_url'] = '#';
            }

        endforeach;


        $productsCount = Product::with('productsCategoriesCheck')
            ->join('products_translations', function ($join) use ($request) {
                $join->on('products_translations.product_id', '=', 'products.id')
                    ->where('language_id', $request->languageID)
                    ->where('name', 'like', '%' . $request->search . '%');
            })
            ->join('products_categories_lists', 'products_categories_lists.product_id', '=', 'products.id')
            ->join('products_categories', function ($join) {
                $join->on('products_categories_lists.category_id', '=', 'products_categories.id')->where('products_categories.status', 1);
            })
            ->select(
                'products.id as id',
            )
            ->where('products.parent', 0)
            ->where('products.status', 1)
            ->groupBy('products_categories_lists.product_id')
            ->get()->count();

        if ($request->search == '') {
            $productsCount = 0;
        }

        $allResultUrl = [];
        $allResultUrl['txt'] = language('frontend.product.search_all_text');
        $allResultUrl['url'] = route('frontend.product.search') . '?q=' . $request->search;
        $allResultUrl['count'] = $productsCount;


        $notResultText = '';
        if ($productsCount == 0) {
            $notResultText = language('frontend.product.not_result');
        }


        return response()->json([
            'success' => true,
            'allResultUrl' => $allResultUrl,
            'notResultText' => $notResultText,
            'data' => $products
        ]);
    }

    public function optionsAjax(Request $request)
    {

        $option = Product::getProduct();

        return response()->json([
            'success' => true,
            'data' => $option
        ]);
    }

    public function optionPrice(Request $request)
    {
        $optionValueID = $request->option_value_id;
        $productID = $request->product_id;

        $optionPrice = ProductOptionList::where('option_value_id', $optionValueID)
            ->where('product_id', $productID)
            ->orderBy('sort', 'ASC')
            ->first();

        $optionImages = ProductOptionList::where('option_value_id', $optionValueID)
            ->where('product_id', $productID)
            ->orderBy('sort', 'ASC')
            ->get();

        $price = product_front_price(
            $optionPrice->price,
            $optionPrice->option_special_price,
            $optionPrice->option_start_date,
            $optionPrice->option_end_date);


        $carousel = view('frontend.product.carousel', compact(
            'optionImages'
        ))->render();


        return response()->json([
            'success' => true,
            'price' => $price,
            'carousel' => $carousel,
            'test' => $optionImages->count(),
        ]);

    }

    public function detail(Request $request)
    {

        $product = Product::getProduct();


        if (!$product || count($product->productsCategoriesCheck) == 0) {
            abort(404);
        }

        $productOptionValueGroupBy = ProductOptionList::select(
            '*',
            'options_values.image as thumbnail',
            'products_options_lists.image as images',
            'products_options_lists.id as id',
        )
            ->join('options_values', 'options_values.id', '=', 'products_options_lists.option_value_id')
            ->join('options_values_translations', 'options_values.id', '=', 'options_values_translations.option_value_id')
            ->where('product_id', $product->id)
            ->where('products_options_lists.option_id', 42)
            ->where('options_values_translations.language_id', request('languageID'))
            ->groupBy('products_options_lists.option_value_id')
            ->orderBy('options_values.sort', 'ASC')
            ->first();


        if ($productOptionValueGroupBy != null) {
            $productOptionValueImages = ProductOptionList::where('option_id', 42)
                ->select('image')
                ->where('product_id', $product->id)
                ->where('option_value_id', $productOptionValueGroupBy->option_value_id)
                ->orderBy('sort', 'ASC')
                ->get();
        } else {
            $productOptionValueImages = null;
        }


        if ($product->getProductCategories2 != null) {

            $currentParentCategory = ProductCategory::with(array('categoryTranslationForParentId' => function ($query) use ($request) {
                $query->where('language_id', $request->languageID);
            }))
                ->where('status', 1)
                ->where('id', $product->getProductCategories2[0]->category_id)
                ->first();

        }


        $productParent = Product::join('products_translations', function ($q) use ($request) {
            $q->on('products.id', '=', 'products_translations.product_id')
                ->where('products_translations.language_id', '=', $request->languageID);
        })
            ->select(
                'products.id as id',
                'products.parent as parent',
                'products.slug as slug',
                'products.length as length',
                'products.width as width',
                'products.height as height',
                'products.image as image',
                'products_translations.name as name',
                'products_translations.sub_name as sub_name',
            )
            ->where('products.status', 1)
            ->where('products.slug', $request->slug)
            ->orderBy('products.id', 'DESC')
            ->first();

//        @dd($productParent);
        $productsParentAndChilds = [];


        //IF PARENT 0
        if ($productParent && $productParent->parent == 0) {

            $dimension = language('frontend.product.width_short') . $productParent->width . 'x' .
                language('frontend.product.height_short') . $productParent->height . 'x' .
                language('frontend.product.length_short') . $productParent->length .
                language('frontend.product.centimeter');

            $productsParentAndChilds[] = [
                'name' => $productParent->name,
                'sub_name' => $productParent->sub_name,
                'url' => $productParent->slug == $request->slug ?
                    'javascript:void(0)'
                    : route('frontend.product.detail', $productParent->slug),
                'dimension' => $dimension,
                'image' => $productParent->image != '' ? $productParent->image
                    : asset('frontend/assets/images/no-image.png'),
                'selected' => $productParent->slug == $request->slug ? true : false,
            ];


            $productChilds = Product::join('products_translations', function ($q) use ($request) {
                $q->on('products.id', '=', 'products_translations.product_id')
                    ->where('products_translations.language_id', '=', $request->languageID);
            })
                ->select(
                    'products.id as id',
                    'products.parent as parent',
                    'products.slug as slug',
                    'products.length as length',
                    'products.width as width',
                    'products.height as height',
                    'products.image as image',
                    'products_translations.name as name',
                    'products_translations.sub_name as sub_name',
                )
                ->where('products.status', 1)
                ->where('products.parent', $productParent->id)
                ->orderBy('products.id', 'DESC')
                ->get();


            foreach ($productChilds as $productChild):

                $dimension = language('frontend.product.width_short') . $productChild->width . 'x' .
                    language('frontend.product.height_short') . $productChild->height . 'x' .
                    language('frontend.product.length_short') . $productChild->length .
                    language('frontend.product.centimeter');

                $productsParentAndChilds[] = [
                    'name' => $productChild->name,
                    'sub_name' => $productChild->sub_name,
                    'url' => $productChild->slug == $request->slug ?
                        'javascript:void(0)'
                        : route('frontend.product.detail', $productChild->slug),
                    'dimension' => $dimension,
                    'image' => $productChild->image != '' ? $productChild->image
                        : asset('frontend/assets/images/no-image.png'),
                    'selected' => $productChild->slug == $request->slug ? true : false,
                ];
            endforeach;


        } else {

            $parent = $productParent->parent;

            $productParent = Product::join('products_translations', function ($q) use ($request) {
                $q->on('products.id', '=', 'products_translations.product_id')
                    ->where('products_translations.language_id', '=', $request->languageID);
            })
                ->select(
                    'products.id as id',
                    'products.parent as parent',
                    'products.slug as slug',
                    'products.length as length',
                    'products.width as width',
                    'products.height as height',
                    'products.image as image',
                    'products_translations.name as name',
                    'products_translations.sub_name as sub_name',
                )
                ->where('products.status', 1)
                ->where('products.id', $parent)
                ->orderBy('products.id', 'DESC')
                ->first();


            $dimension = language('frontend.product.width_short') . $productParent->width . 'x' .
                language('frontend.product.height_short') . $productParent->height . 'x' .
                language('frontend.product.length_short') . $productParent->length .
                language('frontend.product.centimeter');

            $productsParentAndChilds[] = [
                'name' => $productParent->name,
                'sub_name' => $productParent->sub_name,
                'url' => $productParent->slug == $request->slug ?
                    'javascript:void(0)'
                    : route('frontend.product.detail', $productParent->slug),
                'dimension' => $dimension,
                'image' => $productParent->image != '' ? $productParent->image
                    : asset('frontend/assets/images/no-image.png'),
                'selected' => $productParent->slug == $request->slug ? true : false,
            ];


            $productChilds = Product::join('products_translations', function ($q) use ($request) {
                $q->on('products.id', '=', 'products_translations.product_id')
                    ->where('products_translations.language_id', '=', $request->languageID);
            })
                ->select(
                    'products.id as id',
                    'products.parent as parent',
                    'products.slug as slug',
                    'products.length as length',
                    'products.width as width',
                    'products.height as height',
                    'products.image as image',
                    'products_translations.name as name',
                    'products_translations.sub_name as sub_name',
                )
                ->where('products.status', 1)
                ->where('products.parent', $productParent->id)
                ->orderBy('products.id', 'DESC')
                ->get();


            foreach ($productChilds as $productChild):

                $dimension = language('frontend.product.width_short') . $productChild->width . 'x' .
                    language('frontend.product.height_short') . $productChild->height . 'x' .
                    language('frontend.product.length_short') . $productChild->length .
                    language('frontend.product.centimeter');

                $productsParentAndChilds[] = [
                    'name' => $productChild->name,
                    'sub_name' => $productChild->sub_name,
                    'url' => $productChild->slug == $request->slug ?
                        'javascript:void(0)'
                        : route('frontend.product.detail', $productChild->slug),
                    'dimension' => $dimension,
                    'image' => $productChild->image != '' ? $productChild->image
                        : asset('frontend/assets/images/no-image.png'),
                    'selected' => $productChild->slug == $request->slug ? true : false,
                ];
            endforeach;


        }


        $productCategoryIDs = [];
        foreach ($product->getProductCategories2 as $productCategory):
            $productCategoryIDs[] = $productCategory->category_id;
        endforeach;


        $productsRelateds = Product::with(array('productsTranslations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))
            ->with('productsCategoriesCheck')
            ->leftJoin('products_specials_prices_lists', function ($join) {
                $join->on('products_specials_prices_lists.product_id', '=', 'products.id');
            })
            ->join('products_categories_lists', 'products.id', '=', 'products_categories_lists.product_id')
            ->select(
                'products.id as id',
                'products.parent as parent',
                'products.image as image',
                'products.images as images',
                'products.slug as slug',
                'products.price as price',
                'products.status as status',
                'products_specials_prices_lists.special_price as special_price',
                'products_specials_prices_lists.start_date as start_date',
                'products_specials_prices_lists.end_date as end_date',
            )
            ->whereIn('products_categories_lists.category_id', $productCategoryIDs)
            ->where('products.status', 1)
            ->where('products.parent', 0)
            ->where('products.id', '!=', $product->id)
            ->orderBy('products.id', 'DESC')
            ->groupBy('products.id')
            ->get();

        $productsRelatedsCount = $productsRelateds->count();


        //SHUFFLE RELATED PRODUCTS
        $collection = collect($productsRelateds);
        $shuffled = $collection->shuffle();
        $productsRelateds = $shuffled->all();


        return view('frontend.product.detail', compact(
            'product',
            'productOptionValueImages',
            'productsParentAndChilds',
            'productOptionValueGroupBy',
            'productsRelateds',
            'productsRelatedsCount',
        ));

    }

    public function orderItSendAjax(Request $request)
    {
        $name = $request->name;
        $subject = $request->subject;
        $email = $request->email;
        $mobil = $request->mobil;
        $text = $request->text;
        $product_detail = $request->product_detail;


        if (isset($subject)) {
            $subject = $subject;
        } else {
            $subject = language('general.title');
        }

        $data = [
            'name' => $name,
            'subject' => $subject,
            'email' => $email,
            'mobil' => $mobil,
            'product_detail' => $product_detail,
            'text' => $text,
        ];

        $responseData = [];

        if (empty($data['name'])) {
            array_push($responseData, language('frontend.contact.form_error_name'));

        }

        if (!empty($data['email'])) {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                array_push($responseData, language('frontend.contact.form_error_email_invalid'));
            }
        }


        if (empty($data['mobil'])) {
            array_push($responseData, language('frontend.contact.form_error_tel'));
        }


        if ($responseData == null) {

            $toMail = setting('email');


            Mail::to($toMail)
                ->send(new OrderItSendMail($data));

            return response()->json(['success' => true]);

        } else {
            return response()->json(['error' => true, 'data' => $responseData]);
        }


    }


}
