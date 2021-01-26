<?php
session_start();
require_once("Connections/conexao.php");

$cepe=$_POST['cpf'];

$cepe=str_replace('.','',$cepe);
$cepe=str_replace('-','',$cepe);
$cepe=str_replace(' ','',$cepe);
$cepe=trim($cepe);



$idped=(int)$_POST['id_ped'];
$idf=(int)$_POST['idf'];

$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$idped;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);





$nloop=explode(';', $linha_ped['ninhada']);
$micro=explode(';', $linha_ped['nº microchip']);

$sx=explode(';', $linha_ped['sexo']);

$sex=$sx[$idf];

$nasc_pet=$linha_ped['nasc'];

$nome=$nloop[$idf];

$reg=$linha_ped['registro'].$idf;


$prop = addslashes($_POST['nome']);
$nome_cao = addslashes($_POST['nome_cao']);//
$mic = addslashes($_POST['mic']);//
$end = addslashes($_POST['endereco']);
$cep=addslashes($_POST['cep']);
$tel=addslashes($_POST['telefone']);
$cpf=addslashes($_POST['cpf']);
$email=addslashes($_POST['email']);

$tipo=(int)$_POST['docs'];

$pc2=45;//op 3 tarjeta
if($tipo=='1')$pc2=48;
if($tipo=='2')$pc2=60;



$pc=addslashes($_POST['pc']);
//tirando var do ped e montando o campo do comprador

unset($_POST['nome_cao']);

unset($_POST['mic']);

unset($_POST['id_ped']);

unset($_POST['idf']);

unset($_POST['pc']);

unset($_POST['doc']);

$idfb=$idf+4;


//caso tarjeta p bloqueados


$jhb=mysql_query("select * from ped_print where id_ped='".$idped."' and id_f= '".($idf+4)."' order by id_perm desc limit 1") or die('ee2');
$lp=mysql_fetch_assoc($jhb);
$nrx=mysql_num_rows($jhb);

if ($nrx>=1 and $lp['tipo_perm']==1){

//insere tarjeta;
$reg=$linha_ped['registro'].$idf;

$sql = "INSERT INTO pedigre_trocados_tarja (id_trans_capa,id_ped,id_f,proprietario,endereco,cep_t,tel_t,cpf_t,email_t,nome_cao,mic,dt_trans) VALUES ('',$idped,$idfb,'$prop','$end','$cep','$tel','$cpf','$email','$nome_cao','$mic',".time().")";

$query = mysql_query($sql);

$idi=mysql_insert_id();

$tt=mysql_query("insert into tipo_trans values('',$idi,'$tipo',".time().")");


$msg='dados do cliente:
';

foreach($_POST as $k=>$v){

$msg.='

'.$k.' : '.htmlspecialchars($v,ENT_QUOTES);

}

$b64=base64_encode($msg);
//var_dump($_POST);

$p64="
nome $nome_cao 

microchip $mic

valor $pc

";

$p64=base64_encode($p64);


$cidade=trim(mb_strtoupper(addslashes($_POST['cidade']),'UTF-8'));
//echo $p64;
//PET LIGHT
mysql_query("insert into form_health_t values('','$b64','$p64','".time()."','$pc',$idi,'$cidade','')");
if(isset($_POST['proj'])===true)mysql_query("insert into proj_trans_tarja values('',$idi,'0',".time().")");

echo '

<form action="https://pagseguro.uol.com.br/v2/checkout/payment.html" id="pagseguro2" name="pagseguro2" method="post">
<input type="hidden" name="receiverEmail" value="alkc.pagseguro@gmail.com" />
<input type="hidden" name="currency" value="BRL" />
<input type="hidden" name="itemId1" value="transfTarjeta_'.$idped.'_'.$idf.'" />
<input type="hidden" name="itemDescription1" id="lista" value="Transferencia de tarjeta '.$reg.'" />
<input type="hidden" name="itemQuantity1" value="1" />
<input type="hidden" name="itemAmount1" id="valor_produtos"  value="48.00"/>
<input type="hidden" name="itemWeight1" value="1" />
<input type="hidden" name="itemShippingCost1" value="12.00" />
<input type="submit" value="Pagar com Pagseguro">
</form>
';
die();
}


