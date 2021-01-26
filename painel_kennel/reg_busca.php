<?php
session_start();
if($_SESSION['login']=='kcbrasil@alkc.com.br'){

require_once("Connections/conexao.php");


$reg=addslashes(substr(strtoupper($_POST['bus']),0,-1));

$cr=(int)$_POST['criador'];

$cr=$cr+21634;
//echo $serie;

$qb=mysql_query("select * from pedigree where registro = '$reg' ");
$fb=mysql_fetch_assoc($qb);

$id_ped=$fb['id_ped'];

$nr=mysql_num_rows($qb);

$qc=mysql_query("select * from criadores where id_criador = '$cr' ");

$nrc=mysql_num_rows($qc);


if($nr>=1&&$nrc>=1){

$idf=(int)substr(strtoupper($_POST['bus']),-1,1);
$idf=$idf+4;
mysql_query("insert into adiciona_filhote values('','$id_ped','$idf','$cr')");
echo "<script>alert('Cobertura adicionada com sucesso.');location='index_principal.php';</script>"; 
}else echo "<script>alert('Registro nao encontrado.');location='index_principal.php';</script>";

}
?>

