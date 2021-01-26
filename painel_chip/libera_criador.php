<?php
session_start();
if($_SESSION['login']!='sergio@sobraci.org')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

$p=(int)$_GET['usr'];

mysql_query("insert into selecao values('',$p)");
die("<script>alert('Criador promovido.');window.close();</script>");
?>
