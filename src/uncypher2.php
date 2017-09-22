<?php

/**
 * @Author: Yacine
 * @Date:   2017-07-27 14:22:25
 * @Last Modified by:   Yacine
 * @Last Modified time: 2017-07-28 16:23:41
 */
 
 function permChecker($err = "") {
	global $g_total;
	global $g_set;
	$command = 0;
	
	if (!empty($err))
		echo $err . "\n";
	while ($command == 0)
		$command = readline("Saisissez les permutations.\n   P = ");
	setPerm($command) ? : permChecker($command, "Permutations invalides !");
}

function setPerm($key) {
	global $g_perm;
	$regex = "/^([0-9]*,\s?[0-9]*)*$/";

	if (preg_match($regex, $key) && !is_null($key)) {
		$g_perm = explode(",", $key);
		for ($i=0; $i < count($g_perm); $i++)
    		$g_perm[$i] = intval(str_replace(' ', '', $g_perm[$i]));
		return (true);
	} else {
		return (false);
	}
}

function permKey() {
	global $g_perm;
	global $g_set;
	$array = array();
	$dot = 1;
	$i = 0;

	while ($dot <= count($g_set)) {
		if ($dot == $g_perm[$i]) {
			$array[] = $g_set[$i];
			$dot++;
			$i = 0;
		} else
			$i++;
		if ($dot > count($g_set))
			return ($array);
	}
}