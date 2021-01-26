<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");
require_once("Connections/conexao.php");
$al='';
if($_POST['Submit']=='Cadastrar'){
$nome=$_POST['nome'];
$regra=$_POST['regra'];

$al='Vídeo Enviado!';

$foto=(int)$_POST['foto'];
$insert=mysql_query("INSERT INTO videos values('','$regra','$nome','".time()."')")or die('err');



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
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle - NEOWARE .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<link type="text/css" href="jquery/jqueryui/css/redmond/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="jquery/jqueryui/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery/jqueryui/js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="jquery/clone/reCopy.js"></script>


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
      
      $(document).ready(function(){
         $("select[name=categoria]").change(function(){
            $("select[name=subcategoria]").html('<option value="0">Carregando...</option>');
            
            $.post("subcategoria_j.php", 
                  {categ:$(this).val()},
                  function(valor){
					  //alert(valor);
                     $("select[name=subcategoria]").html(valor);
                  }
                  )
            
         })
		 
		 $("select[name=subcategoria]").change(function(){
            $("select[name=subsubcategoria]").html('<option value="0">Carregando...</option>');
            
            $.post("subsubcategoria_j.php", 
                  {subcateg:$(this).val()},
                  function(valor){
					  //alert(valor);
                     $("select[name=subsubcategoria]").html(valor);
                  }
                  )
            
         })
		 
      })
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
    	  <div class="arial_branco20" id="internas_titulo"><?php echo $al;?> Novo Cadastro Vídeo
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            &nbsp;
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr>
    				<td align="right"><label for="nome" class="arial_cinza2_12" >Nome :</label></td>
    				<td><input name="nome" type="text" class="forms" id="nome" size="20" required="required"/></td>
			  </tr>
              
              <tr>
    				<td align="right"><label for="comissao" class="arial_cinza2_12" >arquivo:</label></td>
    				<td><input name="regra" type="file" class="forms"  size="20" required="required"/>
    				  </td>
			  </tr>
              
            
              <tr>
                <td align="right">&nbsp;</td>
                <td><input type="submit" name="Submit"  class="button" value="Cadastrar" /></td>
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
