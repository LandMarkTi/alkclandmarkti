<?php

session_start();
require_once("Connections/conexao.php");

$i=(int)$_SESSION['idi'];

$up=mysql_query("update form_health set conf='ok' where id_capa=".$i);
//$qrm=mysql_query("SELECT * from pedigre_trocados_capa where id_trans_capa=".$i);

/*$f=mysql_fetch_assoc($qrm);

$mensagemHTML = '<html>
<body><br><br>
Transferência web
<br>
Obrigado ' . $f['proprietario'] . ', 
<br>
<br>
<br>
<img src="http://www.megapedigree.com/site/images/conf_proposta.jpg" title="confirma">
<br>
</body></html>
';

*/

//integra3.php?du='.$b64.'&ped='.$p64.'&val='.$pc.'&n='.$nasc_pet.'&sx='.$sex
//setar  como enviado

$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: naoresponda@megapedigree.com\n"; // remetente
$headers .= "Return-Path: contato@megapedigree.com\n"; // return-path


//$email=$f['email_t'];
//$envio = mail($email, "Convenio de saude Pet", "$mensagemHTML", $headers,'-rcontato@megapedigree.com');


?>ok
