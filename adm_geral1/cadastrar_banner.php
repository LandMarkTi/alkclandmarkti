<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");
?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle - NEOWARE" /> 
<meta name="Description" content="Painel de Controle - NEOWARE"/> 
<meta name="copyright" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="jquery/galeria/highslide/highslide.css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle - NEOWARE .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="jquery/galeria/highslide/highslide-with-gallery.js"></script>

<script type="text/javascript">
hs.graphicsDir = 'jquery/galeria/highslide/graphics/';
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.fadeInOut = true;
hs.outlineType = 'glossy-dark';
hs.wrapperClassName = 'dark';
hs.captionEval = 'this.a.title';
hs.numberPosition = 'caption';
hs.useBox = true;
hs.width = 700;
hs.height = 500;
//hs.dimmingOpacity = 0.8;
// Add the slideshow providing the controlbar and the thumbstrip
hs.addSlideshow({
	//slideshowGroup: 'group1',
	interval: 5000,
	repeat: false,
	useControls: true,
	fixedControls: 'fit',
	overlayOptions: {
		position: 'bottom center',
		opacity: 0.75,
		hideOnMouseOut: true
	},
	thumbstrip: {
		position: 'above',
		mode: 'horizontal',
		relativeTo: 'expander'
	}
});
var miniGalleryOptions1 = {
	thumbnailId: 'thumb1'
}
</script>

<script type="text/javascript">
function alteraImagem(tipo){
	if(tipo == 0) {
		$("#visualiza").html('<a href="images/fotos/banner_rotativo.png" class="arial_cinza2_11" id="thumb1" onclick="return hs.expand(this, miniGalleryOptions1)" title="Banner Rotativo">Visualizar Posição</a>');
	} else {
		$("#visualiza").html('<a href="images/fotos/banner_esquerda.png" class="arial_cinza2_11" id="thumb1" onclick="return hs.expand(this, miniGalleryOptions1)" title="Banner Esquerda">Visualizar Posição</a>');
	}
}
</script>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Novo Cadastro Banner 
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form action="sucesso_banner.php" method="post" enctype="multipart/form-data">
            &nbsp;
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr>
    				<td align="right"><label for="tipo_banner" class="arial_cinza2_12" >Banner:</label></td>
    				<td colspan="2"><input type="hidden" name="tipo_banner" value="0">
    				    
                      <div id="visualiza" style="display:inline;"><a href="images/fotos/banner_rotativo.png" class="arial_cinza2_11" id="thumb1" onclick="return hs.expand(this, miniGalleryOptions1)" title="Banner Rotativo">Topo</a></div>
                      </td>
			  </tr>
              
               <tr>
    				<td align="right"><label for="nome" class="arial_cinza2_12" >Link:</label></td>
    				<td colspan="2"><input name="link" type="url" class="forms" id="link" size="85" placeholder="http://www.seusite.com.br" /></td>
			  </tr>
              
               <tr>
    				<td align="right"><label for="foto" class="arial_cinza2_12" >Foto:</label></td>
    				<td width="45%">
   				    <input type="file" name="foto" id="foto" class="forms" required="required" ></td>
    				<td align="left"><div style="
    border: 1px solid #B9BDC1;  color: #999;  background-color: white; width: 304px; height: 33px; border-radius:7px; 
"><img src="../site/images/alerta.png" align="left" style="margin:2px;">Obs.: As imagens devem ter no máximo 500kb e o tamanho exato deve ser 710 x 340 pixels </div></td>
			   </tr>
              
              <tr>
                <td align="right">&nbsp;</td>
                <td colspan="2">
                <input type="submit" name="Submit"  class="button" value="Cadastrar" /> 
                </td>            
              </tr>
              
			</table>
  			</form>
           </div>
            </div>
         </div>
         
        </div>
    </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
