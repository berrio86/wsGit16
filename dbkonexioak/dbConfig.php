<?php

//automatikoki ikusi ea localhosten gauden ala ez

$host = $_SERVER['SERVER_NAME'];

if($host=="localhost") {
	//localhost-en atzitzeko
	define("HOST","localhost");
	define("USER", "root");
	define("PASS", "");
	define("DATABASE", "erabiltzaileak");
	define("ESTEKA","ShowUsersWithImage.php");
} else {
	//hostingerren atzitzeko
	define("HOST","mysql.hostinger.es");
	define("USER", "u880556081_weba");
	define("PASS", "pertsona1");
	define("DATABASE", "u880556081_perts");
	define("ESTEKA","http://berriogit.hol.es/ShowUsersWithImage.php");
}

?>
