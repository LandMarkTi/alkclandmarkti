<?php
session_start();
if($_SESSION['login']=='')die("login");
require_once("Connections/conexao.php");
$id = $_POST['id'];

$sql = "DELETE FROM medalha WHERE id = '$id'";
mysql_query($sql) or die(mysql_error());

?>
