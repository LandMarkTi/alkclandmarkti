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
    	  <div class="arial_branco20" id="internas_titulo">Adquirir Cotas 
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form  method="post">
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >pedigree</label></td>
    				<td><input name="login" type="text" class="forms" id="login" size="85" required="required"/></td>
			  </tr>
              
              <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >RGC</label></td>
    				<td><input name="senha" type="password" class="forms" id="senha" size="85" required="required"/></td>
			  </tr>
              <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Uso do Sistema</label></td>
    				<td><input name="senha" type="password" class="forms" id="senha" size="85" required="required"/></td>
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
