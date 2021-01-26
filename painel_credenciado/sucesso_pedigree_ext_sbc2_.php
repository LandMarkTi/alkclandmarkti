<?php

$fp = fopen('controle_ext.txt', 'a');
	fwrite($fp, "\ndetalhes ".$_SERVER['REMOTE_ADDR'].' '.time()."\n");
	fwrite($fp, "\n".print_r($_POST,true)."\n");
	
fclose($fp);

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

$nome_criador=addslashes($fcr['nome']);

//foto!!!
$proprietario=addslashes($_POST['proprietario']);
$end=addslashes($_POST['endereço']);
//$bloco=$_POST['bloco_ninhada'];

//parentes
$p=$_POST["p[]"];
$ps=addslashes(implode(';',$_POST["p"]));

//ninhada
$ns=addslashes(implode(';',$_POST["n"]));

$obs=addslashes($_POST['obs']);

//sexo


$ss=implode(';',$_POST["s"]);

//cores
$cs=addslashes(implode(';',$_POST["c"]));


//teste registro
$t=mysql_query("SELECT * from pedigree where registro='".trim($registro)."' ");
$n=mysql_num_rows($t);


//if($n>=1)die('registro duplicado');



$sql = "INSERT INTO pedigree VALUES('',2,'$nomecao','$micro',$raca,'$var',$datanasc,'$sex','$pais','$registro',$dataEmissao,'$ninhada_no','$amigo','$nome_criador','$proprietario','$end','$ns','$ss','$cs','$ps','$obs')";

//die($sql);
$query = mysql_query($sql) or die(mysql_error());

//Pegando o ID da cadela que acabo de ser cadastrada
$ultimo_id = (int)mysql_insert_id($conexao);

$registro_ex='RGE 1'.$ultimo_id;

mysql_query("update pedigree set registro='$registro_ex' where id_ped=".$ultimo_id);

$sss=(int)$_POST['id_credenciado'];
mysql_query("insert into registro_anterior values('','".addslashes($_POST['rga'])."',$ultimo_id,".$sss.")")or die('rga');


mysql_query("INSERT INTO `ped_temp` (`id_ped_temp`, `id_ped`, `id_cria`, `id_nucleo`, `data_cadastro`, `data_aprovado`) VALUES (NULL, '$ultimo_id', '$criador', '$sss', '".time()."', '0');");

//mysql_query("insert into ri values('',$ultimo_id)");

	$fotonome = $_FILES['foto']['name'];
	$fototipo = $_FILES['foto']['type'];
	$fototamanho = $_FILES['foto']['size'];
	$fototemp = $_FILES['foto']['tmp_name'];
	//move_uploaded_file($fototemp,'./pedext/'.$fotonome);

//mysql_query("insert into foto_ped values('','".addslashes($fotonome)."',$ultimo_id,22)");


$ht="

Novo pedigree pendente de aprovação

Aviso gerado pelo sistema Sobraci

data: ".date("d/m/Y")."

";

$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: contato@megapedigree.com\n"; // remetente
$headers .= "Return-Path:contato@megapedigree.com\n"; // return-path
//$envio = mail("debora@neoware.com.br", "$assunto", "$mensagemHTML", $headers);


$envio = mail('thayna@sobraci.org', "Novo registro para aprovar", "$ht", $headers,"-rcontato@megapedigree.com");


echo $ultimo_id;
?>
