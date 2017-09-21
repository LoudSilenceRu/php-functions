<?php

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

function plural_form($args) {
	if (!isset($args['number']) || !isset($args['words']))
		return;

  $cases = array (2, 0, 1, 1, 1, 2); // 1 2 5
  echo $args['number'].' '.$args['words'][ ($args['number']%100>4 && $args['number']%100<20) ? 2 : $cases[min($args['number']%10, 5)] ];
}

function timePassed($timestamp) {

	$diff = time()-$timestamp;

	//echo date('d.m.Y H:i:s', $timestamp).'<br>';
	//echo date('d.m.Y H:i:s', time()).'<br>';

	return ($diff < 60) ? array('number' => ($diff%60), 'words' => array('секунда','секунды','секунд')) : //секунды
		($diff >= 60 && $diff < 3600) ? array('number' => intval($diff%3600/60), 'words' => array('минута','минуты','минут')) : //минуты
			($diff >= 3600 && $diff < 86400) ? array('number' => intval($diff/3600), 'words' => array('час','часа','часов')) : //часы
				($diff >= 86400 && $diff < 31536000) ? array('number' => intval($diff/86400), 'words' => array('день','дня','дней')) : //дни
					array('number' => intval($diff/31536000), 'words' => array('год','года','лет')); // годы
}
