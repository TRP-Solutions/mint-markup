<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{Wrapper, Component};

class Select extends Wrapper {
	public function __construct(
		Component $parent,
		?string $name = null,
		?string $value = null,
		bool $disabled = false,
		bool $readonly = false,
		bool $required = false,
		string ...$attributes
	){
		$this->primary_element = MintMarkup::element(
			$parent,
			'select',
			at: $attributes,
			opt: ['name'=>$name,'value'=>$value],
			bool: ['disabled'=>$disabled,'readonly'=>$readonly,'required'=>$required],
		);
	}

	public function option(?string $value = null, ?string $text = null, bool $disabled = false){
		return MintMarkup::element(
			$parent,
			'option',
			opt: ['value'=>$value],
			bool: ['disabled'=>$disabled],
			text: $text ?? $value
		);
	}
}