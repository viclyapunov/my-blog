<?php

require '../vendor/autoload.php';

use App\Models\Article as Article;
use FastRoute\Route;






$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'get_root_handler');
    // {id} must be a number (\d+)
    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
    // The /{title} suffix is optional
    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
    echo "<em>404 not found!</em>";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        indexAction();
        break;
}

function indexAction() {
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
}
