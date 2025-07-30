<?php
/*
MintMarkup is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/mint-markup/blob/master/LICENSE.txt
*/
declare(strict_types=1);

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

$widget = $main->article()->at(['id'=>'widget']);
$widget->header()->h2('Widget');
$widget->p('An article can be used as a widget for a lot of different things.');


$doc->style(<<<CSS
	article {
		padding: 0rem 1rem;
		border: 1px dashed var(--mint-grey-dark);
	}

	blockquote {
		font-style: italic;
	}

	article#widget {
		margin: 2rem 0rem;
		padding: 0rem;
		width: 300px;
		border: 2px solid var(--mint-grey-dark);
		border-radius: .5rem;
	}

	article#widget * {
		margin: 0rem;
		padding: 0rem;
	}

	article#widget header {
		padding: .5rem;
		background-color: var(--mint-grey-dark);
		color: white;
	}

	article#widget > * {
		padding: .5rem;
	}
CSS);
