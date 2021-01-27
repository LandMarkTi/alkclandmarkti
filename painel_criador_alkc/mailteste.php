<?php
require_once("Connections/conexao.php");
require __DIR__.'/../classes/utils/EnviaMail.php';

//use EnviaMail;

$mensagemHTML = "
<p>Alerta do sistema ALKC:</p>
Nova solicitação de microchip !
";

$mail = new EnviaMail;
$mail->Enviar('contato@megapedigree.com', 'ALKC', 'contato@hectordufau.com.br','', 'Novo Pedido Alkc', $mensagemHTML);

?>