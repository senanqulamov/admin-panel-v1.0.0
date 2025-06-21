<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\Admin\Faq\FaqController;
use App\Http\Controllers\Admin\Filemanager\FileManagerController;
use App\Http\Controllers\Admin\Gallery\GalleryActivityController;
use App\Http\Controllers\Admin\Gallery\GalleryCategoryController;
use App\Http\Controllers\Admin\Gallery\GalleryController;
use App\Http\Controllers\Admin\Gallery\GalleryCountryController;
use App\Http\Controllers\Admin\Language\LanguageController;
use App\Http\Controllers\Admin\Language\LanguageGroupController;
use App\Http\Controllers\Admin\Language\LanguagePhraseController;
use App\Http\Controllers\Admin\Menu\MenuController;
use App\Http\Controllers\Admin\OnlineCatalog\OnlineCatalogController;
use App\Http\Controllers\Admin\Page\PageController;
use App\Http\Controllers\Admin\Partner\PartnersController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Product\ProductCategoryController;
use App\Http\Controllers\Admin\Product\ProductCollectionController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Product\ProductManufacturerController;
use App\Http\Controllers\Admin\Product\ProductModelController;
use App\Http\Controllers\Admin\Service\ServiceController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Slide\SlideController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Attribute\AttributeController;
use App\Http\Controllers\Admin\Attribute\AttributeGroupController;
use App\Http\Controllers\Admin\Option\OptionController;
use App\Http\Controllers\Admin\Option\OptionGroupController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\Common\CommonController;
use App\Http\Controllers\Frontend\Gallery\GalleryController as FrontendGalleryController;
use App\Http\Controllers\Frontend\Home\HomeController;
use App\Http\Controllers\Frontend\Language\LanguageController as FrontendLanguageController;
use App\Http\Controllers\Frontend\Page\PageController as FrontendPageController;
use App\Http\Controllers\Frontend\Partner\PartnerController as FrontendPartnerController;
use App\Http\Controllers\Frontend\Post\PostController as FrontendPostController;
use App\Http\Controllers\Frontend\Service\ServiceController as FrontendServiceController;
use App\Http\Controllers\Frontend\Sitemap\SitemapController;
use App\Services\Localization\LocalizationService;
use CKSource\CKFinderBridge\Controller\CKFinderController;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

// ----------------------------------------------------------------------------
// UPDATED FOR LARAVEL 12:
// • Converted string controller declarations to array syntax.
// • Removed unused commented-out routes (Review, Team, Post Category, Service Category, etc.).
// • Improved indentation and added header comments for each section.
// • Added proper controller imports with aliases for frontend controllers with same names.
// ----------------------------------------------------------------------------


// CKFinder Connector Route
Route::middleware([
    'auth',
    'StatususerCheck',
    'Common',
    'CustomCKFinderAuth',
    'FileManager'
])->group(function () {
    Route::any('/ckfinder/connector', [CKFinderController::class, 'requestAction'])
         ->name('ckfinder_connector');
});

