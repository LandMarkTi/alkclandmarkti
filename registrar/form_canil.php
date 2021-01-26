<?php

require_once("../site/Connections/conexao.php");

$sql = "SELECT  *  FROM  `credenciado` left join dados_credenciado on credenciado.id_credenciado=dados_credenciado.id_dados   WHERE id_credenciado not in (16,44,68,43,17,15,43,41,109,102) and id_credenciado>85 order by nome";


$sel='<option value="102">Kennel Clube Brasil</option>';
$query = mysql_query($sql) or die(mysql_error());
while($opt=mysql_fetch_assoc($query))$sel.='<option value="'.$opt['id_credenciado'].'">'.$opt['nome'].'</option>';

?>
<!DOCTYPE html>
<header>
<meta charset="utf-8"> 
<meta name="robots" content="index, follow" />
<meta name="keywords" content="convênio saúde, plano de saúde animal, plano de saúde para cachorro, plano de saúde cachorro, plano de saúde para gato, plano de saúde gato, plano de saúde para pet, plano de saúde pet, assistência médica pet, health for pet, healthforpet, health4pet, assistência medica cão e gato" /> 
<meta name="description" content="Convênio Saúde Pet - O mais novo e completo convênio de saúde para pets do Brasil"/>
<meta name="subject" content="Convênio Saúde Pet">
<meta name="robots" content="index,follow,noodp">
<meta property="og:type" content="product"/>
<meta property="og:title" content="Convênio Saúde Pet"/>
<meta property="og:image" content="http://www.conveniosaudepet.com.br/images/logo_header.png"/>
<meta property="og:site_name" content="Convênio Saúde Pet" />
<meta property="og:description" content="Convênio Saúde Pet - O mais novo e completo convênio de saúde para pets do Brasil" />
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
<meta name="url" content="http://www.conveniosaudepet.com.br"> 




<link rel="shortcut icon" href="favicon.png" />
<title>registrar Canil</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/reset.css" />
<link href='http://fonts.googleapis.com/css?family=PT+Sans|PT+Sans+Narrow' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'PT+Sans::latin', 'PT+Sans+Narrow::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); 
</script>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php //include "includes/header.php";?>

<link href='http://fonts.googleapis.com/css?family=Titillium+Web:200italic,200,300,300italic,400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
        
<!--[if lt IE 9]><script type="text/javascript" src="http://www.health4pet.com.br/static/javascripts/plugins/ui/html5.js"></script><![endif]-->
<!--[if (gt IE 8) | (IEMobile)]><!--><link href="jquery/health/unsemantic-grid-responsive-tablet3.css" rel="stylesheet" type="text/css" /><!--<![endif]-->
<!--[if (lt IE 9) & (!IEMobile)]><link href="http://www.health4pet.com.br/static/stylesheets/ie.css" rel="stylesheet" type="text/css" /><![endif]-->
        
<link href="jquery/health/jquery.qtip.min.css" rel="stylesheet" type="text/css" />
<link href="jquery/health/settings.css" rel="stylesheet" type="text/css" />
        
<link href="jquery/health/theme.css" rel="stylesheet" type="text/css" />
        
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
        
	<script type="text/javascript" src="cep.js"></script>
<script type="text/javascript" src="jquery/health/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="jquery/health/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="jquery/health/jquery.touchwipe.min.js"></script>
<script type="text/javascript" src="jquery/health/jquery.jgrowl.js"></script>
<script type="text/javascript" src="jquery/health/jquery.qtip.min.js"></script>
<script type="text/javascript" src="jquery/health/prettify.js"></script>
<script type="text/javascript" src="jquery/health/skrollr.min.js"></script>  
        
