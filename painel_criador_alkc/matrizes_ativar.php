<?php
session_start();

require_once("Connections/conexao.php");
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");

$id_ped = (int)$_GET['id_ped'];
$id_filhote = (int)$_GET['id_filhote'];

$sql = "update padreadoresmatrizes set ativo = 1 where id_ped = $id_ped and id_filhote = $id_filhote";
$query = mysql_query($sql) or die("Error: " . mysql_error());

header('Location: ' . $_SERVER['HTTP_REFERER']);
