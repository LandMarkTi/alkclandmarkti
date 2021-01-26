<?php
session_start();
require_once("Connections/conexao.php");
$nomecao = addslashes($_POST['tituloAposta']);
$micro=addslashes(implode(';',$_POST["m"]));
$raca=(int)$_POST['subcategoria'];
$datanasc = $_POST['dataInicialEpoch'] / 1000;
$sex=$_POST['sexo'];
$dataEmissao = $_POST['dataFinalEpoch'] / 1000;
$var=addslashes($_POST['variedade']);
$pais=addslashes($_POST['pais']);
$registro=addslashes($_POST['registro']);
$ninhada_no=$_POST['ninhada_no'];
$amigo=addslashes($_POST['amigo']);
$criador=(int)($_POST['criador']);


$qcr=mysql_query('SELECT * FROM  criadores  where id_criador='.$criador);

$fcr=mysql_fetch_assoc($qcr);

$nome_criador=addslashes($_POST['criador_ex']);//=addslashes($fcr['nome']);

//foto!!!
$proprietario=addslashes($_POST['proprietario']);
$end=addslashes($_POST['endereço']);
//$bloco=$_POST['bloco_ninhada'];

//parentes
$p=$_POST["p[]"];
$ps=addslashes(implode(';',$_POST["p"]));

//ninhada
$ns=addslashes(implode(';',$_POST["n"]));

$obs=$_POST['obs'];

//sexo


$ss=implode(';',$_POST["s"]);

//cores
$cs=addslashes(implode(';',$_POST["c"]));


//teste registro
$t=mysql_query("SELECT * from pedigree where registro='".trim($registro)."' ");
$n=mysql_num_rows($t);


//if($n>=1)die('registro duplicado');



$sql = "INSERT INTO pedigree VALUES('',$criador,'$nomecao','$micro',$raca,'$var',$datanasc,'$sex','$pais','$registro',$dataEmissao,'$ninhada_no','$amigo','$nome_criador','$proprietario','$end','$ns','$ss','$cs','$ps','$obs')";

//die($sql);
$query = mysql_query($sql) or die('ped_exo_err ');

//Pegando o ID da cadela que acabo de ser cadastrada
$ultimo_id = (int)mysql_insert_id($conexao);

$registro_ex='RGEO 1'.$ultimo_id;

mysql_query("update pedigree set registro='$registro_ex' where id_ped=".$ultimo_id);

$sss=(int)$_POST['id_credenciado'];

mysql_query("insert into registro_anterior values('','".addslashes($_POST['rga'])."',$ultimo_id,".$sss.")")or die('rga');

	$fotonome = $_FILES['foto']['name'];
	$fototipo = $_FILES['foto']['type'];
	$fototamanho = $_FILES['foto']['size'];
	$fototemp = $_FILES['foto']['tmp_name'];
	//move_uploaded_file($fototemp,'./pedext/'.$fotonome);

mysql_query("insert into foto_ped values('','".addslashes($fotonome)."',$ultimo_id,22)");

//mysql_query("update somatoria set ped_exo=ped_exo+1 where 1");

?>ok
