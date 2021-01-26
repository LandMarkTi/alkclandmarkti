<?php
session_start();
$ttl=time();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");
$ssid=(int)$_SESSION['id'];
if($ssid<=85||$ssid>200||$ssid==0)die("<script>location='index.php';</script>");

//todo: inserir foto usando dados jpg na pasta sobraci para banco.

//if($ttl>1559845085)die('<p> </p><script>location="index_principal.php";</script>');


$id =(int)$_POST['id'];

$t=(int)$_POST["tarjeta"];

//var_dump($pgs);

$serie=(int)$_POST['serie'];

if(isset($_POST['tarjeta'])==true)die("<script>location='./imprime_canil/tarja.php?id=".$id."&id_f=".$t."&se=$serie';</script>");

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


$pdf = new FPDF('L');
$pdf->SetMargins(0,0,0,0);


$border=0;
//consulta dados


$pgs=array("0" => 4);//$_POST["pgs"];

$id =83442;//(int)$_POST['id'];

$busca_f=implode(',',$pgs);

if(isset($_GET['pgs'])){
$pgs=array("0" =>$_GET["pgs"]);


$id =(int)$_GET['id'];

}




//echo "id =".$id;


//ajuste cota
$subcota=(int)sizeof($pgs);

//---if($subcota<8&&$_SESSION['id']!=17)$cc=mysql_query("update dados_credenciado set cota=cota-$subcota where id_dados=".$_SESSION['id']);//


$t_cota=mysql_query("select * from dados_credenciado  where id_dados=".$ssid);

$total_cota=mysql_fetch_array($t_cota);

//---if($total_cota['cota']<=0)die('<script>alert("Limite do Núcleo foi atingido, adicione mais no seu painel de Pedidos");history.go(-1);</script>');



/*serie


$serie=(int)$_POST['serie'];

$str_serie=addslashes($_POST['serie']);



if($_SESSION['id']==44||$_SESSION['id']==26){

$idc=$_SESSION['id'];
//testa serie

$t_query=mysql_query("select * from ped_serie where numero_serie='$str_serie' and status='livre' and id_credenciado='$idc' ") or die('err_pedserie');
$nt=(int)mysql_num_rows($t_query);

if($nt>=1){ mysql_query("update ped_serie set status='usado',id_ped='$id',id_filhote='$pgs[0]',data_add='".time()."' where numero_serie='$str_serie' and id_credenciado='$idc' "); }else {die('numero inválido ou usado');}
}else {

if($serie>0)mysql_query("insert into ped_serie values('',$_SESSION[id],$id,$pgs[0],$serie,'0','usado',".time().")");  

}

*/




$serie=11;//(int)$_POST['serie'];

$str_serie=11;//addslashes($_POST['serie']);


//testa serie

$idc=$_SESSION['id'];
//testa serie



//die('fim');

$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$id;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);
$cattxt=$linha_ped['regrasublocal'];


if($linha_ped['nomeSubcategoria']=='Teckel Pelo Longo')$linha_ped['nomeSubcategoria']='Teckel';


if($linha_ped['idSubcategoria']=='351'||$linha_ped['idSubcategoria']=='352')$linha_ped['nomeSubcategoria']='Chihuahua';

//if($linha_ped['idSubcategoria']=='351'||$linha_ped['idSubcategoria']=='352')$linha_ped['nomeSubcategoria']='Chihuahua';

//if($_SESSION['id']!=44&&($linha_ped['nomeSubcategoria']=='Old English Bulldog'))die('Raca Nao permitida!');


//puxar o id criador join credenciado e pegar o uso_canil ,colocando antes ou depois
$pref='';
$sulf='';

$sql_add="select * from criadores where id_criador=".$linha_ped['id_criador'];
$qr_criador=mysql_query($sql_add);
$fc=mysql_fetch_assoc($qr_criador);

