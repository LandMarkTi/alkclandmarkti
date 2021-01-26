<?php
require_once("Connections/conexao.php");

$idped=(int)$_GET['id_ped'];
$idf=(int)$_GET['id_f'];


$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$idped;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);

$nloop=explode(';', $linha_ped['ninhada']);
$micro=explode(';', $linha_ped['nº microchip']);

$dif_nasc=time()-$linha_ped['nasc'];

$yy=date("Y",$dif_nasc);

$YY=$yy-1970;

$mm=date("m",$dif_nasc);

if($YY<1)$val='70.80';

if($YY>=1&&$YY<=8)$val='59.47';

if($YY>8)$val='idade';

$mic=$micro[$idf];

$nome=$nloop[$idf+4];

$reg=$linha_ped['registro'].$idf;
?><!DOCTYPE html>
<head>
<meta charset="utf-8"> 
<meta name="keywords" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" /> 
<meta name="description" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote"/>
<meta name="Abstract" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" />
<meta name="copyright" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />
<meta property="og:type" content="product"/>
<meta property="og:title" content="SOBRACI - Sociedade Brasileira de Cinofilia Independente - Registro Pedigree Cães - Cachorro - Filhotes"/>
<meta property="og:image" content="http://www.sobraci.org/images/logo_header.png"/>
<meta property="og:site_name" content="SOBRACI - Sociedade Brasileira de Cinofilia Independente - Registro Pedigree Cães - Cachorro - Filhotes" />
<meta property="og:description" content="Pedigree, Pedigri, Registro de ninhada, Registro inicial, Cinofilia, cão de raça, venda de filhote" />
<meta http-equiv="Content-Language" content="pt-br">
<meta name="resource-type" content="document" />
<meta http-equiv="pragma" content="no-cache" />
<meta name="revisit-after" content="1" />
<meta name="robots" content="ALL" />
<meta name="distribution" content="Global" />
<meta name="rating" content="General" />
<meta name="classification" content="Internet">
<meta name="doc-class" content="Completed">
<meta name="doc-rights" content="Public">
<meta name="url" content="http://www.sobraci.org"> 
<meta name="author" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="shortcut icon" href="favicon.png" />
<title>::. SOBRACI - Sociedade Brasileira de Cinofilia Independente - Registro Pedigree Cães - Cachorro - Filhotes .::</title>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed">
<?php include "includes/header.php";?>
	<script type="text/javascript" src="jquery/fancy/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="jquery/fancy/source/jquery.fancybox.js?v=2.1.3"></script>
	<link rel="stylesheet" type="text/css" href="jquery/fancy/source/jquery.fancybox.css?v=2.1.2" media="screen" />
	<link rel="stylesheet" type="text/css" href="jquery/fancy/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="jquery/fancy/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<link rel="stylesheet" type="text/css" href="jquery/fancy/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="jquery/fancy/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="jquery/fancy/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>

	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="cep.js"></script>
    
<script>
onkeydown="$('input').removeAttr('readonly');"
</script>

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
 
 	<div class="internas_box">
      <div class="internas_titulo">Transferência de pedigree</div>
    <div class="arial_cinza1_11" style="margin-top:50px;">
	<style>#emailForm input{width: 420px}
	.forms input {width: 490px;}
		</style>
<div style="border: 1px solid gray;margin: 0px;background-color:whiteSmoke;overflow:hidden">
<br>
<h1 style="margin-left: 98px;">Confira os dados do documento abaixo:</h1>
		<p style="margin: 35px;font-size: 15px;">
		 Confirmo a posse do documento abaixo  cujo animal descrito no mesmo me pertence
		e solicito a transferência de titularidade de acordo com a lei de posse responsavel
		 nº <i>13.131/01 e 13.532/03</i> e estou ciente que devo enviar o original 
		para efetivar a transferência no endereço abaixo:<br><br>
		Estrada Municipal Fernando Nobre 920<br>
		Jardim do Golf I, Jandira/SP<br>
		06642-000<br>

		 </p>
	<center><span id="btnn" style="border: 2px solid gray;border-radius: 7px;background-color: white;padding: 8px 10px;margin: 8px;cursor:pointer;font-size: 19px;" onclick="$('.f1 table').show();$('iframe').slideUp();$('#btnn').remove();">Confirmar</span>
	
	</center><br><br><br>

