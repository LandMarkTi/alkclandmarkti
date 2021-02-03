<?php

session_start();
require_once("Connections/conexao.php");

$sqlsolpe = "update pedigreeexterno set status = 2, motivo = '".$_POST['motivo']."' where id = " . $_POST['idsolicitacao'];
$qsolpe = mysql_query($sqlsolpe);

header('Location:pedigreeexterno_lista.php');

?>