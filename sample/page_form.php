<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/master/LICENSE.txt
*/
declare(strict_types=1);

$main->h1('Form input');

$form = $main->form();
build_input($form);
$main->el('br');
$form = $main->form();
build_input($form, disabled: true);

function build_input($form, $disabled = false){
	$form->labelled_input('Input', disabled: $disabled);
	$form->labelled_input('Number', type:'number', disabled: $disabled);
	$form->labelled_input('File', type:'file', disabled: $disabled);
	$select = $form->labelled_input('Select', type:'select', disabled: $disabled);
	$select->option('option1', 'Option 1');
	$select->option('option2', 'Option 2');
	$select->option('option3', 'Option 3');

	$radio = $form->labelled_input('Radio', type:'radio', disabled: $disabled);
	$radio->option('radio1', 'Radio 1');
	$radio->option('radio1', 'Radio 2');
	$radio->option('radio1', 'Radio 3');

	$checkbox = $form->labelled_input('Checkbox Group', type:'checkbox', name: 'checkbox1', text:'Checkbox A', disabled: $disabled);
	$checkbox->checkbox(name: 'checkbox2', text: 'Checkbox B', disabled: $disabled);

	$form->labelled_input('Textarea', type:'textarea', rows:'3', disabled: $disabled);

	$form->labelled_input('Date', type:'date', disabled: $disabled);

	$form->labelled_input('Password', type:'password', disabled: $disabled);
}

$doc->style(<<<CSS
	form {
		display: grid;
		grid-template-columns: max-content 1fr max-content 1fr;
		align-items: start;
		gap: 1rem;
	}

	mint-input {
		display: flex;
		flex-wrap: wrap;
	}

	form > mint-input {
		display: grid;
		grid-column: span 2;
		grid-template-columns: subgrid;
	}

	mint-radio, mint-checkbox {
		display: flex;
	}

	mint-radio > label,
	mint-checkbox > label {
		min-width: 7.5rem;
		flex-shrink: 1;
	}
CSS);