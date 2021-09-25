<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\layout as layoutDB;
use App\Models\category as categoryDB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use function GuzzleHttp\json_decode;

class Layout extends Controller
{
	private $config_page = array();
	public function __construct(Controller $controller)
	{
		$this->config_page = array(
			'layout-header' => array(
				'menu-center' => array(
					'type' => 'position',
					'title' => 'Menu chính',
					'group' => 'menu-center',
					'layout' => array(),
				),
				'menu-center-1' => array(
					'type' => 'container',
					'title' => 'Menu chính',
					'layout' => array(
						array(
							'type' => 'input',
							'title' => 'Hotline',
							'group' => 'hotline',
							'link' => true
						),
						array(
							'type' => 'input',
							'title' => 'Email',
							'group' => 'email',
							'link' => true
						),
						array(
							'type' => 'input',
							'title' => 'Facebook',
							'group' => 'facebook',
							'link' => true
						),
						array(
							'type' => 'input',
							'title' => 'Instagram',
							'group' => 'instagram',
							'link' => true
						),
						array(
							'type' => 'input',
							'title' => 'Gmail',
							'group' => 'gmail',
							'link' => true
						),
						array(
							'type' => 'editor',
							'title' => 'Menu chính',
							'group' => 'address',
							'link' => true

						),
						array(
							'type' => 'image',
							'title' => 'hình đại diện',
							'group' => 'photo-1',
							'link' => true
						),
					)
				)
			),
			'layout-index' =>  array(
				'product-category' => array(
					'type' => 'position',
					'title' => 'Danh muc',
					'group' => 'product-category',
					'layout' => array(),
				),
			),
			'layout-footer' => array(
				'product-title-1' => array(
					'type' => 'container',
					'title' => 'Danh muc',
					'layout' => array(
						array(
							'type' => 'input',
							'title' => 'Footer tiêu đề 1',
							'group' => 'footer-title-1',
							'link' => false
						),
						array(
							'type' => 'input',
							'title' => 'Footer tiêu đề 2',
							'group' => 'footer-title-2',
							'link' => false
						),
						array(
							'type' => 'input',
							'title' => 'Footer tiêu đề 3',
							'group' => 'footer-title-3',
							'link' => false
						),
						array(
							'type' => 'editor',
							'title' => 'Nội dung footer 1',
							'group' => 'footer-content-1',
							'link' => false
						),
					),
				),	
				'footer-category-2' => array(
					'type' => 'position',
					'title' => 'Danh mục liên kết footer 2',
					'group' => 'footer-category-2',
					'layout' => array(),
				),
				'footer-category-3' => array(
					'type' => 'position',
					'title' => 'Danh mục liên kết footer 3',
					'group' => 'footer-category-3',
					'layout' => array(),
				),
			)
		);
		// $this->account_current = $controller->account_current; #1
		parent::__construct(); #2 all method and variable
	}
	public function list($type)
	{
		$items = array();
		$arrConfig = $this->getConfigLayout($type);
		foreach ($arrConfig as $key => $r_config) {
			$layout = layoutDB::where('name', 'like', 'layout-' . $type);
			foreach ($layout->get() as $r_layout) {
				if ($r_layout->type == 'position') {
					$data = array();
					$value = \json_decode($r_layout['value'], true);
					if(is_array($value) && !empty($value)){
					 
					foreach ($value as $key_category_lv1 => $r_category_lv1) { //level 1
						$data[$key_category_lv1] =  categoryDB::find($r_category_lv1['id'])->translates()->where('lang_id', 'like', $this->default_lang_id)->get()->first()->toArray();
						if (is_array($r_category_lv1['child']) && !empty($r_category_lv1['child'])) {
							foreach ($r_category_lv1['child'] as $key_category_lv2 => $r_category_lv2) {	//level 2
								$data[$key_category_lv1]['child'][$key_category_lv2] =  categoryDB::find($r_category_lv2['id'])->translates()->where('lang_id', 'like', $this->default_lang_id)->get()->first()->toArray();
								if (is_array($r_category_lv2['child']) && !empty($r_category_lv2['child'])) {
									foreach ($r_category_lv2['child'] as $key_category_lv3 => $r_category_lv3) { //level 3
										$data[$key_category_lv1]['child'][$key_category_lv2]['child'][$key_category_lv3] =  categoryDB::find($r_category_lv3['id'])->translates()->where('lang_id', 'like', $this->default_lang_id)->get()->first()->toArray();
									}
								}
							}
						}
					}
				}
					$items[$r_layout->group] = $data;
				}else{
					$arrType = \json_decode($r_layout['value'],true);

					foreach($arrType as $r_type_key => $r_type_value){
                       if(is_array($r_type_value) && !empty($r_type_value)){
						foreach ($r_type_value as $r_type_key_1 => $r_type_value_1) {
							$items[$r_layout->group][$r_type_key_1]=$r_type_value_1;
						}
					   }else{
						$items[$r_layout->group][key($r_type_value)]=$r_type_value[key($r_type_value)];
					   }
					}
				}
			}
			return view('admin.layout.layout-list', ['config_page' => $this->config_page['layout-' . $type], "lang" => $this->config_lang, 'default_lang_id' => $this->default_lang_id, 'layout' => 'layout-' . $type, 'items' => $items]);
		}
		return redirect()->route('admin-home');
	}
	private function getConfigLayout($type = 'header')
	{
		$array_layout = array();
		foreach ($this->config_page as $key => $r_config) {
			if ($key == 'layout-' . $type) {
				foreach ($r_config as $key_group => $group) {
					if ($group['type'] == 'position' &&  (!is_array($group['layout']) || empty($group['layout']))) {
						$array_layout[] = $group;
					}
					if ($group['type'] == 'container') {
						foreach ($group['layout'] as $r_layout) {
							$array_layout[] = $r_layout;
						}
					}
				}
			}
		}
		return $array_layout;
	}
	public function update(Request $request)
	{
		if ($request->has('type')) {
			$arrConfig = $this->getConfigLayout($request->type);
			layoutDB::where('name', 'like', 'layout-' . $request->type)->delete();
			foreach ($arrConfig as $key_group => $group) {
				if ($group['type'] == 'position' && $request->has($group['group'])) {
					$group_name = $group['group'];
					layoutDB::create(array('name' => 'layout-' . $request->type, 'type' => $group['type'], 'group' => $group_name, 'value' => $request->$group_name));
				} else {
					$dataTranslate = array();
					foreach ($this->config_lang as $key_lang => $r_lang) { // loop lang current page
						$group_name = $group['group'] . '_' . $r_lang['url'];
						$dataTranslate[$key_lang][$group_name] = $request->$group_name;
						$group_name = $group['group'] . '_link_' . $r_lang['url'];
						$dataTranslate[$key_lang][$group_name] = $request->$group_name;
					}
					layoutDB::create(array('name' => 'layout-' . $request->type, 'type' => $group['type'], 'group' => $group['group'], 'value' => json_encode($dataTranslate)));
				}
			}
			return back();
		} else {
			return redirect()->route('admin-home');
		}
	}
}
