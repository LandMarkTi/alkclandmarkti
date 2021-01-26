<?php
require_once("Connections/conexao.php");
require_once("mini.php");
$sql = "SELECT * FROM galeria WHERE id='$_GET[id]'";
$query = mysql_query($sql) or die(mysql_error());
$linha = mysql_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle - NEOWARE" /> 
<meta name="Description" content="Painel de Controle - NEOWARE"/> 
<meta name="copyright" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle - NEOWARE .::</title>

<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="stylesheet" href="jquery/modal/reveal.css">
<link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
<link rel="stylesheet" href="jquery/modal/reveal.css">
<link rel="stylesheet" type="text/css" href="jquery/galeria/highslide/highslide.css" />
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<script src="jquery/alerta/jquery-ui.min.js"></script>
<script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>
<script type="text/javascript" src="jquery/galeria/highslide/highslide-with-gallery.js"></script>
<script type="text/javascript" src="jquery/modal/jquery.reveal.js"></script>
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
	//$(function() {
	$(document).ready(function(){	
			$("#yesno").easyconfirm({locale: { title: 'Deseja realmente deletar este Video?', button: ['Não','Sim']}});
			$("#yesno").click(function() {
				$.post("deletar_video.php",
					{id: <?php echo $_GET['id']; ?>},
	   				 function(retorno){
						//$("#resultado").html(retorno);
						window.location="listagem_video.php";
        			 } 
        		);
		});	
	});
</script>

<script type="text/javascript" src="http://cidades-estados-js.googlecode.com/files/cidades-estados-1.2-utf8.js"></script>
<script type="text/javascript">
window.onDomReady(function() {
  new dgCidadesEstados({
    estado: document.getElementById('estado'),
    cidade: document.getElementById('cidade')
  });
});
</script>
<!--Editor de Texto -->
<!-- TinyMCE -->
<script type="text/javascript" src="jquery/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<!-- /TinyMCE -->
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
   	  <div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Atualizar Cadastro          
            <div style="float:right; margin-left:10px;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>
          <div style="float:right;"><a class="botao" id="yesno" href="#"><img src="images/botoes/excluir.png" border="0" title="Excluir Selecionados"></a></div>
    	  </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form action="reparar_sucesso_galeria.php" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" />
            &nbsp;
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td rowspan="2" align="right" class="arial_cinza2_12">Arquivo:</td>
                <td width="45%"><input name="video" type="file" required class="forms" id="video" value="<?php echo $linha['video']; ?>" size="85"/></td>
  <td><div style="
    border: 1px solid #B9BDC1;  color: #999;  background-color: white; width: 304px; height: 33px; border-radius:7px; 
"><img src="../site/images/alerta.png" align="left" style="margin:2px;">Obs.: As imagens devem ter no máximo 500kb e o tamanho máximo deve ser 800 x 600 pixels </div></td>
              </tr>

              <tr><td >&nbsp;</td>
              <td><img src="../site/images/asd/<?php echo $linha['video']; ?>"></td>
              </tr>
              <tr>
                <td align="right" class="arial_cinza2_12">Nome:</td>
                <td colspan="2"><input name="legenda" type="text" required class="forms" id="legenda" value="<?php echo $linha['legenda']; ?>" size="85"/></td>
              </tr>
              
              <tr>
                <td><input type="submit" name="Submit2"  class="button" value="Atualizar" /></td>
                <td colspan="2">&nbsp;</td>
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

<div id="myModal" class="reveal-modal">
<form action="reparar_banner.php?id=<?php echo $_GET['id']; ?>" name="foto1" id="foto1" enctype="multipart/form-data" method="post">
	<div><input name="foto" id="foto" type="file" class="forms" required> </div>
    <input type="hidden" id="idfoto" name="idfoto" value="<?php echo $linha['idBanner']; ?>" />
    <input type="hidden" id="tipo_banner" name="tipo_banner" value="<?php echo $linha['tipoBanner']; ?>" />
    <div style="margin-top:12px;"><input type="submit" name="Submit"  class="button" value="Enviar Imagem" /> </div>
	<a class="close-reveal-modal">&#215;</a>
</form>
</div>
</body>
</html>
