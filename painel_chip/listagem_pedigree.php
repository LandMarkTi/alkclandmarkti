<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$sql = "SELECT  * from chip_pedido  WHERE data_aprovado <=0";
$query = mysql_query($sql) or die('e1');

//Pegando o TOTAL DE REGISTROS da tabel ADM
$nn=mysql_num_rows($query);



$v_p=array('Não','Não','Sim');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<script src="jquery/alerta/jquery-ui.min.js"></script>
<link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
<script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>
<script type="text/javascript">
	//$(function() {
	$(document).ready(function(){	
		$("#yesno").easyconfirm({locale: { title: 'Deseja realmente deletar?', button: ['Não','Sim']}});
		$("#yesno").click(function() {return false;
				var files = '';
				$(".cinput:checked").each(function(){
				files = files + '' + this.value + '-';
				});
				$.post("deletar_varios_ped.php", 
								  {id: files
				},
								  function(retorno){
									 //$("#check").html(retorno);
									 //alert(retorno);
									 document.location.reload();
								  }
								  );
				//alert("Deletado com sucesso!");

				//location="teste.php";
			});
			
	});
	
	function ConfirmaExclusao(id){return false;
		$("#yesno"+id).easyconfirm({locale: { title: 'Deseja realmente deletar?', button: ['Não','Sim']}});
		$("#yesno"+id).click(function() {
				$.post("deletar_ped.php",
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
<?php include "header_l.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    
   <div id="internas_busca">
   <div class="arial_cinza2_14" style="float:right; margin-top:8px; margin-left:4px; width:auto;"></span></div>
   <form method="post" action="#" id="frm-filtro">
      <p>
        <input name="pesquisar" id="pesquisar" type="text" value="Buscar" onBlur="if(this.value=='') {this.value='Buscar';}" onFocus="if(this.value=='Buscar') {this.value='';}" class="forms">
      </p>
    </form>
   </div>
   
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Solicitações de Microchip        
            

          </div>
         <div>
         <form id="frm_resultados" action="#" method="post" name="opts">
         <table cellspacing="0" summary="Tabela de pedigree" width="100%">
      <thead>
        <tr>
          <th width="30"><input type="checkbox" value="1" id="marcar-todos" name="marcar-todos" /></th>
		  

		<th width="201">nome</th>
		<th width="61">qtd</th>
		<th width="101">Contato<br>efetuado</th>
		<th width="101">Kit enviado</th>
		
		  <th width="101">data </th>
		  <th width="101" style="display:none">reservado </th>
		  <th width="67">Opções</th>
        </tr>
      </thead>
      <tbody>
      <?php  while($linha = mysql_fetch_array($query)) {
$nn=explode(';',$linha['ninhada']);
$i=$linha['id_f'];

		if($nn[$i]!='Nome Filhote'){
?>
        <tr>
				<td height="25" align="center"><input type="checkbox" value="<?php echo $linha['id_ped']; ?>" name="marcar[]" class="cinput" /></td>
		        

			<td><?php echo $linha['responsavel']; ?></td>
			<td><?php echo $linha['qtd']; ?></td>
			<td><?php if($linha['data_aprovado']<0)echo Sim ?></td>
			<td>
<?php


			if($linha['data_aprovado']>0)echo date('d/m/Y',$linha['data_aprovado']); else echo 'Não';
			
			?></td>
			<td><?php echo date("d/m/Y",$linha['data_pedido']); ?></td>
			
		        <td valign="middle">

<span onclick="location='dna.php?id_ped=<?php echo $linha['id_dna']; ?>';" style="cursor:pointer;color: white;
background-color: whiteSmoke;
padding: 5px;
border-radius: 7px;
font-size: 17px;
height: 8px;
width: 9px;
display: inline-block;
line-height: 5px;"><img src="images/icons/visualizar.png" ></span>      </tr>
       <?php 

	}
}

//loop trocados

while($linhat = mysql_fetch_array($queryt)){
		$i=$linhat['id_filhote'];
$nn=explode(';',$linhat['ninhada']);
?>
        <tr>
				<td height="25" align="center"><input type="checkbox" value="<?php echo $linhat['id_ped']; ?>" name="marcar[]" class="cinput" /></td>
		        
		        <td><?php echo $linhat['nomeSubcategoria']; ?></td>
			<td><?php echo $nn[$i]; ?></td>
			<td><?php echo $linhat['registro'].''.($i-4); ?></td>
			<td>-</td>
			<td><?php echo date("d/m/Y",$linhat['emissao']); ?></td>
		        <td valign="middle"><a href="../site/pedcode.php?id_ped=<?php echo $linhat['id_ped']; ?>&id_filhote=<?=($i)?>&bt=2"><img src="images/icons/visualizar.png" title="Visualizar" alt="Visualizar" border="0"/></a>        </tr>
       <?php 
	
	
	}


 ?>







      </tbody>
    </table>
        
        
        <div id="pager" class="pager" style="margin-top:17px;">
    	<form>
				<span>
					Exibir <select class="pagesize">
                            <option value="10" selected="selected">10</option>
							<option value="20">20</option>
							<option value="30">30</option>
							<option  value="40">40</option>
					</select> registros
				</span>

				<img src="jquery/tabela/first.png" class="first"/>
    		<img src="jquery/tabela/prev.png" class="prev"/>
    		<input type="text" class="pagedisplay" readonly="readonly"/>
    		<img src="jquery/tabela/next.png" class="next"/>
    		<img src="jquery/tabela/last.png" class="last"/>
    	</form>
    </div>
    
    <script>
    $(function(){
      
      $('table > tbody > tr:odd').addClass('odd');
      
      
      
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
