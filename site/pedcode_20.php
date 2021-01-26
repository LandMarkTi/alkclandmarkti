<?php

//todo: inserir foto usando dados jpg na pasta sobraci para banco.

//require('./fpdf17/fpdf.php');



require_once('./Connections/conexao.php');
mysql_select_db($database_conexao, $conexao);



$border=0;
//consulta dados

if(isset($_GET['code'])){
$qc="select * from qrcode where qrcode=".$_GET['code'].' order by id_code desc';

$rcode=mysql_query($qc) or die('22');
$ncode=mysql_num_rows($rcode);
$dcode=mysql_fetch_assoc($rcode);

//if($ncode<1|| $dcode['id_filhote']==0)die('code')//die('<script>location=\'http://www.megapedigree.com/painel_geral_123/imprime_rgc/ver_carteirinha.php?code='.$_GET['code'].'\';</script>');

$pgs=(int)$dcode["id_filhote"];

//$busca_f=Array("$pgs");

$id =(int)$dcode['id_ped'];
}else{

$pgs=(int)$_GET["id_filhote"];



$id =(int)$_GET['id_ped'];

}

//echo "id =".$id;

//echo "insert into ped_vias values('',$id,".time().",".$_SESSION['id'].",1)";

$verifica="select * from ped_vias2 where id_user=".$id ." and i_filhote =".$pgs;
$vr=mysql_query($verifica)or die('f1');
$fr=mysql_fetch_assoc($vr);
$nrv=mysql_num_rows($vr);

if($nrv<1){

//verifica tarja
$q_seriet=mysql_query("SELECT * FROM ped_serie_a where id_ped=$id and id_filhote=".$pgs);
$f_seriet=mysql_fetch_assoc($q_seriet);
$ntar=mysql_num_rows($q_seriet);
if($ntar<1 && $id> 72756 && $id!=74776 && $id!=74775 && is_null($_GET['r']))die('Documento nao foi habilitado');


}
//inicio
if(!isset($_GET['bt'])) $hi= ';overflow: hidden';;
echo "<html><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><style>@media print { .noprint {display: none !important;}}</style><body oncontextmenu='return false;' style='font-size: 8;height:22cm;width: 17cm;<?=$hi?>'><div style=\"background-image:url('http://www.megapedigree.com/site/certificadoped2.jpg');background-repeat:no-repeat;background-size: 98% 98%;font-size:11px;overflow:hidden;width:29.0cm;height:21cm;margin:-4px;padding:0px\">";

$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$id;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);
$cattxt=$linha_ped['regrasublocal'];

$linha_ped['nasc']=date("d/m/Y",$linha_ped['nasc']);

$linha_ped['emissao']=date("d/m/Y",$linha_ped['emissao']);

//loop filhotes

$nloop=explode(';', $linha_ped['ninhada']);

//puxar o id criador join credenciado e pegar o uso_canil ,colocando antes ou depois
$pref='';
$sulf='';

$sql_add="select * from criadores where id_criador=".$linha_ped['id_criador'];
$qr_criador=mysql_query($sql_add);
$fc=mysql_fetch_assoc($qr_criador);

if($fc['uso_canil']=='sulfixo')$sulf=' '.$fc['nome_completo'].' '; else $pref=' '.$fc['nome_completo'].' ';



//ajustes

//$e1x=array_shift($nloop);
//$e2x=array_shift($nloop);
//$e3x=array_shift($nloop);
//$e4x=array_shift($nloop);

$lista_nomes=$nloop;

$sx=explode(';',$linha_ped['sexo']);
$cor=explode(';', $linha_ped['cor']);
$micro=explode(';', $linha_ped['nº microchip']);

//while($ele=array_shift($pgs)){

$ele=$pgs;
$coratual= $cor[$ele-4];
$sexoatual=$sx[$ele-4];
$linha_ped['nº microchip']=$micro[$ele-4];

//privacidade


$qp=mysql_query("select * from privacidade where id_criador=".$linha_ped['id_criador']);

$np=mysql_num_rows($qp);

if($np>=1){$linha_ped['endereco']=$fc['cidade'].' - '.$fc['estado'];}

//transf
$tr="select * from pedigre_trocados where id_ped=$id and id_f=$pgs order by id_ped desc";

