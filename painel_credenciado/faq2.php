<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");


if($_POST){
$tit=$_POST['titulo'];
$bloco=$_POST['bloco'];
$bloco=str_replace('../','',$bloco);
mysql_query("update textos_site set titulo='' ,bloco='$bloco' where pg='FU' ")or die(mysql_error());


}

$dados=mysql_query("select * from textos_site where pg='FU'")or die();
$linha=mysql_fetch_array($dados);
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
<script type="text/javascript" src="ckeditor.js"></script>
<!--Editor de Texto -->


<!-- TinyMCE -->

<!-- /TinyMCE -->
<script type="text/javascript">
      
      
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
    	  <div class="arial_branco20" id="internas_titulo">Como funciona - Usuário
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:720px;">
         <div style="margin:10px; margin-top:50px;">
            &nbsp;
			<table width="720px" border="0" cellspacing="6" cellpadding="0">
            
  			 
              
              
              
              <tr>
    				<td align="right"><label for="descricao" class="arial_cinza2_12" >Descrição:</label></td>
    				<td>
   				    <textarea name="bloco" id="descricao" cols="60" rows="10" class="forms"><?php echo str_replace('./','.././',$linha['bloco']);?></textarea></td>
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
<script type="text/javascript">
CKEDITOR.replace( 'bloco', {
    filebrowserUploadUrl: '/sysbetoff/upload_ckeditor.php'
});

</script>
<?php include "footer.php";?>
  </form>
</body>
</html>
