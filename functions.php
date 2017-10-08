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

function maxUrlArgs($args, $maxArgs) {
	//d(count($args));
	//d($args);
	//d($args[$maxArgs]);
	//d($maxArgs);
	if (count($args) > $maxArgs) {
		if (!empty($args[$maxArgs])) throw new Exception('Error 404');
	}
}

function hex_to_rgb($hex = "ffffff", $is_arr = true) {
	$hex = str_replace("#","",$hex);
	$str = "";

	if (strlen($hex) == 3) {
		for ($i=0; $i < strlen($hex); $i++) {
			for ($j=0; $j < 2; $j++) { 
				$str .= $hex[$i];
			}
		}
	} else if (strlen($hex) > 6) {
		$str = substr($hex, 0, 6);
	} else {
		for ($i=0, $remain = 6-strlen($hex); $i < $remain; $i++) { 
			$hex = "0$hex";
		}
		$str = $hex;
	}

	list($r, $g, $b) = sscanf($str, "%02x%02x%02x");

	if ($is_arr)
		return (array) array('r' => $r, 'g' => $g,'b' => $b);
	else
		return (string) "$r, $g, $b";
}