//id adicionado para operações de gerenciamento-liberados
$sql = "INSERT INTO pedigre_trocados_capa (id_trans_capa,id_ped,id_f,proprietario,endereco,cep_t,tel_t,cpf_t,email_t,nome_cao,mic,dt_trans) VALUES ('',$idped,$idfb,'$prop','$end','$cep','$tel','$cpf','$email','$nome_cao','$mic',".time().")";
if($cepe=='00000000000'||$cepe=='11111111111'||$cepe=='22222222222'||$cepe=='33333333333'||$cepe=='44444444444'||$cepe=='55555555555'||$cepe=='66666666666'||$cepe=='77777777777'||$cepe=='88888888888'||$cepe=='99999999999'){} else {$query = mysql_query($sql) or die('et');

$idi=mysql_insert_id();

mysql_query("insert into tipo_trans values('',$idi,'$tipo',".time().")");

if(isset($_POST['proj'])===true)mysql_query("insert into proj_trans values('',$idi,'0',".time().")");


$_SESSION['idi']=$idi;
/*
$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$idped;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);


$nloop=explode(';', $linha_ped['ninhada']);
$micro=explode(';', $linha_ped['nº microchip']);

$micro[$idf-4]=$mic;

$nloop[$idf]=$nome_cao;

$m=addslashes(implode(';',$micro));

$n=addslashes(implode(';',$nloop));
*/

//mysql_query("UPDATE pedigree set ninhada='$n', `nº microchip`='$m' where id_ped=".$idped) or die('e2');

//envio do email


$msg='dados do cliente:
';

foreach($_POST as $k=>$v){

$msg.='

'.$k.' : '.htmlspecialchars($v,ENT_QUOTES);

}

$b64=base64_encode($msg);
//var_dump($_POST);

$p64="
nome $nome_cao 

microchip $mic

valor $pc

";

$p64=base64_encode($p64);


$cidade='sem_banner_health';//trim(mb_strtoupper(addslashes($_POST['cidade']),'UTF-8'));
//echo $p64;
//PET LIGHT
mysql_query("insert into form_health values('','$b64','$p64','".time()."','$pc',$idi,'$cidade','')");

//add campo confirmou

//salva tipo transferência

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<html>
<body><br><br>
Transferência web
<br>
Obrigado ' . $prop . ', estamos cuidando para garantir a segurança <br>e 
integridade do seu registro.Caso não tenha visto temos uma promoção:
<br>
<br>
Assine agora mesmo Convênio de saúde Health for Pet e ganhe um desconto especial: 
<br>
<br>
<br>
<a title="convenio gratis" href="http://conveniosaudepet.com.br/planos_desconto3.php'.'"><img src="http://www.megapedigree.com/site/images/banner_trans_desconto.jpg"></a>
<br>*Promoção restrita a área de cobertura:.
</body></html>
';

//integra3.php?du='.$b64.'&ped='.$p64.'&val='.$pc.'&n='.$nasc_pet.'&sx='.$sex

$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: naoresponda@megapedigree.com\n"; // remetente
$headers .= "Return-Path: contato@megapedigree.com\n"; // return-path






}
$vet_cid=array("xx");//"BELO HORIZONTE","COTIA","FERRAZ DE VASCONCELOS","GUARUJÁ","GUARULHOS","MAUÁ","MOGI DAS CRUZES","NITERÓI","OSASCO","POÁ","PRAIA GRANDE","SANTANA DE PARNAÍBA","SANTO ANDRÉ","SANTOS","SÃO BERNARDO DO CAMPO","SÃO CAETANO DO SUL","SÃO PAULO","SAO PAULO","TABOÃO DA SERRA","VARGEM GRANDE PAULISTA","BARUERI");

//if(in_array($cidade,$vet_cid))$envio = mail($email, "Convenio de saude Pet", "$mensagemHTML", $headers,'-rcontato@megapedigree.com');
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8"> 
<meta name="keywords" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" /> 


