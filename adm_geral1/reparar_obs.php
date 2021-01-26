<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$sql = "SELECT * FROM frase WHERE 1";
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
<title>::. Painel de Controle .::</title>

<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="stylesheet" href="jquery/modal/reveal.css">
<link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="jquery/galeria/highslide/highslide.css" />
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<script src="jquery/alerta/jquery-ui.min.js"></script>
<script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>

<script type="text/javascript">
	//$(function() {
	$(document).ready(function(){	
			$("#yesno").easyconfirm({locale: { title: 'Deseja realmente deletar esta categoria?', button: ['Não','Sim']}});
			$("#yesno").click(function() {
				$.post("deletar_categoria.php",
					{id: <?php echo $_GET['id']; ?>},
	   				 function(retorno){
						//$("#resultado").html(retorno);
						window.location="listagem_categoria.php";
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
    	  <div class="arial_branco20" id="internas_titulo">Atualizar Frase Pedigree          
            <div style="float:right; margin-left:10px;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>
          <div style="float:right; margin-right:10px;"><a class="botao" href="cadastrar_categoria.php"><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div>          
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form action="reparar_sucesso_frase.php" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" />
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr>
    				<td align="right"><label for="nome" class="arial_cinza2_12" >Texto:</label></td>
    				<td><input name="nome" type="text" class="forms" id="nome" size="85" required="required" value="<?php echo $linha['nomeCategoria']; ?>"/></td>
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
    </div>   
    </div> 
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
