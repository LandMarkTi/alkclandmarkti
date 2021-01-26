<?php
session_start();
require_once("Connections/conexao.php");

$qr_t=mysql_query("select * from criadores where email='".$_POST['email']."'")or die('ec');
$ft=mysql_fetch_assoc($qr_t);
$n=mysql_num_rows($qr_t);
if($n>=1)die("<script>alert('Email já cadastrado,se necessário recupere sua senha pela capa do site.');window.location='http://www.sobraci.org/';</script>"); 

$ep='petprotect2015@gmail.com';//$_SESSION['email_pg'];
$ec=$_SESSION['email_contato'];
//print_r($_SESSION);
//die();
if(false){/*
$senha='AWQ123';
$qr1=mysql_query("select * from credenciado where email='".$ec."'")or die('ec');
$fc=mysql_fetch_assoc($qr1);
$idcredenciado=$fc['id_credenciado'];//?
$nomecanil=addslashes(strip_tags($_POST['opcoes_nomes']));
unset($_POST['opcoes_nomes']);
$str="insert into criadores values('','".$idcredenciado."','".$senha;
foreach($_POST as $key=>$value)$str.="','".addslashes(strip_tags($value));
$str.="','".$nomecanil."')";
mysql_query($str)or die($str.mysql_error());

$mensagemHTML = "
Alerta do sistema SOBRACI:


Novo cadastro de canil pendente de Pagamento !

";
$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: Site Sobraci <".$_POST['email'].">\n"; // remetente
$headers .= "Return-Path: diagnosticando <info@neoware.com.br>\n"; // return-path
//$envio = mail("debora@neoware.com.br", "$assunto", "$mensagemHTML", $headers);
$envio = mail($_SESSION['email_contato'], "Novo Canil", "$mensagemHTML", $headers);


die("<script>alert('Obrigado pelo cadastro,em breve entraremos em contato.');window.location='http://www.sobraci.org/';</script>"); 
*/
}
//var_dump($_POST);
$senha=1234;
$qr1=mysql_query("select * from credenciado where email='".$ec."'")or die('ec');
$fc=mysql_fetch_assoc($qr1);
$idcredenciado=$_POST['nid'];//?

//$idcredenciado=9;
$nomecanil=addslashes(strip_tags($_POST['opcoes_nomes']));
$cpf2=addslashes(strip_tags($_POST['cpf2']));

$_POST['cpf']=addslashes(strip_tags($_POST['cpf1'])).','.$cpf2;

unset($_POST['opcoes_nomes']);
unset($_POST['cpf1']);
unset($_POST['cpf2']);
unset($_POST['nid']);
$str="insert into criadores values('','".$idcredenciado."','".$senha;
foreach($_POST as $key=>$value)$str.="','".addslashes(strip_tags($value));
$str.="','".$nomecanil."')";
mysql_query($str)or die('erro interno');

$r=mysql_query('SELECT LAST_INSERT_ID() as fim;')or die('kk');
$val=mysql_fetch_assoc($r);

$mensagemHTML = "
Alerta do sistema SOBRACI:


Novo cadastro de canil pendente de aprovação !

";

$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: Site Sobraci <".$_POST['email'].">\n"; // remetente
$headers .= "Return-Path: diagnosticando <info@neoware.com.br>\n"; // return-path
//$envio = mail("debora@neoware.com.br", "$assunto", "$mensagemHTML", $headers);
$envio = mail('adm@sobraci.org', "Novo Canil", "$mensagemHTML", $headers);

?>
<body>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<br>
<p>Obrigado por se cadastrar,iremos entrar em contato após o pagamento.</p><br><br>
<form action="https://pagseguro.uol.com.br/v2/checkout/payment.html" id="pagseguro2" name="pagseguro2" method="post">
<input type="hidden" name="receiverEmail" value="<?php echo $ep;?>" />
<input type="hidden" name="currency" value="BRL" />
<input type="hidden" name="itemId1" value="cad_<?php echo $val['fim'];?>" />
<input type="hidden" name="itemDescription1" id="lista" value="Cadastro Criador" />
<input type="hidden" name="itemQuantity1" value="1" />
<input type="hidden" name="itemAmount1" id="valor_produtos"  value="100.00"/>
<input type="hidden" name="itemWeight1" value="1" />
<input type="hidden" name="itemShippingCost1" value="6.00" />

<p><input value="Pagar pelo pagseguro" type="submit"></p>
</form>
<?php $_SESSION['pstipo']='FILIAÇÃO SOBRACI';


?>
<script>
var y=document.getElementById('pagseguro2');
var x=setTimeout('y.submit();',1000);
</script>
</body>
