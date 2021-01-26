<!DOCTYPE html>
<?php

require_once("Connections/conexao.php");
$busca=substr($_GET['consultar'],0,10);
$estado=substr($_GET['estado'],0,10);

if(isset($_GET['consultar']))$sql = "SELECT  *  FROM  `credenciado` join dados_credenciado on credenciado.id_credenciado=dados_credenciado.id_dados   WHERE (nome ='$busca' or nome LIKE '%$busca%')AND id_credenciado not in(14,17,15,43,44,41,16,58,68) order by credenciado.nome asc ";
if(isset($_GET['estado']))$sql = "SELECT  *  FROM  `credenciado` join dados_credenciado on credenciado.id_credenciado=dados_credenciado.id_dados   WHERE (estado='$estado')AND id_credenciado not in(14,17,15,43,44,41,16,58,68) order by credenciado.nome asc ";

$query = mysql_query($sql) or die(mysql_error());
//or estado='$busca'


$nn=mysql_num_rows($query);
//Pegando o TOTAL DE REGISTROS 

?><head>
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
<meta name="url" content="http://www.sobraci.org"> 
<meta name="author" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />

<link rel="stylesheet" type="text/css" href="./site/css/style.css" />
<link rel="stylesheet" type="text/css" href="./site/css/style_fonts.css" />
<link rel="shortcut icon" href="favicon.png" />
<title>::. SOBRACI - Sociedade Brasileira de Cinofilia Independente - Registro Pedigree Cães - Cachorro - Filhotes .::</title>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed">
<?php include "includes/header.php";?>
	<script type="text/javascript" src="./jquery/fancy/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="./jquery/fancy/source/jquery.fancybox.js?v=2.1.3"></script>
	<link rel="stylesheet" type="text/css" href="./jquery/fancy/source/jquery.fancybox.css?v=2.1.2" media="screen" />
	<link rel="stylesheet" type="text/css" href="./jquery/fancy/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="./jquery/fancy/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<link rel="stylesheet" type="text/css" href="./jquery/fancy/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="./jquery/fancy/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="./jquery/fancy/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>

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
    <div class="internas_titulo">BUSCA CREDENCIADO - <?php echo strtoupper(str_replace("%","todos",strip_tags($_GET['consultar'].$_GET['estado'])));?></div>
    <div class="principal_noticias_box" style="width: 98%;">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10" colspan="2" class="oswald_cinza16"></td>
          </tr>
          <tr>
            <td colspan="2" class="oswald_cinza16">Pesquisar Credenciados:</td>
          </tr>
          <tr><form action="credenciado.php">
            <td width="77%"><input name="consultar" type="text" class="credenciados_forms" id="credenciados"/></td>
            <td width="23%" align="right"><input class="botao" type="image" src="images/botoes/ok.jpg" align="absmiddle"/></td></form>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="right">&nbsp;</td>
          </tr>	
    </table>



<div class="principal_noticias_not" style="background-color: lightGoldenrodYellow;">
        <div class="margin6">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody><tr>
            <td width="125" rowspan="2" align="center"><div class="principal_noticias_foto" style="width:94px;height: 94px;"><img src="./images/logo_credenciados/logo_adm.jpg" border="0" style="width:84px;height:84px; border:1px solid grey;"></div></td>
            <td height="40" align="left" class="oswald_cinza15">ADMINISTRAÇÃO NACIONAL</td>
          </tr>
          <tr>
            <td align="left" valign="top" class="arial_cinza11_not"><a href="mailto:adm@sobraci.org" class="arial_cinza11_not">Email: adm@sobraci.org<br>
Tel: (11) 4206-2037
</a>
            <!--a class="arial_cinza11_not" target="_top" href="#"><br>Local:Rua Thomekiti Kira, n° 287 – Cj. 218 – Edifício Prime Office 23 – Bairro: Granja Viana – Cotia/SP – CEP: 06709-046</a-->
            <br>
            </td>
          </tr>
        </tbody></table>
        </div>        
        </div>

	

	<div class="principal_noticias_not">
        <div class="margin6" style="width:90%;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody><tr>
            <td width="125" rowspan="2" align="center"><div class="principal_noticias_foto" style="width:94px;height: 94px;"><img src="./images/logo_credenciados/logo_sorocaba.jpg" border="0" style="width:84px;height:84px; border:1px solid grey;"></div></td>
            <td height="40" align="left" class="oswald_cinza15"><a class="oswald_cinza15" target="_top" href="http://www.sobraci.org/"> SOBRACI SOROCABA</a></td>
          </tr>
          <tr>
            <td align="left" valign="top" class="arial_cinza11_not"><a href="mailto:nucleosorocaba@sobraci.org" class="arial_cinza11_not">Email:nucleosorocaba@sobraci.org</a><a class="arial_cinza11_not" target="_top" href="http://www.sobraci.org/"><br>Local:RUA MARIA CINTO DE BIAGGI, N˚ 243 – SANTA ROSÁLIA SOROCABA / SP – CEP: 18095-410</a><br>Tel:(15) 3232-6601 (15) 3211-1725</td>
          </tr>
        </tbody></table>
        </div>        
        </div>


   <?php
if($nn>0){
 while($l=mysql_fetch_assoc($query)){
	 
	 
	 ?>
    	<div class="principal_noticias_not">
        <div class="margin6">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody><tr>
            <td width="125" rowspan="2" align="center"><div class="principal_noticias_foto" style="width:94px;height: 94px;"><img src="./images/logo_credenciados/<?php echo $l['foto'];?>" border="0" style="width:84px;height:84px; border:1px solid grey;"></div></td>
            <td height="40" align="left" class="oswald_cinza15"><a class="oswald_cinza15" target="_top" href="http://<?php echo $l['link'];?>"> <?php echo $l['nome'];?></a></td>
          </tr>
          <tr>
            <td align="left" valign="top" class="arial_cinza11_not"><a href="mailto:<?php echo $l['email'];?>" class="arial_cinza11_not">Email:<?php echo $l['contato'];?></a><a class="arial_cinza11_not" target="_top" href="http://<?php echo $l['link'];?>"><br>Local:<?php echo $l['endereco'];?></a><br>Tel:<?php echo $l['tel'];?>
            </td>
          </tr>
        </tbody></table>
        </div>        
        </div>
           <?php }
}else echo 'Nenhum registro encontrado';
?>
    </div>
    </div>
    
    <?php include "includes/informacoes.php"; ?>    
    
 
 </div>
</div>
<?php include "includes/footer.php";?>
</body>

<style>
.principal_noticias_box{width:100%}
.principal_noticias_not{width:100%}
</style>
</html>
