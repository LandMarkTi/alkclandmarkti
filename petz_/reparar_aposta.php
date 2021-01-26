<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");
 
require_once("Connections/conexao.php");

$sql = "SELECT * FROM aposta WHERE idAposta='$_GET[id]'";
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
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle - NEOWARE .::</title>
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="stylesheet" href="jquery/modal/reveal.css">
<link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
<link rel="stylesheet" href="jquery/modal/reveal.css">
<link rel="stylesheet" type="text/css" href="jquery/galeria/highslide/highslide.css" />
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<script src="jquery/alerta/jquery-ui.min.js"></script>
<script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>
<script type="text/javascript" src="jquery/galeria/highslide/highslide-with-gallery.js"></script>
<script type="text/javascript" src="jquery/modal/jquery.reveal.js"></script>
<script type="text/javascript" src="jquery/clone/reCopy.js"></script>

<script type="text/javascript">
$(function(){
	// Datepicker
	$('#dataInicial').datepicker({
		inline: true,
		dateFormat: "yy-mm-dd",
		altField: "#dataInicialEpoch",
		altFormat: "@"
	});
	// Datepicker
	$('#dataFinal').datepicker({
		inline: true,
		dateFormat: "yy-mm-dd",
		altField: "#dataFinalEpoch",
		altFormat: "@"
	});
});
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

<script type="text/javascript">
	//$(function() {
	$(document).ready(function(){	
			$("#yesno").easyconfirm({locale: { title: 'Deseja realmente deletar esta aposta?', button: ['Não','Sim']}});
			$("#yesno").click(function() {
				$.post("deletar_aposta.php",
					{id: <?php echo $_GET['id']; ?>},
	   				 function(retorno){
						//$("#resultado").html(retorno);
						window.location="listagem_aposta.php";
        			 } 
        		);
		});	
	});
	
	function atualizaOpcao(id,valor){
		//alert(id +" "+ valor);
		$.post("atualiza_opcoes_aposta.php",
					{id: id,
					valor: valor},
	   				 function(retorno){
						 //alert(retorno);
						//$("#resultado").html(retorno);
						window.location="reparar_aposta.php?id=<?php echo $_GET['id']; ?>#opcao";
        			 } 
        		);
	}
	
	function excluirOpcao(id){
		$("#yesno"+id).easyconfirm({locale: { title: 'Deseja realmente deletar essa opção?', button: ['Não','Sim']}});
		$("#yesno"+id).click(function() {
				$.post("deletar_apcao_aposta.php",
					{id: id},
	   				 function(retorno){
						//$("#resultado").html(retorno);
						window.location.reload();
        			 } 
        		);
				//alert("Deletado com sucesso! ");
				
		});
		
	}
</script>
<script type="text/javascript">
function teste(){
	var a = <?php echo $linha['dataInicial']; ?>;
	var b = <?php echo time(); ?>;
	var geral = true;
		if(a >= b) {
			geral = true;
		} else {
			alert("A Aposta já começou!\nNão pode sofrer quaisquer alterações!");
			geral = false;	
		}
		//alert(geral);
		
		return geral;	
	}
