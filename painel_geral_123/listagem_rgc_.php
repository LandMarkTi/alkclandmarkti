<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");
?><?php 

require_once("Connections/conexao.php");
$sql = "SELECT * from rgc order by id desc";
$query = mysql_query($sql) or die(mysql_error());

$total="select count(*) from rgc";
$result = mysql_query($total) or die(mysql_error());
$total = mysql_fetch_array($result);
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
<script src="jquery/alerta/jquery-ui.min.js"></script>
<link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
<script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>
<script type="text/javascript">
	//$(function() {
	$(document).ready(function(){	
		$("#yesno").easyconfirm({locale: { title: 'Deseja realmente deletar?', button: ['Não','Sim']}});
		$("#yesno").click(function() {
				var files = '';
				$(".cinput:checked").each(function(){
				files = files + '' + this.value + '-';
				});
				$.post("deletar_varios_rgc.php", 
								  {id: files
				},
								  function(retorno){
									 //$("#check").html(retorno);
									 //alert(retorno);
									 document.location.reload();
								  }
								  );
				//alert("Deletado com sucesso!");
				window.location.reload();
				//location="teste.php";
			});
			
	});
	
	function ConfirmaExclusao(id){
		$("#yesno"+id).easyconfirm({locale: { title: 'Deseja realmente deletar?', button: ['Não','Sim']}});
		$("#yesno"+id).click(function() {
				$.post("deletar_rgc.php",
					{id: id},
	   				 function(retorno){
						//$("#resultado").html(retorno);
						window.location.reload();
        			 } 
        		);
				//alert("Deletado com sucesso! ");
				
		});
		
	}
	
$(document).ready(function() {

            var options1 = {
                //additionalFilterTriggers: [$('#onlyyes'), $('#onlyno'), $('#quickfind')],
                clearFiltersControls: [$('#cleanfilters')],
                matchingRow: function(state, tr, textTokens) {
                  if (!state || !state.id) {
                    return true;
                }
                  var child = tr.children('td:eq(2)');
                  if (!child) return true;
                  var val = child.text();
                  switch (state.id) {
                 case 'onlyyes':
                    return state.value !== true || val === 'yes';
                  case 'onlyno':
                    return state.value !== true || val === 'no';
                  default:
                    return true;
                }
              }
          };

            $('#demotable1').tableFilter(options1);
          
      });		
</script>

<script type='text/javascript' src='jquery/picnet.table.filter.min.js'></script> 

<script src="jquery/tabela/jquery.tablesorter.min.js"></script>
<script src="jquery/tabela/jquery.tablesorter.pager.js"></script>
<link rel="stylesheet" href="jquery/tabela/custom.css" media="screen" />


<style>

<style>
table tbody tr.checked{
        background:#549ABE;
		color:#FFF;
}

table tbody tr.checked:hover{
        background:#549ABE;
		color:#FFF;
}

table tbody tr.unchecked:hover{
        background:#549ABE;
		color:#FFF;
}		
.aviso{
	width:100%;
	font-size:18px;	
}

</style>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
<?php include "include_menu_esquerdo.php"; ?>
    <div id="internas_box">
    
   <div id="internas_busca">
   <div class="arial_cinza2_14" style="float:right; margin-top:8px; margin-left:4px; width:auto;">Total de registros: <span class="arial_cinza2_14" style="font-weight:bold;"><?php echo $total[0]; ?></span></div>
   
   </div>
   
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">RGC          
            <div style="float:right; margin-left:10px;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>
          <div style="float:right; margin-right:10px;"><a class="botao" href="cadastrar_subcategoria.php"><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div>
          </div>
         <div>
         <form id="frm_resultados" action="#" method="post" name="opts">
        
         <table cellspacing="0" summary="Tabela de Categorias" width="100%" id="demotable1">
      <thead>
        <tr>
          <th width="34"><input type="checkbox" value="1" id="marcar-todos" name="marcar-todos" /></th>
		  <th width="37">Número RGC</th>
		  <th width="295">Nome proprietário</th>
          <th width="299">Nome do cão</th>
          <th>Data</th>
		  <th width="73">Opções</th>
        </tr>
      </thead>
      <tbody>
      <?php  while($linha = mysql_fetch_array($query)) {?>
        <tr>
				<td height="25" align="center"><input type="checkbox" value="<?php echo $linha['id']; ?>" name="marcar[]" class="cinput" /></td>
		        <td height="25" align="center"><?php echo $linha['id']; ?></td>
		        <td><?php echo $linha['nome']; ?></td>
                <td><?php echo $linha['nome_cao']; ?></td>
                <td><?php echo implode("/",array_reverse(explode("-",$linha['nascimento']))); ?></td>
		        <td valign="middle">
				<a href="#" id="yesno<?php echo $linha['id']; ?>"><img src="images/icons/excluir.png" title="Excluir" alt="Excluir" border="0" onClick="ConfirmaExclusao(<?php echo $linha['id']; ?>);"/></a>
                                
                <a href="reparar_rgc.php?id=<?php echo $linha['id']; ?>"><img src="images/icons/visualizar.png" title="Visualizar" alt="Visualizar" border="0"/></a>

                <a href="imprime_rgc/ver_carteirinha.php?id=<?php echo $linha['id']; ?>"><img src="images/icons/carteirinha.png" title="Visualizar Carteirinha" alt="Visualizar Carteirinha" border="0"/></a>
                </td>
        </tr>
       <?php } ?>
      </tbody>
    </table>
        
        
    

           </form>
         </div>
         
      </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