<iframe src="http://www.megapedigree.com/painel_credenciado/pedcode.php?id_ped=<?=$idped?>&id_filhote=<?=$idf+4;?>" scrolling="no" style="width:20.4cm;border:0px;height:29.6cm;margin-left: -22px;"></iframe>
<form action="env_trans_health.php" method="post" class="f1">
			<table width="100%" border="0" cellspacing="6" cellpadding="0" style="display:none">
            
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Novo Proprietário</label><input type="hidden"></td>
    				<td><input style="width: 490px;" name ="nome" type="text" class="forms" id="login"  required="required"/></td>
			  </tr>
                          <tr>
    				<td align="right"><label for="cpf" class="arial_cinza2_12" >CPF</label></td>
    				<td><input style="width: 490px;" name ="cpf" type="text" class="forms"  required="required" /></td>
			  </tr>

			  <tr>
    				<td align="right"><label for="data_nascimento" class="arial_cinza2_12" >Data de Nascimento</label></td>
    				<td><input style="width: 490px;" name ="data_nascimento" type="text" class="forms"  required="required" /></td>
			  </tr>


			  <tr>
    				<td align="right"><label for="sexo" class="arial_cinza2_12" >Sexo</label></td>
    				<td><select name="sexo" class=""><option>selecione..</option><option>Masculino</option><option>Feminino</option></select></td>
			  </tr>


			  <tr>
    				<td align="right"><label for="endereço" class="arial_cinza2_12" >Endereço</label></td>
    				<td><input style="width: 490px;" name ="endereço" type="text" class="forms"  required="required" /></td>
			  </tr>

	  		<tr>
    				<td align="right"><label for="número" class="arial_cinza2_12" >Número</label></td>
    				<td><input style="width: 490px;" name ="número" type="text" class="forms"  required="required" /></td>
			  </tr>

  			<tr>
    				<td align="right"><label for="complemento" class="arial_cinza2_12" >Complemento</label></td>
    				<td><input style="width: 490px;" name ="complemento" type="text" class="forms"  required="required" /></td>
			  </tr>

  			<tr>
    				<td align="right"><label for="bairro" class="arial_cinza2_12" >Bairro</label></td>
    				<td><input style="width: 490px;" name ="bairro" type="text" class="forms"  required="required" /></td>
			  </tr>

			<tr>
    				<td align="right"><label for="cidade" class="arial_cinza2_12" >Cidade</label></td>
    				<td><input style="width: 490px;" name ="cidade" type="text" class="forms"  required="required" /></td>
			  </tr>
			<tr>
    				<td align="right"><label for="estado" class="arial_cinza2_12" >Estado</label></td>
    				<td><input style="width: 490px;" name ="estado" type="text" class="forms"  required="required" /></td>
			  </tr>

			<tr>
    				<td align="right"><label for="cep" class="arial_cinza2_12" >CEP</label></td>
    				<td><input style="width: 490px;" name ="cep" type="text" class="forms"  required="required" /></td>
			  </tr>
			<tr>
    				<td align="right"><label for="telefone" class="arial_cinza2_12" >Telefone</label></td>
    				<td><input style="width: 490px;" name ="telefone" type="text" class="forms"  required="required" /></td>
			  </tr>
			<tr>
    				<td align="right"><label for="celular" class="arial_cinza2_12" >Celular</label></td>
    				<td><input style="width: 490px;" name ="celular" type="text" class="forms"  required="required" /></td>
			  </tr>
	         	 <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Email</label></td>
    				<td><input style="width: 490px;" name ="email" type="email" class="forms"  required="required" /><input type="hidden"  name="id_ped" value="<?php echo $idped;?>"><input type="hidden"  name="idf" value="<?php echo ($idf);?>"></td>
			  </tr>
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" ></label></td>
    				<td><b>Dados do Cão:</b></td>
			  </tr>
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Nome do cão</label></td>
    				<td><input style="width: 490px;" name ="nome_cao" type="text" value="<?=$nome?>" class="forms" id="cc"  required="required"/></td>
			  </tr>
	  		<tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Microchip</label></td>
    				<td><input style="width: 490px;" name ="mic" type="text" value="<?=$mic?>" class="forms" id="ccm"  /></td>
			  </tr>
              
             


          <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" > </label></td>
    				<td> É necessário um email válido para concluir o processo.<br>Após o pagamento, não esqueça de enviar o documento original.</td>
			  </tr>
          <tr>
                <td align="right">&nbsp;</td>
                <td>
 <br><input name="pc" type="hidden" value="<?=$val?>" ><input type="submit"><br>
                </td>            
              </tr>
              
			</table></form>
  			


</div>
     
    </div> 
    </div>
    <script>

var x='in';
	$('#mae').append('<'+x+'put type="hidden" name="blockme" value="'+Math.random()+'">');	
$("#pagseguro2").submit(function(){

	//$.post('env_trans.php',{prop: $(".f1 input:eq(1)").val(),nome_cao: $(".f1 input:eq(2)").val(),mic: $(".f1 input:eq(3)").val(),end: $(".f1 input:eq(4)").val(),cep: $(".f1 input:eq(5)").val(),tel: $(".f1 input:eq(6)").val(),cpf: $(".f1 input:eq(7)").val(),email: $(".f1 input:eq(9)").val(),id_ped: $(".f1 input:eq(10)").val(),id_f: $(".f1 input:eq(11)").val()},function(data){alert('Verifique o email após o pagamento.');return true;});
	//return false;
	$('#apg').remove();

});
	
</script>




</script>
    <?php include "includes/informacoes.php"; ?>    

<script>
function verifica(){
	var microchip = document.getElementById("microchip").value;
	var verifica = microchip.substring(0,3);
	if (verifica !=981&&verifica !=963){
		alert("Favor corrigir o número do microchip");
	}
	if (verifica ==981||verifica ==963){
		$('#qrcode').removeAttr('readonly');
	}
}

function verifica_qrcode(){
var qrcode = document.getElementById("qrcode").value;
if(qrcode=='' || qrcode==' ' ){
alert ("QRCODE inválido");	
}
else{
		$('input').removeAttr('readonly');
}
}
</script>    
 
 </div>
</div>
<?php include "includes/footer.php";?>
</body>
</html>
