<?php
session_start();
require_once("Connections/conexao.php");
if($_SESSION['login']!='sergio@sobraci.org')die("<script>location='index.php';</script>");

$idc=(int)$_POST['idc'];

$tipo=(int)$_POST['tipo'];

$cod=addslashes(trim($_POST['cod']));

if($cod!=''){

$qc=mysql_query("SELECT email FROM `criadores` WHERE id_criador=$idc ");

$fc=mysql_fetch_assoc($qc);


$texto="<html>
<body><br><br>";

$texto.="Obrigado por escolher a SOBRACI!<br><br>

O seu cadastro foi aprovado e o certificado já foi enviado.<br>

Acompanhe a entrega através do link abaixo:<br>

<br><br>
http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI=$cod
<br><br>
Enviado pelo sistema Petweball

";

$texto.='<br>
</body></html>
';

$em=strip_tags(trim($fc['email']));
$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: naoresponda@megapedigree.com\n"; // remetente
$headers .= "Return-Path: contato@megapedigree.com\n"; // return-path
$envio = mail($em, "Envio do Certificado", "$texto", $headers,'-rcontato@megapedigree.com');


mysql_query("INSERT INTO `rastreio` (`id_ras`, `tipo_e`, `id_ref`, `data_envio`, `cd_ras`) VALUES ('', '$tipo', '$idc', ".time().", '$cod'); ");


}


?>Rastreamento Salvo e enviado para <?=$fc['email']?>.
