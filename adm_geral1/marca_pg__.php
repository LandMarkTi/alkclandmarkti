<?php
session_start();
if($_SESSION['login']=='sergio@sobraci.org'){} else die("sem login");

require_once("Connections/conexao.php");
//var_dump($_POST);


$idfb=(int)$_POST['id_f'];

$idped=(int)$_POST['id_ped'];

$em=strip_tags($_POST['em']);
mysql_query("INSERT INTO `pag_trans_capa` (`id_pag`, `id_ped`, `id_f`, `data_pg`) VALUES (NULL, ".$idped.", ".$idfb.", NOW());");

$pss=strrev($idped).str_pad($idfb,2,"0",STR_PAD_LEFT);

mysql_query("update pedigre_trocados_capa SET rastreio='".md5($pss)."' where id_ped='".$idped."' and id_f='".$idfb."'");

$k=base64_encode($_POST['id_ped'].str_pad($_POST['id_f'],2,"0",STR_PAD_LEFT));

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = "<html>
<body><br><br>
Transferência ALKC web
<br>
<br><br>
Para concluir o processo, é necessário escanear ou enviar uma foto do pedigree para:
<br><br>
info@alkc.com.br
<br><br><br><br>
<br><br>
Para entrar na área do proprietário, utilize os dados abaixo:
<br><br>
Login :".trim(strip_tags($_POST['em']))."<br><br>

Senha :".$pss."<br><br>

<br><br>
Acesso:
<br><br>
<a href='http://alkc.org.br/area-do-proprietario'>http://alkc.org.br/area-do-proprietario</a>

<br><br>
Enviado pelo sistema ALKC<br><br>
";


$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: naoresponda@megapedigree.com\n"; // remetente
$headers .= "Return-Path: contato@megapedigree.com\n"; // return-path
$envio = mail($em, "Envio do Pedigree", "$mensagemHTML", $headers,'-rcontato@megapedigree.com');


?>Pagamento Confimado!
