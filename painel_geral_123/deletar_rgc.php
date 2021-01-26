<?php
session_start();
if($_SESSION['login']=='')die("login");
require_once("Connections/conexao.php");
$id = (int)$_POST['id'];

$sql = "DELETE FROM rgc WHERE id = '$id'";
mysql_query($sql) or die(mysql_error());
?>
