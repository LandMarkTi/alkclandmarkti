<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

//print chr(255).chr(254);
$data=date("d/m/Y");

$dataf=date("d_m_Y");

header("Cache-Control: must-revalidate");
header("Pragma: must-revalidate");
header("Content-type: application/vnd.ms-excel");
//header("content-type:application/csv;charset=UTF-8");
   header("Content-Disposition: attachment; filename=relatorio_$dataf.xls");
require_once("Connections/conexao.php");

$raca=trim($_POST['raca']);

$cert=trim($_POST['cert']);

if($raca!='-'&& $raca!='')$busca.="and Racas like '$raca%' ";

$cep=trim($_POST['cep']);
if($cep!='-'&& $cep!='')$busca.="and cep = '$cep' ";


$estado=trim($_POST['estado']);
if($estado!='-')$busca.="and estado like '$estado%' ";

$cidade=trim($_POST['cidade']);
if($cidade!='-'&& $cidade!='')$busca.="and cidade like '$cidade%' ";


$ano=trim($_POST['ano']);
if($ano!='-')$busca.="and Nascimento like '__/__/$ano %' ";

/*
$epoch_ini=mktime(0, 0, 0, 1, 1, $ano);
$epoch_fim=mktime(0, 0, 0, 12, 1, $ano);
if($ano!='-')$busca.="and nasc between ($epoch_ini,$epoch_fim) ";
*/

$knl=trim($_POST['knl']);
if($knl!='-')$busca.="and id_credenciado = '$knl' ";


$sql="select * from criadores where id_criador>'21634' and id_criador in(select id_criador from aprovados where 1) $busca limit 5000";


$qr=mysql_query($sql) or die('busca errada');

$nd=mysql_num_rows($qr);

   // do your Db stuff here to get the content into $content
   //print "Relatório $data com $nd registros\n";
   //print $sql;
	$cpfu='-';
	if($cert=='nasc')print mb_convert_encoding("id\tnome\tregistro\traça\tnascimento\tlocal\tsexo\tespecie\tcor\tchip\temail\ttutor 1\tcpf1\ttutor 2\tcpf2\tPai\tMãe\tAvo1\tAvo2\tAvo3\tAvo4\ttime\tstats", 'UTF-16LE', 'UTF-8')."\n";
	//if($cert=='obito')print mb_convert_encoding("id\tnome\tregistro\traça\tnascimento\tlocal\tsexo\tespecie\tcor\tchip\temail\ttutor 1\tcpf1\ttutor 2\tcpf2\tcausa morte\ttime\tstats", 'UTF-16LE', 'UTF-8')."\n";
	while($linha=mysql_fetch_assoc($qr)){

		//if($linha['cpf']!=$cpfu){
			foreach($linha as $i => $v){ if($i!='id_criador'&&$i!='senha'&&$i!='ps'&&$i!='id_credenciado'&&$i!='uso_canil')print mb_convert_encoding(str_replace(","," ",$v)."\t", 'UTF-16LE', 'UTF-8'); }//print $i.'='.$v;
				
		$cpfu=$linha['cpf'];
		print "\n";//}
	}
	

?>