$r_t=mysql_query($tr);
$ft=mysql_fetch_assoc($r_t);
$nt=mysql_num_rows($r_t);

if($nt>=1){
$linha_ped['endereco']=$ft['endereco'];
$linha_ped['proprietario']=$ft['proprietario'];
}



//$pdf->AddPage();
//$pdf->SetFont('Arial','B',8);

//rgeo nao tem sufixo

$linha_ped['nome']=$pref.$lista_nomes[$ele].$sulf;

if(substr($linha_ped['registro'],0,4)=='RGE '||substr($linha_ped['registro'],0,4)=='RGEO'||substr($linha_ped['registro'],0,4)=='RG/E')$linha_ped['nome']=$lista_nomes[$ele];

//if($linha_ped['id_ped']==72321)$linha_ped['criador']='Cathie Warren & Michael A Odegaard';

if($sexoatual=='Masc')$linha_ped['genero']='MACHO'; else $linha_ped['genero']='FEMEA';


$linha_ped['variedade']= str_replace('Escolha a cor..','',$coratual);


$vcor=explode('*',$coratual);

$coratual=$vcor[0];

$var=$vcor[1];

if($linha_ped['nomeSubcategoria']=='Teckel Pelo Longo')$linha_ped['nomeSubcategoria']='Teckel';

$linha_ped['nomeSubcategoria']=$linha_ped['nomeSubcategoria'].' '.$var;

$dfinal=$ele-4;
$linha_ped['registro']=$linha_ped['registro'].''.$dfinal;//só por um indice .$ele
$linha_ped['regrasublocal']=html_entity_decode(strip_tags($linha_ped['regrasublocal']),ENT_QUOTES,'UTF-8');
//consulta dos campos utf8_decode
$sql="SELECT * FROM `gabarito_crg2` where id_gab<>17 and id_gab<>16 and id_gab<>11 and id_gab<>7 and id_gab<>10";
$qr=mysql_query($sql);
while($l=mysql_fetch_assoc($qr)){

if($l['nome']=='nome')$l['py']='38';

if($l['nome']=='nomeSubcategoria')$l['py']='50';

if($l['nome']=='proprietario')$l['py']='47';

if($l['nome']=='nasc'||$l['nome']=='genero'||$l['nome']=='emissao')$l['py']='59';

if($l['nome']=='nº microchip')$l['py']='50';
//$pdf->SetXY($l['px'],$l['py']);
//$pdf->Cell($l['largura'],$l['altura'],strtoupper(iconv('UTF-8', 'windows-1252', $linha_ped[$l['nome']])),$border,0,'c');
echo "<div class='noprint' style='position:absolute;left:".$l['px']."mm;top:".$l['py']."mm;width:".$l['largura']."mm;height:".$l['altura']."mm;font-size:13px'>".$linha_ped[$l['nome']]."</div>";

}
//cor 

//$pdf->SetXY(83,39);
//$pdf->Cell(55,10,strtoupper(iconv('UTF-8', 'windows-1252', $coratual)),$border,0,'c');
echo "<div class='noprint' style='position:absolute;left:16mm;top:67mm;width:55mm;height:10mm'>".strtoupper(str_replace('Escolha a cor..','',$coratual))."</div>";

//4	104	33	95 

$i=1;
$offx=0;//borda
$largs=array(0,45,45,45,95);
$offy=array(0,21,9,3,);

$p=explode(';', $linha_ped['parentes']);

$tamanhoInicial=11;//7
while($i<=4){
	$j=0;
	$offx+=$largs[$i-1]+(20/$i);
	//$pdf->SetFont('Arial','B',$tamanhoInicial);
	while($j<pow(2,$i)){
		//$pdf->SetXY($offx,105.5+((95/pow(2,$i))+0.2)*$j);
		//$pdf->MultiCell($largs[$i],95/16,strtoupper(str_pad(str_replace('digite o nome..','XXXXXXXXXXXXXXX',array_shift($p)),50,' ')),$border,'L');//era 56
		echo "<div class='noprint' style='position:absolute;left:".$offx."mm;top:".(75.0 +$offy[$i]+((95/pow(2,$i))+0.2)*$j)."mm;width:".$largs[$i]."mm;height:".(95/16)."mm;font-size:$tamanhoInicial'>".strtoupper(str_pad(str_replace(',','<br>',str_replace('digite o nome..','XXXXXXXXXXXXXXX',str_replace('\n','<br>',array_shift($p)))),50,' '))."</div>";
		$j++;
	}
	if($tamanhoInicial>10)$tamanhoInicial--;
	$i++;
}

	//$pdf->SetFont('Arial','B',6);