// ---------------------- BACKEND START ----------------------
Route::group(['namespace' => 'Admin'], function () {
    Route::prefix(env('APP_PANEL_NAME'))->middleware(['auth', 'StatususerCheck', 'Common'])->group(function () {

        // Admin Dashboard Routes
        Route::get('/', [AdminController::class, 'index'])
             ->name('admin.index');
        Route::get('/permission', [AdminController::class, 'permission'])
             ->name('admin.permission');

        // Language Routes
        Route::group(['namespace' => 'Language', 'prefix' => 'language'], function () {
            Route::get('/', [LanguageController::class, 'index'])
                 ->name('admin.language.index');
            Route::post('/add', [LanguageController::class, 'add'])
                 ->name('admin.language.add');
            Route::post('/update', [LanguageController::class, 'update'])
                 ->name('admin.language.update');
            Route::post('/delete', [LanguageController::class, 'delete'])
                 ->name('admin.language.delete');
            Route::post('/delete-ajax', [LanguageController::class, 'deleteAjax'])
                 ->name('admin.language.deleteAjax');
            Route::post('/all-delete-ajax', [LanguageController::class, 'allDeleteAjax'])
                 ->name('admin.language.allDeleteAjax');
            Route::post('/edit-ajax', [LanguageController::class, 'editAjax'])
                 ->name('admin.language.editAjax');
            Route::post('/default-status', [LanguageController::class, 'defaultStatus'])
                 ->name('admin.language.defaultStatus');
            Route::post('/sort-ajax', [LanguageController::class, 'sortAjax'])
                 ->name('admin.language.sortAjax');
            Route::post('/status-ajax', [LanguageController::class, 'statusAjax'])
                 ->name('admin.language.statusAjax');
            Route::get('/search/{text?}', [LanguageController::class, 'search'])
                 ->name('admin.language.search');
        });

        // Language Group Routes
        Route::group(['namespace' => 'Language', 'prefix' => 'language-group'], function () {
            Route::get('/', [LanguageGroupController::class, 'index'])
                 ->name('admin.languageGroup.index');
            Route::post('/add', [LanguageGroupController::class, 'groupAdd'])
                 ->name('admin.languageGroup.add');
            Route::post('/update', [LanguageGroupController::class, 'groupUpdate'])
                 ->name('admin.languageGroup.update');
            Route::post('/delete', [LanguageGroupController::class, 'groupDelete'])
                 ->name('admin.languageGroup.delete');
            Route::post('/delete-ajax', [LanguageGroupController::class, 'deleteAjax'])
                 ->name('admin.languageGroup.deleteAjax');
            Route::post('/all-delete-ajax', [LanguageGroupController::class, 'allDeleteAjax'])
                 ->name('admin.languageGroup.allDeleteAjax');
            Route::post('/all-delete', [LanguageGroupController::class, 'allDelete'])
                 ->name('admin.languageGroup.allDelete');
            Route::post('/edit-ajax', [LanguageGroupController::class, 'groupEditAjax'])
                 ->name('admin.languageGroup.editAjax');
            Route::get('/search/{text?}', [LanguageGroupController::class, 'groupSearch'])
                 ->name('admin.languageGroup.search');
            /*   Language Group Detail   */
            Route::get('/detail/{id}', [LanguageGroupController::class, 'groupDetail'])
                 ->where('id', '[0-9]+')
                 ->name('admin.languageGroup.detail');
            Route::post('/detail-phrase-add', [LanguageGroupController::class, 'groupDetailPhraseAdd'])
                 ->name('admin.languageGroup.phraseAdd');
            Route::post('/detail-phrase-edit-ajax', [LanguageGroupController::class, 'groupDetailPhraseEditAjax'])
                 ->name('admin.languageGroup.phraseEditAjax');
            Route::post('/detail-phrase-update', [LanguageGroupController::class, 'groupDetailPhraseUpdate'])
                 ->name('admin.languageGroup.phraseUpdate');
            Route::get('/detail/search/{id?}/{text?}', [LanguageGroupController::class, 'groupDetailSearch'])
                 ->name('admin.languageGroup.groupDetailSearch');
            Route::post('/detail/delete', [LanguageGroupController::class, 'groupDetailDelete'])
                 ->name('admin.languageGroup.groupDetailDelete');
            Route::post('/detail/delete-ajax', [LanguageGroupController::class, 'groupDetailDeleteAjax'])
                 ->name('admin.languageGroup.groupDetailDeleteAjax');
        });

        // Language Phrase Routes
        Route::group(['namespace' => 'Language', 'prefix' => 'language-phrase'], function () {
            Route::get('/', [LanguagePhraseController::class, 'index'])
                 ->name('admin.languagePhrase.index');
            Route::post('/phrase-add', [LanguagePhraseController::class, 'add'])
                 ->name('admin.languagePhrase.add');
            Route::post('/phrase-edit-ajax', [LanguagePhraseController::class, 'editAjax'])
                 ->name('admin.languagePhrase.editAjax');
            Route::post('/phrase-update', [LanguagePhraseController::class, 'update'])
                 ->name('admin.languagePhrase.update');
            Route::get('/search/{text?}', [LanguagePhraseController::class, 'search'])
                 ->name('admin.languagePhrase.search');
            Route::post('/delete', [LanguagePhraseController::class, 'delete'])
                 ->name('admin.languagePhrase.delete');
            Route::post('/delete-ajax', [LanguagePhraseController::class, 'deleteAjax'])
                 ->name('admin.languagePhrase.deleteAjax');
            Route::post('/all-delete-ajax', [LanguagePhraseController::class, 'allDeleteAjax'])
                 ->name('admin.languagePhrase.allDeleteAjax');
        });

        // MENU Routes
        Route::group(['namespace' => 'Menu', 'prefix' => 'menu'], function () {
            Route::get('/', [MenuController::class, 'index'])
                 ->name('admin.menu.index');
            Route::get('/add', [MenuController::class, 'add'])
                 ->name('admin.menu.add');
            Route::post('/add-menu-name', [MenuController::class, 'addMenuName'])
                 ->name('admin.menu.addMenuName');
            Route::post('/delete', [MenuController::class, 'delete'])
                 ->name('admin.menu.delete');
            Route::get('/edit/{id}', [MenuController::class, 'edit'])
                 ->name('admin.menu.edit');
            Route::post('/position-add', [MenuController::class, 'positionAdd'])
                 ->name('admin.menu.positionAdd');
            Route::post('/position-delete-ajax', [MenuController::class, 'positionDeletAjax'])
                 ->name('admin.menu.position.delete.ajax');
            Route::post('/all-delete-ajax', [MenuController::class, 'allDeleteAjax'])
                 ->name('admin.menu.allDeleteAjax');
            Route::post('/all-delete', [MenuController::class, 'allDelete'])
                 ->name('admin.menu.allDelete');
            Route::post('/edit-ajax', [MenuController::class, 'editAjax'])
                 ->name('admin.menu.edit.ajax');
            Route::post('/store-ajax', [MenuController::class, 'storeAjax'])
                 ->name('admin.menu.store.ajax');
            Route::post('/change-ajax', [MenuController::class, 'changeAjax'])
                 ->name('admin.menu.change.ajax');
            Route::post('/delete-ajax', [MenuController::class, 'deleteAjax'])
                 ->name('admin.menu.delete.ajax');
        });

        // USERS Routes
        Route::group(['namespace' => 'User', 'prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index'])
                 ->name('admin.user.index');
            Route::get('/add', [UserController::class, 'add'])
                 ->name('admin.user.add');
            Route::post('/store', [UserController::class, 'store'])
                 ->name('admin.user.store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])
                 ->name('admin.user.edit');
            Route::post('/update', [UserController::class, 'update'])
                 ->name('admin.user.update');
            Route::get('/search', [UserController::class, 'search'])
                 ->name('admin.users.search');
            Route::get('/status-ajax', [UserController::class, 'statusAjax']);
            Route::post('/status-ajax', [UserController::class, 'statusAjax'])
                 ->name('admin.user.statusAjax');
            Route::post('/delete-ajax', [UserController::class, 'deleteAjax'])
                 ->name('admin.user.deleteAjax');
            Route::post('/delete', [UserController::class, 'delete'])
                 ->name('admin.user.delete');
            Route::post('/all-delete-ajax', [UserController::class, 'allDeleteAjax'])
                 ->name('admin.user.allDeleteAjax');
        });
        Route::group(['prefix' => 'profil'], function () {
            Route::get('/edit/{id}', [UserController::class, 'profilEdit'])
                 ->name('admin.user.profilEdit');
            Route::post('/profilUpdate', [UserController::class, 'profilUpdate'])
                 ->name('admin.user.profilUpdate');
        });

        // SETTINGS Routes
        Route::group(['namespace' => 'Setting', 'prefix' => 'setting'], function () {
            Route::get('/', [SettingController::class, 'index'])
                 ->name('admin.setting.index');
            Route::post('/update', [SettingController::class, 'update'])
                 ->name('admin.setting.update');
            Route::post('/search-icons', [SettingController::class, 'searchIcons'])
                 ->name('admin.setting.searchIcons');
        });

        // SLIDE Routes
        Route::group(['namespace' => 'Slide', 'prefix' => 'slide'], function () {
            Route::get('/', [SlideController::class, 'index'])
                 ->name('admin.slide.index');
            Route::get('/add', [SlideController::class, 'add'])
                 ->name('admin.slide.add');
            Route::post('/store', [SlideController::class, 'store'])
                 ->name('admin.slide.store');
            Route::get('/edit/{id}', [SlideController::class, 'edit'])
                 ->name('admin.slide.edit');
            Route::post('/update', [SlideController::class, 'update'])
                 ->name('admin.slide.update');
            Route::post('/sort-ajax', [SlideController::class, 'sortAjax'])
                 ->name('admin.slide.sortAjax');
            Route::post('/status-ajax', [SlideController::class, 'statusAjax'])
                 ->name('admin.slide.statusAjax');
            Route::post('/delete', [SlideController::class, 'delete'])
                 ->name('admin.slide.delete');
            Route::post('/delete-ajax', [SlideController::class, 'deleteAjax'])
                 ->name('admin.slide.deleteAjax');
            Route::post('/all-delete-ajax', [SlideController::class, 'allDeleteAjax'])
                 ->name('admin.slide.allDeleteAjax');
        });

        // FAQ Routes
        Route::group(['namespace' => 'Faq', 'prefix' => 'faq'], function () {
            Route::get('/', [FaqController::class, 'index'])
                 ->name('admin.faq.index');
            Route::get('/add', [FaqController::class, 'add'])
                 ->name('admin.faq.add');
            Route::post('/store', [FaqController::class, 'store'])
                 ->name('admin.faq.store');
            Route::get('/edit/{id}', [FaqController::class, 'edit'])
                 ->name('admin.faq.edit');
            Route::post('/update', [FaqController::class, 'update'])
                 ->name('admin.faq.update');
            Route::post('/sort-ajax', [FaqController::class, 'sortAjax'])
                 ->name('admin.faq.sortAjax');
            Route::post('/status-ajax', [FaqController::class, 'statusAjax'])
                 ->name('admin.faq.statusAjax');
            Route::post('/delete', [FaqController::class, 'delete'])
                 ->name('admin.faq.delete');
            Route::post('/delete-ajax', [FaqController::class, 'deleteAjax'])
                 ->name('admin.faq.deleteAjax');
            Route::post('/all-delete-ajax', [FaqController::class, 'allDeleteAjax'])
                 ->name('admin.faq.allDeleteAjax');
        });

        // Online Catalog Routes
        Route::group(['namespace' => 'OnlineCatalog', 'prefix' => 'onlineCatalog'], function () {
            Route::get('/', [OnlineCatalogController::class, 'index'])
                 ->name('admin.onlineCatalog.index');
            Route::get('/add', [OnlineCatalogController::class, 'add'])
                 ->name('admin.onlineCatalog.add');
            Route::post('/store', [OnlineCatalogController::class, 'store'])
                 ->name('admin.onlineCatalog.store');
            Route::get('/edit/{id}', [OnlineCatalogController::class, 'edit'])
                 ->name('admin.onlineCatalog.edit');
            Route::post('/update', [OnlineCatalogController::class, 'update'])
                 ->name('admin.onlineCatalog.update');
            Route::post('/sort-ajax', [OnlineCatalogController::class, 'sortAjax'])
                 ->name('admin.onlineCatalog.sortAjax');
            Route::post('/status-ajax', [OnlineCatalogController::class, 'statusAjax'])
                 ->name('admin.onlineCatalog.statusAjax');
            Route::post('/delete', [OnlineCatalogController::class, 'delete'])
                 ->name('admin.onlineCatalog.delete');
            Route::post('/delete-ajax', [OnlineCatalogController::class, 'deleteAjax'])
                 ->name('admin.onlineCatalog.deleteAjax');
            Route::post('/all-delete-ajax', [OnlineCatalogController::class, 'allDeleteAjax'])
                 ->name('admin.onlineCatalog.allDeleteAjax');
        });

        // BANNER Routes
        Route::group(['namespace' => 'Banner', 'prefix' => 'banner'], function () {
            Route::get('/', [BannerController::class, 'index'])
                 ->name('admin.banner.index');
            Route::get('/add', [BannerController::class, 'add'])
                 ->name('admin.banner.add');
            Route::post('/store', [BannerController::class, 'store'])
                 ->name('admin.banner.store');
            Route::get('/edit/{id}', [BannerController::class, 'edit'])
                 ->name('admin.banner.edit');
            Route::post('/update', [BannerController::class, 'update'])
                 ->name('admin.banner.update');
            Route::post('/sort-ajax', [BannerController::class, 'sortAjax'])
                 ->name('admin.banner.sortAjax');
            Route::post('/status-ajax', [BannerController::class, 'statusAjax'])
                 ->name('admin.banner.statusAjax');
            Route::post('/delete', [BannerController::class, 'delete'])
                 ->name('admin.banner.delete');
            Route::post('/delete-ajax', [BannerController::class, 'deleteAjax'])
                 ->name('admin.banner.deleteAjax');
            Route::post('/all-delete-ajax', [BannerController::class, 'allDeleteAjax'])
                 ->name('admin.banner.allDeleteAjax');
        });

        // PARTNER Routes
        Route::group(['namespace' => 'Partner', 'prefix' => 'partner'], function () {
            Route::get('/', [PartnersController::class, 'index'])
                 ->name('admin.partner.index');
            Route::get('/add', [PartnersController::class, 'add'])
                 ->name('admin.partner.add');
            Route::post('/store', [PartnersController::class, 'store'])
                 ->name('admin.partner.store');
            Route::get('/edit/{id}', [PartnersController::class, 'edit'])
                 ->name('admin.partner.edit');
            Route::post('/update', [PartnersController::class, 'update'])
                 ->name('admin.partner.update');
            Route::post('/sort-ajax', [PartnersController::class, 'sortAjax'])
                 ->name('admin.partner.sortAjax');
            Route::post('/status-ajax', [PartnersController::class, 'statusAjax'])
                 ->name('admin.partner.statusAjax');
            Route::post('/delete', [PartnersController::class, 'delete'])
                 ->name('admin.partner.delete');
            Route::post('/delete-ajax', [PartnersController::class, 'deleteAjax'])
                 ->name('admin.partner.deleteAjax');
            Route::post('/all-delete-ajax', [PartnersController::class, 'allDeleteAjax'])
                 ->name('admin.partner.allDeleteAjax');
        });

        // PAGES Routes
        Route::group(['namespace' => 'Page', 'prefix' => 'page'], function () {
            Route::get('/', [PageController::class, 'index'])
                 ->name('admin.page.index');
            Route::get('/add', [PageController::class, 'add'])
                 ->name('admin.page.add');
            Route::post('/store', [PageController::class, 'store'])
                 ->name('admin.page.store');
            Route::get('/edit/{id}', [PageController::class, 'edit'])
                 ->name('admin.page.edit');
            Route::post('/update', [PageController::class, 'update'])
                 ->name('admin.page.update');
            Route::post('/slug', [PageController::class, 'slug'])
                 ->name('admin.page.slug');
            Route::post('/status-ajax', [PageController::class, 'statusAjax'])
                 ->name('admin.page.statusAjax');
            Route::post('/delete', [PageController::class, 'delete'])
                 ->name('admin.page.delete');
            Route::post('/delete-ajax', [PageController::class, 'deleteAjax'])
                 ->name('admin.page.deleteAjax');
            Route::post('/all-delete-ajax', [PageController::class, 'allDeleteAjax'])
                 ->name('admin.page.allDeleteAjax');
            Route::get('/search', [PageController::class, 'search'])
                 ->name('admin.page.search');
        });

        // POST Routes
        Route::group(['namespace' => 'Post', 'prefix' => 'post'], function () {
            Route::get('/', [PostController::class, 'index'])
                 ->name('admin.post.index');
            Route::get('/add', [PostController::class, 'add'])
                 ->name('admin.post.add');
            Route::post('/store', [PostController::class, 'store'])
                 ->name('admin.post.store');
            Route::get('/edit/{id}', [PostController::class, 'edit'])
                 ->name('admin.post.edit');
            Route::post('/update', [PostController::class, 'update'])
                 ->name('admin.post.update');
            Route::post('/slug', [PostController::class, 'slug'])
                 ->name('admin.post.slug');
            Route::post('/status-ajax', [PostController::class, 'statusAjax'])
                 ->name('admin.post.statusAjax');
            Route::post('/delete', [PostController::class, 'delete'])
                 ->name('admin.post.delete');
            Route::post('/delete-ajax', [PostController::class, 'deleteAjax'])
                 ->name('admin.post.deleteAjax');
            Route::post('/all-delete-ajax', [PostController::class, 'allDeleteAjax'])
                 ->name('admin.post.allDeleteAjax');
            Route::get('/search', [PostController::class, 'search'])
                 ->name('admin.post.search');
            Route::get('/categories/{id}', [PostController::class, 'categories'])
                 ->name('admin.post.categories');
        });

        // GALLERY Routes and Sub-Groups (Gallery Category, Activity, Country)
        Route::group(['namespace' => 'Gallery', 'prefix' => 'gallery'], function () {
            Route::get('/', [GalleryController::class, 'index'])
                 ->name('admin.gallery.index');
            Route::get('/show-home-page-filter', [GalleryController::class, 'showHomePageFilter'])
                 ->name('admin.gallery.showHomePageFilter');
            Route::get('/add', [GalleryController::class, 'add'])
                 ->name('admin.gallery.add');
            Route::post('/store', [GalleryController::class, 'store'])
                 ->name('admin.gallery.store');
            Route::get('/edit/{id}', [GalleryController::class, 'edit'])
                 ->name('admin.gallery.edit');
            Route::post('/update', [GalleryController::class, 'update'])
                 ->name('admin.gallery.update');
            Route::post('/slug', [GalleryController::class, 'slug'])
                 ->name('admin.gallery.slug');
            Route::post('/status-ajax', [GalleryController::class, 'statusAjax'])
                 ->name('admin.gallery.statusAjax');
            Route::post('/show-home-page-ajax', [GalleryController::class, 'showHomePage'])
                 ->name('admin.gallery.showHomePage');
            Route::post('/delete', [GalleryController::class, 'delete'])
                 ->name('admin.gallery.delete');
            Route::post('/delete-ajax', [GalleryController::class, 'deleteAjax'])
                 ->name('admin.gallery.deleteAjax');
            Route::post('/all-delete-ajax', [GalleryController::class, 'allDeleteAjax'])
                 ->name('admin.gallery.allDeleteAjax');
            Route::get('/search', [GalleryController::class, 'search'])
                 ->name('admin.gallery.search');
            Route::get('/categories/{id}', [GalleryController::class, 'categories'])
                 ->name('admin.gallery.categories');
            Route::get('/activities/{id}', [GalleryController::class, 'activities'])
                 ->name('admin.gallery.activities');
            Route::get('/countries/{id}', [GalleryController::class, 'countries'])
                 ->name('admin.gallery.countries');
        });
        Route::group(['namespace' => 'Gallery', 'prefix' => 'gallery/category'], function () {
            Route::get('/', [GalleryCategoryController::class, 'index'])
                 ->name('admin.gallery.category.index');
            Route::get('/add', [GalleryCategoryController::class, 'add'])
                 ->name('admin.gallery.category.add');
            Route::post('/store', [GalleryCategoryController::class, 'store'])
                 ->name('admin.gallery.category.store');
            Route::get('/edit/{id}', [GalleryCategoryController::class, 'edit'])
                 ->name('admin.gallery.category.edit');
            Route::post('/update', [GalleryCategoryController::class, 'update'])
                 ->name('admin.gallery.category.update');
            Route::post('/slug', [GalleryCategoryController::class, 'slug'])
                 ->name('admin.gallery.category.slug');
            Route::post('/status-ajax', [GalleryCategoryController::class, 'statusAjax'])
                 ->name('admin.gallery.category.statusAjax');
            Route::post('/delete', [GalleryCategoryController::class, 'delete'])
                 ->name('admin.gallery.category.delete');
            Route::post('/delete-ajax', [GalleryCategoryController::class, 'deleteAjax'])
                 ->name('admin.gallery.category.deleteAjax');
            Route::post('/all-delete-ajax', [GalleryCategoryController::class, 'allDeleteAjax'])
                 ->name('admin.gallery.category.allDeleteAjax');
            Route::get('/search', [GalleryCategoryController::class, 'search'])
                 ->name('admin.gallery.category.search');
        });
        Route::group(['namespace' => 'Gallery', 'prefix' => 'gallery/activity'], function () {
            Route::get('/', [GalleryActivityController::class, 'index'])
                 ->name('admin.gallery.activity.index');
            Route::get('/add', [GalleryActivityController::class, 'add'])
                 ->name('admin.gallery.activity.add');
            Route::post('/store', [GalleryActivityController::class, 'store'])
                 ->name('admin.gallery.activity.store');
            Route::get('/edit/{id}', [GalleryActivityController::class, 'edit'])
                 ->name('admin.gallery.activity.edit');
            Route::post('/update', [GalleryActivityController::class, 'update'])
                 ->name('admin.gallery.activity.update');
            Route::post('/slug', [GalleryActivityController::class, 'slug'])
                 ->name('admin.gallery.activity.slug');
            Route::post('/status-ajax', [GalleryActivityController::class, 'statusAjax'])
                 ->name('admin.gallery.activity.statusAjax');
            Route::post('/delete', [GalleryActivityController::class, 'delete'])
                 ->name('admin.gallery.activity.delete');
            Route::post('/delete-ajax', [GalleryActivityController::class, 'deleteAjax'])
                 ->name('admin.gallery.activity.deleteAjax');
            Route::post('/all-delete-ajax', [GalleryActivityController::class, 'allDeleteAjax'])
                 ->name('admin.gallery.activity.allDeleteAjax');
            Route::get('/search', [GalleryActivityController::class, 'search'])
                 ->name('admin.gallery.activity.search');
        });
        Route::group(['namespace' => 'Gallery', 'prefix' => 'gallery/country'], function () {
            Route::get('/', [GalleryCountryController::class, 'index'])
                 ->name('admin.gallery.country.index');
            Route::get('/add', [GalleryCountryController::class, 'add'])
                 ->name('admin.gallery.country.add');
            Route::post('/store', [GalleryCountryController::class, 'store'])
                 ->name('admin.gallery.country.store');
            Route::get('/edit/{id}', [GalleryCountryController::class, 'edit'])
                 ->name('admin.gallery.country.edit');
            Route::post('/update', [GalleryCountryController::class, 'update'])
                 ->name('admin.gallery.country.update');
            Route::post('/slug', [GalleryCountryController::class, 'slug'])
                 ->name('admin.gallery.country.slug');
            Route::post('/status-ajax', [GalleryCountryController::class, 'statusAjax'])
                 ->name('admin.gallery.country.statusAjax');
            Route::post('/delete', [GalleryCountryController::class, 'delete'])
                 ->name('admin.gallery.country.delete');
            Route::post('/delete-ajax', [GalleryCountryController::class, 'deleteAjax'])
                 ->name('admin.gallery.country.deleteAjax');
            Route::post('/all-delete-ajax', [GalleryCountryController::class, 'allDeleteAjax'])
                 ->name('admin.gallery.country.allDeleteAjax');
            Route::get('/search', [GalleryCountryController::class, 'search'])
                 ->name('admin.gallery.country.search');
        });

        // SERVICE Routes
        Route::group(['namespace' => 'Service', 'prefix' => 'service'], function () {
            Route::get('/', [ServiceController::class, 'index'])
                 ->name('admin.service.index');
            Route::get('/add', [ServiceController::class, 'add'])
                 ->name('admin.service.add');
            Route::post('/store', [ServiceController::class, 'store'])
                 ->name('admin.service.store');
            Route::get('/edit/{id}', [ServiceController::class, 'edit'])
                 ->name('admin.service.edit');
            Route::post('/update', [ServiceController::class, 'update'])
                 ->name('admin.service.update');
            Route::post('/slug', [ServiceController::class, 'slug'])
                 ->name('admin.service.slug');
            Route::post('/status-ajax', [ServiceController::class, 'statusAjax'])
                 ->name('admin.service.statusAjax');
            Route::post('/delete', [ServiceController::class, 'delete'])
                 ->name('admin.service.delete');
            Route::post('/delete-ajax', [ServiceController::class, 'deleteAjax'])
                 ->name('admin.service.deleteAjax');
            Route::post('/all-delete-ajax', [ServiceController::class, 'allDeleteAjax'])
                 ->name('admin.service.allDeleteAjax');
            Route::post('/sort-ajax', [ServiceController::class, 'sortAjax'])
                 ->name('admin.service.sortAjax');
            Route::get('/search', [ServiceController::class, 'search'])
                 ->name('admin.service.search');
            Route::get('/categories/{id}', [ServiceController::class, 'categories'])
                 ->name('admin.service.categories');
        });

        // PRODUCT Routes and Sub-Groups (Category, Collection, Model, Manufacturer)
        Route::group(['namespace' => 'Product', 'prefix' => 'product'], function () {
            Route::get('/', [ProductController::class, 'index'])
                 ->name('admin.product.index');
            Route::get('/add', [ProductController::class, 'add'])
                 ->name('admin.product.add');
            Route::post('/store', [ProductController::class, 'store'])
                 ->name('admin.product.store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])
                 ->name('admin.product.edit');
            Route::post('/update', [ProductController::class, 'update'])
                 ->name('admin.product.update');
            Route::post('/slug', [ProductController::class, 'slug'])
                 ->name('admin.product.slug');
            Route::post('/status-ajax', [ProductController::class, 'statusAjax'])
                 ->name('admin.product.statusAjax');
            Route::post('/delete', [ProductController::class, 'delete'])
                 ->name('admin.product.delete');
            Route::post('/delete-ajax', [ProductController::class, 'deleteAjax'])
                 ->name('admin.product.deleteAjax');
            Route::post('/all-delete-ajax', [ProductController::class, 'allDeleteAjax'])
                 ->name('admin.product.allDeleteAjax');
            Route::get('/search', [ProductController::class, 'search'])
                 ->name('admin.product.search');
            Route::get('/parents/{parent_id}', [ProductController::class, 'parents'])
                 ->name('admin.product.parents');
            Route::get('/categories/{id}', [ProductController::class, 'categories'])
                 ->name('admin.product.categories');
            Route::get('/collections/{id}', [ProductController::class, 'collections'])
                 ->name('admin.product.collections');
            Route::get('/models/{id}', [ProductController::class, 'models'])
                 ->name('admin.product.models');
            Route::get('/manufacturers/{id}', [ProductController::class, 'manufacturers'])
                 ->name('admin.product.manufacturers');
            Route::post('/attribute-ajax', [ProductController::class, 'getAttributeAjax'])
                 ->name('admin.product.getAttributeAjax');
            Route::post('/attribute-add-ajax', [ProductController::class, 'getAttributeAddAjax'])
                 ->name('admin.product.getAttributeAddAjax');
            Route::post('/option-ajax', [ProductController::class, 'getOptionAjax'])
                 ->name('admin.product.getOptionAjax');
            Route::post('/option-add-ajax', [ProductController::class, 'getOptionAddAjax'])
                 ->name('admin.product.getOptionAddAjax');
            Route::get('/product-parent-ajax', [ProductController::class, 'getProductParent'])
                 ->name('admin.product.getProductParent');
            Route::get('/product-gallery-ajax', [ProductController::class, 'getProductGallery'])
                 ->name('admin.product.getProductGallery');
        });
        Route::group(['namespace' => 'Product', 'prefix' => 'product/category'], function () {
            Route::get('/', [ProductCategoryController::class, 'index'])
                 ->name('admin.product.category.index');
            Route::get('/add', [ProductCategoryController::class, 'add'])
                 ->name('admin.product.category.add');
            Route::post('/store', [ProductCategoryController::class, 'store'])
                 ->name('admin.product.category.store');
            Route::get('/edit/{id}', [ProductCategoryController::class, 'edit'])
                 ->name('admin.product.category.edit');
            Route::post('/update', [ProductCategoryController::class, 'update'])
                 ->name('admin.product.category.update');
            Route::post('/slug', [ProductCategoryController::class, 'slug'])
                 ->name('admin.product.category.slug');
            Route::post('/status-ajax', [ProductCategoryController::class, 'statusAjax'])
                 ->name('admin.product.category.statusAjax');
            Route::post('/delete', [ProductCategoryController::class, 'delete'])
                 ->name('admin.product.category.delete');
            Route::post('/delete-ajax', [ProductCategoryController::class, 'deleteAjax'])
                 ->name('admin.product.category.deleteAjax');
            Route::post('/all-delete-ajax', [ProductCategoryController::class, 'allDeleteAjax'])
                 ->name('admin.product.category.allDeleteAjax');
            Route::get('/search', [ProductCategoryController::class, 'search'])
                 ->name('admin.product.category.search');
        });
        Route::group(['namespace' => 'Product', 'prefix' => 'product/collection'], function () {
            Route::get('/', [ProductCollectionController::class, 'index'])
                 ->name('admin.product.collection.index');
            Route::get('/add', [ProductCollectionController::class, 'add'])
                 ->name('admin.product.collection.add');
            Route::post('/store', [ProductCollectionController::class, 'store'])
                 ->name('admin.product.collection.store');
            Route::get('/edit/{id}', [ProductCollectionController::class, 'edit'])
                 ->name('admin.product.collection.edit');
            Route::post('/update', [ProductCollectionController::class, 'update'])
                 ->name('admin.product.collection.update');
            Route::post('/slug', [ProductCollectionController::class, 'slug'])
                 ->name('admin.product.collection.slug');
            Route::post('/status-ajax', [ProductCollectionController::class, 'statusAjax'])
                 ->name('admin.product.collection.statusAjax');
            Route::post('/delete', [ProductCollectionController::class, 'delete'])
                 ->name('admin.product.collection.delete');
            Route::post('/delete-ajax', [ProductCollectionController::class, 'deleteAjax'])
                 ->name('admin.product.collection.deleteAjax');
            Route::post('/all-delete-ajax', [ProductCollectionController::class, 'allDeleteAjax'])
                 ->name('admin.product.collection.allDeleteAjax');
            Route::get('/search', [ProductCollectionController::class, 'search'])
                 ->name('admin.product.collection.search');
        });
        Route::group(['namespace' => 'Product', 'prefix' => 'product/model'], function () {
            Route::get('/', [ProductModelController::class, 'index'])
                 ->name('admin.product.model.index');
            Route::get('/add', [ProductModelController::class, 'add'])
                 ->name('admin.product.model.add');
            Route::post('/store', [ProductModelController::class, 'store'])
                 ->name('admin.product.model.store');
            Route::get('/edit/{id}', [ProductModelController::class, 'edit'])
                 ->name('admin.product.model.edit');
            Route::post('/update', [ProductModelController::class, 'update'])
                 ->name('admin.product.model.update');
            Route::post('/slug', [ProductModelController::class, 'slug'])
                 ->name('admin.product.model.slug');
            Route::post('/status-ajax', [ProductModelController::class, 'statusAjax'])
                 ->name('admin.product.model.statusAjax');
            Route::post('/delete', [ProductModelController::class, 'delete'])
                 ->name('admin.product.model.delete');
            Route::post('/delete-ajax', [ProductModelController::class, 'deleteAjax'])
                 ->name('admin.product.model.deleteAjax');
            Route::post('/all-delete-ajax', [ProductModelController::class, 'allDeleteAjax'])
                 ->name('admin.product.model.allDeleteAjax');
            Route::get('/search', [ProductModelController::class, 'search'])
                 ->name('admin.product.model.search');
        });
        Route::group(['namespace' => 'Product', 'prefix' => 'product/manufacturer'], function () {
            Route::get('/', [ProductManufacturerController::class, 'index'])
                 ->name('admin.product.manufacturer.index');
            Route::get('/add', [ProductManufacturerController::class, 'add'])
                 ->name('admin.product.manufacturer.add');
            Route::post('/store', [ProductManufacturerController::class, 'store'])
                 ->name('admin.product.manufacturer.store');
            Route::get('/edit/{id}', [ProductManufacturerController::class, 'edit'])
                 ->name('admin.product.manufacturer.edit');
            Route::post('/update', [ProductManufacturerController::class, 'update'])
                 ->name('admin.product.manufacturer.update');
            Route::post('/slug', [ProductManufacturerController::class, 'slug'])
                 ->name('admin.product.manufacturer.slug');
            Route::post('/status-ajax', [ProductManufacturerController::class, 'statusAjax'])
                 ->name('admin.product.manufacturer.statusAjax');
            Route::post('/delete', [ProductManufacturerController::class, 'delete'])
                 ->name('admin.product.manufacturer.delete');
            Route::post('/delete-ajax', [ProductManufacturerController::class, 'deleteAjax'])
                 ->name('admin.product.manufacturer.deleteAjax');
            Route::post('/all-delete-ajax', [ProductManufacturerController::class, 'allDeleteAjax'])
                 ->name('admin.product.manufacturer.allDeleteAjax');
            Route::get('/search', [ProductManufacturerController::class, 'search'])
                 ->name('admin.product.manufacturer.search');
        });

        // ATTRIBUTE GROUP Routes
        Route::group(['namespace' => 'Attribute', 'prefix' => 'attribute/group'], function () {
            Route::get('/', [AttributeGroupController::class, 'index'])
                 ->name('admin.attribute.group.index');
            Route::get('/add', [AttributeGroupController::class, 'add'])
                 ->name('admin.attribute.group.add');
            Route::post('/store', [AttributeGroupController::class, 'store'])
                 ->name('admin.attribute.group.store');
            Route::get('/edit/{id}', [AttributeGroupController::class, 'edit'])
                 ->name('admin.attribute.group.edit');
            Route::post('/update', [AttributeGroupController::class, 'update'])
                 ->name('admin.attribute.group.update');
            Route::post('/sort-ajax', [AttributeGroupController::class, 'sortAjax'])
                 ->name('admin.attribute.group.sortAjax');
            Route::post('/status-ajax', [AttributeGroupController::class, 'statusAjax'])
                 ->name('admin.attribute.group.statusAjax');
            Route::post('/delete', [AttributeGroupController::class, 'delete'])
                 ->name('admin.attribute.group.delete');
            Route::post('/delete-ajax', [AttributeGroupController::class, 'deleteAjax'])
                 ->name('admin.attribute.group.deleteAjax');
            Route::post('/all-delete', [AttributeGroupController::class, 'allDelete'])
                 ->name('admin.attribute.group.allDelete');
            Route::post('/all-delete-ajax', [AttributeGroupController::class, 'allDeleteAjax'])
                 ->name('admin.attribute.group.allDeleteAjax');
            Route::get('/search', [AttributeGroupController::class, 'search'])
                 ->name('admin.attribute.group.search');
        });
        // ATTRIBUTE Routes
        Route::group(['namespace' => 'Attribute', 'prefix' => 'attribute'], function () {
            Route::get('/', [AttributeController::class, 'index'])
                 ->name('admin.attribute.index');
            Route::get('/add', [AttributeController::class, 'add'])
                 ->name('admin.attribute.add');
            Route::post('/store', [AttributeController::class, 'store'])
                 ->name('admin.attribute.store');
            Route::get('/edit/{id}', [AttributeController::class, 'edit'])
                 ->name('admin.attribute.edit');
            Route::post('/update', [AttributeController::class, 'update'])
                 ->name('admin.attribute.update');
            Route::post('/sort-ajax', [AttributeController::class, 'sortAjax'])
                 ->name('admin.attribute.sortAjax');
            Route::post('/status-ajax', [AttributeController::class, 'statusAjax'])
                 ->name('admin.attribute.statusAjax');
            Route::post('/delete', [AttributeController::class, 'delete'])
                 ->name('admin.attribute.delete');
            Route::post('/delete-ajax', [AttributeController::class, 'deleteAjax'])
                 ->name('admin.attribute.deleteAjax');
            Route::post('/all-delete-ajax', [AttributeController::class, 'allDeleteAjax'])
                 ->name('admin.attribute.allDeleteAjax');
            Route::get('/search', [AttributeController::class, 'search'])
                 ->name('admin.attribute.search');
            Route::get('/list/{id}', [AttributeController::class, 'list'])
                 ->name('admin.attribute.list');
        });

        // OPTION GROUP Routes
        Route::group(['namespace' => 'Option', 'prefix' => 'option/group'], function () {
            Route::get('/', [OptionGroupController::class, 'index'])
                 ->name('admin.option.group.index');
            Route::get('/add', [OptionGroupController::class, 'add'])
                 ->name('admin.option.group.add');
            Route::post('/store', [OptionGroupController::class, 'store'])
                 ->name('admin.option.group.store');
            Route::get('/edit/{id}', [OptionGroupController::class, 'edit'])
                 ->name('admin.option.group.edit');
            Route::post('/update', [OptionGroupController::class, 'update'])
                 ->name('admin.option.group.update');
            Route::post('/sort-ajax', [OptionGroupController::class, 'sortAjax'])
                 ->name('admin.option.group.sortAjax');
            Route::post('/status-ajax', [OptionGroupController::class, 'statusAjax'])
                 ->name('admin.option.group.statusAjax');
            Route::post('/delete', [OptionGroupController::class, 'delete'])
                 ->name('admin.option.group.delete');
            Route::post('/delete-ajax', [OptionGroupController::class, 'deleteAjax'])
                 ->name('admin.option.group.deleteAjax');
            Route::post('/all-delete', [OptionGroupController::class, 'allDelete'])
                 ->name('admin.option.group.allDelete');
            Route::post('/all-delete-ajax', [OptionGroupController::class, 'allDeleteAjax'])
                 ->name('admin.option.group.allDeleteAjax');
            Route::get('/search', [OptionGroupController::class, 'search'])
                 ->name('admin.option.group.search');
        });
        // OPTION Routes
        Route::group(['namespace' => 'Option', 'prefix' => 'option'], function () {
            Route::get('/', [OptionController::class, 'index'])
                 ->name('admin.option.index');
            Route::get('/add', [OptionController::class, 'add'])
                 ->name('admin.option.add');
            Route::post('/store', [OptionController::class, 'store'])
                 ->name('admin.option.store');
            Route::get('/edit/{id}', [OptionController::class, 'edit'])
                 ->name('admin.option.edit');
            Route::post('/update', [OptionController::class, 'update'])
                 ->name('admin.option.update');
            Route::post('/sort-ajax', [OptionController::class, 'sortAjax'])
                 ->name('admin.option.sortAjax');
            Route::post('/status-ajax', [OptionController::class, 'statusAjax'])
                 ->name('admin.option.statusAjax');
            Route::post('/delete', [OptionController::class, 'delete'])
                 ->name('admin.option.delete');
            Route::post('/delete-ajax', [OptionController::class, 'deleteAjax'])
                 ->name('admin.option.deleteAjax');
            Route::post('/all-delete-ajax', [OptionController::class, 'allDeleteAjax'])
                 ->name('admin.option.allDeleteAjax');
            Route::get('/search', [OptionController::class, 'search'])
                 ->name('admin.option.search');
            Route::get('/list/{id}', [OptionController::class, 'list'])
                 ->name('admin.option.list');
            Route::post('/option-add-ajax', [OptionController::class, 'getOptionAddAjax'])
                 ->name('admin.option.getOptionAddAjax');
        });

        // FILE MANAGER Routes
        Route::group(['namespace' => 'Filemanager', 'middleware' => ['FileManager']], function () {
            Route::get('/file-manager', [FileManagerController::class, 'index'])
                 ->name('admin.FileManager.index');
        });

        // CACHE CLEAR Route
        Route::post('cache-clear', [AdminController::class, 'cacheClear'])
             ->name('admin.cacheClear');
    });
});
// ----------------------- BACKEND END -----------------------


