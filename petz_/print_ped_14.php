<?php
session_start();

//todo: inserir foto usando dados jpg na pasta sobraci para banco.

require('./fpdf17/fpdf.php');
//require_once("Connections/conexao.php");

$hostname_conexao = "186.202.152.41:3306";
$database_conexao = "megapedigree_banco";
$username_conexao = "megap_neoware";
$password_conexao = "megap123";
$conexao = mysql_pconnect($hostname_conexao, $username_conexao, $password_conexao) or die(mysql_error());
mysql_select_db($database_conexao, $conexao);
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');


$pdf = new FPDF();
$pdf->SetMargins(5,5,5,5);


$border=0;
//consulta dados


$pgs=$_POST["pgs"];

$busca_f=implode(',',$pgs);

$id =(int)$_POST['id'];
//echo "id =".$id;

//echo "insert into ped_vias values('',$id,".time().",".$_SESSION['id'].",1)";

foreach($pgs as $key=>$value){//value
$verifica="select * from ped_vias2 where id_user=".$id ." and i_filhote =".$value;
$vr=mysql_query($verifica)or die('f1');
$fr=mysql_fetch_assoc($vr);
$nr=mysql_num_rows($vr);
if ($nr>0&&$fr['conta_via']==2)die('<script>alert("Limite de impressão atingido!");history.go(-1);</script>');
if ($nr>0&&$fr['conta_via']==1)mysql_query('update ped_vias2 set conta_via=2 where id_user='.$id." and i_filhote =".$value);else mysql_query("insert into ped_vias2 values('',$id,".time().",".$_SESSION['id'].",1,$value)");
}
//ajuste cota
$subcota=sizeof($pgs);
$cc=mysql_query("update dados_credenciado set cota=cota-$subcota where id_dados=".$_SESSION['id']);


//die('fim');

$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$id;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);
$cattxt=$linha_ped['regrasublocal'];

$linha_ped['nasc']=date("d/m/Y",$linha_ped['nasc']);

$linha_ped['emissao']=date("d/m/Y",$linha_ped['emissao']);

//loop filhotes

$nloop=explode(';', $linha_ped['ninhada']);



//ajustes

//$e1x=array_shift($nloop);
//$e2x=array_shift($nloop);
//$e3x=array_shift($nloop);
//$e4x=array_shift($nloop);

$lista_nomes=$nloop;

$sx=explode(';',$linha_ped['sexo']);
$cor=explode(';', $linha_ped['cor']);

while($ele=array_shift($pgs)){
$coratual=iconv('UTF-8', 'windows-1252', $cor[$ele-4]);
$sexoatual=iconv('UTF-8', 'windows-1252', $sx[$ele-4]);

$pdf->AddPage();
$pdf->SetFont('Arial','B',8);

$linha_ped['nome']=$lista_nomes[$ele];

if($sexoatual=='Masc')$linha_ped['genero']='MACHO'; else $linha_ped['genero']='FEMEA';
$linha_ped['variedade']=iconv('UTF-8', 'windows-1252', $coratual);
$linha_ped['registro']=$linha_ped['registro'].'-'.$ele;//só por um indice .$ele
$linha_ped['regrasublocal']=html_entity_decode(strip_tags($linha_ped['regrasublocal']),ENT_QUOTES,'UTF-8');
//consulta dos campos utf8_decode
$sql="SELECT * FROM `gabarito_crg` where id_gab<>17 and id_gab<>16";
$qr=mysql_query($sql);
while($l=mysql_fetch_assoc($qr)){

$pdf->SetXY($l['px'],$l['py']);
$pdf->Cell($l['largura'],$l['altura'],strtoupper(iconv('UTF-8', 'windows-1252', $linha_ped[$l['nome']])),$border,0,'c');

}
//cor 

$pdf->SetXY(83,39);
$pdf->Cell(55,10,strtoupper(iconv('UTF-8', 'windows-1252', $coratual)),$border,0,'c');


//4	104	33	95 

$i=1;
$offx=5;//borda
$largs=array(0,32,37,38,82);
$p=explode(';',iconv('UTF-8', 'windows-1252', $linha_ped['parentes']));

$tamanhoInicial=8;
while($i<=4){
	$j=0;
	$offx+=$largs[$i-1]+2;
	$pdf->SetFont('Arial','B',$tamanhoInicial);
	while($j<pow(2,$i)){
		$pdf->SetXY($offx,105.5+((95/pow(2,$i))+0.2)*$j);
		//echo "<br>x:".$offx." Y:".(106.5+(95/16)*$j).'p:'.pow(2,$i);
		$pdf->MultiCell($largs[$i],95/16,strtoupper(str_pad(str_replace('digite o nome..','XXXXXXXXXXXXXXX',array_shift($p)),50,' ')),$border,'L');//era 56
		$j++;
	}
	if($tamanhoInicial>6)$tamanhoInicial--;
	$i++;
}

	$pdf->SetFont('Arial','B',6);
$n=explode(';',iconv('UTF-8', 'windows-1252', $linha_ped['ninhada']));
//ajustes
$e1=array_shift($n);
$e2=array_shift($n);
$e3=array_shift($n);
$e4=array_shift($n);



array_unshift($n,$e4);

array_unshift($n,'');

array_unshift($n,$e2);

array_unshift($n,'');

array_unshift($n,$e3);

array_unshift($n,'');

array_unshift($n,$e1);

array_unshift($n,'');


//39 	76 	167 	22
$pdf->SetFont('Arial','B',6);

$largs=array(0,0,7,10,29.5,29.5,29.5,28.5,29.5);
$h=5;

$i=1;
$px=40.5;
while($i<=7){
$j=0;
$px+=$largs[$i]+0;
while($j<4){
		
		$pdf->SetXY($px,79.0+5.0*$j);
		$pdf->Cell($largs[$i+1],5.0,substr(str_replace('NOME FILHOTE','',strtoupper(array_shift($n))),0,20),$border,0,'c');
		$j++;}


$i++;

}



//texto ped

$pdf->SetFont('Arial','B',5);

$pdf->SetXY(7,205);
$pdf->MultiCell(195,5,iconv('UTF-8', 'windows-1252', str_replace("\n","",$linha_ped['regrasublocal'])),$border,'L');

//foto
$sql_fot="SELECT * FROM  `foto_ped` where id_ped=$id ORDER BY id_foto DESC";
$qrf=mysql_query($sql_fot);
$lin=mysql_fetch_assoc($qrf);
$nnn=mysql_num_rows($qrf);
if($nnn>=1)$pdf->Image('./images/pedigree/'.rawurldecode($lin['arquivo']),8,67,32,32);
}



$pdf->Output();

?>
