<?php
$resultado = "";

$v=array('PET LIGHT','PET PLUS','PET TOTAL','PET PREMIUM');

$plan=(int)$_GET['p'];

if($_POST){

$nome  = $_POST["nome"];
$telefone   = $_POST["phone"];
$email  = $_POST["email"];
$assunto  = $_POST["subject"];
$mensagem  = $_POST["message"];

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = 'Assunto: ' . $assunto . '
'. '
Nome: ' . $nome . '
Telefone: '. $telefone . '
Email: '. $email . '
Assunto: '. $assunto . '
'. '
Mensagem: '. '
'. $mensagem . '
'. '
';
$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: Convenio Saude Pet <comercial@conveniosaudepet.com.br>\n"; // remetente
$headers .= "Return-Path: diagnosticando <comercial@conveniosaudepet.com.br>\n"; // return-path
$envio = mail("comercial@conveniosaudepet.com.br", "$assunto", "$mensagemHTML", $headers,'-rcomercial@conveniosaudepet.com.br');

$resultado = "<a href='#' data-reveal-id='myModal' id='sucesso'></a>
			 <div id='myModal' class='reveal-modal'>
			 <div class='helvetica_vermelho45' style='width:100%; text-align:center;'>
			 Sua solicitação de informações adicionais <br>Foi enviada com sucesso!</div>
			 <a class='close-reveal-modal'>&#215;</a>
			 </div>";
}
?>
<!DOCTYPE html>
<header>
<meta charset="utf-8"> 
<meta name="robots" content="index, follow" />
<meta name="keywords" content="convênio saúde, plano de saúde animal, plano de saúde para cachorro, plano de saúde cachorro, plano de saúde para gato, plano de saúde gato, plano de saúde para pet, plano de saúde pet, assistência médica pet, health for pet, healthforpet, health4pet, assistência medica cão e gato" /> 
<meta name="description" content="Convênio Saúde Pet - O mais novo e completo convênio de saúde para pets do Brasil"/>
<meta name="subject" content="Convênio Saúde Pet">
<meta name="robots" content="index,follow,noodp">
<meta name="Googlebot" content="index,follow">
<meta name="Abstract" content="Convênio Saúde Pet - O mais novo e completo convênio de saúde para pets do Brasil" />
<meta name="copyright" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />
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
<meta name="author" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />

<link rel="shortcut icon" href="favicon.png" />
<title>Convênio Saúde Pet - O mais novo e completo convênio de saúde para pets do Brasil</title>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed">
<?php include "includes/header.php";?>

<link href='http://fonts.googleapis.com/css?family=Titillium+Web:200italic,200,300,300italic,400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
        
<!--[if lt IE 9]><script type="text/javascript" src="http://www.health4pet.com.br/static/javascripts/plugins/ui/html5.js"></script><![endif]-->
<!--[if (gt IE 8) | (IEMobile)]><!--><link href="jquery/health/unsemantic-grid-responsive-tablet.css" rel="stylesheet" type="text/css" /><!--<![endif]-->
<!--[if (lt IE 9) & (!IEMobile)]><link href="http://www.health4pet.com.br/static/stylesheets/ie.css" rel="stylesheet" type="text/css" /><![endif]-->
        
<link href="jquery/health/jquery.qtip.min.css" rel="stylesheet" type="text/css" />
<link href="jquery/health/settings.css" rel="stylesheet" type="text/css" />
        
<link href="jquery/health/theme.css" rel="stylesheet" type="text/css" />
        
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
        
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
            window.onload = function(){  
                document.getElementById('sucesso').click();  
            }  
</script>

<script language="JavaScript" src="jquery/validacao/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript"> 
 $(document).ready( function() {
                $("#form1").validate({
                    rules:{                       
                        nome:{
                            required: true, minlength: 3
                        },						
						email:{
                            required: true, email: true
                        },	
						message:{
                            required: true, minlength: 10
                        },						
						phone:{
                            required: true, minlength: 7
                        }				
                    },
                    // Define as mensagens de erro para cada regra
                    messages:{
                        nome:{
                            required: "<br>&nbsp;Digite o seu Nome",
                            minlength: "<br>&nbsp;Mínimo, 3 caracteres"
                        },	
						email: "<br>&nbsp;Por favor insira um e-mail válido",	
						message:{
                            required: "<br>&nbsp;Digite uma mensagem",
                            minlength: "<br>&nbsp;Mínimo de 10 caracteres"
                        },	
						phone:{
                            required: "<br>&nbsp;Digite o Telefone para contato",
                            minlength: "<br>&nbsp;O Telefone para contato deve ter no mínimo, 7 caracteres"
                        }	
					}
                });
            });
