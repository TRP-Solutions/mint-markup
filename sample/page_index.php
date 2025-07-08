<?php
/*
HealDocument is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/heal-document/blob/master/LICENSE.txt
*/
declare(strict_types=1);

$section = $main->section();
$hgroup = $section->hgroup();
$hgroup->el('h2')->te('Section Heading');
$hgroup->p('Extra text in section heading.');
$section->p('Lorem ipsum sit dolor amet.');
$section->details('Section Details', true)->p('Section details contents. Lorem ipsum sit dolor amet.');