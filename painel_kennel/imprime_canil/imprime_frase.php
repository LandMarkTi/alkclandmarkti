<?php
session_start();
define('FPDF_FONTPATH','./font');
require_once("fpdf.php");
require_once("../Connections/conexao.php");



$usr=22663;

$sql = "SELECT * FROM criadores join aprovados on criadores.id_criador=aprovados.id_criador where criadores.id_criador=$usr ORDER BY criadores.id_criador DESC ";
$query = mysql_query($sql) or die(mysql_error());
$linha = mysql_fetch_array($query);
//serie







$n_registro = 'Registro:'.$linha['id_criador'];
if($linha['id_criador']>21634)$n_registro = 'Registro:'.($linha['id_criador']-21634);

$proprietario = 'Proprietário(s) : '.$linha['nome'];

if($linha['sobrenome']!='')$proprietario=$proprietario.' e '.$linha['sobrenome'];
$cidade_estado  = 'Cidade/Estado : '.$linha['cidade']." / ". $linha['estado'];
$data_abertura  = 'Abertura: '.date("d/m/Y",$linha['data']);//= $linha['dia_assinatura']."/".$linha['mes_assinatura']."/".$linha['ano_assinatura'];
$canil = ucwords(strtolower($linha['nome_completo']));

$validade = $linha['dia_assinatura']."/".$linha['mes_assinatura']."/".($linha['ano_assinatura']+1);
//$validade  = date('d/m/Y', strtotime($validade));


 
$pdf= new FPDF("L","cm",array(30,21));
 
 

$pdf->AddFont('oldscript','','oldscript.php');

$pdf->AddFont('COPRGTB','','COPRGTB.php');

$pdf->AddFont('arial','','arial.php');

$pdf->AddPage();
 
//$pdf->Image('foto.jpg',0.81, 0.88 , 5.33 , 5.33);

$pdf->SetXY(0,7.5);
$pdf->SetFont('oldscript','',50);
$pdf->Cell(29.5, 2,iconv('UTF-8', 'windows-1252', 'Certificamos o Registro do Afixo:') , 0 , 1 , 'C' );





$pdf->SetXY(0,10);
$pdf->SetFont('oldscript','',60);
$pdf->Cell(29.5, 2,iconv('UTF-8', 'windows-1252', $canil) , 0 , 1 , 'C' );





$pdf->SetXY(7.9,12.3);
$pdf->SetFont('COPRGTB','',12);
$pdf->Cell(16.5, 0.6, iconv('UTF-8', 'windows-1252',"Associado e apto a efetuar registros pelo sistema ALKC") , 0 , 1 , 'L' );
$pdf->SetXY(7.9,13.1);
$pdf->Cell(16.5, 0.6, iconv('UTF-8', 'windows-1252'," ") , 0 , 1 , 'L' );
$pdf->SetXY(4.9,13.9);
$pdf->SetFont('arial','',10);
$pdf->Cell(16.5, 0.6, iconv('UTF-8', 'windows-1252',$n_registro) , 0 , 1 , 'L' );
$pdf->SetXY(4.9,14.7);
$pdf->Cell(16.5, 0.6, iconv('UTF-8', 'windows-1252',$proprietario) , 0 , 1 , 'L' );
$pdf->SetXY(4.9,15.5);
$pdf->Cell(16.5, 0.6, iconv('UTF-8', 'windows-1252',$cidade_estado) , 0 , 1 , 'L' );
$pdf->SetXY(4.9,16.3);
$pdf->Cell(16.5, 0.6, iconv('UTF-8', 'windows-1252',$data_abertura) , 0 , 1 , 'L' );



//$pdf->Cell(16.5, 1, iconv('UTF-8', 'windows-1252',$validade) , 0 , 1 , 'L' );

 
$pdf->Output("arquivo.pdf","I");
		echo "<meta http-equiv='refresh' content='1;url=listagem_usuario.php'>";
?>
