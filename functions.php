<?php

function dd($t) {
	echo '<pre>';
	var_dump($t);
	echo '</pre>';
	die();
}