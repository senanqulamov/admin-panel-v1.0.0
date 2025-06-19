<?php


namespace App\Services;



use App\Models\Menu\Menu;
use Illuminate\Support\Facades\Cache;

class MenuServices
{




    public static function getMenu($HTTP_HOST,$languageID,$position = 0, $parent_id = 0, $parents = [])
    {


        //Aktiv dilleri aldim
        Cache::rememberForever('menu-all-'.$languageID.'-'.$position, function () use ($languageID,$position) {
            return Menu::where('languages.status', 1)
                ->where('languages.id', $languageID)
//                ->where('menus.menu_position_id', $position)
                ->where(function ($query) use ($position){
                    //0 ci indexi yoxlayir where olduqu uchun
                    $query->where('position->0', $position);
                    foreach (config('menu.menu_position') as $key => $menuPosition):
                        //o dan sonraki qalan indexleri yoxlayir orWhere() ile
                        if($key != 0){
                            $query->orWhere('position->'.$key, $position);
                        }
                    endforeach;

                })

                ->join('menu_positions', 'menus.menu_position_id', '=', 'menu_positions.id')
                ->join('menu_translations', 'menus.id', '=', 'menu_translations.menu_id')
                ->join('languages', 'languages.id', '=', 'menu_translations.language')
                ->select(
                    'menu_translations.*',
                    'menus.id',
                    'menus.sort',
                    'menus.menu_position_id',
                    'menus.parent',
                    'languages.id as languageID',
                    'languages.default as languageDefault',
                    'menu_positions.position as position'
                )
                ->orderBy('sort','ASC')
                ->get()->toArray();
        });


        if ($parent_id == 0) {
            foreach (cache('menu-all-'.$languageID.'-'.$position) as $element) {
                if (($element['parent'] != 0) && !in_array($element['parent'], $parents)) {
                    $parents[] = $element['parent'];
                }
            }
        }
        $menu_html = '';

        foreach (cache('menu-all-'.$languageID.'-'.$position) as $element) {




            if ($element['parent'] == $parent_id) {
                if (in_array($element['id'], $parents)) {

                    $isActive = str_replace($HTTP_HOST,'',url()->full()) == $element['link'] ? "current":null;
                    $menu_html .= '<li class="'.$isActive.' dropdown">';

                    $menu_html .= '<a href="'.$element['link'].'">' . $element['label'] . '</a>';

                } else {

                    $isActive = str_replace($HTTP_HOST,'',url()->full()) == $element['link'] ? "class='current'":null;
                    $menu_html .= '<li  '.$isActive.'>';

                    $menu_html .= '<a href="'.$element['link'].'" >' . $element['label'] . '</a>';
                }
                if (in_array($element['id'], $parents)) {
                    $menu_html .= '<ul>';
                    $menu_html .= self::getMenu($HTTP_HOST,$languageID,$position, $element['id'], $parents);
                    $menu_html .= '</ul>';
                }
                $menu_html .= '</li>';
            }
        }
        return $menu_html;




    }

    public static function getMenuFooter($HTTP_HOST,$languageID,$position = 0, $parent_id = 0, $parents = [])
    {


        //Aktiv dilleri aldim
        Cache::rememberForever('menu-all-'.$languageID.'-'.$position, function () use ($languageID,$position) {
            return Menu::where('languages.status', 1)
                ->where('languages.id', $languageID)
//                ->where('menus.menu_position_id', $position)
                ->where(function ($query) use ($position){
                    //0 ci indexi yoxlayir where olduqu uchun
                    $query->where('position->0', $position);
                    foreach (config('menu.menu_position') as $key => $menuPosition):
                        //o dan sonraki qalan indexleri yoxlayir orWhere() ile
                        if($key != 0){
                            $query->orWhere('position->'.$key, $position);
                        }
                    endforeach;

                })

                ->join('menu_positions', 'menus.menu_position_id', '=', 'menu_positions.id')
                ->join('menu_translations', 'menus.id', '=', 'menu_translations.menu_id')
                ->join('languages', 'languages.id', '=', 'menu_translations.language')
                ->select(
                    'menu_translations.*',
                    'menus.id',
                    'menus.sort',
                    'menus.menu_position_id',
                    'menus.parent',
                    'languages.id as languageID',
                    'languages.default as languageDefault',
                    'menu_positions.position as position'
                )
                ->orderBy('sort','ASC')
                ->get()->toArray();
        });


        if ($parent_id == 0) {
            foreach (cache('menu-all-'.$languageID.'-'.$position) as $element) {
                if (($element['parent'] != 0) && !in_array($element['parent'], $parents)) {
                    $parents[] = $element['parent'];
                }
            }
        }
        $menu_html = '';

        foreach (cache('menu-all-'.$languageID.'-'.$position) as $element) {




            if ($element['parent'] == $parent_id) {
                $menu_html .= '<li class="list-inline-item">"';
                if (!in_array($element['id'], $parents)) {

                    $isActive = str_replace($HTTP_HOST,'',url()->full()) == $element['link'] ? "class='active'":null;


                    $menu_html .= '<a href="'.$element['link'].'" >' . $element['label'] . '</a>';
                }

                $menu_html .= '</li>';
            }
        }
        return $menu_html;




    }


    public static function getMegaMenu($languageID,$position = 0)
    {

        Cache::rememberForever('menu-all-'.$languageID.'-'.$position, function () use ($languageID,$position) {
            return Menu::where('languages.status', 1)
                ->where('languages.id', $languageID)
//                ->where('menus.menu_position_id', $position)
                ->where(function ($query) use ($position){
                    //0 ci indexi yoxlayir where olduqu uchun
                    $query->where('position->0', $position);
                    foreach (config('menu.menu_position') as $key => $menuPosition):
                        //o dan sonraki qalan indexleri yoxlayir orWhere() ile
                        if($key != 0){
                            $query->orWhere('position->'.$key, $position);
                        }
                    endforeach;

                })

                ->join('menu_positions', 'menus.menu_position_id', '=', 'menu_positions.id')
                ->join('menu_translations', 'menus.id', '=', 'menu_translations.menu_id')
                ->join('languages', 'languages.id', '=', 'menu_translations.language')
                ->select(
                    'menu_translations.*',
                    'menus.id',
                    'menus.sort',
                    'menus.menu_position_id',
                    'menus.parent',
                    'languages.id as languageID',
                    'languages.default as languageDefault',
                    'menu_positions.position as position'
                )
                ->orderBy('sort','ASC')
                ->get();
        });

    }



}
