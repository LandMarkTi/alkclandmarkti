<?php
require_once("fpdf.php");
require_once("../Connections/conexao.php");
$id = (int)$_GET['id'];



$sql = "select *,DATE_FORMAT(nascimento,'%d/%m/%y') as nasci from rgc left join castrado on id=id_rgc where id = $id";
$query = mysql_query($sql) or die (mysql_error());
$l = mysql_fetch_array($query);

$nncode=mysql_num_rows($query);
if($nncode<1)die('Não Encontrado.');


if(substr($l['crmv'],0,1)=='L'||substr($l['crmv'],0,1)=='O'||substr($l['crmv'],0,1)=='C')$l['crmv']='-';



//if($l['pago']==1)die('Pagamento Pendente. ');
$pdf= new FPDF("P","cm",array(21,30));
 
 
$pdf->SetMargins(2,2,2,2);

$pdf->AddPage();
 
$file='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://rgpetsystem.club/ver_carteirinha.php?id='.$id;



//copy($file, './qr/code.jpg');




$pdf->Image($file,14.0, 0.8 , 4 , 4,'PNG');



if(is_file('../'.$l['foto']))$pdf->Image('../'.$l['foto'],0.6, 0.6 , 3 , 3);

$pdf->SetXY(4.9,2.0);
$pdf->SetFont('arial','',9);
$pdf->Cell(5.6, 0.7,iconv('UTF-8', 'windows-1252', $id) , 0 , 1 , 'L' );


$pdf->SetXY(5.4,2.5);
$pdf->SetFont('arial','',9);
$pdf->Cell(5.5, 0.8,iconv('UTF-8', 'windows-1252', $l['microchip']) , 0 , 1 , 'L' );



$pdf->SetXY(5.7,3.0);
$pdf->SetFont('arial','',9);
$pdf->Cell(5.5, 0.8,iconv('UTF-8', 'windows-1252', trim($l['crmv'])) , 0 , 1 , 'L' );

$pdf->SetXY(8.1,3.5);
$pdf->SetFont('arial','',9);
$pdf->Cell(3.5, 0.8,iconv('UTF-8', 'windows-1252', trim($l['nasci'])) , 0 , 1 , 'L' );


$pdf->SetXY(2.0,3.5);
$pdf->SetFont('arial','',9);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim(substr($l['nome_cao'],0,21))) , 0 , 1 , 'L' );

$pdf->SetXY(2.0,4.0);
$pdf->SetFont('arial','',9);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim($l['raca'])) , 0 , 1 , 'L' );

$pdf->SetXY(2.0,4.5);
$pdf->SetFont('arial','',9);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim($l['sexo'])) , 0 , 1 , 'L' );


$pdf->SetXY(1.5,4.9);
$pdf->SetFont('arial','',9);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim($l['pai'])) , 0 , 1 , 'L' );


$pdf->SetXY(1.7,5.4);
$pdf->SetFont('arial','',9);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', trim($l['mae'])) , 0 , 1 , 'L' );


$pdf->SetXY(0.4,6);
$pdf->SetFont('arial','',9);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', $l['tipo'].' '.$l['valor']) , 0 , 1 , 'L' );



$pdf->SetXY(5.4,4.5);
$pdf->SetFont('arial','',9);
$pdf->Cell(9.5, 0.8,iconv('UTF-8', 'windows-1252', $l['cor']) , 0 , 1 , 'L' );

 
$pdf->Output("arquivo".$id.".pdf","D");
		//echo "<meta http-equiv='refresh' content='1;url=listagem_usuario.php'>";
?>
