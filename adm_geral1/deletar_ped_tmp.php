<?php
session_start();
require_once("Connections/conexao.php");

if($_SESSION['login']=='sergio@sobraci.org'){
$id = (int)$_POST['id'];


$sql = "delete from ped_temp  WHERE id_ped_temp = $id";

mysql_query($sql) or die('ee');

} else die('login.');
?>
