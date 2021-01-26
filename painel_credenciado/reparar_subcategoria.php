<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$sql = "SELECT * FROM subcategoria WHERE idSubcategoria='$_GET[id]'";
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
<script type="text/javascript" src="jquery/clone/reCopy.js"></script>
<script type="text/javascript" src="jquery/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<script type="text/javascript">
$(function(){
  var removeLink = ' <a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"><img src="images/icons/excluir.png" /></a>';
$('a.add').relCopy({ append: removeLink});	
});
</script>
<script type="text/javascript">
	//$(function() {
	$(document).ready(function(){	
			$("#yesno").easyconfirm({locale: { title: 'Deseja realmente deletar esta sub-categoria?', button: ['Não','Sim']}});
			$("#yesno").click(function() {
				$.post("deletar_subcategoria.php",
					{id: <?php echo $_GET['id']; ?>},
	   				 function(retorno){
						//$("#resultado").html(retorno);
						window.location="listagem_subcategoria.php";
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
    	  <div class="arial_branco20" id="internas_titulo">Atualizar Raça          
            <div style="float:right; margin-left:10px;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>
          <div style="float:right; margin-right:10px;"><a class="botao" href="cadastrar_subcategoria.php"><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div>          
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form action="reparar_sucesso_subcategoria.php" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" />
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr>
    				<td align="right"><label for="categoria" class="arial_cinza2_12" >Nome Categoria:</label></td>
    				<td colspan="2">              <select name="categoria" id="categoria" class="forms">
              			<option value="<?php echo $linha['idCategoria']; ?>">Deixar Categoria Atual</option>
                        <?php
                        	$sqlcateg = "SELECT * FROM categoria ORDER BY nomeCategoria ASC";
                            $querycateg = mysql_query($sqlcateg) or die(mysql_error());
                            while($linhacateg = mysql_fetch_array($querycateg)) {
                            	echo "<option value='$linhacateg[idCategoria]'>$linhacateg[nomeCategoria]</option>";
                            }
                        ?>
			        </select></td>
			  </tr>
                           
              <tr>
    				<td align="right"><label for="subcategoria" class="arial_cinza2_12" >Nome Sub-Categoria:</label></td>
    				<td colspan="2"><input name="subcategoria" type="text" class="forms" id="nomesubcategoria" size="85" required="required" value="<?php echo $linha['nomeSubcategoria']; ?>" readonly></td>
			  </tr>
		 <tr>
    				<td align="right"><label for="subcategoria" class="arial_cinza2_12" >Foto:</label></td>
    				<td width="45%"><input name="foto" type="file" class="forms" id="foto"  ></td>
    				<td>
<div style="
    border: 1px solid #B9BDC1;  color: #999;  background-color: white; width: 304px; height: 33px; border-radius:7px; 
"><img src="../site/images/alerta.png" align="left" style="margin:2px;">Obs.: As imagens devem ter no máximo 500kb e o tamanho exato deve ser 280 x 216 pixels </div>
                    </td>
			  </tr>
					 <!--tr>
    				<td align="right"><label for="" class="arial_cinza2_12" >Atual:</label></td>
    				<td colspan="2"><img src="<?php echo $linha['foto']; ?>" ></td>
			  </tr-->  
		 <tr>
    				<td align="right"><label for="subcategoria" class="arial_cinza2_12" >Descrição:</label></td>
    				<td colspan="2"><textarea name="regra" type="text" class="forms" id="subcategoria"    cols="85" rows="20"><?php echo $linha['regrasublocal']; ?></textarea></td>
			  </tr>
	 <tr>
    				<td align="right"><label for="subcategoria" class="arial_cinza2_12" >Conteúdo:</label></td>
    				<td colspan="2"><textarea name="conteudo" type="text" class="forms" id="conteudo"   cols="85" rows="20"><?php echo $linha['conteudo']; ?></textarea></td>
			  </tr>
<?php 
	$set=explode(';',$linha['pelagem']);
	$set=array_filter($set);
	while($c=array_pop($set)){?>
		 <tr>
    				<td align="right"><label for="subcategoria" class="arial_cinza2_12" >Cor:</label></td>
    				<td colspan="2"><input name="opcao[]" type="text" class="forms" id="subcategoria" size="55"  value="<?php echo $c; ?>"/><img onclick ="$(this).parent().prev().remove();$(this).parent().remove();" src="images/icons/excluir.png"></td>
			  </tr>
                            <?php }?>
		  <tr>

    				<td width="13%" align="right" valign="top"><label for="tituloAposta" class="arial_cinza2_12" >Opções  Cores:</label></td>
    				<td width="87%" colspan="2">
                     <p class="clone"> <input name="opcao[]" type="text" class='forms' size="70" /></p>
                     <a href="#" class="add" rel=".clone"><img src="images/botoes/adicionar.png" alt="Adicionar Opção" style="float:right" title="Adicionar Opção" hspace="10" vspace="10" border="0" /></a>
                    </td>
			  </tr>
               <tr>
    				<td align="right"><label for="pais_raca" class="arial_cinza2_12" >País de origem</label></td>
    				<td><input name="pais_raca" type="text" class="forms" id="pais_raca" size="80" required="required" value="<?php echo $linha['pais_raca']; ?>"/></td>
			  </tr>              
              
              <tr>
                <td align="right">&nbsp;</td>
                <td colspan="2" id = "subz">
                <input type="submit"  name="Submit" class="button" value="Atualizar" style="width: 73px;height: 30px;background-color: olivedrab;color: white;"/> 
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
<script>
var l='lock';
$('#subz').append('<input type="hidden" name="'+l+'" value="'+Math.random()+'">');
</script>
<?php include "footer.php";?>
</body>
</html>