<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="shortcut icon" href="favicon.png" />
<title>::. transferencia .::</title>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed">
<?php //include "includes/header.php";?>
<script type="text/javascript" src="jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="jquery/fancy/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="jquery/fancy/source/jquery.fancybox.js?v=2.1.3"></script>
	<link rel="stylesheet" type="text/css" href="jquery/fancy/source/jquery.fancybox.css?v=2.1.2" media="screen" />
	<link rel="stylesheet" type="text/css" href="jquery/fancy/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="jquery/fancy/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<link rel="stylesheet" type="text/css" href="jquery/fancy/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="jquery/fancy/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="jquery/fancy/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>

<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});
		});
</script>

<div class="internas_full">
 <div class="internas_margem_full">
 <style>
.fotos {
margin-right: 10px;
border: #e9e9e9 solid 10px;
}
</style>
<?php
	$sql = "select * from paginas_internas";
	//$query = mysql_query($sql) or die (mysql_error());
	//$l = mysql_fetch_array($query);
	?>
    
 	<div class="internas_box">


    <div class="arial_cinza1_13" style="margin-top:50px;">
    

<?php if(in_array($cidade,$vet_cid)){?>
<iframe  id="mfr" title="http://conveniosaudepet.com.br/integra.php?du=<?=$b64?>&ped=<?=$p64?>&val=<?=$pc?>&n=<?=$nasc_pet?>&sx=<?=$sex?>" style="display:none"></iframe>
    <?php }?><br><br>
	<center><?php if(in_array($cidade,$vet_cid)){?><img src="images/banner_trans_desconto2.jpg" style="width: 710px;"><br><div class="onetime" onclick="alert('Aguarde o contato após o pagamento!');$('#valor_produtos').val('<?=$pc?>');$('#lista').val('Convenio Pet <?=$reg?> e transferencia');$.post('post_conf.php',{ts:<?=time();?>,pc:<?=$pc?>},function(data){$('#pagseguro2').submit();});" style="cursor: pointer;
color: #FFF;
width: 150px;
height: 44px;
background: #ff6a80 none repeat scroll 0% 0%;
top: -132px;
left: -95px;
position: relative;
border-radius: 10px;
font-size: 14px;
box-shadow: 5px 5px 8px gray;"><br><b >CONTRATAR</b></div>
<div class="onetime" onclick="window.open('http://conveniosaudepet.com.br/planos_desconto3.php');" style="cursor: pointer;
color: #FFF;
width: 150px;
height: 44px;
background: #05bcfe none repeat scroll 0% 0%;
top: -176px;
left: 105px;
position: relative;
border-radius: 10px;
font-size: 14px;
box-shadow: 5px 5px 8px gray;"><br><b >VER MAIS</b></div>
<script>//por  mframe(); no final do onclik
		function mframe(){
			$('#mfr').attr('src',local);
			$('.onetime').remove();
		}
</script>
	<?php 
		
	}?></center><br><br>

<form action="https://pagseguro.uol.com.br/v2/checkout/payment.html" id="pagseguro2" name="pagseguro2" method="post">
<input type="hidden" name="receiverEmail" value="alkc.pagseguro@gmail.com" />
<input type="hidden" name="currency" value="BRL" />
<input type="hidden" name="itemId1" value="transfWeb_<?=time();?>_<?=$idped?>_<?=$idf;?>" />
<input type="hidden" name="itemDescription1" id="lista" value="Transferencia de propriedade <?=$reg?>" />
<input type="hidden" name="itemQuantity1" value="1" />
<input type="hidden" name="itemAmount1" id="valor_produtos"  value="<?=$pc2?>.00"/>
<input type="hidden" name="itemWeight1" value="1" />
<input type="hidden" name="itemShippingCost1" value="12.00" />

  
	<!--a href="boleto_email.php?du=<?=$b64?>&ped=<?=$reg?>"><img src="images/botao_boleto2.jpg" style="margin-left: 35px;"></a--> &nbsp;&nbsp;&nbsp;<input type="submit" id="pgg" onclick="$('#valor_produtos').val('<?=$pc2?>.00');$('#lista').val('Transferencia ALKC <?=$reg?>');" value="Continuar">
    <br>* Ao Clicar no botão aguarde o carregamento para finalizar a compra pelo Pagseguro.

<br>
<br>

  
</form>
	</div> 

    </div>
    
    <?php //include "includes/informacoes.php"; ?>    
    
 
 </div>
</div>
<?php //include "includes/footer.php";?>
</body>
</html>
