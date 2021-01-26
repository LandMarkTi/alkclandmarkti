<?php


require_once('./Connections/conexao.php');
mysql_select_db($database_conexao, $conexao);
$email=str_replace(" ","",$_POST['obj']);



//echo $txt;

//$para = "daniel@neoware.com.br";
$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: contato@megapedigree.com\n"; // remetente
$headers .= "Subject: Senha criador\n";
$headers .= "Return-Path: contato@megapedigree.com\n"; // return-path

$qa="SELECT * FROM usuarios WHERE email='".$em."' ";
$qr=mysql_query($qa)or die(mysql_error());
$resp=mysql_fetch_array($qr);
$nr=mysql_num_rows($qr);
if($nr<1)die('não encontrado');else{
$t=mysql_query("update criadores set senha='".time()."' WHERE email='".$email."' ");
$txt='
Sua senha é '.time();


$envio = mail($email, 'Senha skinbar', $txt, $headers);
}

?>
