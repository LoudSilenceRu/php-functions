<?php
define("HOST", "localhost");
define("DB", "my_db");
define("USER", "localhost");
define("PASS", "");

$connect = mysqli_connect(HOST, USER, PASS, DB) or die("Error " . mysqli_error($link));
 
?>