</script>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<form action="reparar_sucesso_aposta.php" method="post" enctype="multipart/form-data" onSubmit="return teste();">
<?php include "header.php";?>
<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Atualizar Cadastro 
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            &nbsp;
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr>
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Titulo Aposta:</label></td>
    				<td><input name="tituloAposta" type="text" class="forms" id="tituloAposta" value="<?php echo $linha['tituloAposta']; ?>" size="85" required="required"/>
   				    <input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>"></td>
			  </tr>
              
              <tr>
    				<td align="right"><label for="dataInicial" class="arial_cinza2_12" >Data Inicial:</label></td>
    				<td><input name="dataInicial" type="text" class="forms" id="dataInicial" value="<?php echo date("Y/m/d",$linha['dataInicial']); ?>" size="85" required="required"/>
   				    <input type="hidden" name="dataInicialEpoch" id="dataInicialEpoch" value="<?php echo $linha['dataInicial'] * 1000; ?>"></td>
			  </tr>
              
              <tr>
    				<td align="right"><label for="dataFinal" class="arial_cinza2_12" >Data Final:</label></td>
    				<td><input name="dataFinal" type="text" class="forms" id="dataFinal" value="<?php echo date("Y/m/d",$linha['dataFinal']); ?>" size="85" required="required"/>
   				    <input type="hidden" name="dataFinalEpoch" id="dataFinalEpoch" value="<?php echo $linha['dataFinal'] * 1000; ?>"></td>
			  </tr>
              
              <tr>
    				<td align="right"><label for="categoria" class="arial_cinza2_12" >Categoria:</label></td>
    				<td>
    				  <select name="categoria" id="categoria" class="forms">
                      <option value="<?php echo $linha['idCategoria']; ?>">Manter Categoria</option>
                      <?php
					  	$sqlcateg = "SELECT * FROM categoria ORDER BY nomeCategoria ASC";
						$querycateg = mysql_query($sqlcateg) or die(mysql_error());
						while($linhacateg = mysql_fetch_array($querycateg)){
							echo"
								<option value='$linhacateg[idCategoria]'>$linhacateg[nomeCategoria]</option>
							";	
						}
					  ?>
  				    </select></td>
			  </tr>
              
              <tr>
    				<td align="right"><label for="subcategoria" class="arial_cinza2_12" >Sub-Categoria:</label></td>
    				<td>
    				  <select name="subcategoria" id="subcategoria" class="forms">
    				    <option value="<?php echo $linha['idSubCategoria']; ?>">Manter Sub Categoria</option>
			        </select></td>
			  </tr>
              
              <tr>
    				<td align="right"><label for="subsubcategoria" class="arial_cinza2_12" >Sub-Sub-Categoria:</label></td>
    				<td>
    				  <select name="subsubcategoria" id="subsubcategoria" class="forms">
                      <option value="<?php echo $linha['idSubSubCategoria']; ?>">Manter Sub Sub Categoria</option>
  				    </select></td>
			  </tr>
              
              <tr>
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Valor Aposta:</label></td>
    				<td><input name="valorAposta" type="text" class="forms" id="valorAposta" size="85" required="required" value='<?php echo money_format("%!0.2n",$linha['valorAposta']*0.01); ?> '/></td>
			  </tr>
              
              <tr>
    				<td align="right"><label for="descricao" class="arial_cinza2_12" >Descrição:</label></td>
    				<td>
   				    <textarea name="descricao" id="descricao" cols="87" rows="5" class="forms"><?php echo $linha['descricao']; ?></textarea></td>
			  </tr>
              
              <tr>
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Regras:</label></td>
    				<td>
   				    <textarea name="regras" id="regras" cols="87" rows="5" class="forms"><?php echo $linha['regras']; ?></textarea></td>
			  </tr>
              
              <tr style="display:none;">
    				<td align="right" ><label for="status" class="arial_cinza2_12" >Status:</label></td>
    				<td>
                    <?php
					$status =  $linha['status'];
					$a = "";
					$b = "";
					$c = "";
					switch($status){
						case "A": $a = "selected";
						break;
						case "B": $b = "selected";
						break;
						case "C": $c = "selected";
						break;
					}
					?>
    				  <select name="status" id="status" class="forms" multiple>
    				    <option value="A" <?php echo $a; ?>>Ativo</option>
    				    <option value="B" <?php echo $b; ?>>Bloqueado</option>
    				    <option value="C" <?php echo $c; ?>>Cancelada</option>
			        </select></td>
			  </tr>
                           
			</table>
           </div>
            </div>
         </div>
         
         
         <div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo"><a name="opcao"></a>Opções das Apostas</div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            &nbsp;
            <table width="100%" border="0" cellspacing="6" cellpadding="0">
            
               <tr>
    				<td width="13%" align="right" valign="top"><label for="tituloAposta" class="arial_cinza2_12" >Opções  Cadastradas:</label></td>
    				<td width="87%">
            <?php
			$sqlop = "SELECT * FROM opcoesaposta WHERE idAposta = '$_GET[id]' ORDER BY id ASC";
			$queryop = mysql_query($sqlop) or die(mysql_error());
			while($linhaop = mysql_fetch_array($queryop)){ ?>
				
            	 <input name="opcoesca" type="text" class="forms" id="opcoesca" value="<?php echo $linhaop['opcao']; ?>" size="70" <?php if($linha['dataInicial'] <= time()) { ?>onBlur="atualizaOpcao('<?php echo $linhaop['id'];?>',this.value);" readonly <?php } ?>> <?php if($linha['dataInicial'] > time()) echo '<a href="#" id="yesno'.$linhaop['id'].'"><img src="images/icons/excluir.png" title="Excluir" alt="Excluir" border="0" onClick="excluirOpcao('.$linhaop['id'].');"/></a>'; ?>   
			<?php }?>
                    </td>
			  </tr>
  			 
              <tr>
    				<td width="13%" align="right" valign="top"><label for="tituloAposta" class="arial_cinza2_12" >Opções  Aposta:</label></td>
    				<td width="87%">
                     <p class="clone"> <input name="opcao[]" type="text" class='forms' size="70"/></p>
                     <a href="#" class="add" rel=".clone"><img src="images/botoes/adicionar.png" alt="Adicionar Opção" title="Adicionar Opção" hspace="10" vspace="10" border="0" /></a>
                    </td>
			  </tr>
              
              <tr>
                <td align="right">&nbsp;</td>
                <td>
                  <input type="submit" name="Submit"  class="button" value="Cadastrar" /> 
                  </td>            
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
