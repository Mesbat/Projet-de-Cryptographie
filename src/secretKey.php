<?php

/**
 * @Author: Yacine
 * @Date:   2017-07-27 09:47:32
 * @Last Modified by:   Yacine
 * @Last Modified time: 2017-07-27 14:46:41
 */

function getSet($err = "") {
	global $g_total;
	global $g_set;
	global $g_e;
	global $g_m;

	if (!empty($err))
		echo $err . "\n";
	$command = readline("Saisissez une suite super-croissante.\n   S = ");
	$result = (setChecker($command)) ? true : getSet("Suite invalide (S = 1, 2, 5, 10, 20...)");

	return ($result);
}

function getME($err = "") {
	global $g_total;
	global $g_set;
	global $g_e;
	global $g_m;

	if (!empty($err))
		echo $err . "\n";
	$command = readline("Saisissez un entier m et e tel que e et m soit premiers entre eux (ex: 35,24), avec  m > $g_total et 1 < e < m.\n   m, e = ");
	$result = (numberChecker($command)) ? true : getME("Paire Invalide, Vérifiez que : [m > $g_total et 1 < e < m] et [PGCD(m/e)] = 1.");

	return ($result);
}

function setChecker($set) {
	global $g_total;
	global $g_set;
	$regex = "/([0-9]*,\s?[0-9]*)*/";
	$g_set = 0;
	$g_total = 0;

	if (preg_match($regex, $set)) {
    	$set = explode(",", $set);
    	for ($i=0; $i < count($set); $i++) { 
    		$set[$i] = intval(str_replace(' ', '', $set[$i]));
    		if ($set[$i] <= $g_total)
    			return (false);
    		$g_total += $set[$i];
    	}
    	$g_set = $set;
    	return (true);
	} else
    	return (false);
}

function PGCD($a, $b)
{
    while($b > 0)
    {
        $result = $a % $b;
        $a = $b;
        $b = $result;
    }
    return $a;
}

function numberChecker($number) {
	global $g_total;
	global $g_e;
	global $g_m;
	$regex = "/^([0-9]*,\s?[0-9]*)$/";

	if (preg_match($regex, $number)) {
		$number = explode(",", $number);
		for ($i=0; $i < count($number); $i++) {
			$number[$i] = intval(str_replace(' ', '', $number[$i]));
		}

  		if ($number[0] > $g_total && $number[1] > 1 && $number[0] > $number[1] && PGCD($number[0], $number[1]) == 1) {
  			$g_m = $number[0];
  			$g_e = $number[1];
    		return (true);
  		}
    	else
    		return (false);
	} else
    	return (false);
}