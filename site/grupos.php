<!DOCTYPE html>
<?php

require_once("Connections/conexao.php");
$sql = "SELECT * FROM `categoria` order by nomeCategoria";
$query = mysql_query($sql) or die('eg');
/*

<ul>
<li><a href="racas.php?grupo=10">GRUPO 01 - Cães de Caça e Tiro</a></li>
<li><a href="racas.php?grupo=9">GRUPO 02 - Cães de Caça e Presa</a></li>
<li><a href="racas.php?grupo=12">GRUPO 03 - Cães de Guarda e Utilidade</a></li>
<li><a href="racas.php?grupo=13">GRUPO 04 - Cães Terriers</a></li>
<li><a href="racas.php?grupo=14">GRUPO 05 - Cães de Luxo</a></li>
<li><a href="racas.php?grupo=15">GRUPO 06 - Cães de Companhia</a></li>
<li><a href="racas.php?grupo=16">GRUPO 07 - Cães Pastores</a></li>
<li><a href="racas.php?grupo=17">GRUPO 08 - Raças Brasileiras</a></li>
</ul>


*/
?>
<head>
<meta charset="utf-8"> 
<meta name="keywords" content="Pedigree, Registro de ninhada, Registro inicial, Cinofilia, cão de raça" /> 
<meta name="description" content="Pedigree, Registro de ninhada, Registro inicial, Cinofilia, cão de raça"/>
<meta name="Abstract" content="Pedigree, Registro de ninhada, Registro inicial, Cinofilia" />
<meta name="copyright" content="petweball" />
<meta http-equiv="Content-Language" content="pt-br">
<meta name="resource-type" content="document" />
<meta http-equiv="pragma" content="no-cache" />
<meta name="revisit-after" content="1" />
<meta name="robots" content="ALL" />
<meta name="distribution" content="Global" />
<meta name="rating" content="General" />
<meta name="classification" content="Internet">

<link rel="stylesheet" type="text/css" href="./site/css/style.css" />
<link rel="stylesheet" type="text/css" href="./site/css/style_fonts.css" />
<link rel="shortcut icon" href="favicon.png" />
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
<title>::. .::</title>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" style="backgroud-color:transparent">
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
<style>
.principal_noticias_not:hover {
    opacity: 0.7;
transition-duration: 1s;
}
</style>
<div class="internas_full" style="backgroud-color:transparent;width: 750px;">
 <div class="internas_margem_full" style="backgroud-color:transparent;width: 750px;">
 
 	<div class="internas_box">
    <!--div class="internas_titulo">Raças</div-->
    <div class="principal_noticias_box" style="width: 98%;">
   <?php while($l=mysql_fetch_assoc($query)){?>
    	<div class="principal_noticias_not" style="height: 50px;border: 2px #2b829e solid;border-radius: 6px;background-color: white;width: 60%;margin-left: 20%;">
        <div class="margin6" style="width: 90%;background-color: white;" >
        <table width="95%" border="0" cellspacing="0" cellpadding="0" style="width: 100%;backgroud-color:white">
          <tbody><tr>
            <td width="25%" rowspan="2" align="center">&nbsp;</td>
            <td width="75%" height="40" align="left" > <a border="0" class="oswald_cinza15" style="font-size: 18px;color:#2b829e" href="racas2.php?grupo=<?php echo $l['idCategoria'];?>" ><?php echo $l['nomeCategoria'];?></a></td>
          </tr>
        </tbody></table>
        </div>        
        </div>
           <?php }?>

    	<div class="principal_noticias_not" style="height: 50px;border: 2px #2b829e solid;border-radius: 6px;background-color: white;width: 60%;margin-left: 20%;">
        <div class="margin6" style="width: 90%;background-color: white;" >
        <table width="95%" border="0" cellspacing="0" cellpadding="0" style="width: 100%;backgroud-color:white">
          <tbody><tr>
            <td width="25%" rowspan="2" align="center">&nbsp;</td>
            <td width="75%" height="40" align="left" > <a border="0" class="oswald_cinza15" style="font-size: 18px;color:#2b829e" href="racas2.php?grupo=22" > Grupo 09 - Miscelaneous</a></td>
          </tr>
        </tbody></table>
        </div>        
        </div>

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
