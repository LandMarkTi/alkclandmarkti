<?php
session_start();
if($_SESSION['login']!='sergio@sobraci.org')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$sql = "SELECT  *  FROM  `pedigree`  JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria join criadores using(id_criador) join ri using(id_ped)   WHERE 1=1";
$query = mysql_query($sql) or die(mysql_error());

//pago ou não..impresso ou não

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
<link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
<script src="http://cdn.datatables.net/plug-ins/505bef35b56/filtering/type-based/accent-neutralise.js"></script>
<link rel="stylesheet" href="jquery/tabela/custom.css" media="screen" />
<script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>

<script type="text/javascript">
	//$(function() {

	
	function ConfirmaExclusao(id){return false;
		$("#yesno"+id).easyconfirm({locale: { title: 'Deseja realmente deletar?', button: ['Não','Sim']}});
		$("#yesno"+id).click(function() {
				$.post("deletar_ped.php",{id: id},
	   				 function(retorno){
						//$("#resultado").html(retorno);
						location.reload();
        			 } 
        		);
				//alert("Deletado com sucesso! ");
				
		});
		
	}
	
	
</script>

   

<link rel="stylesheet" href="jquery/tabela/custom.css" media="screen" />


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



#example_length{float:right}
#example_info{float:right}
#example_paginate{cursor:pointer}


</style>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
<?php include "menu_esquerdo.php"?>


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
    	  <div class="arial_branco20" id="internas_titulo"> Pedigree RI        
            <div style="float:right; margin-left:10px;display:none;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>
          <div style="float:right;display:none;"><a class="botao" id="yesno" href="#"><img src="images/botoes/excluir.png" border="0" title="Excluir Selecionados"></a></div>
          <div style="float:right; margin-right:10px;display:none;"><a class="botao" href="cadastrar_credenciado.php"><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div>
          </div>
         <div>
         <form id="frm_resultados" action="#" method="post" name="opts">
         <table cellspacing="0"  width="100%" id="example">
      <thead>
        <tr>
          <th width="30"><!--input type="checkbox" value="1" id="marcar-todos" name="marcar-todos" /--></th>
		  <th width="42"></th>
		  <th width="201">Raça </th>
		<th width="201">criador</th>
		  <th width="50">data </th>
          <th>Núcleo</th>
          <th width="50"></th>
		  <th width="67"></th>
        </tr>
      </thead>
      <tbody>
       
      
      <?php  while($linha = mysql_fetch_array($query)) {?>
        <tr>
				<td height="25" align="center"><input type="checkbox" value="<?php echo $linha['id_ped']; ?>" name="marcar[]" class="cinput" /></td>
		        <td height="25" align="center"><?php echo $linha['id_ped']; ?></td>
		        <td><?php echo $linha['nomeSubcategoria']; ?></td>
			<td><?php echo $linha['criador']; ?></td>
			<td><?php echo date("d/m/Y",$linha['nasc']); ?></td>
            <td>
            <?php
			$credenciado = $linha['id_credenciado'];
			
			$sql2 = "select nome from credenciado where id_credenciado = $credenciado";
			$query2 = mysql_query($sql2) or die (mysql_error());
			$nome_credenciado = mysql_fetch_array($query2);
			echo $nome_credenciado[0];
			?>
            </td>
			<td><input type="checkbox" <?php if($linha['id_env']!='')echo "checked='checked'";?>value="<?php echo $linha['id_ped']; ?>" xx="$.post('enviado.php',{},function(){});"></td>
		        <td valign="middle"><a href="reparar_pedigree2.php?id=<?php echo $linha['id_ped']; ?>"><img src="images/icons/visualizar.png" title="Visualizar" alt="Visualizar" border="0"/></a> <a href="#" ><img onclick="var s=confirm('deseja mesmo excluir este pedigree?');if(s==true)$.post('deletar_ped_ri.php',{id:<?php echo $linha['id_ped']; ?>},function(){location.reload();});" src="images/icons/excluir.png" title="Excluir" alt="Excluir" border="0" title="ConfirmaExclusao(<?php echo $linha['id_ped']; ?>);"/></a>
                <a style="display:none" href="http://www.megapedigree.com/painel_credenciado/pedcode_ri.php?id_ped=<?php echo $linha['id_ped']; ?>&id_filhote=<?=$i?>"><img style="max-width:20px" src="http://www.megapedigree.com/painel_credenciado/images/icons/Note-icon.png"></a>
                </td>
        </tr>
       <?php } ?>
      </tbody>
    </table>
        

 <script>////cdn.datatables.net/plug-ins/e9421181788/i18n/Portuguese.json
    $(document).ready(function() {
    $('#example').dataTable( {
	"order": [ 1, 'asc' ],
	"language": {
            "url": "http://cdn.datatables.net/plug-ins/e9421181788/i18n/Portuguese.json"
        },
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            var total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            var pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Update footer
            //$( api.column( 4 ).footer() ).html('$'+pageTotal +' ( $'+ total +' total)');
        }
    } );
} );

$(document).ready(function() {
      var table = $('#example').dataTable();
 
      // Remove accented character from search input as well
      $('input:eq(1)').keyup( function () {
        table
          .search(
            jQuery.fn.DataTable.ext.type.search.string( this )
          )
          .draw()
      } );
  } );
    </script>
    
           </form>
         </div>
         
      </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
