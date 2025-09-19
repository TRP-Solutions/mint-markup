<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/master/LICENSE.txt
*/
declare(strict_types=1);
require_once '../../heal-document/lib/HealDocument.php'; // https://github.com/TRP-Solutions/heal-document
require_once "../lib/MintMarkup.php";
require_once "../lib/Document.php";
require_once "../lib/ElementGroup.php";
require_once "../lib/ElementSrcset.php";
require_once "../lib/Icon.php";
require_once "../lib/Menu.php";
require_once "../lib/Checkbox.php";
require_once "../lib/Radio.php";
require_once "../lib/Select.php";
require_once "../lib/Table.php";
require_once "../lib/TableRow.php";
require_once "../lib/Pagination.php";
require_once "functions.php";

\TRP\HealDocument\HealDocument::register_plugin('\TRP\MintMarkup\MintMarkup');

$valid_pages = [
	'index'=>'Index',
	'article'=>'Article',
	'form'=>'Form',
	'floatinglabel'=>'Floating Labels',
	'modal'=>'Modal',
	'pagination'=>'Pagination',
	'table'=>'Table',
	'icon'=>'Icon',
];

try {
	$page = !empty($_GET) ? array_keys($_GET)[0] : 'index';
	if(!isset($valid_pages[$page])){
		throw new \Exception("'$page' Not Found", 404);
	}

	[$doc, $main, $aside] = page($page, $valid_pages);

	$filename = 'page_'.$page.'.php';
	if(!is_file($filename)){
		throw new \Exception("'$page' Not Found", 404);
	} else {
		$source = highlight_file($filename, true);
		$aside->details('Source')->fr($source);
		$aside->el('hr');
		require_once $filename;
	}
} catch (\Exception $e){
	if(!isset($main)){
		[$doc, $main] = page('Error', $valid_pages);
	}
	error($main, $e->getCode(), $e->getMessage());
}

echo $doc;
