<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/master/LICENSE.txt
*/
declare(strict_types=1);

$main->h1('Article');

$article = $main->article();
$quote = $article->blockquote('https://html.spec.whatwg.org/multipage/sections.html#the-article-element');

$quote->p(<<<TEXT
The article element represents a complete, or self-contained, composition in a document, page, application, or site and that is, in principle, independently distributable or reusable, e.g. in syndication.
This could be a forum post, a magazine or newspaper article, a blog entry, a user-submitted comment, an interactive widget or gadget, or any other independent item of content.
TEXT);
$quote->p(<<<TEXT
When article elements are nested, the inner article elements represent articles that are in principle related to the contents of the outer article.
For instance, a blog entry on a site that accepts user-submitted comments could represent the comments as article elements nested within the article element for the blog entry.
TEXT);
$article->p('— ')->cite('HTML Standard','https://html.spec.whatwg.org/multipage/sections.html#the-article-element','_blank');

$section = $main->section()->at(['id'=>'example']);
$section->h2('Examples');

$widget = $section->article()->at(['id'=>'widget']);
$widget->header()->h3('Widget');
$widget->p('An article can be used as a widget for a lot of different things.');

$grid = $section->article()->at(['id'=>'grid']);
$grid->header()->h3('Grid');
$grid->img('der_naturen_bloeme_olifant.jpg');
$grid->p('Lorem');
$grid->p('Ipsum');
$grid->p('Sit');
$grid->p('Dolor');
$grid->input(placeholder: 'olifant');
$grid->button('Button A');
$grid->button('Button B');
$grid->button('Button C');
$grid->button('Button D');
$grid->footer()->cite("14th century 'olifant' on Public Domain Image Archive",'https://pdimagearchive.org/images/30d968a8-e874-4912-8db8-1b9baeb8f4cf/','_blank');

$doc->style(<<<CSS
	main > article {
		padding: 0rem 1rem;
		border: 1px dashed var(--mint-grey-dark);
	}

	blockquote {
		font-style: italic;
	}

	section#example {
		display: flex;
		flex-wrap: wrap;
		align-items: start;
		gap: 1rem;
	}

	section h2 {
		width: 100%;
		margin-bottom: 0rem;
	}

	section article {
		padding: .5rem;
		width: 350px;
		border: 2px solid var(--mint-grey-dark);
		border-radius: .5rem;
		overflow: hidden;
	}

	section article * {
		margin: 0rem;
	}

	article header {
		margin: -.5rem -.5rem .5rem -.5rem;
		padding: .5rem;
		background-color: var(--mint-grey-dark);
		color: white;
	}

	article#grid {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		grid-template-rows: max-content repeat(3, 1fr) max-content;
		gap: .5rem;
	}

	article#grid header {
		grid-column: span 4;
		margin-bottom: 0;
	}

	article#grid img {
		grid-column: span 2;
		grid-row: span 3;
		max-width: 100%;
		max-height: 100%;
	}

	article#grid input {
		grid-column: span 2;
	}

	article#grid footer {
		margin: 0rem -.5rem -.5rem -.5rem;
		padding: .25rem .5rem;
		background-color: var(--mint-grey-light);
		grid-column:span 4;
		font-style:italic;
		font-size:0.8em;
		border-top: 1px solid var(--mint-grey-dark);
	}
CSS);
