<?php
session_start();
require_once("Connections/conexao.php");
$qr=mysql_query("select * from credenciado where id_credenciado=".$_SESSION['id']);
$f=mysql_fetch_assoc($qr);

//echo $f['nome'];

$pedigree=(int)$_POST['ped'];
$sis=(int)$_POST['uso'];
$rgc=(int)$_POST['rgc'];

$data=date('Y-m-d');

$id_meu=$_SESSION['id'];


$ht='Novo pedido do '.$f['nome'].'

Pedigree : '.$pedigree.' 

RGC : '.$sis.' 

Sistema : '.$rgc.' 

Enviado pelo Painel Sobraci em '.$data.' 

';


$q_cota=mysql_query("INSERT INTO `megapedigree_banco`.`cotas` (`id_cota`, `id_cred`, `v_ped`, `v_rgc`, `v_sistema`, `data_pedido`, `data_apr`) VALUES (NULL, '$id_meu', '$pedigree', '$rgc', '$sis', '$data', '0000-00-00');");



$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: contato@megapedigree.com.br\n"; // remetente
$headers .= "Return-Path:contato@megapedigree.com.br\n"; // return-path
//$envio = mail("debora@neoware.com.br", "$assunto", "$mensagemHTML", $headers);
$envio = mail('dxpert1@hotmail.com,adm@sobraci.org', "Adicionar Cota", "$ht", $headers,"-rcontato@megapedigree.com.br");


die('<script>alert(\'Pedido enviado!\');document.location=\'index_principal.php\';</script>');
//bloqueado em 19 de maio de 2014
?>
<body>
<br>
<p>Obrigado, entraremos em contato após o pagamento.</p><br><br>
<form action="https://pagseguro.uol.com.br/v2/checkout/payment.html" id="pagseguro2" name="pagseguro2" method="post">
<input type="hidden" name="receiverEmail" value="adm@sobraci.org" />
<input type="hidden" name="currency" value="BRL" />
<input type="hidden" name="itemId1" value="ped_conta" />
<input type="hidden" name="itemDescription1"  value="cota_pedigree" />
<input type="hidden" name="itemQuantity1" value="<?php echo $pedigree;?>" />
<input type="hidden" name="itemAmount1"  value="17.50"/>
<input type="hidden" name="itemWeight1" value="1" />
<input type="hidden" name="itemShippingCost1" value="0.00" />

<input type="hidden" name="itemId2" value="rgc_conta" />
<input type="hidden" name="itemDescription2"  value="cota_rgc" />
<input type="hidden" name="itemQuantity2" value="<?php echo $rgc;?>" />
<input type="hidden" name="itemAmount2" value="22.50"/>
<input type="hidden" name="itemWeight2" value="1" />
<input type="hidden" name="itemShippingCost2" value="0.00" />

<input type="hidden" name="itemId3" value="sistema_conta" />
<input type="hidden" name="itemDescription3"  value="cota_sistema" />
<input type="hidden" name="itemQuantity3" value="<?php echo $sis;?>" />
<input type="hidden" name="itemAmount3"  value="0.25"/>
<input type="hidden" name="itemWeight3" value="1" />
<input type="hidden" name="itemShippingCost3" value="0.00" />


<p><input value="Pagar pelo pagseguro" type="submit"></p>
</form>
<?php //$_SESSION['pstipo']='FILIAÇÃO SOBRACI';


?>
<script>
var y=document.getElementById('pagseguro2');
var x=setTimeout('y.submit();',1000);
</script>
</body>
