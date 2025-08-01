<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/master/LICENSE.txt
*/
declare(strict_types=1);

function page($page, $valid_pages){
	$title = $valid_pages[$page] ?? $page;
	$full_title = 'MintMarkup :: '.$title;
	$doc = new \TRP\MintMarkup\Document($full_title, lang: 'en');

	$doc->stylesheet('sample.css');

	$header = $doc->header();
	$header->el('h1')->te($full_title);
	$nav = $header->nav();
	$details = $nav->details();
	$current_title = null;
	foreach($valid_pages as $page_key => $page_title){
		$url = $page_key == 'index' ? '.' : '?'.$page_key;
		$link = $details->a($url, $page_title);
		if($page == $page_key){
			$current_title = $page_title;
			$link->at(['style'=>'background:var(--mint-green);']);
		}
	}
	$details->summary->te($current_title ?? 'Documentation');

	$aside = $doc->aside();
	$main = $doc->main();

	return [$doc, $main, $aside];
}

function error($context, int $error, ?string $error_message = null){
	if(400 <= $error && $error <= 599){
		http_response_code($error);
	}

	$error_message ??= match($error){
		404 => "Not Found",
		500 => "Internal Server Error",
		501 => "Not Implemented",
		default => "Unknown Error"
	};
	$context->aside()->p("Error $error: $error_message");
}
