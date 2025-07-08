<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{Wrapper, Component};

class Table extends Wrapper {
	protected Component $thead;
	protected Component $tbody;
	protected Component $tfoot;

	public function __construct(Component $parent, ?string $caption = null){
		$this->primary_element = $parent->el('table');
		if(isset($caption)){
			$this->primary_element->el('caption')->te($caption);
		}
	}

	public function thead(){
		if(!isset($this->thead)){
			$this->thead = $this->primary_element('thead');
		}
		return $this->thead;
	}

	public function tbody(){
		if(!isset($this->tbody)){
			$this->tbody = $this->primary_element('tbody');
		}
		return $this->tbody;
	}

	public function tbody_add(){
		$this->tbody = $this->primary_element('tbody');
		return $this->tbody;
	}

	public function tfoot(){
		if(!isset($this->tfoot)){
			$this->tfoot = $this->primary_element('tfoot');
		}
		return $this->tfoot;
	}

	public function header(...$headers){
		return (new TableRow($this->thead()))->header(...$headers);
	}

	public function data(...$data){
		return (new TableRow($this->tbody()))->data(...$data);
	}

	public function footer(...$footers){
		return (new TableRow($this->tfoot()))->data(...$footers);
	}
}