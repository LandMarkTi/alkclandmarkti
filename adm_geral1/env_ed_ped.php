<?php
session_start();

require_once("Connections/conexao.php");

if($_SESSION['login']!='sergio@sobraci.org')die("<script>location='index.php';</script>");

//print_r($_POST);

$id=(int)$_POST['id'];

$idf=(int)$_POST['f'];
$idf=$idf+4;

$nome_cao= addslashes(strip_tags($_POST['nome']));

$mic= addslashes(strip_tags($_POST['mic']));

$sex= addslashes(strip_tags($_POST['sex']));

$cor= addslashes(strip_tags($_POST['cor']));

$prop=addslashes(strip_tags($_POST['prop']));

$end=addslashes(strip_tags($_POST['endereco']));

$nasc= addslashes(strip_tags($_POST['nasc']));


$aa=substr($nasc,6,4);

$mm=substr($nasc,3,2);

$dd=substr($nasc,0,2);

$nasc=mktime(8, 0, 0, $mm, $dd,$aa,-1);

$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$id;
$qr=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr);


$ncor=explode(';',$linha_ped['cor']);

$nsex=explode(';',$linha_ped['sexo']);

$nloop=explode(';', $linha_ped['ninhada']);
$micro=explode(';', $linha_ped['nº microchip']);

$micro[$idf-4]=$mic;

$ncor[$idf-4]=$cor;

$nsex[$idf-4]=$sex;

$nloop[$idf]=$nome_cao;


$m=addslashes(implode(';',$micro));

$n=addslashes(implode(';',$nloop));



$s=addslashes(implode(';',$nsex));

$c=addslashes(implode(';',$ncor));

$p=implode(';',$_POST['p']);

$p=addslashes(substr($p,0,-30));

mysql_query("UPDATE pedigree set `ninhada`='$n', `nº microchip`='$m',`cor`='$c',`sexo`='$s',`parentes`='$p',`nasc`=$nasc, `proprietario`= '$prop',endereco='$end' where id_ped=".$id);

//echo "<br>".$c."<br>".$m."<br>".$n."<br>".$s;
//echo substr($p,0,-30);
?>Dados enviados
<script>
location='index_principal.php';
</script>


