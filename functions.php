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

function Declension($number = 1, $type = 'd') {
	//$type = s || m || h || d
	$str = '';
	$nStr = (string) $number;
	$nStr = $nStr[strlen($nStr)-1];

	function sm($number, $string) {
		switch ($number) {
			case 1:
			$string = $string.'а';
			break;
			case 2:
			$string = $string.'ы';
			break;
			case 3:
			$string = $string.'ы';
			break;
			case 4:
			$string = $string.'ы';
			break;
			default:
			break;
		}
		return $string;
	}

	function h($number) {
		$string = 'час';
		switch ($number) {
			case 1:
			break;
			case 2:
			$string = $string.'а';
			break;
			case 3:
			$string = $string.'а';
			break;
			case 4:
			$string = $string.'а';
			break;
			default:
			$string = $string.'ов';
			break;
		}
		return $string;
	}

	function days($number) {
		switch ($number) {
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
	}

	switch ($type) {
		case 's':
		$str = sm($nStr, 'секунд');
		break;
		case 'm':
		$str = sm($nStr, 'минут');
		break;
		case 'h':
		$str = h($nStr);
		break;
		case 'd':
		$str = days($nStr);
		break;
		default:

		break;
	}

	return $number.' '.$str;
}

function timePassed($timestamp) {

	$diff = time()-$timestamp;

	if ($diff < 60) {
		return ($diff%60);
	} else if ($diff > 60 && $diff < 3600) {
		return floor($diff%3600/60);
	} else if ($diff > 3600 && $diff < 86400) {
		return floor($diff/3600);
	} else if ($diff > 86400 && $diff < 31536000) {
		return floor($diff/86400);
	} else {
		return floor($diff/31536000);
	}
}
