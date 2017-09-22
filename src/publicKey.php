<?php

/**
 * @Author: Yacine
 * @Date:   2017-07-27 14:22:25
 * @Last Modified by:   Yacine
 * @Last Modified time: 2017-07-27 18:31:03
 */

function getPermutation($FA, $LA) {
	$perm = array();
	for ($i=0; $i < count($FA); $i++) { 
		for ($a=0; $a < count($LA); $a++) { 
			if ($FA[$i] == $LA[$a])
				$perm[] = $a + 1;
		}
	}
	return ($perm = implode(",", $perm));
}

function generatePublicKey() {
	global $g_total;
	global $g_set;
	global $g_e;
	global $g_m;
	global $g_pset;
	global $g_perm;

	$gArr = array();
	for ($i=0; $i < count($g_set); $i++) { 
		$gArr[] = ($g_set[$i] * $g_e) % $g_m;
	} 

	$g_pset = $gArr;
	sort($g_pset, SORT_NUMERIC);
	$g_perm = getPermutation($gArr, $g_pset);
}