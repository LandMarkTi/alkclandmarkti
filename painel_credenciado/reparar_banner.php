<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
require_once("mini.php");
$sql = "SELECT * FROM banner WHERE idBanner='$_GET[id]'";
$query = mysql_query($sql) or die(mysql_error());
$linha = mysql_fetch_array($query);

if($_POST){
	$id = $_POST['idfoto'];
	$tipo_banner = $_POST['tipo_banner'];
	//Pegando os dados da foto enviada
	$fotonome = $_FILES['foto']['name'];
	$fototipo = $_FILES['foto']['type'];
	$fototamanho = $_FILES['foto']['size'];
	$fototemp = $_FILES['foto']['tmp_name'];
	move_uploaded_file($fototemp,'../images/banner/original/'.$fotonome);
	
	$mini = new PicMini();
	//Mini
	$mini -> load("../images/banner/original/$fotonome");
	if($tipo_banner == 0)$mini -> resize(990,288); else $mini -> resize(175,400); 
	$mini -> save("../images/banner/$fotonome");
	
	$sqla = "UPDATE banner SET foto = '$fotonome' WHERE idBanner = '$id'";
	$querya = mysql_query($sqla) or die(mysql_error());
	header("Location: reparar_banner.php?id=$id");
}
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
			$("#yesno").easyconfirm({locale: { title: 'Deseja realmente deletar esta categoria?', button: ['Não','Sim']}});
			$("#yesno").click(function() {
				$.post("deletar_banner.php",
					{id: <?php echo $_GET['id']; ?>},
	   				 function(retorno){
						//$("#resultado").html(retorno);
						window.location="listagem_banner.php";
        			 } 
        		);
		});	
	});
</script>


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
          <div style="float:right; margin-right:10px;"><a class="botao" href="cadastrar_banner.php"><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div>          
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form action="reparar_sucesso_banner.php" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" />
            &nbsp;
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr>
    				<td align="right">Tipo Banner:</td>
    				<td>
                    <select name="tipo_banner" id="tipo_banner" class="forms" onChange="alteraImagem(this.value)">
    				    <option value="<?php echo $linha['tipoBanner']; ?>" selected>Manter Tipo Banner</option>
                
			        </select>
                    </td>
			  </tr>
              
              <tr>
    				<td align="right">Link:</td>
    				<td><input name="link" type="url" class="forms" id="link" size="85" required="required" value="<?php echo $linha['link']; ?>"/></td>
			  </tr>
                            
              <tr>
                <td align="right">&nbsp;</td>
                <td>
                <input type="submit" name="Submit"  class="button" value="Atualizar" /> 
                </td>            
              </tr>
              
			</table>
  			</form>
           </div>
        </div>
         </div>
         
         
         <div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Imagens Cadastradas</div>
         	<div style="width:750px;">
         	<div style="margin:10px; margin-top:50px;">
            
           	  <div id="moldura_fotos"><a href="<?php echo $linha['foto']; ?>" id="thumb1" onclick="return hs.expand(this, miniGalleryOptions1)"><img src="<?php echo $linha['foto']; ?>" border="0" width="144" height="111"/></a>
                <div id="icones_fotos"><a href="#" data-reveal-id="myModal" data-animation="fade"><img src="images/icons/editar.png" alt="Editar Imagem" border="0" title="Editar Imagem"></a></div>
              </div>
                                              
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
	<div><input name="foto" id="foto" type="file" class="forms" required="required"> </div>
    <input type="hidden" id="idfoto" name="idfoto" value="<?php echo $linha['idBanner']; ?>" />
    <input type="hidden" id="tipo_banner" name="tipo_banner" value="<?php echo $linha['tipoBanner']; ?>" />
    <div style="margin-top:12px;"><input type="submit" name="Submit"  class="button" value="Enviar Imagem" /> </div>
	<a class="close-reveal-modal">&#215;</a>
</form>
</div>
</body>
</html>
