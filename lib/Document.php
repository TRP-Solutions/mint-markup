<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/main/LICENSE.txt
*/
declare(strict_types=1);
namespace TRP\MintMarkup;

use \TRP\HealDocument\{HealDocument, Wrapper, Component};

class Document extends Wrapper {
	public readonly HealDocument $document;
	public readonly Component $head;

	public function __construct($title, $lang = null, $charset = 'utf-8'){
		$this->document = new HealDocument();
		$html = MintMarkup::element($this->document, 'html', opt: ['lang'=>$lang]);
		$this->head = $html->el('head');
		$this->head->el('title')->te($title);
		if(isset($charset)){
			$this->head->el('meta',['charset'=>$charset]);
		}
		$this->primary_element = $html->el('body');

	}

	public function meta(string $name, string $content): Component {
		return $this->head->el('meta',['name'=>$name,'content'=>$content]);
	}

	public function link(string $href, string $rel, string ...$attributes): Component {
		return $this->head->el('link',['href'=>$href,'rel'=>$rel,...$attributes]);
	}

	public function script(?string $src = null): Component {
		return $this->head->el('script', isset($src) ? ['src'=>$src] : []);
	}

	public function style(string $style): Component {
		return $this->head->el('style')->te($style);
	}

	public function stylesheet(string ...$stylesheets) {
		foreach($stylesheets as $href){
			$this->link($href, 'stylesheet');
		}
	}

	public function javascript(string ...$scripts){
		foreach($scripts as $src){
			$this->script($src);
		}
	}

	public function __toString(): string {
		return (string) $this->document;
	}
}