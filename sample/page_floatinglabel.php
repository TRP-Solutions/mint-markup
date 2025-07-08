<?php
/*
HealDocument is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/heal-document/blob/master/LICENSE.txt
*/
declare(strict_types=1);

$form = $main->form();
$form->floatinglabel('Input');
$form->floatinglabel('Number', type:'number');
$form->floatinglabel('Textarea', type:'textarea', rows:'3');

$form->floatinglabel('Input', disabled: true);
$form->floatinglabel('Number', type:'number', disabled: true);
$form->floatinglabel('Textarea', type:'textarea', rows:'3', disabled: true);

$doc->style(<<<CSS
	mint-floating {
		display: block;
		min-height: 3.5rem;
		position: relative;
		z-index: 0;
		margin-bottom: .5rem;
	}

	mint-floating > input,
	mint-floating > textarea {
		display: block;
		width: 100%;
		padding: 1rem .5rem;
		box-sizing: border-box;
		appearance: none;
		border: 1px solid #dee2e6;
		border-radius: .5rem;
	}

	mint-floating > input:disabled,
	mint-floating > textarea:disabled {
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
	mint-floating > textarea:not(:placeholder-shown) {
		padding-top: 1.625rem;
		padding-bottom: .375rem;
	}

	mint-floating > input:focus ~ label,
	mint-floating > input:not(:placeholder-shown) ~ label,
	mint-floating > textarea:focus ~ label,
	mint-floating > textarea:not(:placeholder-shown) ~ label  {
		transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
	}
CSS);
