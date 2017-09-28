<?php

function d($value = "", $die = false, $vd = true) {

	echo '<p>Debug: </p><pre>';
	if ($vd)
		var_dump($value);
	else
		print_r($value);
	echo '</pre>';
	if($die) die;
}

function ajaxOutput($options = null) {
	die(json_encode($options, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)); //JSON_HEX_TAG
}

function HideEmail($email) {
	$email = strtolower($email);
	$explode = explode('@', $email);
	$pref = "";

	for ($i=0; $i < 3; $i++) { 
		$pref .= $explode[0][$i];
	}

	return $pref."***@".$explode[1];
}

function RandomString($length = 10) {
	return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
}

function plural_form($number = 0, $text = array('комментарий','комментария','комментариев')) {
  $cases = array (2, 0, 1, 1, 1, 2); // 1 2 5
  echo $number.' '.$text[ ($number%100>4 && $number%100<20) ? 2 : $cases[min($number%10, 5)] ];
}

function timePassed($timestamp) {

	$diff = time()-$timestamp;

	if ($diff < 60) 
		return plural_form($diff%60, array('секунда','секунды','секунд'));
	else if ($diff >= 60 && $diff < 3600) 
		return plural_form(floor($diff%3600/60), array('минута','минуты','минут'));
	else if ($diff >= 3600 && $diff < 86400) 
		return plural_form(floor($diff/3600), array('час','часа','часов'));
	else if ($diff >= 86400 && $diff < 31536000) 
		return plural_form(floor($diff/86400), array('день','дня','дней'));
	else 
		return plural_form(floor($diff/31536000), array('год','года','лет'));
}

function curl($url) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$response = curl_exec($ch);
	curl_close($ch);
	return json_decode($response, true);
}

function custom_cmp($a, $b) {
	return $a <=> $b;
}

$arr = array(1,3,6,2,7,0);

usort($arr, "custom_cmp");

d($arr);
