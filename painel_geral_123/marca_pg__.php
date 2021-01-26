<?php
session_start();
if($_SESSION['login']=='sergio@sobraci.org'){} else die("sem login");

require_once("Connections/conexao.php");
//var_dump($_POST);

$em=strip_tags($_POST['em']);
mysql_query("INSERT INTO `pag_trans_capa` (`id_pag`, `id_ped`, `id_f`, `data_pg`) VALUES (NULL, ".$_POST['id_ped'].", ".$_POST['id_f'].", NOW());");

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<html>
<body><br><br>
Transferência sobraci web
<br>
<br><br>
Para concluir o processo, é necessário enviar o pedigree para:
<br><br>
Estrada Municipal Fernando Nobre 920<br>
Jardim do Golf I, Jandira/SP<br>
06642-000<br>
<br>
Aproveite e faça agora a sua carteirinha gratuitamente:

<a href="http://www.megapedigree.com/painel_geral_123/imprime_rgc/ver_carteirinha_transf.php?id='.$_POST['id_trans'].'">abrir carteirinha</a>
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
