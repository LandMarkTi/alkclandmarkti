<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");


if($_POST){
$bloco=addslashes($_POST['bloco']);
$titulo = $_POST['titulo'];

$f='';
if($_FILES){
$fotonome = $_FILES["foto"]["name"];
$fototipo = $_FILES['foto']['type'];
$fototamanho = $_FILES['foto']['size'];
$fototemp = $_FILES["foto"]["tmp_name"];
move_uploaded_file($fototemp,'../site/images/banner/original/'.rawurlencode($fotonome));
$f=",foto= '/images/banner/original/".rawurlencode($fotonome)."'";
if($fotonome!=''){
mysql_query("update paginas_internas set transferencia_foto='images/banner/original/$fotonome'") or die (mysql_error());
}
}

mysql_query("update paginas_internas set transferencia='$bloco'") or die (mysql_error());
mysql_query("update paginas_internas set transferencia_titulo='$titulo'") or die (mysql_error());
die("<script>alert('Dados Enviados!');location='index_principal.php';</script>");

}
$sql = "select * from paginas_internas";
$query = mysql_query($sql) or die (mysql_error($sql));
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
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle - NEOWARE .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<link type="text/css" href="jquery/jqueryui/css/redmond/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="jquery/jqueryui/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery/jqueryui/js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="jquery/clone/reCopy.js"></script>

<script type="text/javascript">

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
<script type="text/javascript">
      
      
</script>
<script type="text/javascript">
$(function(){
  var removeLink = ' <a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"><img src="images/icons/excluir.png" /></a>';
$('a.add').relCopy({ append: removeLink});	
});
</script>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<form  method="post" enctype="multipart/form-data">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Editar Conteúdo
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            &nbsp;
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
  			  <tr>
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Titulo :</label></td>
    				<td><input name="titulo" value="<?php echo $linha['transferencia_titulo'];?>" type="text" class="forms" id="titulo" size="65" required="required"/></td>
			  </tr>          
                <tr>
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Foto :</label></td>
    				<td><input name="foto" value="<?php echo $linha['transferencia_foto'];?>" type="file" class="forms" id="foto" size="65" /></td>
			  </tr>
              
              
              <tr>
    				<td align="right"><label for="descricao" class="arial_cinza2_12" >texto:</label></td>
    				<td>
   				    <textarea name="bloco" id="descricao" cols="67" rows="10" class="forms"><?php echo htmlentities($linha['transferencia'],ENT_QUOTES);?></textarea></td>
			  </tr>
              
             <tr>
    				<td align="right"><label for="descricao" class="arial_cinza2_12" ><input type="submit" value="enviar"></label></td>
    				</tr>
             
			</table>
           </div>
            </div>
         </div>
         
         
         
         
        </div>
    </div>
    
  </div>
</div>
<?php include "footer.php";?>
  </form>
</body>
</html>
