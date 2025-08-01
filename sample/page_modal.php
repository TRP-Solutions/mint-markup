<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/master/LICENSE.txt
*/
declare(strict_types=1);

$main->h1('Modal');

$main->button('Show Modal Dialog','document.querySelector("#modal-dialog").showModal();');

$dialog = $doc->dialog(id: "modal-dialog");
$dialog->dialog_close_button("\u{2715}");
$menu = $dialog->menu();
$menu->menubutton('Tab 1', ['onclick'=>"this.closest('dialog').querySelector('#tab1').open = true;"]);
$menu->menubutton('Tab 2', ['onclick'=>"this.closest('dialog').querySelector('#tab2').open = true;"]);
$menu->menubutton('Tab 3', ['onclick'=>"this.closest('dialog').querySelector('#tab3').open = true;"]);
$dialog->details(name: 'dialog-tab', id: 'tab1', open: true)->p('Tab 1 contents. Lorem ipsum sit dolor amet.');
$dialog->details(name: 'dialog-tab', id: 'tab2')->p('Tab 2 contents. Consectetur adipiscing elit.');
$dialog->details(name: 'dialog-tab', id: 'tab3')->p('Tab 3 contents. Sed do eiusmod tempor incididunt.');

$doc->style(<<<CSS
	dialog menu {
		display: flex;
		list-style: none;
		margin: 0px;
		padding: 0px;
		gap: .5rem;
	}
	dialog form[method=dialog] {
		float: right;
		margin-left: 1rem;
	}
	dialog menu li {
		flex-grow: 1;
	}
	dialog menu li button {
		width: 100%;
	}
	details summary:empty {
		display: none;
	}
CSS);