$n=explode(';',$linha_ped['ninhada']);
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
//$pdf->SetFont('Arial','B',6);

$largs=array(0,0,8,8,29.5,29.5,29.5,28.5,29.5);
$h=5;

$i=1;
$px=42.5;




//texto ped

//$pdf->SetFont('Arial','B',5);

//$pdf->SetXY(7,205);
//$pdf->MultiCell(195,5,iconv('UTF-8', 'windows-1252', str_replace("\n","",$linha_ped['regrasublocal'])),$border,'L');
		//echo "<div style='position:absolute;left:7mm;top:205mm;width:195mm;height:6mm'>". str_replace("\n","",$linha_ped['regrasublocal'])."</div>";


//foto
$sql_fot="SELECT * FROM  `foto_ped` where id_ped=$id ORDER BY id_foto DESC";
$qrf=mysql_query($sql_fot);
$lin=mysql_fetch_assoc($qrf);
$nnn=mysql_num_rows($qrf);
//if($nnn>=1)$pdf->Image('./images/pedigree/'.rawurldecode($lin['arquivo']),8,67,32,32);



$q_serie=mysql_query("SELECT * FROM ped_serie_a where id_ped=$id and tipo_serie=0 and id_filhote=$pgs ");
$f_serie=mysql_fetch_assoc($q_serie);
$csa=mysql_num_rows($q_serie);
//ajuste antigos

if ($csa<1){

$q_serie=mysql_query("SELECT * FROM ped_serie where id_ped=$id and id_filhote=$pgs ");
$f_serie=mysql_fetch_assoc($q_serie);

}

//echo "<div style='position: absolute;left: 155mm;top: 286mm;color:red;'>$f_serie[numero_serie]</div>";
//foto:
//if($id==19692)echo '<img src="./images/pedigree/IMG_20150901_HDR.jpg" style="position:absolute;top:65mm;left:8mm;width:22mm;">';

 //if(isset($_GET['bt'])) echo '<p ><form style="position: absolute;top: 796px;" method="post" action="env_perm.php">Habilitar:<input type="hidden" name="id_filhote" value="'.$pgs.'"><input type="hidden" name="id_ped" value="'.$id.'"><select name="upgr"><option value="0">Tarjeta</option><option value="1">Tarjeta+Pedigree</option><option value="2">Transferência</option></select><input type="submit"></form></p>';

//laudo
$vl=array("","HD-","HD +/-","HD +","HD ++","HD +++","","","DNA Profile");

$ql=mysql_query("select * from foto_laudos where id_ped=".$id." and id_f =".$pgs." and (resultado <= 5) order by id_foto desc");
$nl=mysql_num_rows($ql);
$ll=mysql_fetch_assoc($ql);
if($nl>=1)echo "<div style='position: absolute;
left: 204mm;
top: 61mm;
width: 50mm;
height: 10mm;
font-size: 13px;'>".$vl[$ll['resultado']]."</div>";


$ql2=mysql_query("select * from foto_laudos where id_ped=".$id." and id_f =".$pgs." and (resultado = 8) order by id_foto desc");
$nl2=mysql_num_rows($ql2);
$ll2=mysql_fetch_assoc($ql2);
if($nl2>=1)echo "<div style='position: absolute;
left: 224mm;
top: 61mm;
width: 50mm;
height: 10mm;
font-size: 13px;'>".$vl[$ll2['resultado']]."</div>";




echo "<div  style='width: 29.5cm;
height: 21cm;
display: block;
position: absolute;
top: 0;
left: 0;'></div>
<span style='background: lightblue none repeat scroll 0% 0%;
width: 100px;
height: 28px;
display: block;
top: 685px;
position: relative;
left: 155px;
font-size: 18px;
text-align: center;
border-top: 7px solid lightblue;
'>$f_serie[numero_serie]</span>
</body></html>";

?>
