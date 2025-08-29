<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/master/LICENSE.txt
*/
declare(strict_types=1);

$main->h1('Icon');

$main->icon('example-icon');
$main->el('span')->te('Example Text');

$main->button(icon: 'example-icon');

$main->button('Button Text', icon: 'example-icon');
$main->button('Button Text', icon: 'example-icon')->at(['style'=>'color:var(--mint-green-dark);']);

$main->icon('example-icon');
$main->icon('example-icon')->at(['style'=>'color:var(--mint-grey-dark);']);
$main->icon('example-icon')->at(['style'=>'color:var(--mint-green-dark);']);
$main->icon('example-icon')->at(['style'=>'color:var(--mint-green);']);

$example_icon = base64_encode(<<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120">
<polygon points="103.192,120 16.526,120 16.526,0 55.96,0 55.96,46.301 103.192,46.301" fill="currentColor"/>
<polygon points="64.476,0 64.476,38.717 103.192,38.717" fill="currentColor"/>
</svg>
SVG);

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

	mint-icon {
		display: inline-block;
		height: 1.2em;
		width: 1.2em;
		background-color: currentColor;
	}

	mint-icon[data-icon="example-icon"] {
		mask-image: url(data:image/svg+xml;base64,$example_icon);
	}
CSS);