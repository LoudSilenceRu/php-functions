<?php
define("HOST", "localhost");
define("DB", "my_db");
define("USER", "localhost");
define("PASS", "");

//DB Connection
$connect = mysqli_connect(HOST, USER, PASS, DB) or die("Error " . mysqli_error($connect));

//Simple sanitize string
function sanStr($str) {
	return nl2br(htmlspecialchars(trim($str), ENT_QUOTES), false);
}
