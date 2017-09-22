<?php

/**
 * @Author: Yacine
 * @Date:   2017-07-27 14:22:25
 * @Last Modified by:   Yacine
 * @Last Modified time: 2017-07-28 16:54:14
 */

function CrypToBinary($sample) {
	$arr = array();
	$crypted_sample = "";

	for ($i=0; $i < strlen($sample); $i++) { 
		$arr[] = sprintf( "%08d", decbin(ord($sample[$i])));
	}

	for ($a=0; $a < count($arr); $a++) { 
		$crypted_sample .= (string) $arr[$a];
	}

	return ($crypted_sample);
}

function publicChecker($err = "") {
	$command = 0;
	
	if (!empty($err))
		echo $err . "\n";
	while ($command == 0)
		$command = readline("Saisissez votre clé publique.\n   Clé : ");
	setPublicKey($command) ? : publicChecker($command, "Clé invalide !");
}

function setPublicKey($key) {
	global $g_pset;
	$regex = "/^([0-9]*,\s?[0-9]*)*$/";

	if (preg_match($regex, $key) && !is_null($key)) {
		$g_pset = explode(",", $key);
		for ($i=0; $i < count($g_pset); $i++)
    		$g_pset[$i] = intval(str_replace(' ', '', $g_pset[$i]));
		return (true);
	} else {
		return (false);
	}
}

function getCrypted($n, $cuttted_binaries) {
	global $g_pset;
	$crypted = "";
	$useful_number = 1;
	$binary_sample = sprintf("%0{$n}d", 0);

	for ($i=0; $i < $n; $i++) { 
		$arr[] = sprintf("%0{$n}d", $useful_number);
		$useful_number *= 10;
	} $useful_number = 0;

	for ($i=0; $i < count($cuttted_binaries); $i++) { 
		for ($a=0; $a < strlen($cuttted_binaries[$i]); $a++) { 
			if ($cuttted_binaries[$i][$a] == '1') {
				$binary_sample[$a] = "1";
				$useful_number += $g_pset[array_search($binary_sample, $arr)];
			}
			$binary_sample = sprintf("%{$n}d", 0);
		}
		$crypted .= $useful_number . ",";
		$useful_number = 0;
	}
	return (substr($crypted, 0, -1));
}