<script type="text/javascript" src="jquery/health/jquery.form.js"></script>
<script type="text/javascript" src="jquery/health/jquery.uniform.min.js"></script>
<script type="text/javascript" src="jquery/health/jquery.autosize.js"></script>
<script type="text/javascript" src="jquery/health/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="jquery/health/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="jquery/health/jquery.inputmask.js"></script>
<script type="text/javascript" src="jquery/health/jquery.select2.min.js"></script>
<script type="text/javascript" src="jquery/health/jquery.listbox.js"></script>
<script type="text/javascript" src="jquery/health/jquery.validation.js"></script>
<script type="text/javascript" src="jquery/health/jquery.validationEngine-pt_BR.js"></script>
      
        
<script type="text/javascript" src="jquery/health/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="jquery/health/jquery.themepunch.revolution.min.js"></script>        
        
<script type="text/javascript" src="jquery/health/functions.js"></script>
<script type="text/javascript" src="jquery/health/theme.js"></script>
<script type="text/javascript" src="jquery/reveal/jquery.reveal.js"></script>
<link rel="stylesheet" href="jquery/reveal/reveal.css">	

<script type="text/javascript">  
 
</script>

<script language="JavaScript" src="jquery/validacao/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript"> 
 $(document).ready( function() {

            });
