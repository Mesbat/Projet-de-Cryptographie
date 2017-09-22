<?php

/**
 * @Author: Yacine
 * @Date:   2017-07-27 14:22:25
 * @Last Modified by:   Yacine
 * @Last Modified time: 2017-07-28 13:43:46
 */

function getInvModulaire($e,$m){
	if ($m < 0)
		$m = -$m;
    if ($e < 0)
    	$e = $m - (-$e % $m);

	$abs_m = $m;
	$a = 0;
	$b = 1;
	$mod_res = $e % $m;

	while ($mod_res != 0) {
		$quot= (Int) ($abs_m/$mod_res);
		$res = $b;
		$b = $a - $quot * $b;
		$a = $res;
		$res = $mod_res;
		$mod_res = $abs_m - $quot * $mod_res;
		$abs_m = $res;
	}

	if ($abs_m > 1)
		return (-1);
	if ($a < 0)
		$a += $m;
	return ($a);
}

function uncypherME($err = "") {
	global $g_total;
	global $g_set;
	global $g_e;
	global $g_m;

	if (!empty($err))
		echo $err . "\n";
	$command = readline("Saisissez votre paire [M,E]\n   m, e = ");
	$result = (numberChecker($command)) ? true : uncypherME("Paire Invalide");

	return ($result);
}

function privateChecker($err = "") {
	global $g_total;
	global $g_set;
	$command = 0;
	
	if (!empty($err))
		echo $err . "\n";
	while ($command == 0)
		$command = readline("Saisissez votre clé secrete.\n   Clé : ");
	setPrivateSet($command) ? : privateChecker($command, "Clé invalide !");

	for ($i=0; $i < count($g_set); $i++) { 
		$g_total += $g_set[$i];
	}
}

function setPrivateSet($key) {
	global $g_set;
	$regex = "/^([0-9]*,\s?[0-9]*)*$/";

	if (preg_match($regex, $key) && !is_null($key)) {
		$g_set = explode(",", $key);
		for ($i=0; $i < count($g_set); $i++)
    		$g_set[$i] = intval(str_replace(' ', '', $g_set[$i]));
		return (true);
	} else {
		return (false);
	}
}

function decryptOne($crypted_sample, $d, $m) {
	$crypted_sample = explode(" ", $crypted_sample);

	for ($i=0; $i < count($crypted_sample); $i++) { 
		$crypted_sample[$i] = ($crypted_sample[$i] * $d) % $m;
	}

	return ($crypted_sample);
}