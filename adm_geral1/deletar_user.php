<?php
session_start();
if($_SESSION['login']=='sergio@sobraci.org'){
 require_once("Connections/conexao.php");
$id =(int)$_POST['id'];

mysql_select_db($database_conexao,$conexao);

$sql="delete from usuario WHERE id = $id";
$deleta=mysql_query($sql) or die (mysql_error ());

}
?>
