<?php 
session_start();
require_once("Connections/conexao.php");
$sqluser = "SELECT * FROM usuario WHERE id = '$_SESSION[id]'";
$queryuser = mysql_query($sqluser) or die(mysql_error());
$linhauser = mysql_fetch_array($queryuser);

//var_dump($_POST);
$idu=(int)$_POST['idu'];
$value=(int)$_POST['value'];
$qr=mysql_query('UPDATE usuario SET nivel='.$value.' WHERE id ='.$idu) or die('ee');

?>