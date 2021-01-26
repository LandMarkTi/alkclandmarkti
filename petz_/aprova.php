<?php
session_start();
if($_SESSION['login']=='')die("login");
require_once("Connections/conexao.php");
$id = (int)$_POST['id'];
//echo "id =".$id;
$sql = "insert into aprovados values('',$id,".time().",".$_SESSION['id'].")";

mysql_query($sql) or die('e1');



$em="SELECT * FROM `criadores` where id_criador=".$id;
$qr=mysql_query($em);
$f=mysql_fetch_assoc($qr);
$psw=time();
$ps="update `criadores` set senha=".$psw." where id_criador=".$id;
$qrp=mysql_query($ps);

$ass='Senha Criador SOBRACI';
$msg="Olá ";
$msg.=$f['Nome'];
$msg.="Para acessar o sistema use os dados abaixo.\n";
$msg.='login:'.$f['email'];
$msg.="\n\n";
$msg.='Senha:'.$psw."\n";
$msg.="Enviado pelo sistema SOBRACI ";
$msg.="\n";

$para=$f['email'];
$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: sobraci@sobraci.com.br\n"; // remetente
//$headers .= "To: $para\n";
$headers .= "Subject: $ass\n";
$headers .= "Return-Path: contato@sobraci.com.br\n"; // return-path
$envio = mail($para, $ass, $msg, $headers,'-rsobraci@sobraci.com.br');

?>
