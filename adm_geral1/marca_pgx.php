<?php
session_start();
if($_SESSION['login']=='sergio@sobraci.org'){} else die("sem login");

require_once("Connections/conexao.php");
//var_dump($_POST);

$em=strip_tags($_POST['em']);
mysql_query("INSERT INTO `pag_trans_pre` (`id_pag`, `id_ped`, `id_f`, `data_pg`) VALUES (NULL, ".$_POST['id_ped'].", ".$_POST['id_f'].", NOW());");


$k=base64_encode($_POST['id_ped'].str_pad($_POST['id_f'],2,"0",STR_PAD_LEFT));

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<html>
<body><br><br>
Transferência ALKC 
<br>
<br><br>
Para concluir o processo, é necessário escanear ou enviar uma foto do pedigree para:
<br><br>
info@alkc.com.br
<br><br><br><br>



<br>
<br>
</body></html>
';

$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: naoresponda@megapedigree.com\n"; // remetente
$headers .= "Return-Path: contato@megapedigree.com\n"; // return-path
$envio = mail($em, "Envio do Pedigree", "$mensagemHTML", $headers,'-rcontato@megapedigree.com');


?>Pagamento Confimado!
