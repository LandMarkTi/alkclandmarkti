<!DOCTYPE html>
<?php

require_once("Connections/conexao.php");
$g=(int)$_GET['grupo'];
$sql = "SELECT  * from subcategoria WHERE idCategoria=".$g." order by nomeSubcategoria asc";
$query = mysql_query($sql) or die('eg');
//Pegando o TOTAL DE REGISTROS 

?>
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
<meta name="url" content="http://www.sobraci.org"> 
<meta name="author" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />

<link rel="stylesheet" type="text/css" href="./site/css/style.css" />
<link rel="stylesheet" type="text/css" href="./site/css/style_fonts.css" />
<link rel="shortcut icon" href="favicon.png" />
<title>::. SOBRACI - Sociedade Brasileira de Cinofilia Independente - Registro Pedigree Cães - Cachorro - Filhotes .::</title>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed">
<script type="text/javascript" src="jquery/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="./css/style.css" />
<link rel="stylesheet" type="text/css" href="./css/style_fonts.css" />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Oswald::latin' ] }
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
<?php //include "includes/header.php";?>
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

<div class="internas_full" style="width: 750px;">
 <div class="internas_margem_full" style="width: 750px;">
 
 	<div class="internas_box">
    <!--div class="internas_titulo">Raças</div avenir light/bold-->
    <div class="principal_noticias_box" style="width: 98%;">
   <?php while($l=mysql_fetch_assoc($query)){?>
    	<div class="principal_noticias_not" style="background-color:white">
        <div class="margin6">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody><tr>
            <td width="25%" rowspan="2" align="center"><div class="principal_noticias_foto" style="width:140px;font-size: 20px;"><a border="0" href="detalhe_raca2.php?raca=<?php echo $l['idSubcategoria'];?>" ><img src="<?php echo str_replace("com.br","org",$l['foto']);?>" border="0" width="130" height="95" style="margin-top:4px;"></a></div></td>
            <td width="75%" height="40" align="left" > <a border="0" class="oswald_cinza15" href="detalhe_raca2.php?raca=<?php echo $l['idSubcategoria'];?>" ><?php echo $l['nomeSubcategoria'];?></a></td>
          </tr>
          <!--tr>
            <td align="left" valign="top" class="arial_cinza11_not"><a href="detalhe_raca2.php?raca=<?php echo $l['idSubcategoria'];?>" class="arial_cinza11_not"><?php echo substr(strip_tags($l['conteudo']),0,150);?>...<br>
            Leia mais...</a></td>
          </tr-->
        </tbody></table>
        </div>        
        </div>
           <?php }?>
    </div>
    </div>
    
    <?php //include "includes/informacoes.php"; ?>    
    
 
 </div>
</div>
<?php //include "includes/footer.php";?>
</body>
<style>
.principal_noticias_box{width:100%}
.principal_noticias_not{width:100%}
</style>
</html>
