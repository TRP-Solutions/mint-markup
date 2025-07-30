<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/master/LICENSE.txt
*/
declare(strict_types=1);

$form = $main->form();
build_input($form);
build_input($form, disabled: true);

function build_input($form, $disabled = false){
	$form->floatinglabel('Input', disabled: $disabled);
	$form->floatinglabel('Number', type:'number', disabled: $disabled);
	$form->floatinglabel('File', type:'file', disabled: $disabled);
	$select = $form->floatinglabel('Select', type:'select', disabled: $disabled);
	$select->option('option1', 'Option 1');
	$select->option('option2', 'Option 2');
	$select->option('option3', 'Option 3');

	$radio = $form->floatinglabel('Radio', type:'radio', disabled: $disabled);
	$radio->option('radio1', 'Radio 1');
	$radio->option('radio1', 'Radio 2');
	$radio->option('radio1', 'Radio 3');

	$checkbox = $form->floatinglabel('Checkbox Group', type:'checkbox', name: 'checkbox1', text:'Checkbox A', disabled: $disabled);
	$checkbox->checkbox(name: 'checkbox2', text: 'Checkbox B', disabled: $disabled);

	$form->floatinglabel('Textarea', type:'textarea', rows:'3', disabled: $disabled);

	$form->floatinglabel('Date', type:'date', disabled: $disabled);
	
	$form->floatinglabel('Password', type:'password', disabled: $disabled);
}

$doc->style(<<<CSS
	mint-floating {
		display: block;
		min-height: 3.5rem;
		position: relative;
		z-index: 0;
		margin-bottom: .5rem;
	}

	mint-floating > input,
	mint-floating > textarea,
	mint-floating > select,
	mint-floating > mint-input {
		display: block;
		width: 100%;
		padding: 1rem .5rem;
		box-sizing: border-box;
		appearance: none;
		border: 1px solid #dee2e6;
		border-radius: .5rem;
	}

	mint-floating > select {
		background-color: unset;
	}

	mint-floating > input:disabled,
	mint-floating > textarea:disabled,
	mint-floating > select:disabled,
	mint-floating > mint-input[disabled] {
		background-color: #e9ecef;
	}

	mint-floating > input::placeholder,
	mint-floating > textarea::placeholder {
		opacity: 0;
	}

	mint-floating > label {
		position: absolute;
		top: 0;
		left: 0;
		z-index: 2;
		max-width: 100%;
		height: 100%;
		padding: 1rem .5rem;
		color: rgba(33, 37, 41, 0.65);
		overflow: hidden;
		text-align: start;
		text-overflow: ellipsis;
		white-space: nowrap;
		pointer-events: none;
		transform-origin: 0 0;
 		transition: opacity .1s ease-in-out,transform .1s ease-in-out;
	}

	mint-floating > input:focus,
	mint-floating > input:not(:placeholder-shown),
	mint-floating > textarea:focus,
	mint-floating > textarea:not(:placeholder-shown),
	mint-floating > select,
	mint-floating > mint-input {
		padding-top: 1.625rem;
		padding-bottom: .375rem;
	}

	mint-floating > input:focus ~ label,
	mint-floating > input:not(:placeholder-shown) ~ label,
	mint-floating > textarea:focus ~ label,
	mint-floating > textarea:not(:placeholder-shown) ~ label,
	mint-floating > select ~ label,
	mint-floating > mint-input ~ label {
		transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
	}
CSS);