// ----------------------- LOGIN START -----------------------
Route::group(['prefix' => env('APP_PANEL_NAME')], function () {
    Route::get('/login', [LoginController::class, 'index'])
         ->name('admin.login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])
         ->name('admin.logout');
});
// ----------------------- LOGIN END -----------------------


// ----------------------- LOGGER VIEW START -----------------------
Route::group(['prefix' => env('APP_PANEL_NAME'), 'middleware' => 'auth'], function () {
    Route::get('logs', [LogViewerController::class, 'index'])
         ->name('admin.logs');
});
// ----------------------- LOGGER VIEW END -----------------------


// ----------------------- FRONTEND START -----------------------
Route::group([
    'prefix' => LocalizationService::locale(),
    'middleware' => ['setLocale', 'Common', 'Maintenance']
], function () {
    Route::group(['namespace' => 'Frontend'], function () {

        // COMMON Routes
        Route::get('/common/bot/{username?}', [CommonController::class, 'instagramBot'])
             ->name('frontend.common.instagramBot');

        // HOME Routes
        Route::get('/', [HomeController::class, 'index'])
             ->name('frontend.home.index');

        // CONTACT Routes
        Route::get('/contact', [HomeController::class, 'contact'])
             ->name('frontend.home.contact');
        Route::post('/contact-send-ajax', [HomeController::class, 'contactSendAjax'])
             ->name('frontend.home.contactSendAjax');

        // PAGE Routes
        Route::get('/page/{slug}', [FrontendPageController::class, 'page'])
             ->name('frontend.page.index');

        // CUSTOM PAGES Routes
        Route::get('/about-us', [FrontendPageController::class, 'aboutUs'])
             ->name('frontend.custom.page.aboutUs');
        Route::get('/mobile-and-web-shop', [FrontendPageController::class, 'mobileApp'])
             ->name('frontend.custom.page.mobileApp');
        Route::get('/evisitcard', [FrontendPageController::class, 'evisitcard'])
             ->name('frontend.custom.page.evisitcard');
        Route::get('/attendance-tracking', [FrontendPageController::class, 'attendanceTracking'])
             ->name('frontend.custom.page.attendanceTracking');
        Route::get('/jobhbn', [FrontendPageController::class, 'jobhbn'])
             ->name('frontend.custom.page.jobhbn');
        Route::get('/gps-tracking', [FrontendPageController::class, 'gpsTracking'])
             ->name('frontend.custom.page.gpsTracking');

        // GALLERY Routes
        Route::get('/projects', [FrontendGalleryController::class, 'categories'])
             ->name('frontend.portfolio.categories');
        Route::get('/projects/{category}', [FrontendGalleryController::class, 'index'])
             ->name('frontend.portfolio.index');
        Route::get('/projects/{category}/{slug?}', [FrontendGalleryController::class, 'detail'])
             ->name('frontend.portfolio.detail');

        // SERVICE Routes
        Route::get('/services', [FrontendServiceController::class, 'index'])
             ->name('frontend.service.index');
        Route::get('/services/{slug}', [FrontendServiceController::class, 'detail'])
             ->name('frontend.service.detail');

        // PARTNER Routes
        Route::get('/partners', [FrontendPartnerController::class, 'index'])
             ->name('frontend.partner.index');

        // BLOG Routes
        Route::get('/blogs', [FrontendPostController::class, 'index'])
             ->name('frontend.post.index');
        Route::get('/blogs/{slug}', [FrontendPostController::class, 'detail'])
             ->name('frontend.post.detail');

        // LANGUAGE Routes
        Route::group(['namespace' => 'Language', 'prefix' => 'language'], function () {
            Route::get('/test', [FrontendLanguageController::class, 'test'])
                 ->name('frontend.language.test');
            Route::post('/change', [FrontendLanguageController::class, 'change'])
                 ->name('frontend.language.change');
        });

        // SITEMAP & RSS Routes
        Route::get('/sitemap.xml', [SitemapController::class, 'index'])
             ->name('frontend.sitemap.index');
        Route::get('/rss.xml', [SitemapController::class, 'rss'])
             ->name('frontend.sitemap.rss');
    });
});
// ----------------------- FRONTEND END -----------------------
