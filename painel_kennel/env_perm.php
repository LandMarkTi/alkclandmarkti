<?php

session_start();

require_once("Connections/conexao.php");
if($_SESSION['login']=='')die("<script>location='index.php';</script>");
$usr=(int)$_SESSION['cid'];

if($usr>0){

$id_ped=(int)$_POST['id_ped'];

$id_f=(int)$_POST['id_filhote'];

$perm=(int)$_POST['upgr'];


mysql_query("insert into ped_print values ('',$id_ped,$id_f,$usr,$perm)")or die('net_error');


}

?>
<script>
alert('Dados Gravados com sucesso.');
location='../painel_criador_alkc/listagem_pedigree.php';
</script>
