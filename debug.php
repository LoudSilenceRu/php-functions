<?php

function d($value = null, $die = false) {

	echo '<p>Debug: </p><pre>';
	var_dump($value);
	//print_r($value);
	echo '</pre>';

	if($die) die;
}