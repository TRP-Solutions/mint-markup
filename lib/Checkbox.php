<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{Wrapper, Component};

class Checkbox extends Wrapper {
	protected Component $wrapper;
	public function __construct(
		Component $parent,
		?string $name = null,
		?string $text = null,
		?string $id = null,
		?string $value = null,
		bool $disabled = false,
		bool $readonly = false,
		bool $required = false,
		bool $checked = false,
		string ...$attributes,
	){
		$this->attributes = $attributes;
		$this->wrapper = MintMarkup::element($parent, 'mint-input', bool: ['disabled'=>$disabled]);
		$this->primary_element = $this->checkbox(
			...$attributes,
			name: $name,
			text: $text,
			id: $id,
			value: $value,
			disabled: $disabled,
			readonly: $readonly,
			required: $required,
			checked: $checked,
		);
	}

	public function checkbox(
		?string $name = null,
		?string $text = null,
		?string $id = null,
		?string $value = null,
		bool $disabled = false,
		bool $readonly = false,
		bool $required = false,
		bool $checked = false,
		string ...$attributes,
	){
		$wrapper = MintMarkup::element($this->wrapper, 'mint-checkbox');
		if(!isset($id)){
			$id = 'mint-input-'.bin2hex(random_bytes(4));
		}
		$input = MintMarkup::element(
			$wrapper,
			'input',
			at: ['type'=>'checkbox','id'=>$id]+$attributes,
			opt: ['value'=>$value,'name'=>$name],
			bool: [
				'disabled'=>$disabled,
				'readonly'=>$readonly,
				'required'=>$required,
				'checked'=>$checked,
			],
		);
		$label_element = MintMarkup::label($wrapper, $text, $id);
		return new ElementGroup($input, label: $label_element, wrapper: $wrapper);
	}
}