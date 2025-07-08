<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{Wrapper, Component};

class ElementGroup extends Wrapper {
	protected readonly array $elements;

	public function __construct(Component $primary_element, Component ...$elements){
		$this->primary_element = $primary_element;
		$this->elements = $elements;
	}

	public function get_elements(){
		return $this->elements;
	}

	public function __get($name){
		return $this->elements[$name] ?? null;
	}

	public function __isset($name){
		return isset($this->elements[$name]);
	}

	public function __set($name, $value){
		throw new \Exception('Not Allowed');
	}

	public function __unset($name){
		throw new \Exception('Not Allowed');
	}
}