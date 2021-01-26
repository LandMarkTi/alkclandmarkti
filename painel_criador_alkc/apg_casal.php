<?php
session_start();
require_once("Connections/conexao.php");
if($_SESSION['login']=='')die("<script>location='index.php';</script>");
$idcop=(int)$_POST['id_cop'];
$idc=(int)$_SESSION['cid'];
if($idcop>0)mysql_query('delete from acasalamento where id_cop='.$idcop.' and id_criador='.$idc);
?>ok
