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

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

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
            <form action="sucesso_subcategoria.php" method="post">
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
    				<td><input name="subcategoria" type="text" class="forms" id="subcategoria" size="85" required="required"/></td>
			  </tr>
                  <tr>
    				<td align="right"><label for="subcategoria" class="arial_cinza2_12" >Descrição</label></td>
    				<td><input name="regra" type="text" class="forms" id="subcategoria" size="85" required="required"/></td>
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
