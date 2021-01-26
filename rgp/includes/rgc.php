<?php
require_once("Connections/conexao.php");

$resultado = "";

if($_POST){


/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '';
foreach($_POST as $k=>$v)$mensagemHTML.="$k : $v
";
$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: Site Sobraci <".$_POST['email'].">\n"; // remetente
$headers .= "Return-Path: diagnosticando <info@neoware.com.br>\n"; // return-path
//$envio = mail("debora@neoware.com.br", "$assunto", "$mensagemHTML", $headers);
$envio = mail("nucleocotia@sobraci.org", "RGC SOBRACI", "$mensagemHTML", $headers,'-nucleocotia@sobraci.org');

$resultado = "alert('RGC Enviado');";
}
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
    <div class="internas_titulo">REGISTRO GERAL CANINO</div>
    <div class="arial_cinza1_11" style="margin-top:50px;">
      <p><b>O que é o registro inicial canino?</b><br><br>
A Sobraci inovando mais uma vez criou o RGC Registro Geral Canino, onde  todos os cães de todas as raças poderá obter um número de identificação Sobraci  atrelado ao microchip, onde será efetuado um cadastro nacional de cães,  possibilitando no caso de extravio, perda ou roubo do animal que o mesmo seja  encontrado. Não é necessário que o cão possua pedigree, inclusive cães SRD (Sem  Raça Definida) poderão aderir ao sistema do RGC Registro Geral Canino, cujo o  foco principal é a identificação e segurança do animal.<br>
A Sobraci vai fornecer o Cartão de Identificação juntamente com o  microchip a ser aplicado. Faça agora mesmo o RGC do seu cão.<br>
</p><style>#emailForm input{width: 420px}</style><div style="border: 2px solid gray;margin: 21px;background-color:whiteSmoke">
<form method="post" name="emailForm" id="emailForm" style="margin-left: 143px;margin-top: 69px;">
<H1 >Formulário RGC</h1>
Nome completo: <br>
                <input type="text" name="nome" id="nome" size="30" value=""  >
                <br>
                RG:<br>
                <input type="text" name="rg" id="rg" size="30" value=""  >                
                <br>
                CPF:<br>
                <input type="text" name="cpf" id="cpf" size="30" value=""  >                                
                <br>
                Endereço:<br>
                <input type="text" name="endereco" id="endereco" size="30" value=""  >                                                
                <br>
                Bairro:<br>
                <input type="text" name="bairro" id="bairro" size="30" value=""  >   <br>                                                             
               Cidade:<br>
                <input type="text" name="cidade" id="cidade" size="30" value=""  ><br>
				Estado:<br>
                <input type="text" name="estado" id="estado" size="30" value=""  >
<br>
CEP:<br>
                <input type="text" name="cep" id="cep" size="30" value=""  >                
<br>
Telefone residencial: 
                <br>
                <input type="text" name="tel_res" id="tel_res" size="30" value=""  >                                
<br>
Telefone Telefone comercial:
                <br>
                <input type="text" name="tel_com" id="tel_com" size="30" value=""  >                                                
<br>
Celular:<br>
                <input type="text" name="celular" id="celular" size="30" value=""  >                                                                
<br> E-mail:  <br>
                <input type="text" name="email" id="email" size="30" value=""  >
<br>
Foto do cão: 
                <br>
                <input type="file" name="foto" id="foto" size="30" value=""  ><br>
  Nome do cão: 
                <br>
                <input type="text" name="email" id="email" size="30" value=""  >
<br>
  Data de Nascimento: 
                <br>
                <input type="text" name="nascimento" id="nascimento" size="30" value=""  >                
<br>
  Raça: 
                <br>
                <input type="text" name="raca" id="raca" size="30" value=""  >                                
<br>
  Sexo: 
                <br>
                <input type="text" name="sexo" id="sexo" size="30" value=""  >                                
<br>
  Cor: 
                <br>
                <input type="text" name="cor" id="cor" size="30" value=""  ><br>                                                
Caso não saiba o nome do pai e da mãe, <br>preencha com seu nome e seja o Papai e Mamãe do seu cão.
<br><br>
  Nome do Pai: 
                <br>
                <input type="text" name="pai" id="pai" size="30" value=""  >
<br>
  Nome da Mãe: 
                <br>
                <input type="text" name="mae" id="mae" size="30" value=""  ><br>
                <input type="submit" value="Enviar" style="height: 40px;margin-top:20px">
		<br><br><br><br>
                </form></div>
     
    </div> 
    </div>
    <script><?php echo $resultado;?></script>
    <?php include "includes/informacoes.php"; ?>    
    
 
 </div>
</div>
<?php include "includes/footer.php";?>
</body>
</html>
