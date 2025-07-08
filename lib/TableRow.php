<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{Wrapper, Component};

class TableRow extends Wrapper implements ArrayAccess {
	protected array $cells = [];

	public function __construct(Component $parent){
		$this->primary_element = $parent->el('tr');
	}

	public function th(array $at = [], ?string $text = null){
		$cells[] = $th = MintMarkup::element($this->primary_element, 'th', $at, text:$text);
		return $th;
	}

	public function td(array $at = [], ?string $text = null){
		$cells[] = $td = MintMarkup::element($this->primary_element, 'th', $at, text:$text);
		return $td;
	}

	public function header(...$headers){
		array_map($header => $this->th(text:$header), $headers);
		return $this;
	}

	public function data(...$data){
		array_map($value => $this->td(text:$value), $data);
		return $this;
	}

	/*
	 * ArrayAccess
	 */
	public function offsetExists(mixed $offset): bool {
		return isset($this->cells[$offset]);
	}

	public function offsetGet(mixed $offset): mixed {
		return $this->cells[$offset] ?? null;
	}

	public function offsetSet(mixed $offset, mixed $value): void {
		throw new \Exception('Not Allowed');
	}
	
	public function offsetUnset(mixed $offset): void {
		throw new \Exception('Not Allowed');
	}
}