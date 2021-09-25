<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\layout as layoutDB;
use App\Models\Category as categoryDB;
use App\Models\Lang;
use Illuminate\Support\Facades\Cache;


class UiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('ui/*', function ($view) #2
        {
            // if (!Cache::has('sidebar') || !Cache::has('footer')) {
            $config_lang = Lang::all();
            $default_lang_id = $config_lang->where('default', 1)->first()->id;
            $default_lang_url = $config_lang->where('default', 1)->first()->url;
            $layout = layoutDB::all();
            $items = array();
            foreach ($layout as $r_layout) {
                if ($r_layout->type == 'position') {
                    $data = array();
                    $value = \json_decode($r_layout['value'], true);
                    if (is_array($value) && !empty($value)) {

                        foreach ($value as $key_category_lv1 => $r_category_lv1) { //level 1
                            $data[$key_category_lv1] =  categoryDB::find($r_category_lv1['id'])->translates()->where('lang_id', 'like', $default_lang_id)->get()->first()->toArray();
                            $data[$key_category_lv1]['url'] =  categoryDB::find($r_category_lv1['id'])->url;
                            $data[$key_category_lv1]['thumbnail'] =  categoryDB::find($r_category_lv1['id'])->thumbnail;

                            if (is_array($r_category_lv1['child']) && !empty($r_category_lv1['child'])) {

                                foreach ($r_category_lv1['child'] as $key_category_lv2 => $r_category_lv2) {    //level 2
                                    $data[$key_category_lv1]['child'][$key_category_lv2] =  categoryDB::find($r_category_lv2['id'])->translates()->where('lang_id', 'like', $default_lang_id)->get()->first()->toArray();
                                    $data[$key_category_lv1]['child'][$key_category_lv2]['thumbnail'] = categoryDB::find($r_category_lv2['id'])->thumbnail;
                                    $data[$key_category_lv1]['child'][$key_category_lv2]['url'] = categoryDB::find($r_category_lv2['id'])->url;
                                    if (is_array($r_category_lv2['child']) && !empty($r_category_lv2['child'])) {
                                        foreach ($r_category_lv2['child'] as $key_category_lv3 => $r_category_lv3) { //level 3
                                            $data[$key_category_lv1]['child'][$key_category_lv2]['child'][$key_category_lv3] =  categoryDB::find($r_category_lv3['id'])->translates()->where('lang_id', 'like', $default_lang_id)->get()->first()->toArray();
                                            $data[$key_category_lv1]['child'][$key_category_lv2]['child'][$key_category_lv3]['thumbnail'] = categoryDB::find($r_category_lv3['id'])->thumbnail;
                                            $data[$key_category_lv1]['child'][$key_category_lv2]['child'][$key_category_lv3]['url'] = categoryDB::find($r_category_lv3['id'])->url;
                                        }
                                    }
                                }
                            } else {
                                $data[$key_category_lv1]['child'] = array();
                            }
                        }
                    }
                    $items[str_replace('layout-', '', $r_layout->name)][$r_layout->group] = $data;
                } else {
                    $arrType = \json_decode($r_layout['value'], true);
                    foreach ($arrType as $r_type_key => $r_type_value) {
                        if (is_array($r_type_value) && !empty($r_type_value)) {
                            foreach ($r_type_value as $r_type_key_1 => $r_type_value_1) {
                                if (strpos($r_type_key_1, $default_lang_url) == true && strpos($r_type_key_1, 'link_' . $default_lang_url)) {
                                    $items[str_replace('layout-', '', $r_layout->name)][$r_layout->group]['link'] = $r_type_value_1;
                                }
                                if (strpos($r_type_key_1, $default_lang_url) == true && !strpos($r_type_key_1, 'link_' . $default_lang_url)) {
                                    if ($r_layout['type'] == 'image') {
                                        $items[str_replace('layout-', '', $r_layout->name)][$r_layout->group]['thumbnail'] = $r_type_value_1;
                                    } else {
                                        $items[str_replace('layout-', '', $r_layout->name)][$r_layout->group]['value'] = $r_type_value_1;
                                    }
                                }
                            }
                        } else {
                            $items[str_replace('layout-', '', $r_layout->name)][$r_layout->group]['value'] = $r_type_value[key($r_type_value)];
                        }
                    }
                }
            }
            $view->with('layout', $items);
            $view->with('default_lang_id', $default_lang_id);
            // }
        });
    }
}
