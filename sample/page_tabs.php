<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/master/LICENSE.txt
*/
declare(strict_types=1);

$main->h1('Tabs');

$tabs = $main->tabs();
$tab1 = $tabs->tab('Tab 1', selected: true);
$tab1->at(['onclick'=>'select_tab(this);']);
$tab1->panel->h2('Tab 1');
$tab1->panel->p('Tab 1 contents. Lorem ipsum sit dolor amet.');

$tab2 = $tabs->tab('Tab 2');
$tab2->at(['onclick'=>'select_tab(this);']);
$tab2->panel->at(['style'=>'display:none;']);
$tab2->panel->h2('Tab 2');
$tab2->panel->p('Tab 2 contents. Consectetur adipiscing elit.');

$tab3 = $tabs->tab('Tab 3');
$tab3->at(['onclick'=>'select_tab(this);']);
$tab3->panel->at(['style'=>'display:none;']);
$tab3->panel->h2('Tab 3');
$tab3->panel->p('Tab 3 contents. Sed do eiusmod tempor incididunt.');

$doc->script()->te(<<<JS
	function select_tab(tab){
		const tablist = tab.closest('[role=tablist]');
		const selected_tab = tablist.querySelector('button[role=tab][aria-selected=true]');
		console.log(selected_tab, tab);
		if(selected_tab != tab){
			selected_tab.setAttribute('aria-selected','false');
			tab.setAttribute('aria-selected','true');
			const selected_tabpanel = tablist.parentElement.querySelector('#'+selected_tab.getAttribute('aria-controls'));
			const tabpanel = tablist.parentElement.querySelector('#'+tab.getAttribute('aria-controls'));
			selected_tabpanel.style.display = 'none';
			tabpanel.style.display = '';
		}
	}
JS);

$doc->style(<<<CSS
	mint-tabs {
		display: block;
		clear: both;
	}
	mint-tablist {
		display: flex;
	}
	mint-tablist > button,
	mint-tabpanel {
		border-width: 1px;
		border-style: solid;
		border-color: var(--mint-grey-dark);
	}
	mint-tablist > button {
		flex-grow: 1;
		font-size: 1.2rem;
		border-radius: 5px 5px 0px 0px;
	}
	mint-tablist > button[aria-selected=true] {
		background-color: white;
		border-bottom-color: white;
	}
	mint-tabpanel {
		display: block;
		padding: .5rem;
		margin-top: -1px;
	}
CSS);
