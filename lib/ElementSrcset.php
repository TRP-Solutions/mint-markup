<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{Wrapper, Component};

class ElementSrcset extends Wrapper {
	protected array $srcset = [];
	public function __construct(
		protected Component $primary_element,
	){

	}

	public function srcset(string $src, ?string $param = null){
		if(isset($param)){
			$key = $param;
			$src = $src.' '.$param;
		} else {
			$key = 'plain';
		}
		$this->srcset[$key] = $src;
		$this->primary_element->at(['srcset'=>implode(',',$this->srcset)]);
		return $this;
	}
}