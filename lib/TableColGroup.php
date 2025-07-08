<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{Wrapper, Component};

class TableColGroup extends Wrapper {
	protected bool $has_cols = false;

	public function __construct(Component $parent, protected ?int $span = null){
		$this->primary_element = $parent->el('colgroup');
		if(isset($this->span)){
			$this->primary_element->at(['span'=>$this->span]);
		}
	}

	public function span(int $span){
		if($this->has_cols){
			throw new \Exception('Invalid HTML: <colgroup> with <col> children must not have a span attribute.');
		}
		$this->span = $span;
		$this->primary_element->at(['span'=>$this->span]);
	}

	public function col(?int $span = null, string ...$attributes){
		if(isset($this->span)){
			throw new \Exception('Invalid HTML: <colgroup> with a span attribute must not have <col> children.');
		}
		$this->has_cols = true;
		return MintMarkup::element($this->primary_element, 'col', at: $attributes, opt: ['span': $span]);
	}

	// overwrites at method from Wrapper
	public function at(array $values, bool $append = false): Component {
		if(isset($values['span'])){
			$this->span(intval($values['span']));
			unset($values['span']);
		}
		return parent::at($values, $append);
	}
}