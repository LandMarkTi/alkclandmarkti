<?php
require_once("fpdf.php");
 
$pdf= new FPDF("L","cm",array(30,21));
 
 
$pdf->AddPage();
 
//$pdf->Image('foto.jpg',0.81, 0.88 , 5.33 , 5.33);
$pdf->SetXY(7,12.5);
$pdf->SetFont('arial','',18);
$pdf->Cell(16.5, 1, 'N de registro' , 0 , 1 , 'L' );
$pdf->SetX(7);
$pdf->Cell(16.5, 1, 'Proprietário' , 0 , 1 , 'L' );
$pdf->SetX(7);
$pdf->Cell(16.5, 1, 'Cidade/Estado' , 0 , 1 , 'L' );
$pdf->SetX(7);
$pdf->Cell(16.5, 1, 'Data de abertura' , 0 , 1 , 'L' );
$pdf->SetX(8);
$pdf->Cell(16.5, 1, 'Proprietário' , 0 , 1 , 'L' );

/*$pdf->Cell(3.1, 1.66, 'RGF' , 1 , 0 , 'L' );
$pdf->Cell(10.34, 1.66, $RGF , 1 , 1 , 'L' );
$pdf->SetX(6.77);
$pdf->Cell(3.1, 1.66, 'CHIP' , 1 , 0 , 'L' );
$pdf->Cell(10.34, 1.66, $CHIP , 1 , 2 , 'L' );
$pdf->SetX(0.81);
$pdf->SetY(6.74);
$pdf->Cell(3.46, 1.23, 'Nome:' , 1 , 0 , 'L' );
$pdf->Cell(10.48, 1.23, $nome , 1 , 1 , 'L' );

$pdf->Cell(2.82, 1.23, 'Raça:' , 1 , 0 , 'L' );
$pdf->Cell(4.16, 1.23, $raca , 1 , 0 , 'L' );
$pdf->Cell(2.80, 1.23, 'Nasc:' , 1 , 0 , 'L' );
$pdf->Cell(4.16, 1.23, $nasc , 1 , 1 , 'L' );

$pdf->Cell(2.82, 1.23, 'Sexo:' , 1 , 0 , 'L' );
$pdf->Cell(4.16, 1.23, $sexo , 1 , 0 , 'L' );
$pdf->Cell(2.80, 1.23, 'Cor:' , 1 , 0 , 'L' );
$pdf->Cell(4.16, 1.23, $cor , 1 , 1 , 'L' );
  
$pdf->Cell(2.80, 1.23, 'Pai:' , 1 , 0 , 'L' );
$pdf->Cell(11.14, 1.23, $pai , 1 , 1 , 'L' );

$pdf->Cell(2.80, 1.23, 'Mãe:' , 1 , 0 , 'L' );
$pdf->Cell(11.14, 1.23, $mae , 1 , 1 , 'L' ); */ 

/*$pdf->SetX();
$pdf->SetAuthor();*/

//$pdf->Image('logo.jpg',15.03, 6.74 , 5.19 , 6.14);
 
 
 
$pdf->Output("arquivo.pdf","D");
?>