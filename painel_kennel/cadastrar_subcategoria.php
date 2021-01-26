<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

include("Connections/conexao.php");
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
<script type="text/javascript" src="jquery/clone/reCopy.js"></script>
<script type="text/javascript" src="jquery/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>
<script type="text/javascript">
$(function(){
  var removeLink = ' <a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"><img src="images/icons/excluir.png" /></a>';
$('a.add').relCopy({ append: removeLink});	
});
</script>
<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Novo Cadastro de Raças 
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form action="sucesso_subcategoria.php" method="post" enctype="multipart/form-data">
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr>
    				<td align="right"><label for="categoria" class="arial_cinza2_12" >Grupo</label></td>
    				<td>
                    <select name="categoria" id="categoria" class="forms">
                        <?php
                        	$sqlcateg = "SELECT * FROM categoria ORDER BY nomeCategoria ASC";
                            $querycateg = mysql_query($sqlcateg) or die(mysql_error());
                            while($linhacateg = mysql_fetch_array($querycateg)) {
                            	echo "<option value='$linhacateg[idCategoria]'>$linhacateg[nomeCategoria]</option>";
                            }
                        ?>
			        </select>
                    </td>
			  </tr>
              
              <tr>
    				<td align="right"><label for="subcategoria" class="arial_cinza2_12" >Raça</label></td>
    				<td><input name="subcategoria" type="text" class="forms" id="subcategoria" size="60" required="required"/></td>
			  </tr>
		 <tr>
    				<td rowspan="2" align="right"><label for="subcategoria" class="arial_cinza2_12" >Foto</label></td>
    				<td><input name="foto" type="file" class="forms" id="subcategoria" size="60" required="required"/></td>
    				
                </tr>
		 <tr>
		   <td><div style="
    border: 1px solid #B9BDC1;  color: #999;  background-color: white; width: 326px; height: 33px; border-radius:7px; 
"><img src="../site/images/alerta.png" align="left" style="margin:2px;">Obs.: As imagens devem ter no máximo 500kb e o tamanho exato deve ser 280 x 216 pixels </div></td>
		   </tr>
                  <tr>
    				<td align="right"><label for="subcategoria" class="arial_cinza2_12" >Descrição</label></td>
    				<td><textarea  name="regra" cols="85" rows="20"/></textarea></td>
			  </tr>
                  <tr>
    				<td align="right"><label for="subcategoria" class="arial_cinza2_12" >Conteúdo Site</label></td>
    				<td><textarea  name="conteudo" cols="85" rows="20"/></textarea></td>
			  </tr>
		  <tr>

    				<td width="13%" align="right" valign="top"><label for="tituloAposta" class="arial_cinza2_12" >Opções  Cores:</label></td>
    				<td>
                     <p class="clone"> <input name="opcao[]" type="text" class='forms' size="70" required="required"/></p>
                     <a href="#" class="add" rel=".clone"><img src="images/botoes/adicionar.png" alt="Adicionar Opção" title="Adicionar Opção" hspace="10" vspace="10" border="0" /></a>
                    </td>
			  </tr>
               <tr>
    				<td align="right"><label for="pais_raca" class="arial_cinza2_12" >País de origem</label></td>
    				<td><input name="pais_raca" type="text" class="forms" id="pais_raca" size="80" required="required"/></td>
			  </tr>              
              
              <tr>
                <td align="right">&nbsp;</td>
                <td>
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
