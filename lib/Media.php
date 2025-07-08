<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{Wrapper, Component};

class Media extends Wrapper {
	public function __construct(
		Component $parent,
		protected string $type,
		?string $src = null,
		bool $autoplay = false,
		bool $controls = false,
		bool $muted = false,
		bool $loop = false,
		?string $poster = null,
		string ...$attributes
	){
		$poster = $type == 'video' ? $poster : null;
		$this->primary_element = self::element(
			$parent,
			$type,
			$attributes,
			opt: ['src'=>$src,'poster'=>$poster],
			bool: ['autoplay'=>$autoplay,'controls'=>$controls,'muted'=>$muted,'loop'=>$loop],
		);
	}

	public function source(?string $type = null, ?string $src = null, ?string $media = null){
		if($this->type == 'picture'){
			$source = MintMarkup::element($this->primary_element, 'source', opt: ['type'=>$type,'media'=>$media]);
			return new ElementSrcset($source);
		} else {
			return MintMarkup::element($this->primary_element, 'source', opt: ['type'=>$type,'src'=>$src,'media'=>$media]);
		}
	}
}