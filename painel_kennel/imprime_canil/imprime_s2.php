<?php
session_start();

require_once("../Connections/conexao.php");
require __DIR__ . '/../classes/utils/EnviaMail.php';


$usr=$_GET['usr'];

$sql = "SELECT * FROM criadores join aprovados on criadores.id_criador=aprovados.id_criador where criadores.id_criador=$usr ORDER BY criadores.id_criador DESC ";
$query = mysql_query($sql) or die(mysql_error());
$linha = mysql_fetch_array($query);
//serie

$ssid=(int)$_SESSION['id'];
if($ssid<=85||$ssid>200||$ssid==0)die("<script>location='index.php';</script>");


$str_serie=addslashes($_GET['serie']);

$t_query=mysql_query("select * from ped_serie_cert where numero_serie='$str_serie' and status='usado' and tipo_serie='1' and id_credenciado='$ssid' ") or die('err_pedserie');
$nt=(int)mysql_num_rows($t_query);

$t_query2=mysql_query("select * from ped_serie_cert where numero_serie='$str_serie' and status='livre' and tipo_serie='1' and id_credenciado='$ssid' ") or die('err_pedserie2');
$livre=(int)mysql_num_rows($t_query2);



if($livre>=1&&$nt<1){

 $upp=mysql_query("update ped_serie_cert set status='usado',id_ped='$usr',id_filhote='1',data_add='".time()."' where numero_serie='$str_serie' and id_credenciado='$ssid' and tipo_serie='1'") or die('opaa');
$nup=(int)mysql_num_rows($upp);



$id = (int)$usr;
//echo "id =".$id;
$sqlx = "insert into aprovados values('',$id,".time().",".$_SESSION['id'].")";

mysql_query($sqlx) or die('e1');



$em="SELECT * FROM `criadores` where id_criador=".$id;
$qr=mysql_query($em);
$f=mysql_fetch_assoc($qr);
$psw=$f['senha'];
$ps="update `criadores` set senha='".$psw."' ano_assinatura='2018', mes_assinatura='".date('m')."',dia_assinatura='".date('d')."' where id_criador=".$id;

$qrp=mysql_query($ps);

$ass='Senha Criador ALKC';
$msg="Olá ";
$msg.=$f['Nome'];
$msg.="Para acessar o sistema use os dados abaixo.\n";
$msg.='login:'.$f['email'];
$msg.="\n\n";
$msg.='Senha:'.$psw."\n";
$msg.="\n\n";
//$msg.='Certificado: http://www.megapedigree.com/site/busca_canil.php?usr='.$id."\n";
//$msg.="\n\n";
$msg.="Enviado pelo sistema ALKC ";
$msg.="\n";

$para=$f['email'];

	$mail = new EnviaMail;
	$mail->Enviar('sistema@crgabrasil.org', 'SISTEMA ALKC', $para, 'sistema@crgabrasil.org', $ass, $msg);




 }else {die('numero invalido ou usado');}//usado






		echo "<meta http-equiv='refresh' content='1;url=../listagem_usuario.php'>";
?>
