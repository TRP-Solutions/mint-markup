<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/master/LICENSE.txt
*/
declare(strict_types=1);

\TRP\MintMarkup\Icon::register_spritesheet('spritesheet.svg');
\TRP\MintMarkup\Icon::register_spritesheet('spritesheet_other.svg','other');

$main->h1('Icon');

$main->icon('example-icon');
$main->el('span')->te('Example Text');

$main->button(icon: 'example-icon');

$main->button('Button Text', icon: 'example-icon');
$main->button('Button Text', icon: 'example-icon')->at(['style'=>'color:var(--mint-green-dark);']);
$main->button('Button Text', icon: 'folder');
$main->button('Button Text', icon: ['example-icon','other']);

$main->icon('folder');
$main->icon('example-icon', 'other');
$main->icon('example-icon');
$main->icon('example-icon')->at(['style'=>'color:var(--mint-grey-dark);']);
$main->icon('example-icon')->at(['style'=>'color:var(--mint-green-dark);']);
$main->icon('example-icon')->at(['style'=>'color:var(--mint-green);']);

$doc->style(<<<CSS
	main > * {
		vertical-align: middle;
	}

	button {
		display: inline-flex;
		align-items: center;
		gap: .25em;
		margin: 0em .5em;
		height: 2em;
	}

	svg[data-mint-icon] {
		display: inline-block;
		height: 1.2em;
		width: 1.2em;
	}
CSS);