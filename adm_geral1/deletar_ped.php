<?php
session_start();
require_once("Connections/conexao.php");
if($_SESSION['login']=='sergio@sobraci.org'){
$id = (int)$_POST['id'];

$sql = "DELETE FROM pedigree WHERE id_ped = '$id'";
mysql_query($sql) or die(mysql_error());
} else die('Sem login');
?>
