<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{Wrapper, Component};

class Radio extends Wrapper {
	protected array $attributes = [];
	public function __construct(
		Component $parent,
		protected ?string $name = null,
		protected bool $disabled = false,
		protected bool $readonly = false,
		protected bool $required = false,
		string ...$attributes
	){
		$this->attributes = $attributes;
		$this->primary_element = MintMarkup::element($parent, 'mint-input', bool: ['disabled'=>$disabled]);
		if(!isset($this->name)){
			$this->name = 'mint-radio-'.bin2hex(random_bytes(4));
		}
	}

	public function option(
		?string $value = null,
		?string $text = null,
		?string $id = null,
		bool $disabled = false,
		bool $readonly = false,
		bool $checked = false,
		string ...$attributes
	){
		$wrapper = MintMarkup::element($this->primary_element, 'mint-radio');
		if(!isset($id)){
			$id = 'mint-input-'.bin2hex(random_bytes(4));
		}
		$input = MintMarkup::element(
			$wrapper,
			'input',
			at: ['type'=>'radio','name'=>$this->name,'id'=>$id]+$attributes+$this->attributes,
			opt: ['value'=>$value],
			bool: [
				'disabled'=>$disabled || $this->disabled,
				'readonly'=>$readonly || $this->readonly,
				'required'=>$this->required,
				'checked'=>$checked,
			],
		);
		$label_element = MintMarkup::label($wrapper, $text, $id);
		return new ElementGroup($input, label: $label_element, wrapper: $wrapper);
	}
}