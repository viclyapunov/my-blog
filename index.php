<?php

require 'functions.php';
require_once 'vendor/autoload.php';

/**
 * @purpose
 *	To hold article data
 */
class Article {
	public $time_created;
	public $time_edited;
	public $title;
	public $text;
	public $is_published = false;

	public function __construct($time_created, $time_edited, $title, $text) {
		$this->time_created = $time_created;
		$this->time_edited = $time_edited;
		$this->title = $title;
		$this->text = $text;
	}

	public function getTitle() {
		return $this->title;
	}

	public function __toString() {
		return $this->title;
	}
}

$articles =  [
	new Article(time(), time(), "this is the 1st article", "This is the long long text.", "the-first-article"),
	new Article(time(), time(), "The 2nd article follows", "The longer and longer text.", "the-2nd-article"),
	new Article(time(), time(), "Here is the third article", "The longest text ever...", "the-3rd-one"),
	new Article(time(), time(), "And it is followed by the 4th article", "The longest article ever..")
	];

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array());
//$twig->addExtension(new Twig_Extension_Debug());
$template = $twig->load('view.html');
echo $template->render(array('articles' => $articles));
