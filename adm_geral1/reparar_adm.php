<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$sql = "SELECT * FROM adm WHERE id='$_GET[id]'";
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
<link rel="stylesheet" type="text/css" href="jquery/galeria/highslide/highslide.css" />
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<script src="jquery/alerta/jquery-ui.min.js"></script>
<script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>

<script type="text/javascript">
	//$(function() {
	$(document).ready(function(){	
			$("#yesno").easyconfirm({locale: { title: 'Deseja realmente deletar esta imagem?', button: ['Não','Sim']}});
			$("#yesno").click(function() {
				$.post("deletar_adm.php",
					{id: <?php echo $_GET['id']; ?>},
	   				 function(retorno){
						//$("#resultado").html(retorno);
						window.location="listagem_adm.php";
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
          <div style="float:right; margin-right:10px;"><a class="botao" href="cadastrar.php"><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div>          
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
         <span class="arial_vermelho11" style="float:right;">Caso não queria alterar a senha, deixar o campo em branco</span>
            <form action="reparar_sucesso_adm.php" method="post">
            <input type="hidden" name="id" id="name" value="<?php echo $_GET['id']; ?>" />
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr>
    				<td align="right"><label for="login" class="arial_cinza2_12" >Login:</label></td>
    				<td><input name="login" type="text" class="forms" id="login" size="85" required="required" value="<?php echo $linha['login']; ?>"/></td>
			  </tr>
              
              <tr>
    				<td align="right"><label for="senha" class="arial_cinza2_12" >Senha:</label></td>
    				<td><input name="senha" type="text" class="forms" id="senha" size="85" /></td>
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
