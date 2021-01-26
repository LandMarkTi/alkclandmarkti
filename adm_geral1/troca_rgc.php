<?php
session_start();
if($_SESSION['login']=='sergio@sobraci.org'){
require_once("Connections/conexao.php");
$id = (int)$_POST['id'];
$psw = md5(trim($_POST['psw']));
//echo "id =".$id;
//$sql = "insert into aprovados values('',$id,".time().",".$kid.")";

$qre="update `pedigre_trocados_capa` set rastreio='$psw' where id_trans_capa=$id";
//echo $qre;

//mysql_query($sql) or die('e1');
$q=mysql_query($qre);




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
$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: SISTEMA ALKC <sistema@crgabrasil.org>'\n"; // remetente
//$headers .= "To: $para\n";
$headers .= "Subject: $ass\n";
$headers .= "Return-Path: sistema@crgabrasil.org\n"; // return-path
//$envio = mail($para, $ass, $msg, $headers,'-rsistema@crgabrasil.org');
}else die('sem login');
?>ok
