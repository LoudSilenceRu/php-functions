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

function plural_form($number = 0, $text = array('комментарий','комментария','комментариев'), $postfix = '') {
  $cases = array (2, 0, 1, 1, 1, 2); // 1 2 5
  return $number.' '.$text[($number%100>4 && $number%100<20) ? 2 : $cases[min($number%10, 5)]].' '.$postfix;
}

function timePassed($timestamp) {

	$diff = time()-$timestamp;
	$postfix = "назад";

	if ($diff < 60) 
		return plural_form($diff%60, array('секунда','секунды','секунд'), $postfix);
	else if ($diff >= 60 && $diff < 3600) 
		return plural_form(floor($diff%3600/60), array('минута','минуты','минут'), $postfix);
	else if ($diff >= 3600 && $diff < 86400) 
		return plural_form(floor($diff/3600), array('час','часа','часов'), $postfix);
	else if ($diff >= 86400 && $diff < 31536000) 
		return plural_form(floor($diff/86400), array('день','дня','дней'), $postfix);
	else 
		return plural_form(floor($diff/31536000), array('год','года','лет'), $postfix);
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

function rgb_to_hex($rgb, $sharp = true) {
	if (!is_array($rgb) || count($rgb) < 3)
		return;
	$pattern = $sharp ? '#' : '';
	return (string) sprintf("$pattern%02x%02x%02x", $rgb[0], $rgb[1], $rgb[2]);
}

function color_inverse($hex = "fff"){
	$hex = str_replace('#', '', $hex);
	$rgb = '';
	for ($i=0;$i<3;$i++){
		$c = 255 - hexdec(substr($hex,(2*$i),2));
		$c = ($c < 0) ? 0 : dechex($c);
		$rgb .= (strlen($c) < 2) ? '0'.$c : $c;
	}
	return '#'.$rgb;
}
