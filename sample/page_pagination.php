<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/master/LICENSE.txt
*/
declare(strict_types=1);

$page = (int) ($_GET['page'] ?? 1);
$prevpage = $page - 1;
$nextpage = $page + 1;

$javascript = "location='?pagination&page='+(this.dataset.mintPage=='next'?'$nextpage':(this.dataset.mintPage=='prev'?'$prevpage':this.dataset.mintPage))";
$main->pagination(1, $page, onclick: $javascript);
$main->pagination(3, $page, onclick: $javascript);
$main->pagination(7, $page, onclick: $javascript);
$main->pagination(8, $page, onclick: $javascript);
$main->pagination(20, $page, onclick: $javascript);

\TRP\MintMarkup\Pagination::$max_page_buttons = 10;
$main->pagination(20, $page, $javascript);

$doc->style(<<<CSS
	mint-pagination {
		display: flex;
		margin: 1rem auto;
	}

	mint-pagination button {
		width: 3rem;
		height: 2rem;
		border-width: 1px;
		border-style: solid;
		border-radius: 0rem;
	}

	mint-pagination button:first-child {
		border-radius: .5rem 0rem 0rem .5rem;
	}

	mint-pagination button:last-child {
		border-radius: 0rem .5rem .5rem 0rem;
	}

	mint-pagination button[data-mint-current-page]{
		background-color: var(--mint-green);
	}
CSS);
