<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{Wrapper, Component};

class Pagination extends Wrapper implements \ArrayAccess {
	public static string $previous_label = '«';
	public static string $next_label = '»';
	public static string $skip_label = '…';
	public static int $max_page_buttons = 7;

	protected $children = [];
	public readonly Component $prev;
	public readonly Component $next;
	public readonly ?Component $skip_start;
	public readonly ?Component $skip_end;

	public function __construct(
		Component $parent,
		protected int $pages,
		protected int $page = 1,
		protected ?string $onclick = null,
	){
		$this->page = max(1, min($pages, $page));

		$this->primary_element = $parent->el('mint-pagination');
		$this->prev = $this->button(static::$previous_label, $onclick, 'prev', disabled: $this->page == 1);
		$this->page_button(1);

		if($pages > 1){
			$use_skips = $this->pages > static::$max_page_buttons;
			$middle = ceil(static::$max_page_buttons / 2);
			$start_skip = $use_skips && $this->page > ceil(static::$max_page_buttons / 2);
			$end_skip = $use_skips && $this->page < $this->pages - floor(static::$max_page_buttons / 2);

			$buttons_middle = static::$max_page_buttons - 4;

			$end_to = $pages - 1;
			$end_from = max(3, $end_to - $buttons_middle);

			$middle_from = max(3, $this->page - floor(($buttons_middle-1)/2));
			$middle_to = $middle_from + $buttons_middle - $end_skip;
			
			$from = (int) min($middle_from, $end_from) - !$start_skip;
			$to = min($middle_to, $end_to);

			$this->skip_start = $this->skip($start_skip);
			for($i = $from; $i <= $to; $i++){
				$this->page_button($i);
			}
			$this->skip_end = $this->skip($end_skip);
			$this->page_button($pages);
		} else {
			$this->skip_start = null;
			$this->skip_end = null;
		}

		$this->next = $this->button(static::$next_label, $onclick, 'next', disabled: $this->page == $pages);
	}

	private function page_button(int $page){
		$label = (string)$page;
		$this->children[$page] = $this->button($label, $this->onclick, $label, current: $page == $this->page);
	}

	protected function skip(bool $show): ?Component {
		$skip = $this->button(static::$skip_label, disabled: true);
		if(!$show){
			$skip->at(['style'=>'display:none;']);
		}
		return $skip;
	}

	protected function button(
		string $label,
		?string $onclick = null,
		?string $page = null,
		bool $disabled = false,
		bool $current = false,
	): Component {
		return MintMarkup::element(
			$this->primary_element,
			'button',
			at: ['type'=>'button'],
			opt: ['onclick'=>$onclick,'data-mint-page'=>$page],
			bool: ['disabled'=>$disabled, 'data-mint-current-page'=>$current],
			text: $label
		);
	}

	/*
	 * ArrayAccess
	 */
	public function offsetExists(mixed $offset): bool {
		return isset($this->children[$offset]);
	}

	public function offsetGet(mixed $offset): mixed {
		return $this->children[$offset] ?? null;
	}

	public function offsetSet(mixed $offset, mixed $value): void {
		throw new \Exception('Not Allowed');
	}
	
	public function offsetUnset(mixed $offset): void {
		throw new \Exception('Not Allowed');
	}
}