<?php
session_start();
require_once("Connections/conexao.php");

if($_SESSION['login']=='')die("login");
$id = (int)$_POST['id'];
$cota =(int)$_POST['cota'];
$cred=(int)$_POST['cred'];

$sql = "delete from cotas  WHERE id_cota = $id";

mysql_query($sql) or die('ee');


?>