if($fc['uso_canil']=='sulfixo')$sulf=' '.$fc['nome_completo'].' '; else $pref=' '.$fc['nome_completo'].' ';


//ajuste proprietário

if($fc['sobrenome']==''){} else $fc['nome'].=' e '.$fc['sobrenome'];

//ajuste sem transf..
if(substr($linha_ped['registro'],0,4)!='RG/E'&&$linha_ped['id_ped']!=79796 )$linha_ped['proprietario']=$fc['nome'];



//caso externo

if(substr($linha_ped['registro'],0,3)=='RGE'||substr($linha_ped['registro'],0,4)=='RG/E'){$sulf='';$pref='';}

if($linha_ped['id_ped']==72321)$linha_ped['criador']='Cathie Warren & Michael A Odegaard';

$linha_ped['nasc']=date("d/m/Y",$linha_ped['nasc']);

$linha_ped['emissao']=date("d/m/Y",$linha_ped['emissao']);

//$linha_ped['endereco']=substr($linha_ped['endereco'],0,60);

//loop filhotes

$nloop=explode(';', $linha_ped['ninhada']);

$pf=$value;
$cf=0;
foreach($nloop as $k => $v){ if($k>3 &&$k!=$pf&& $v!='nome filhote')$cf++;else if($k>3)break; }

//ajustes

//$e1x=array_shift($nloop);
//$e2x=array_shift($nloop);
//$e3x=array_shift($nloop);
//$e4x=array_shift($nloop);

$lista_nomes=$nloop;

