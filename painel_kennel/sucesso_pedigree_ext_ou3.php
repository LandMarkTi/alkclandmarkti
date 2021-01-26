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



$sss=(int)$_POST['id_credenciado'];
$q2=mysql_query('select * from credenciado join dados_credenciado ON id_credenciado=id_dados where id_credenciado='.$sss);
$fr=mysql_fetch_assoc($q2);
$nfr=mysql_num_rows($q2);

$qcr=mysql_query('SELECT * FROM  criadores  where id_criador='.$criador);

$fcr=mysql_fetch_assoc($qcr);

$nome_criador=addslashes($_POST['proprietario']);//addslashes($_POST['criador_ex']);//=addslashes($fcr['nome']);

//foto!!!
$proprietario=addslashes($_POST['cani']);//($_POST['criador_ex']);
$end=addslashes($_POST['endereço']);
//$bloco=$_POST['bloco_ninhada'];

//parentes
$p=$_POST["p[]"];
$ps=addslashes(implode(';',$_POST["p"]));

//ninhada
$ns=addslashes(implode(';',$_POST["n"]));

$ns.=';Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote';

$obs=$_POST['obs'];

//sexo


$ss=implode(';',$_POST["s"]);

$ss.=';;;;;;;;;;;;;;;';

//cores

$_POST["c"][0]=$_POST["c"][0].'*'.$_POST["var"][0];

$cs=addslashes(implode(';',$_POST["c"]));


$vs=addslashes($_POST["var"]);

$cs.=';Escolha a cor..;Escolha a cor..;Escolha a cor..;Escolha a cor..;Escolha a cor..;Escolha a cor..;Escolha a cor..;Escolha a cor..;Escolha a cor..;Escolha a cor..;Escolha a cor..;Escolha a cor..;Escolha a cor..;Escolha a cor..;Escolha a cor..';


$micro.=';;;;;;;;;;;;;;;';

//teste registro


if($nfr<1)die('Session_error');



$sql = "INSERT INTO pedigree VALUES('',2,'$nomecao','$micro',$raca,'$var',$datanasc,'$sex','$pais','$registro',$dataEmissao,'$ninhada_no','$amigo','$nome_criador','$proprietario','$end','$ns','$ss','$cs','$ps','$obs')";

//die($sql);
$query = mysql_query($sql) or die('ped_exo_err ');



//Pegando o ID da cadela que acabo de ser cadastrada
$ultimo_id = (int)mysql_insert_id($conexao);

//add no temp


$ultimo_crop=substr($ultimo_id,1);

$registro_ex='RG/E/'.$fr['sigla'].'/21/'.$ultimo_crop;

mysql_query("update pedigree set registro='$registro_ex' where id_ped=".$ultimo_id);


mysql_query("insert into registro_anterior values('','".addslashes($_POST['rga'])."',$ultimo_id,".$sss.")")or die('rga');

//só por 2 no criador do insert do pedigree e descomentar abaixo

mysql_query("INSERT INTO `ped_temp` (`id_ped_temp`, `id_ped`, `id_cria`, `id_nucleo`, `data_cadastro`, `data_aprovado`) VALUES (NULL, '$ultimo_id', '$criador', '$sss', '".time()."', '0');");

	$fotonome = $_FILES['foto']['name'];
	$fototipo = $_FILES['foto']['type'];
	$fototamanho = $_FILES['foto']['size'];
	$fototemp = $_FILES['foto']['tmp_name'];
//move_uploaded_file($fototemp,'./images/pedigree/'.$fotonome);

//mysql_query("insert into tarja values('','".addslashes($fotonome)."',$ultimo_id,0)");


$ht="

Novo pedigree pendente de aprovação

Aviso gerado pelo sistema ALKC

data: ".date("d/m/Y")."

";

$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: contato@megapedigree.com\n"; // remetente
$headers .= "Return-Path:contato@megapedigree.com\n"; // return-path
//$envio = mail("debora@neoware.com.br", "$assunto", "$mensagemHTML", $headers);
$envio = mail('thayna@alkc.com.br', "Novo registro para aprovar", "$ht", $headers,"-rcontato@megapedigree.com");


//mysql_query("update somatoria set ped_exo=ped_exo+1 where 1");

echo $ultimo_id;
?>
