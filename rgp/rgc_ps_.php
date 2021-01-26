<?php
session_start();
require_once("Connections/conexao.php");


$ep='petprotect2015@gmail.com';//icbarral@gmail.com

//print_r($_SESSION);
//die();

$rgpet=(int)$_GET['rg'];

$mensagemHTML = "
Alerta do sistema :


Novo cadastro de rgc pendente de pagamento !

";

$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: Site Sobraci <contato@sobraci.org>\n"; // remetente
$headers .= "Return-Path: diagnosticando <info@neoware.com.br>\n"; // return-path
//$envio = mail("debora@neoware.com.br", "$assunto", "$mensagemHTML", $headers);
//$envio = mail('adm@sobraci.org', "Novo Canil", "$mensagemHTML", $headers);

?>
<body>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<br>
<p>Obrigado por se cadastrar,iremos entrar em contato após o pagamento.</p><br><br>
<form action="https://pagseguro.uol.com.br/v2/checkout/payment.html" id="pagseguro2" name="pagseguro2" target="_top" method="post">
<input type="hidden" name="receiverEmail" value="<?php echo $ep;?>" />
<input type="hidden" name="currency" value="BRL" />
<input type="hidden" name="itemId1" value="cad_<?php echo $rgpet;?>" />
<input type="hidden" name="itemDescription1" id="lista" value="Cadastro RG Pet <?php echo $rgpet;?>" />
<input type="hidden" name="itemQuantity1" value="1" />
<input type="hidden" name="itemAmount1" id="valor_produtos"  value="5.00"/>
<input type="hidden" name="itemWeight1" value="1" />
<input type="hidden" name="itemShippingCost1" value="0.00" />

<p><input value="Pagar pelo pagseguro" type="submit"></p>
</form>
<?php $_SESSION['pstipo']='RG Pet';

?>
<script>
var y=document.getElementById('pagseguro2');
var x=setTimeout('y.submit();',1000);
</script>
</body>