$sx=explode(';',$linha_ped['sexo']);
$cor=explode(';', $linha_ped['cor']);
$micro=explode(';', $linha_ped['nº microchip']);
while($ele=array_shift($pgs)){

$c1=explode('*',$cor[$ele-4]);
$var=$c1[1];
$coratual=iconv('UTF-8', 'windows-1252', $c1[0]);

$linha_ped['nomeSubcategoria']=$linha_ped['nomeSubcategoria'].' '.$var;

$sexoatual=iconv('UTF-8', 'windows-1252', $sx[$ele-4]);
$linha_ped['nº microchip']=$micro[$ele-4];

$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->SetFont('Arial','',8);

$linha_ped['nome']=$pref.$lista_nomes[$ele].$sulf;

//transf
$tr="select * from pedigre_trocados where id_ped=$id and id_f=$ele order by id_ped desc";

$r_t=mysql_query($tr);
$ft=mysql_fetch_assoc($r_t);
$nt=mysql_num_rows($r_t);


//privacidade

$qp=mysql_query("select * from privacidade where id_criador=".$linha_ped['id_criador']);

$np=mysql_num_rows($qp);

if($np>=1){$linha_ped['endereco']=$fc['cidade'].' - '.$fc['estado'];}




if($nt>=1){
$linha_ped['endereco']=mb_strtoupper(trim($ft['endereco']), 'UTF-8');
$linha_ped['proprietario']=mb_strtoupper(trim($ft['proprietario']), 'UTF-8');
}


if($sexoatual=='Masc')$linha_ped['genero']='MACHO'; else $linha_ped['genero']='FEMEA';
//$linha_ped['variedade']=iconv('UTF-8', 'windows-1252', $coratual);
$linha_ped['registro']=$linha_ped['registro'].$cf;//só por um indice .$ele
$linha_ped['regrasublocal']=html_entity_decode(strip_tags($linha_ped['regrasublocal']),ENT_QUOTES,'UTF-8');

//consulta dos campos utf8_decode
$sql="SELECT * FROM `gabarito_crg2` where id_gab<>17 and id_gab<>16 and id_gab<>11 and id_gab<>7 and id_gab<>10";
$qr=mysql_query($sql);
while($l=mysql_fetch_assoc($qr)){
$pdf->SetFont('Arial','',$l['tam']);
$pdf->SetXY($l['px'],$l['py']);
$pdf->MultiCell($l['largura'],$l['altura'],iconv('UTF-8', 'windows-1252', mb_strtoupper($linha_ped[$l['nome']], 'UTF-8')),$border,'c',false);

}
//cor 

$pdf->SetFont('Arial','',8);
//$pdf->SetXY(16,64);nasc genero e emissa foi somado 2mm, na cor soma 3
$pdf->SetXY(16,66);

$pdf->Cell(55,10,mb_strtoupper($coratual, 'ISO-8859-1'),$border,0,'c');



//laudo


$vl=array("","HD-","HD +/-","HD +","HD ++","HD +++","","","DNA Profile");

$ql=mysql_query("select * from foto_laudos where id_ped=".$id." and id_f =".$ele." and (resultado <= 5) order by id_foto desc");
$nl=mysql_num_rows($ql);
$ll=mysql_fetch_assoc($ql);
if($nl>=1){

$pdf->SetFont('Arial','',8);
$pdf->SetXY(205,58);
$pdf->Cell(55,10,mb_strtoupper($vl[$ll['resultado']], 'ISO-8859-1'),$border,0,'c');


} else {

$pdf->SetFont('Arial','',8);
$pdf->SetXY(205,58);
$pdf->Cell(55,10,mb_strtoupper($linha_ped['amigo'], 'ISO-8859-1'),$border,0,'c');


}

$ql2=mysql_query("select * from foto_laudos where id_ped=".$id." and id_f =".$ele." and (resultado = 8) order by id_foto desc");
$nl2=mysql_num_rows($ql2);
$ll2=mysql_fetch_assoc($ql2);
if($nl2>=1){

$pdf->SetFont('Arial','',8);
$pdf->SetXY(224,58);
$pdf->Cell(55,10,mb_strtoupper($vl[$ll2['resultado']], 'ISO-8859-1'),$border,0,'c');

} else {

$pdf->SetFont('Arial','',8);
$pdf->SetXY(204,64);
$pdf->MultiCell(60,5,iconv('UTF-8', 'windows-1252',$linha_ped['obs']),$border,'c');

}




$i=1;
$offx=-5;//borda
$largs=array(0,45,45,45,102);
$offy=array(0,21,9,3,);

$p=explode(';',iconv('UTF-8', 'windows-1252', $linha_ped['parentes']));

$tamanhoInicial=8;
while($i<=4){
	$j=0;
	$offx+=$largs[$i-1]+(24/$i);
	$pdf->SetFont('Arial','',$tamanhoInicial);
	while($j<pow(2,$i)){
		$pdf->SetXY($offx,80.0 +$offy[$i]+((95/pow(2,$i))+0.2)*$j);
		//echo "<br>x:".$offx." Y:".(106.5+(95/16)*$j).'p:'.pow(2,$i);
		$parr=mb_strtoupper(str_pad(str_replace(',',"\n",str_replace('digite o nome..','XXXXXXXXXXXXXXX',array_shift($p))),50,' '),'ISO-8859-1');
		$pdf->MultiCell($largs[$i],3,$parr,$border,'L');//era 56
		//$pdf->MultiCell($largs[$i],95/16,'off',$border,'L');//era 56
		$j++;
	}
	if($tamanhoInicial>7)$tamanhoInicial--;
	$i++;
}

$pdf->Image('assinatura.png',$offx+20,175,50,30,'PNG');

	$pdf->SetFont('Arial','',6);
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
$pdf->SetFont('Arial','',6);

$largs=array(0,0,7,8,29.5,29.5,29.5,28.5,29.5);
$h=5;

$i=1;
$px=42.5;
/*
while($i<=7){
$j=0;
$px+=$largs[$i]+0;
while($j<4){
		
		$pdf->SetXY($px,79.0+5.0*$j);
		$pdf->Cell($largs[$i+1],5.0,substr(str_replace('NOME FILHOTE','XXXX',mb_strtoupper(array_shift($n),'ISO-8859-1')),0,19),$border,0,'c');
		$j++;}


$i++;

}*/



//texto ped

$pdf->SetFont('Arial','',8);

$pdf->SetXY(7,205);
//$pdf->MultiCell(195,3,iconv('UTF-8', 'windows-1252', substr(str_replace("\n","",$linha_ped['regrasublocal']),0,3200)),$border,'L');

//foto
//$sql_fot="SELECT * FROM  `foto_ped` where id_ped=$id and id_f=".($value-4)." ORDER BY id_foto DESC";
//$qrf=mysql_query($sql_fot);
//$lin=mysql_fetch_assoc($qrf);
//$nnn=mysql_num_rows($qrf);
//if($nnn>=1)

$file='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://rgpetsystem.club/ver_carteirinha.php?id=4010';
$pdf->Image('chaves.png',62,79,120,97,'PNG');
}


