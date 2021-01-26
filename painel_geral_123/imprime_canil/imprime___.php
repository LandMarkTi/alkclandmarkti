<?php
require_once("fpdf.php");
require_once("../Connections/conexao.php");
$usr=$_GET['usr'];

$sql = "SELECT * FROM criadores where id_criador=$usr ORDER BY id_criador DESC ";
$query = mysql_query($sql) or die(mysql_error());
$linha = mysql_fetch_array($query);

$n_registro = $linha['id_criador'];
$proprietario = $linha['nome'].' '.$linha['sobrenome'];
$cidade_estado  = $linha['cidade']." / ". $linha['estado'];
$data_abertura  = $linha['dia_assinatura']."/".$linha['mes_assinatura']."/".$linha['ano_assinatura'];
$canil = $linha['nome_completo'];

$validade = $linha['dia_assinatura']."/".$linha['mes_assinatura']."/".($linha['ano_assinatura']+1);
//$validade  = date('d/m/Y', strtotime($validade));


 
$pdf= new FPDF("L","cm",array(30,21));
 
 
$pdf->AddPage();
 
//$pdf->Image('foto.jpg',0.81, 0.88 , 5.33 , 5.33);

$pdf->SetXY(3,8.7);
$pdf->SetFont('arial','',20);
$pdf->Cell(16.5, 2,iconv('UTF-8', 'windows-1252', $canil) , 0 , 1 , 'C' );

$pdf->SetXY(6.8,11.7);
$pdf->SetFont('arial','',16);
$pdf->Cell(16.5, 1, iconv('UTF-8', 'windows-1252',$n_registro) , 0 , 1 , 'L' );
$pdf->SetXY(6.8,12.9);
$pdf->Cell(16.5, 1, iconv('UTF-8', 'windows-1252',$proprietario) , 0 , 1 , 'L' );
$pdf->SetXY(6.9,14.1);
$pdf->Cell(16.5, 1, iconv('UTF-8', 'windows-1252',$cidade_estado) , 0 , 1 , 'L' );
$pdf->SetXY(7.3,15.3);
$pdf->Cell(16.5, 1, iconv('UTF-8', 'windows-1252',$data_abertura) , 0 , 1 , 'L' );
$pdf->SetXY(7.7,16.5);
$pdf->Cell(16.5, 1, iconv('UTF-8', 'windows-1252',$validade) , 0 , 1 , 'L' );

 
$pdf->Output("arquivo.pdf","D");
		echo "<meta http-equiv='refresh' content='1;url=listagem_usuario.php'>";
?>
