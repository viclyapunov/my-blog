<?php

require '../vendor/autoload.php';

use App\Models\Article as Article;

$articles =  [
	new Article(time(), time(), "this is the 1st article", "This is the long long text.", "the-first-article"),
	new Article(time(), time(), "The 2nd article follows", "The longer and longer text.", "the-2nd-article"),
	new Article(time(), time(), "Here is the third article", "The longest text ever...", "the-3rd-one"),
	new Article(time(), time(), "And it is followed by the 4th article", "The longest article ever..")
	];

$loader = new Twig_Loader_Filesystem('../App/templates');
$twig = new Twig_Environment($loader, array());
//$twig->addExtension(new Twig_Extension_Debug());
$template = $twig->load('index.view.twig');
echo $template->render(array('articles' => $articles));
