<?php

require_once("Connections/conexao.php");

$busca="select * from criadores where nome_completo='".trim($_POST['non'])."' ";

$qr=mysql_query($busca);
$n=mysql_num_rows($qr);
if ($n>0)die('Esse Nome Já existe');
die('Nome disponível,sujeito a análise.');

?>
