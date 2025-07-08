<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{Wrapper, Component};

class Menu extends Wrapper {
	public function __construct(Component $parent){
		$this->primary_element = $parent->el('menu');
	}

	public function menubutton(
		?string $text = null,
		array $attr = [],
		array $li_attr = []
	){
		$button = $this->primary_element->el('li', $li_attr)->el('button', $attr+['type'=>'button']);
		if(isset($text)){
			$button->te($text);
		}
		return $button;
	}
}