//frente

$pdf->AddPage('L');

//era 159 na outra grafica, add 1 de tudo na frente do x
$pdf->SetFont('Arial','',11);
$pdf->SetXY(160,136);
$pdf->MultiCell(150,9,iconv('UTF-8', 'windows-1252', mb_strtoupper(trim($linha_ped['nome']), 'UTF-8')),$border,'c',false);


//registro
$pdf->SetFont('Arial','',11);
$pdf->SetXY(160,150);
$pdf->MultiCell(150,9,iconv('UTF-8', 'windows-1252', mb_strtoupper($linha_ped['registro'], 'UTF-8')),$border,'c',false);


//raca
$pdf->SetFont('Arial','',11);
$pdf->SetXY(160,159);
$pdf->MultiCell(150,9,iconv('UTF-8', 'windows-1252', mb_strtoupper($linha_ped['nomeSubcategoria'], 'UTF-8')),$border,'c',false);


//genero
$pdf->SetFont('Arial','',11);
$pdf->SetXY(160,168);
$pdf->MultiCell(40,9,iconv('UTF-8', 'windows-1252', mb_strtoupper($linha_ped['genero'], 'UTF-8')),$border,'c',false);


//nasc
$pdf->SetFont('Arial','',11);
$pdf->SetXY(160,177);
$pdf->MultiCell(40,9,iconv('UTF-8', 'windows-1252', mb_strtoupper($linha_ped['nasc'], 'UTF-8')),$border,'c',false);


//micro
$pdf->SetFont('Arial','',11);
$pdf->SetXY(160,186);
$pdf->MultiCell(70,9,iconv('UTF-8', 'windows-1252', mb_strtoupper($linha_ped['nº microchip'], 'UTF-8')),$border,'c',false);



//cor 

$pdf->SetFont('Arial','',11);
$pdf->SetXY(198,168);
$pdf->Cell(55,9,mb_strtoupper(str_replace('Escolha a cor..','',$coratual), 'ISO-8859-1'),$border,0,'c');

//pais


//pais
$pdf->SetFont('Arial','',11);
$pdf->SetXY(198,177);
if($id==93188){
$pdf->MultiCell(40,9,iconv('UTF-8', 'windows-1252', mb_strtoupper('Portugal', 'UTF-8')),$border,'c',false);
} else {
$pdf->MultiCell(40,9,iconv('UTF-8', 'windows-1252', mb_strtoupper('Brazil', 'UTF-8')),$border,'c',false);

}
//adendo


$qob=mysql_query("select * from frase where 1");
$nlo=mysql_num_rows($qob);
$lob=mysql_fetch_assoc($qob);


$pdf->SetFont('Arial','',11);
$pdf->SetXY(15,150);
if(!isset($_POST['dizer'])&&$_SESSION['id']!=89)$pdf->MultiCell(120,9,iconv('UTF-8', 'windows-1252', mb_strtoupper($lob['nomeCategoria'], 'UTF-8')),$border,'c',false);




$pdf->Output();

?>
