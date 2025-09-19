<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{Wrapper, Component};

class Icon extends Wrapper {
	protected static ?string $default_spritesheet = null;
	protected static array $spritesheet_lookup = [];

	public readonly Component $use;

	public function __construct(
		Component $parent,
		protected string $id,
		protected ?string $spritesheet = null,
		protected float $aspect_ratio = 1,
	){
		if(empty($spritesheet)){
			if(!isset(static::$default_spritesheet)){
				throw new \Exception('Missing default spritesheet when creating Mintmarkup::Icon');
			}
			$shorthand = '';
			$base_url = static::$default_spritesheet;
		} elseif(isset(static::$spritesheet_lookup[$spritesheet])) {
			$shorthand = $spritesheet;
			$base_url = static::$spritesheet_lookup[$spritesheet];
		} else {
			$shorthand = null;
			$base_url = $spritesheet;
		}
		$url = $base_url.'#'.$id;
		
		$this->primary_element = MintMarkup::element(
			$parent,
			'svg',
			[
				'xmlns'=>'http://www.w3.org/2000/svg',
				'xmlns:xlink'=>'http://www.w3.org/1999/xlink',
				'viewBox'=>$this->viewbox(),
				'data-mint-icon'=>$id,
				'data-mint-icon-url'=>$base_url,
			],
			[
				'data-mint-icon-spritesheet'=>$shorthand,
			],
		);

		$this->use = $this->primary_element->el('use',[
			'xlink:href'=>$url,
			'x'=>'0',
			'y'=>'0',
			'height'=>'120',
			'width'=>round(120*$aspect_ratio)
		]);
	}

	protected function viewbox(){
		return '0 0 '.round(120*$this->aspect_ratio).' 120';
	}

	public static function register_spritesheet(string $url, ?string $shorthand = null){
		if(empty($shorthand)){
			static::$default_spritesheet = $url;
		} else {
			static::$spritesheet_lookup[$shorthand] = $url;
		}
	}
}