</script>
<?=$resultado?>
<div id="contactPage" class="full-container grid-100">
		
		<div class="grid-container">
			
			<div class="grid-parent grid-100 tablet-grid-60 mobile-grid-100 padding-top-40">
				
				<div class="header grid-parent grid-60 tablet-grid-60 mobile-grid-100 push-20 tablet-push-20 mobile-push-0 margin-bottom-20">
					
					<h2>Proposta Convênio Saúde Pet - Plano <?=$v[$p]?></h2>
					
					<p>
						
						
						</p><!--ul class="phones">
							<li><a class="phone" href="callto:1126902290 "><i class="icon-phone"></i> (11) 2690-2290</a></li>
						</ul-->
					<p></p>
					
				</div>
				
				<div class="grid-parent grid-100 tablet-grid-100 mobile-grid-100 margin-top-30">
					
					<form name="form1" id="form1" method="post" action="form_pet.php?p=<?=$_GET['p']?>">
						
						
						<fieldset>
							
							<div class="contactData">								
								<div class="control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Nome:</label>
									</div>
									<div class="controls grid-50 tablet-grid-60 mobile-grid-100" style="font-size:12px; color:#F00;">
										<input name="nome" placeholder="Digite seu nome" class="grid-100 tablet-grid-100 mobile-grid-100 validate[required]" data-message-class="error" data-message-icon="icon-exclamation-sign" type="text" required>
									</div>
								</div>
							
								<div class="control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent" style="font-size:12px; color:#F00;">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">CPF:</label>
									</div>
									<div class="controls grid-15 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="cpf" id="cepe" data-mask="999.999.999-99" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>
									<div class="labels grid-5 tablet-grid-40 mobile-grid-100">
										<label class="control-label">nasc:</label>
									</div>
									<div class="controls grid-15 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="data_nascimento" data-mask="99/99/9999" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>

									<div class="labels grid-5 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Sexo:</label>
									</div>
									<div class="controls grid-10 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<select name="sexo" class="grid-100 tablet-grid-100 mobile-grid-100 valid"><option>selecione..</option><option>Masculino</option><option>Feminino</option></select>
									</div>
								</div>

								<div class="control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Endereço:</label>
									</div>
									<div class="controls grid-50 tablet-grid-60 mobile-grid-100">
										<input name="endereço"  class="grid-100 tablet-grid-100 mobile-grid-100 validate[required]" data-message-class="error" data-message-icon="icon-exclamation-sign" type="text" required>
									</div>
								</div>
								

								<div class="control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent" style="font-size:12px; color:#F00;">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Número:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="número" data-mask="9********" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>
									<div class="labels grid-10 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Complemento:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="complemento"  class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>
								</div>

								<div class="control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent" style="font-size:12px; color:#F00;">
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



								<div class="control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent" style="font-size:12px; color:#F00;">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Estado</label>
									</div>
									<div class="controls grid-5 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="estado" data-mask="**" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>
									<div class="labels grid-5 tablet-grid-40 mobile-grid-100">
										<label class="control-label">CEP</label>
									</div>
									<div class="controls grid-10 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="cep" data-mask="99999-999" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>

									<div class="labels grid-10 tablet-grid-40 mobile-grid-100">
										<label class="control-label">&nbsp;Telefone:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="telefone" data-mask="(99) 99999999*" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>
									
								</div>

								<div class="control-group grid-100 tablet-grid-100 mobile-grid-100 grid-parent" style="font-size:12px; color:#F00;">
									<div class="labels grid-30 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Celular:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="celular" data-mask="(99) 99999999*" class="grid-100 tablet-grid-100 mobile-grid-100 valid" type="text" required>
									</div>
									<div class="labels grid-10 tablet-grid-40 mobile-grid-100">
										<label class="control-label">Email:</label>
									</div>
									<div class="controls grid-20 tablet-grid-25 mobile-grid-40" style="font-size:12px; color:#F00;">
										<input name="email" placeholder="Digite seu e-mail" class="grid-100 tablet-grid-100 mobile-grid-100 validate[required,custom[email]]" data-message-class="error" data-message-icon="icon-exclamation-sign" type="text">
									</div>
								</div>


								
							
								
								<div class="grid-parent grid-50 tablet-grid-60 mobile-grid-100 push-30 tablet-push-40 mobile-push-0">
									<button type="submit" class="display-block">Enviar</button>
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
label {font-size: 15px;}
</style>

<br />
<?php include "includes/footer.php";?>
</body>
</html>
