<?php

/**
 * @Author: Yacine
 * @Date:   2017-07-27 09:47:32
 * @Last Modified by:   Yacine
 * @Last Modified time: 2017-07-28 16:25:09
 */

include 'src/secretKey.php';
include 'src/publicKey.php';
include 'src/cypher.php';
include 'src/uncypher.php';
include 'src/uncypher2.php';

$g_total;
$g_set;
$g_e;
$g_m;
$g_pset;
$g_perm;

function command1() {
	global $g_pset;
	global $g_set;
	global $g_perm;
	global $g_m;
	global $g_e;
	$command = false;

	if (getSet())
		if (getME())
			generatePublicKey();
		system('clear');
	echo "Fiche de Génération\n";
 	echo "-----------------------------------\n";
 	echo "  -> Clé Secrete! = [". implode(",", $g_set) . "] \n";
 	echo "  -> Paire M/E = [$g_m,$g_e] \n";
 	echo "  -> Clé publique =  [" . implode(",", $g_pset) . "]\n";
 	echo "  -> Permutations = [$g_perm] \n";
 	echo "-----------------------------------\n";

	while ($command != "quit")
		$command = readline("Saisissez 'quit' pour revenir au menu principal : ");
	main();
}

function command2() {
	$command = readline("Saisissez l'élément à Chiffrer.\n   -> ");
	$crypted_sample = CrypToBinary($command);
	while ($command < 4 || $command > 8)
		$command = readline("Saisissez un nombre n compris entre 4 et 8.\n   N : ");
	publicChecker();
	$output = str_split($crypted_sample, $command);
	for ($i=0; $i < count($output); $i++)
		while (strlen($output[$i]) < $command)
			$output[$i] .= "0";

	system('clear');
	echo "Fiche de Génération\n";
 	echo "-----------------------------------\n";
	echo "Message chiffré : [" . getCrypted($command, $output) . "]\n";
	echo "-----------------------------------\n";

	while ($command != "quit")
		$command = readline("Saisissez 'quit' pour revenir au menu principal :");
	main();
}

function command3() {
	global $g_m;
	global $g_e;
	$crypted_sample = 0;
	$n = 0;

	while ($crypted_sample == 0)
		$crypted_sample = readline("Saisissez le message chiffré.\n   Message chiffré : ");
	while ($n < 4 || $n > 8)
		$n = readline("Saisissez le nombre n compris entre 4 et 8.\n   N : ");

	privateChecker();
	permChecker();

	if (uncypherME())
		$d = getInvModulaire($g_e, $g_m);

	$permuted_key = permKey();
	$crypted_sample = decryptOne($crypted_sample, $d, $g_m);
}

 function main($err = "") {
 	system('clear');
 	echo "Interface de Gestion CryptoProject\n";
 	echo "-----------------------------------\n";
	echo "1 : Génération d'une clé publique\n";
	echo "2 : Chiffrement d'un message\n";
	echo "3 : Déchiffrement d'un message\n";
	echo "-----------------------------------\n";
	if (!empty($err))
		echo $err . "\n";
	$command = readline("Commande : ");

	if ($command != '1' && $command != '2' && $command != '3') {
		return (main("Commande [{$command}] introuvable, veuillez-réessayer."));
	}
	else {
		$command = "command" . $command;
		echo "-----------------------------------\n";
		$command();
	}
 }

 main();