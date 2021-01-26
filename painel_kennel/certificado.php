<?php
session_start();
$ttl=time();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");
$ssid=(int)$_SESSION['id'];

//todo: inserir foto usando dados jpg na pasta  para banco.



$id =(int)$_POST['id'];


//var_dump($pgs);

$serie=(int)$_POST['serie'];

require('./fpdf17/fpdf.php');
//require_once("Connections/conexao.php");

$hostname_conexao = "opmy0031.servidorwebfacil.com";
$database_conexao = "megapedigree_com";
$username_conexao = "megap_com";
$password_conexao = "Companheiro3@10";
$conexao = mysql_pconnect($hostname_conexao, $username_conexao, $password_conexao) or die('');
mysql_select_db($database_conexao, $conexao);
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');


$pdf = new FPDF('P','mm','A4');
$pdf->SetMargins(0,0,0,0);
$pdf->AddPage();

$border=0;
//consulta dados


$pgs=$_POST["pgs"];

$id =(int)$_POST['id'];




//echo "id =".$id;






$serie=(int)$_POST['serie'];

$str_serie=addslashes($_POST['serie']);


//testa serie

$idc=$_SESSION['id'];
//testa serie


$pdf->Image('fundo.png',0, 0 , 210 , 297,'PNG');

$sql1="select * from cert_nasc where id_cert=1";//.$id;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);


//consulta dos campos utf8_decode
$sql="SELECT * FROM `gabarito_cert` where id_gab<>100";
$qr=mysql_query($sql);
while($l=mysql_fetch_assoc($qr)){
$pdf->SetFont('Arial','',$l['tam']);
$pdf->SetXY(($l['px']+10),($l['py']+10));
$pdf->MultiCell($l['largura'],$l['altura'],iconv('UTF-8', 'windows-1252', $linha_ped[$l['nome']]),$border,'c',false);
//echo ($linha_ped[$l['nome']]);
}
//cor 







$pdf->Output();

?>