</script>
<?=$resultado?>
<div id="contactPage" class="full-container grid-100">
		
		<div class="grid-container">
			
			<div class="grid-parent grid-100 tablet-grid-90 mobile-grid-100 padding-top-40">
				
				<div class="header grid-parent grid-90 tablet-grid-90 mobile-grid-100 push-20 tablet-push-20 mobile-push-0 margin-bottom-20">
					
					<h2>Registro Canil ALKC</h2>
					
					
					
				</div>
				
				<div class="grid-parent grid-100 tablet-grid-100 mobile-grid-100 margin-top-30">
					
					<form name="form1" id="form1" method="post" action="ok.php" onSubmit="$('.pe1').hide();$('.pe2').show();return false;">
						
						
						<fieldset>
							
							<div class="contactData">								
								<div class="pe1 control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Kennel:</label>
									</div>
									<div class="controls grid-50 tablet-grid-60 mobile-grid-100" style="font-size:12px; color:#F00;">
										<select name="sexo" class="grid-100 tablet-grid-40 mobile-grid-40 validate" data-message-class="error" data-message-icon="icon-exclamation-sign" required><option value=''>Selecione..</option><?=$sel;?></select>
									</div>
								</div>
							
								<div class="pe1 control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent" style="font-size:12px; color:#F00;">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Nome:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="nome"  placeholder="Seu nome" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" onblur="$('#nome_completo').val(this.value);" required>
									</div>
									<div class="labels grid-10 tablet-grid-40 mobile-grid-100">
										<label class="control-label">RG:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="rg"  placeholder="RG" class="grid-100 tablet-grid-100 mobile-grid-100 valid" data-mask="99.999.999" type="text" required>
									</div>
								</div>


								<div class="pe1 control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent" style="font-size:12px; color:#F00;">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">CPF:</label>
									</div>
									<div class="controls grid-15 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="cpf" placeholder="CPF" id="cepe" data-mask="999.999.999-99" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>
									<div class="labels grid-5 tablet-grid-40 mobile-grid-100">
										<label class="control-label">nasc:</label>
									</div>
									<div class="controls grid-15 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="data_nascimento" placeholder="Nascimento" data-mask="99/99/9999" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>

									<div class="labels grid-5 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Sexo:</label>
									</div>
									<div class="controls grid-10 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<select name="sexo" class="grid-100 tablet-grid-100 mobile-grid-100 valid"><option>selecione..</option><option>Masculino</option><option>Feminino</option></select>
									</div>
								</div>



								<div class="pe1 control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent" style="font-size:12px; color:#F00;">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">CEP</label>
									</div>
									<div class="controls grid-10 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="cep" id="cep" placeholder="CEP" data-mask="99999-999" onblur="getEndereco();" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>
									<div class="labels grid-5 tablet-grid-40 mobile-grid-100 adr">
										<label class="control-label"> Estado</label>
									</div>
									<div class="controls grid-5 tablet-grid-25 mobile-grid-40 adr" style="font-size:12px; color:#F00;">
										<input name="estado" data-mask="**" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>

									<div class="labels grid-10 tablet-grid-40 mobile-grid-100">
										<label class="control-label">&nbsp;Telefone:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="telefone" placeholder="Telefone" data-mask="(99) 99999999*" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>
									
								</div>


								<div class="pe1 control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent adr">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Endereço:</label>
									</div>
									<div class="controls grid-50 tablet-grid-60 mobile-grid-100">
										<input name="endereco"  class="grid-100 tablet-grid-40 mobile-grid-40"  type="text" required>
									</div>
								</div>
								

								<div class="pe1 control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent adr" style="font-size:12px; color:#F00;">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Número:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="número" placeholder="Nº" data-mask="9********" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>
									<div class="labels grid-10 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Complemento:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="complemento"  placeholder="Complemento" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" >
									</div>
								</div>

								<div class="pe1 control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent adr" style="font-size:12px; color:#F00;">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Bairro:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="bairro"  class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>
									<div class="labels grid-10 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Cidade:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="cidade"  class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>
								</div>



								<div class="pe1 control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent" style="font-size:12px; color:#F00;">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Celular:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="celular" placeholder="Celular" data-mask="(99) 99999999*" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" >
									</div>
									<div class="labels grid-10 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Email:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="email" placeholder="Email Válido" placeholder="Digite seu e-mail" class="grid-100 tablet-grid-100 mobile-grid-100 validate[required,custom[email]]" data-message-class="error" data-message-icon="icon-exclamation-sign" type="text">
									</div>
								</div>


								<div class="pe1 control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Raças:</label>
									</div>
									<div class="controls grid-50 tablet-grid-60 mobile-grid-100">
										<input name="Raças" placeholder="Criador das Raças" class="grid-100 tablet-grid-40 mobile-grid-40"  type="text" required>
									</div>
								</div>
								
								<div class="pe1 control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent" style="font-size:12px; color:#F00;">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Afixo:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="afixo"  placeholder="Afixo" class="display-block grid-100 tablet-grid-40 mobile-grid-40" type="text" id="opnome" onblur="$.post('../painel_kennel/vernome.php',{non:$('#opnome').val()},function(data){alert(data);if(data=='Esse Nome Já existe'){$('#opnome').val('');}else{$('#afix').val($('#opnome').val());}});" required>
									</div>
							
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="ck" value="Verificar"  class="grid-80 tablet-grid-80 mobile-grid-80 push-50 valid" type="submit" onclick="return false">
									</div>
								</div>
							

								<div class="pe1 control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent" style="font-size:12px; color:#F00;">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label"></label>
									</div>
									<div class="controls grid-30 tablet-grid-25 mobile-grid-40 push-10" style="font-size:12px; color:#F00;">
										<p>O Afixo será utilizado como:</p>
									</div>
							
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
																				<select name="tipo" class="grid-100 tablet-grid-100 mobile-grid-100 valid"><option value="">selecione..</option><option>Prefixo</option><option>Sufixo</option></select>
									</div>
								</div>

								
								<div class="pe1 grid-parent grid-50 tablet-grid-40 mobile-grid-40 push-30 tablet-push-40 mobile-push-0">
									<button type="submit" class="display-block grid-100 tablet-grid-40 mobile-grid-40" onclick="$(window).scrollTop(0);">Continuar</button>
								</div>

								<div class="pe2 control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label"></label>
									</div>
									<div class="controls grid-50 tablet-grid-60 mobile-grid-100">
										<p>Eu, <input name="nome_completo" id="nome_completo" value=" " style="width: 20%;height: 13px;
