<?php
session_start();

require_once("Connections/conexao.php");
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");

$id_ped = (int)$_GET['id_ped'];
$id_filhote = (int)$_GET['id_filhote'];

$sql = "insert into padreadoresmatrizes (id_ped, id_filhote, ativo) values ($id_ped, $id_filhote, 1)";
$query = mysql_query($sql) or die("Error: " . mysql_error());

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>