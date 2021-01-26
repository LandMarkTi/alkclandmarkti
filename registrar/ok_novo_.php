<?php
session_start();
require_once("../painel_kennel/Connections/conexao.php");

$eteste=addslashes(strip_tags($_POST['email']));

$idcredenciado=(int)$_POST['nid'];

$qr_t=mysql_query("select * from criadores where  id_credenciado=$idcredenciado and email='".$eteste."'")or die('ect');
$ft=mysql_fetch_assoc($qr_t);
$n=mysql_num_rows($qr_t);
if($n>=1)die("<script>alert('Email já cadastrado,se necessário recupere sua senha pela capa do site.');</script>"); 

$dtn=explode('/',$_POST['Nascimento1']);

$ann=(int)$dtn[2];

if($ann>1999)die('Somente para maiores de 18 anos.');

$ep='alkc.pagseguro@gmail.com';//$_SESSION['email_pg'];
//$ec=$_SESSION['email_contato'];
//print_r($_SESSION);
//die();


//var_dump($_POST);
$senha='as4'.time();
//$qr1=mysql_query("select * from credenciado where email='".$ec."'")or die('ec');
//$fc=mysql_fetch_assoc($qr1);

$idcredenciado=(int)$_POST['nid'];//?



//$idcredenciado=9;
$nomecanil=addslashes(strip_tags($_POST['opcoes_nomes']));
$cpf2=addslashes(strip_tags($_POST['cpf2']));

$cpfs=addslashes(strip_tags($_POST['cpf1'])).','.$cpf2;

if($_POST['cpf1']=='220.653.368-54'||$_POST['cpf1']=='276.776.428-70')die('bloqueado');
if($_POST['cpf2']=='220.653.368-54'||$_POST['cpf2']=='276.776.428-70')die('bloqueado');

//unset($_POST['opcoes_nomes']);
unset($_POST['cpf1']);
unset($_POST['cpf2']);
unset($_POST['nid']);



$nome=addslashes(strip_tags($_POST['nome']));
$sobre=addslashes(strip_tags($_POST['sobre']));
$rgs=addslashes(strip_tags($_POST['rg1'])).','.addslashes(strip_tags($_POST['rg2']));
$nasc=addslashes(strip_tags($_POST['Nascimento1'])).addslashes(strip_tags($_POST['Nascimento2']));
$site=addslashes(strip_tags($_POST['site']));
$email=addslashes(strip_tags($_POST['email']));
$cep=addslashes(strip_tags($_POST['cep']));
$endereco=addslashes(strip_tags($_POST['End_residencial']));
$endereco.=' '.addslashes(strip_tags(' '.$_POST['complemento'].' '.$_POST['num']));
$cidade=addslashes(strip_tags($_POST['cidade']));
$estado=addslashes(strip_tags($_POST['estado']));
$ddd=addslashes(strip_tags($_POST['ddd']));
$tel1=addslashes(strip_tags($_POST['fone_res']));
$tel2=addslashes(strip_tags($_POST['fone_com']));
$cel=addslashes(strip_tags($_POST['fone_fax']));
$raca=addslashes(strip_tags($_POST['Raças']));

$uso=addslashes(strip_tags($_POST['uso_canil']));
$local=addslashes(strip_tags($_POST['cidade']));


//$str="insert into criadores values('','".$idcredenciado."','".$senha;


$str="INSERT INTO `criadores` (`id_criador`, `id_credenciado`, `senha`, `nome`, `sobrenome`, `nacionalidade`, `estado_civil`, `profissao`, `Nascimento`, `cpf`, `RG`, `End_residencial`, `bairro`, `cidade`, `estado`, `cep`, `email`, `end_corresp`, `bairro_corresp`, `cidade_corresp`, `cep_corresp`, `ddd`, `fone_res`, `fone_com`, `fone_fax`, `uso_canil`, `Racas`, `opcoes_nomes`, `local_assinatura`, `dia_assinatura`, `mes_assinatura`, `ano_assinatura`, `nome_completo`) 
VALUES 
(NULL, '$idcredenciado', '$senha', '$nome', '$sobre', 'BRASILEIRO', '$site', '-', '$nasc', '$cpfs', '$rgs', '$endereco', '$bairro', '$cidade', '$estado', '$cep', '$email', '-', '-', '-', '-', '$ddd', '$tel1', '$tel2', '$cel', '$uso', '$raca', '$nome', '$cidade', '".date("d",time())."', '".date("m",time())."', '".date("Y",time())."', '$nomecanil');";

//addslashes(strip_tags($var));

//$str.="','".$nomecanil."')";
mysql_query($str)or die('err_insert');

$id_rgc = mysql_insert_id();


$nc=$id_rgc-21634;

$mensagemHTML = "
Alerta do sistema ALKC:


Novo cadastro de canil pendente de aprovação !

nº  $nc

email $eteste

";

$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: contato@megapedigree.com\n"; // remetente
$headers .= "Return-Path: info@petweball.com.br\n"; // return-path

$envio = mail('info@alkc.com.br', "Novo Canil", "$mensagemHTML", $headers,'-rcontato@megapedigree.com');

?>
<body>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<p>Obrigado por se cadastrar,iremos entrar em contato após o pagamento do Boleto.</p><br><br>
<form action="https://pagseguro.uol.com.br/v2/checkout/payment.html" id="pagseguro2" name="pagseguro2" method="post">
<input type="hidden" name="receiverEmail" value="<?php echo $ep;?>" />
<input type="hidden" name="currency" value="BRL" />
<input type="hidden" name="itemId1" value="cad_<?php echo $nc;?>" />
<input type="hidden" name="itemDescription1" id="lista" value="Cadastro Criador <?php echo $nc;?>" />
<input type="hidden" name="itemQuantity1" value="1" />
<input type="hidden" name="itemAmount1" id="valor_produtos"  value="100.00"/>
<input type="hidden" name="itemWeight1" value="1" />
<input type="hidden" name="itemShippingCost1" value="10.00" />

<p><input value="Pagar pelo pagseguro" type="submit"></p>
</form>
<p></p>

<?php $_SESSION['pstipo']='FILIAÇÃO ALKC';


?>
<script>
var y=document.getElementById('pagseguro2');
var x=setTimeout('y.submit();',1000);
</script>
</body>
