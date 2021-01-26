<?php
session_start();
if($_SESSION['login']=='sergio@sobraci.org'){} else die("sem login");

require_once("Connections/conexao.php");
//var_dump($_POST);

mysql_query("INSERT INTO `pag_trans_capa` (`id_pag`, `id_ped`, `id_f`, `data_pg`) VALUES (NULL, ".$_POST['id_ped'].", ".$_POST['id_f'].", NOW());");



?>Pagamento Confimado!
