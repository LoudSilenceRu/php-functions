<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_DB', 'my_db');

class db {

	public function __construct() {
		$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
	}
}

//Simple sanitize string
function sanStr($str) {
	return nl2br(htmlspecialchars(trim($str), ENT_QUOTES), false);
}