border: 0px none;border-bottom:1px dotted black;margin-bottom:-5px;color:#2b829e;background-color:transparent;border-radius:0px"> solicito junto ao ALKC – América Latina Kennel Clube a minha filiação e registro do Afixo 
<input name="afix" id="afix" style="width: 20%;height: 13px;
border: 0px none;border-bottom:1px dotted black;margin-bottom:-5px;color:#2b829e;background-color:transparent;border-radius:0px" value=" ">

										, estou ciente que a aceitação e registro do nome é analisado pelo sistema e que mesmo após aprovado, o registro, se algum criador venha reivindicar similaridade de nome o mesmo está sujeito a ser alterado por conveniência do ALKC sem prévio aviso. Declaro que irei respeitar e acatar as normas e regras do ALKC no decorrer da minha filiação perante ao Clube, estou ciente que a manutenção do nome e fornecimento do sistema são serviços da ALKC e concordo com a taxa de manutenção anual.
Tenho ciência que todas as informações concedidas para a elaboração do registro do afixo e posterior registro de cães são de minha inteira responsabilidade, declaro que li e aceito os termos dispostos e autorizo a divulgação dos meus dados dentro do Clube de benefícios do ALKC recebendo informativos e novidades sobre a Cinofília Nacional e Mundial. </p>
									</div>
								</div>

								<div class="pe2 control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">☑</label>
									</div>
									<div class="controls grid-50 tablet-grid-60 mobile-grid-100">
										<p>Declaro que li, aceito e autorizo a divulgação dos meus dados dentro do sistema ALKC.</p>
									</div>
								</div>
								
								<div class="pe2 grid-parent grid-50 tablet-grid-40 mobile-grid-40 push-30 tablet-push-40 mobile-push-0">
									<button type="submit" class="display-block grid-100 tablet-grid-40 mobile-grid-40" onclick="$('#form1').attr('onsubmit','').submit();">Continuar</button>
								</div>
								<div class="clear"></div>
								
								<div class="messages grid-parent grid-50 tablet-grid-60 mobile-grid-100 push-30 tablet-push-40 mobile-push-0 margin-top-10">
									<div class="success"><i class="icon-ok-sign"></i><span>Seus dados foram enviados com sucesso. Obrigado!</span></div>
									<div class="error"><i class="icon-exclamation-sign"></i><span>Ops! Ocorreu um erro ao enviar.<br>Por favor, confirme os dados enviados e tente novamente.</span></div>
								</div>
								
							</div><!-- /.contactData -->
							
						</fieldset>
						
					</form>
					
				</div>
				
			</div>
			
			
			
		</div>
		
	</div>
<script>

function vc(str){
    str = str.replace('.','');
    str = str.replace('.','');
    str = str.replace('-','');
 
    cpf = str;
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    digitos_iguais = 1;
    if (cpf.length < 11)
        return false;
    for (i = 0; i < cpf.length - 1; i++)
        if (cpf.charAt(i) != cpf.charAt(i + 1)){
            digitos_iguais = 0;
            break;
        }
    if (!digitos_iguais){
        numeros = cpf.substring(0,9);
        digitos = cpf.substring(9);
        soma = 0;
        for (i = 10; i > 1; i--)
            soma += numeros.charAt(10 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0)){alert('CPF é Obrigatório!');return false;}
        numeros = cpf.substring(0,10);
        soma = 0;
        for (i = 11; i > 1; i--)
            soma += numeros.charAt(11 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1)){alert('CPF é Obrigatório!');return false;}
        return true;
    }
    else{alert('CPF é Obrigatório!');return false;}
}
$('#cepe').blur(function(){
var cepe=$('#cepe').val();
//cepe=cepe.replace('.','');
//cepe=cepe.replace('-','');
if (vc(cepe)==false)$('#cepe').val('').focus();

});

$('input[name=data_nascimento]').blur(function(){if(this.value=='00/00/0000')this.value='';});
</script>
<style>

label {height: 31px;
font-size: 18px;}


.pe2{display:none;
}

.adr{display:none;
}
</style>

<br />
<?php //include "includes/footer.php";?>
</body>
</html>
