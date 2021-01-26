<?php
define('FPDF_FONTPATH','./font');
require_once("fpdf.php");
require_once("../Connections/conexao.php");
$usr=$_GET['usr'];

$sql = "SELECT * FROM criadores join aprovados on criadores.id_criador=aprovados.id_criador where criadores.id_criador=$usr ORDER BY criadores.id_criador DESC ";
$query = mysql_query($sql) or die(mysql_error());
$linha = mysql_fetch_array($query);


$n_registro = 'Registro:'.$linha['id_criador'];
if($n_registro>21634)$n_registro = 'Registro:'.($linha['id_criador']-21634);

$proprietario = 'Proprietário(s) : '.$linha['nome'];

if($linha['sobrenome']!='')$proprietario=$proprietario.' e '.$linha['sobrenome'];
$cidade_estado  = 'Cidade/Estado : '.$linha['cidade']." / ". $linha['estado'];
$data_abertura  = 'Abertura: '.date("d/m/Y",$linha['data']);//= $linha['dia_assinatura']."/".$linha['mes_assinatura']."/".$linha['ano_assinatura'];
$canil = ucwords(strtolower($linha['nome_completo']));

$validade = $linha['dia_assinatura']."/".$linha['mes_assinatura']."/".($linha['ano_assinatura']+1);
//$validade  = date('d/m/Y', strtotime($validade));


 
$pdf= new FPDF("L","cm",array(30,21));
 
 

$pdf->AddFont('oldscript','','oldscript.php');


$pdf->AddPage();
 
//$pdf->Image('foto.jpg',0.81, 0.88 , 5.33 , 5.33);

$pdf->SetXY(6,7);
$pdf->SetFont('oldscript','',40);
$pdf->Cell(16.5, 2,iconv('UTF-8', 'windows-1252', 'Certificamos o Registro do Canil:') , 0 , 1 , 'C' );





$pdf->SetXY(5,9);
$pdf->SetFont('oldscript','',50);
$pdf->Cell(16.5, 2,iconv('UTF-8', 'windows-1252', $canil) , 0 , 1 , 'C' );





$pdf->SetXY(7.9,12.3);
$pdf->SetFont('arial','',14);
$pdf->Cell(16.5, 0.6, iconv('UTF-8', 'windows-1252',$n_registro) , 0 , 1 , 'L' );
$pdf->SetXY(7.9,13.1);
$pdf->Cell(16.5, 0.6, iconv('UTF-8', 'windows-1252',$proprietario) , 0 , 1 , 'L' );
$pdf->SetXY(7.9,13.9);
$pdf->Cell(16.5, 0.6, iconv('UTF-8', 'windows-1252',$cidade_estado) , 0 , 1 , 'L' );
$pdf->SetXY(7.9,14.7);
$pdf->Cell(16.5, 0.6, iconv('UTF-8', 'windows-1252',$data_abertura) , 0 , 1 , 'L' );
$pdf->SetXY(8.3,15.5);
//$pdf->Cell(16.5, 1, iconv('UTF-8', 'windows-1252',$validade) , 0 , 1 , 'L' );

 
$pdf->Output("arquivo.pdf","D");
		echo "<meta http-equiv='refresh' content='1;url=listagem_usuario.php'>";
?>
