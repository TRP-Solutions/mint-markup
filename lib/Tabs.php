<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{Wrapper, Component};

class Tabs extends Wrapper {
	protected Component $tablist;
	protected array $tabs = [];

	public function __construct(Component $parent){
		$this->primary_element = $parent->el('mint-tabs');
		$this->tablist = $this->primary_element->el('mint-tablist',['role'=>'tablist']);
	}

	public function tab(?string $text = null, array|string|null $icon = null, ?string $key = null, bool $panel = true, bool $selected = false){
		$at = ['role'=>'tab','type'=>'button'];
		if($panel){
			if(!isset($key)){
				$key = count($this->tabs);
			}
			$panel_id = 'mint-tabpanel-'.$key;
			$at['aria-controls'] = $panel_id;
		}
		if(isset($key)){
			$at['id'] = 'mint-tab-'.$key;
		}
		if($selected){
			$at['aria-selected'] = 'true';
			$at['tabindex'] = '0';
		} else {
			$at['aria-selected'] = 'false';
			$at['tabindex'] = '-1';
		}
		$tab = MintMarkup::element($this->tablist,'button',$at);
		if(isset($icon)){
			if(is_array($icon)){
				MintMarkup::icon($tab, ...$icon);
			} else {
				MintMarkup::icon($tab, $icon);
			}
			if(isset($text)){
				$tab->el('span')->te($text);
			}
		} elseif(isset($text)) {
			$tab->te($text);
		}
		if($panel){
			$panel_element = MintMarkup::element($this->primary_element,'mint-tabpanel',['role'=>'tabpanel','id'=>$panel_id]);
			$component = new ElementGroup($tab, panel: $panel_element);
		} else {
			$component = $tab;
		}
		if(isset($key)){
			$this->tabs[$key] = $tab;
		}
		return $component;
	}
}
