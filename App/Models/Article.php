<?php

namespace App\Models;

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