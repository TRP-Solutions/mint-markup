<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/master/LICENSE.txt
*/
declare(strict_types=1);

$main->h1('Tables');

$table = $main->table('Mint Plants')->at(['id'=>'mint-plants']);
$table->header('Family','Genus','Species','Common Name','Favorite','Pizza');

$row = $table->data('Lamiaceae','Mentha','M. spicata','Spearmint, common mint');
$row[0]->at(['rowspan'=>9]);
$row[1]->at(['rowspan'=>3]);
$row->td()->input('favorite','spearmint','radio');
$row->td()->input(type:'checkbox');

$row = $table->data('M. aquatica','Watermint');
$row->td()->input('favorite','watermint','radio');
$row->td()->input(type:'checkbox');

$row = $table->data('M. × piperita','Peppermint');
$row->td()->input('favorite','peppermint','radio', checked: true);
$row->td()->input(type:'checkbox');

$row = $table->data('Ocimum','O. basilicum','Basil');
$row->td()->input('favorite','basil','radio');
$row->td()->input(type:'checkbox',checked:true);

$row = $table->data('Origanum','O. vulgare','Oregano');
$row[0]->at(['rowspan'=>2]);
$row->td()->input('favorite','oregano','radio');
$row->td()->input(type:'checkbox',checked:true);

$row = $table->data('O. majorana','Marjoram, sweet marjoram');
$row->td()->input('favorite','marjoram','radio');
$row->td()->input(type:'checkbox');

$row = $table->data('Salvia','S. officinalis','Sage');
$row[0]->at(['rowspan'=>2]);
$row->td()->input('favorite','sage','radio');
$row->td()->input(type:'checkbox');

$row = $table->data('S. rosmarinus','Rosemary');
$row->td()->input('favorite','rosemary','radio');
$row->td()->input(type:'checkbox');

$row = $table->data('Thymus','T. vulgaris','Thyme');
$row->td()->input('favorite','thyme','radio');
$row->td()->input(type:'checkbox',checked:true);

$row = $table->footer('Read more about the mint family of plants on ');
$row[0]->at(['colspan'=>6]);
$row[0]->a('https://en.wikipedia.org/wiki/Lamiaceae', 'wikipedia', '_blank');

$doc->style(<<<CSS
	table#mint-plants {
		border-spacing: 0rem;
	}

	table#mint-plants tr:nth-child(2n){
		background: var(--mint-green-light);
	}

	table#mint-plants tr:not(:first-child) td {
		border-top: 1px solid var(--mint-green-dark);
	}

	table#mint-plants td,
	table#mint-plants th {
		padding: .25rem .5rem;
	}

	table#mint-plants tfoot td {
		font-style: italic;
		text-align: end;
		padding-top: .75rem;
	}
CSS);
