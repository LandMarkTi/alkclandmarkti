<?php
session_start();
require_once("Connections/conexao.php");


$login='sergio@sobraci.org';


	$id = 8;
	$_SESSION['login'] = $login;
	$_SESSION['id'] = $id;
	$_COOKIE['mm']='ok';
	echo "2";

?>
