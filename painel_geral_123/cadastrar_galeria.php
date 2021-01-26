<?php
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

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Nova Imagem 
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form action="sucesso_galeria.php" enctype="multipart/form-data" method="post">
            &nbsp;
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
              
              <tr>
    				<td align="right"><label for="video" class="arial_cinza2_12" >Arquivo:</label></td>
    				<td width="45%"><input name="video" type="file" class="forms" id="video" size="85" required/></td>
    				  <td><div style="
    border: 1px solid #B9BDC1;  color: #999;  background-color: white; width: 304px; height: 33px; border-radius:7px; 
"><img src="../site/images/alerta.png" align="left" style="margin:2px;">Obs.: As imagens devem ter no máximo 500kb e o tamanho máximo deve ser 800 x 600 pixels </div></td>

<tr>
    				<td align="right"><label for="legenda" class="arial_cinza2_12" >nome:</label></td>
    				<td colspan="2" ><input name="legenda" type="text" class="forms" id="legenda" size="85" required/></td>
   				</tr>
                            
              <tr>
                <td align="right">&nbsp;</td>
                <td colspan="3">
                <input type="submit" name="Submit"  class="button" value="Cadastrar" /></td>            
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
