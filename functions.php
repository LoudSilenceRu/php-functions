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

function dDays($number) {
	$str = '';
	$nStr = (string) $number;
	$nStr = $nStr[strlen($nStr)-1];
	switch ($nStr) {
		case 1:
			$str = 'день';
			break;
		case 2:
			$str = 'дня';
			break;
		case 3:
			$str = 'дня';
			break;
		case 4:
			$str = 'дня';
			break;
		default:
			$str = 'дней';
			break;
	}
	return $number.' '.$str;
}
