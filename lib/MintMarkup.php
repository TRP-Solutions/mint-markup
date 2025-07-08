<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{HealDocument, Plugin, Component};

class MintMarkup extends Plugin {
	/*
	 * Document structure elements
	 */
	public static function main(Component $parent){
		return $parent->el('main');
	}

	public static function header(Component $parent){
		return $parent->el('header');
	}

	public static function footer(Component $parent){
		return $parent->el('footer');
	}

	public static function nav(Component $parent){
		return $parent->el('nav');
	}

	public static function section(Component $parent){
		return $parent->el('section');
	}

	public static function hgroup(Component $parent){
		return $parent->el('hgroup');
	}

	public static function article(Component $parent){
		return $parent->el('article');
	}

	public static function aside(Component $parent){
		return $parent->el('aside');
	}

	public static function h1(Component $parent, ?string $text = null){
		return self::element($parent, 'h1', text: $text);
	}

	public static function h2(Component $parent, ?string $text = null){
		return self::element($parent, 'h1', text: $text);
	}

	public static function h3(Component $parent, ?string $text = null){
		return self::element($parent, 'h1', text: $text);
	}

	public static function h4(Component $parent, ?string $text = null){
		return self::element($parent, 'h1', text: $text);
	}

	public static function h5(Component $parent, ?string $text = null){
		return self::element($parent, 'h1', text: $text);
	}

	public static function h6(Component $parent, ?string $text = null){
		return self::element($parent, 'h1', text: $text);
	}

	public static function p(Component $parent, ?string $text = null){
		return self::element($parent, 'p', text: $text);
	}

	public static function a(Component $parent, string $href, ?string $text = null){
		return self::element($parent, 'a', ['href'=>$href],text: $text);
	}

	/*
	 * Table element
	 */
	public static function table(Component $parent, ?string $caption = null){
		return new Table($parent, $caption);
	}

	/*
	 * Form related elements
	 */
	public static function form(Component $parent, ?string $action = null, ?string $method = null, string ...$attributes){
		return self::element($parent, 'form', $attributes, ['action'=>$action, 'method'=>$method]);
	}

	public static function input(
		Component $parent,
		?string $name = null,
		?string $value = null,
		string $type = 'text',
		bool $disabled = false,
		bool $readonly = false,
		bool $required = false,
		bool $checked = false,
		string ...$attributes
	) {
		return self::element(
			$parent,
			'input',
			at: ['type'=>$type]+$attributes,
			opt: ['name'=>$name,'value'=>$value],
			bool: ['disabled'=>$disabled,'readonly'=>$readonly,'required'=>$required,'checked'=>$checked],
		);
	}

	public static function textarea(
		Component $parent,
		?string $name = null,
		?string $value = null,
		bool $disabled = false,
		bool $readonly = false,
		bool $required = false,
		string ...$attributes
	) {
		return self::element(
			$parent,
			'textarea',
			at: $attributes,
			opt: ['name'=>$name,'value'=>$value],
			bool: ['disabled'=>$disabled,'readonly'=>$readonly,'required'=>$required],
		);
	}

	public static function select(
		Component $parent,
		?string $name = null,
		?string $value = null,
		bool $disabled = false,
		bool $readonly = false,
		bool $required = false,
		string ...$attributes
	) {
		return new Select(
			$parent,
			...$attributes,
			name: $name,
			value: $value,
			disabled: $disabled,
			readonly: $readonly,
			required: $required,
		);
	}

	public static function label(Component $parent, ?string $text = null, ?string $for = null){
		return self::element($parent, 'label', opt: ['for'=>$for], text: $text);
	}

	public static function floatinglabel(
		Component $parent,
		string $label,
		?string $id = null,
		string $type = 'text',
		...$arguments
	){
		$wrapper = $parent->el('mint-floating');
		if(!isset($id)){
			$id = 'mint-floating-'.bin2hex(random_bytes(4));
		}
		if($type == 'select'){
			$input = static::select($wrapper, ...$arguments, id: $id);
		} elseif($type == 'textarea'){
			$input = static::textarea($wrapper, ...$arguments, id: $id, placeholder: $label);
		} else {
			$input = static::input($wrapper, ...$arguments, id: $id, placeholder: $label, type: $type);
		}
		$label_element = static::label($wrapper, $label, $id);
		return new ElementGroup($input, label: $label_element, wrapper: $wrapper);
	}

	/*
	 * Media elements
	 */
	public static function img(Component $parent, ?string $src = null, ?string $alt = null){
		return new ElementSrcset(self::element($parent, 'img', opt: ['src'=>$src,'alt'=>$alt]));
	}

	public static function picture(Component $parent){
		return new Media($parent,'picture');
	}

	public static function video(
		Component $parent,
		?string $src = null,
		bool $autoplay = false,
		bool $controls = true,
		?bool $muted = null,
		bool $loop = false,
		?string $poster = null,
		string ...$attributes
	){
		return new Media(
			$parent,
			'video',
			...$attributes,
			src: $src,
			autoplay: $autoplay,
			controls: $controls,
			muted: $muted ?? $autoplay,
			loop: $loop,
			poster: $poster
		);
	}

	public static function audio(
		Component $parent,
		?string $src = null,
		bool $controls = true,
		bool $muted = false,
		bool $loop = false,
		string ...$attributes
	){
		return new Media(
			$parent,
			'audio',
			...$attributes,
			src: $src,
			controls: $controls,
			muted: $muted,
			loop: $loop
		);
	}

	public static function figure(Component $parent, ?string $text = null, ?string $src = null, ?string $alt = null){
		$figure = $parent->el('figure');
		$figcaption = self::element($figure, 'figcaption', text: $text);
		if(isset($src)){
			$img = self::element($figure, 'img', ['src'=>$src], ['alt'=>$alt]);
			return new ElementGroup($figure, figcaption: $figcaption, img: $img);
		} else {
			return new ElementGroup($figure, figcaption: $figcaption);
		}
	}

	/*
	 * Interactive elements
	 */
	public static function menu(Component $parent){
		return new Menu($parent);
	}

	public static function dialog(Component $parent, bool $open = false, ?string $id = null){
		return self::element($parent, 'dialog', opt: ['id'=>$id], bool: ['open'=>$open],);
	}

	public static function dialog_close_button(Component $parent, ?string $label = null){
		$form = $parent->el('form',['method'=>'dialog']);
		return self::element($form, 'button', text: $label);
	}

	public static function details(
		Component $parent,
		?string $summary = null,
		bool $open = false,
		?string $name = null,
		array $summary_at = [],
		?string ...$attributes
	){
		$details_element = self::element($parent, 'details', $attributes, opt: ['name'=>$name], bool: ['open'=>$open]);
		$summary_element = self::element($details_element, 'summary', $summary_at, text: $summary);
		return new ElementGroup($details_element, summary: $summary_element);
	}

	public static function button(Component $parent, ?string $onclick = null, string $type = 'button', bool $disabled = false){
		return self::element($parent, 'button', ['type'=>$type], ['onclick'=>$onclick], ['disabled'=>$disabled]);
	}

	/*
	 * Generic element
	 */
	public static function element($parent, string $elementname, array $at = [], array $opt = [], array $bool = [], ?string $text = null){
		$element = $parent->el($elementname, $at + array_filter($opt) + array_keys($bool, true));
		if(isset($text)){
			$element->te($text);
		}
		return $element;
	}
}