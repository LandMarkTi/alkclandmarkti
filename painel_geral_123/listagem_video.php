<?php
require_once("Connections/conexao.php");
$sql = "SELECT * FROM video ORDER BY id DESC ";
$query = mysql_query($sql) or die(mysql_error());
//Pegando o TOTAL DE REGISTROS da tabel ADM
$total="select count(*) FROM video ";
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
				$.post("deletar_varios_video.php", 
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
				$.post("deletar_video.php",
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
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    
   <div id="internas_busca">
   <div class="arial_cinza2_14" style="float:right; margin-top:8px; margin-left:4px; width:auto;">Total de registros: <span class="arial_cinza2_14" style="font-weight:bold;"><?php echo $total[0]; ?></span></div>
   <form method="post" action="#" id="frm-filtro">
      <p>
        <input name="pesquisar" id="pesquisar" type="text" value="Buscar" onBlur="if(this.value=='') {this.value='Buscar';}" onFocus="if(this.value=='Buscar') {this.value='';}" class="forms">
      </p>
    </form>
   </div>
   
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Lista de Videos
	            <div style="float:right;"><a class="botao" href="cadastrar_video.php" ><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div>
            <div style="float:right; margin-left:10px;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>
          <div style="float:right;display:none"><a class="botao" id="yesno" href="#"><img src="images/botoes/excluir.png" border="0" title="Excluir Selecionados"></a></div>
          </div>
         <div>
         <form id="frm_resultados" action="#" method="post" name="opts">
         <table cellspacing="0" summary="Tabela de Aposta" width="100%">
      <thead>
        <tr>
          <th width="30"><input type="checkbox" value="1" id="marcar-todos" name="marcar-todos" /></th>
		  <th width="45">Id</th>
		  <th width="590">Video</th>
          <th width="75">Opções</th>
        </tr>
      </thead>
      <tbody>
      <?php  while($linha = mysql_fetch_array($query)) {?>
        <tr>
				<td height="25" align="center"><input type="checkbox" value="<?php echo $linha['id']; ?>" name="marcar[]" class="cinput" /></td>
		        <td height="25" align="center"><?php echo $linha['id']; ?></td>
		        <td><?php echo $linha['video']; ?> </td>
                <td valign="middle"><a href="reparar_video.php?id=<?php echo $linha['id']; ?>" ><img src="images/icons/visualizar.png" title="Visualizar" alt="Visualizar" border="0"/></a> <a href="#" id="yesno<?php echo $linha['id']; ?>"><img src="images/icons/excluir.png" title="Excluir" alt="Excluir" border="0" onClick="ConfirmaExclusao(<?php echo $linha['id']; ?>);"/></a></td>
        </tr>
       <?php } ?>
      </tbody>
    </table>
        
        
        <div id="pager" class="pager" style="margin-top:20px;">
   	<form>
				<span>
					Exibir <select class="pagesize">
							<option value="2">2</option>
                            <option value="10" selected="selected">10</option>
							<option value="20">20</option>
							<option value="30">30</option>
							<option  value="40">40</option>
					</select> registros
				</span>

				<img src="jquery/tabela/first.png" class="first"/>
    		<img src="jquery/tabela/prev.png" class="prev"/>
    		<input type="text" class="pagedisplay" readonly/>
    		<img src="jquery/tabela/next.png" class="next"/>
    		<img src="jquery/tabela/last.png" class="last"/>
    	</form>
    </div>
    
    <script>
    $(function(){
      
      $('table > tbody > tr:odd').addClass('odd');
      
      $('table > tbody > tr').hover(function(){
        $(this).toggleClass('hover');
      });
      
      $('#marcar-todos').click(function(){
        $('table > tbody > tr > td > :checkbox')
          .attr('checked', $(this).is(':checked'))
          .trigger('change');
      });
      
      $('table > tbody > tr > td > :checkbox').bind('click change', function(){
        var tr = $(this).parent().parent();
        if($(this).is(':checked')) $(tr).addClass('selected');
        else $(tr).removeClass('selected');
      });
      
      $('form').submit(function(e){ e.preventDefault(); });
      
      $('#pesquisar').keydown(function(){
        var encontrou = false;
        var termo = $(this).val().toLowerCase();
        $('table > tbody > tr').each(function(){
          $(this).find('td').each(function(){
            if($(this).text().toLowerCase().indexOf(termo) > -1) encontrou = true;
          });
          if(!encontrou) $(this).hide();
          else $(this).show();
          encontrou = false;
        });
      });
      
      $("table") 
        .tablesorter({
          dateFormat: 'uk',
          headers: {
            0: {
              sorter: false
            },
            5: {
              sorter: false
            }
          }
        }) 
        .tablesorterPager({container: $("#pager")})
        .bind('sortEnd', function(){
          $('table > tbody > tr').removeClass('odd');
          $('table > tbody > tr:odd').addClass('odd');
        });
      
    });
    </script>
           </form>
         </div>
         
      </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
