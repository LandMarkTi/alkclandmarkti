<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

$sql = "SELECT * FROM cotas join credenciado on id_credenciado=id_cred where  1  ORDER BY id_cota asc ";//

$query = mysql_query($sql) or die($sql);
//Pegando o TOTAL DE REGISTROS da tabel ADM
$total="select count(*) from cotas";
$result = mysql_query($total) or die(mysql_error());
$total = mysql_fetch_array($result);

$nn=mysql_num_rows($query);
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
<link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="jquery/tabela/custom.css" media="screen" />
<script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>

<script type="text/javascript">
	//$(function() {

	/*
	function ConfirmaExclusao(id){
		$("#yesno"+id).easyconfirm({locale: { title: 'Deseja realmente deletar?', button: ['Não','Sim']}});
		$("#yesno"+id).click(function() {
				$.post("deletar_criador.php",
					{id: id},
	   				 function(retorno){
						//$("#resultado").html(retorno);
						window.location.reload();
        			 } 
        		);
				//alert("Deletado com sucesso! ");
				
		});
		
	}
	*/

</script>



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
<?php include "include_menu_esquerdo.php"; ?>
    <div id="internas_box">
    
   <div id="internas_busca">


   </div>
   
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Lista de Pedidos        
            <div style="float:right; margin-left:10px;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>
          
          <div style="float:right; margin-right:10px;"></div>
          </div>
         <div>
         <form id="frm_resultados" action="#" method="post" name="opts">
         <table cellspacing="0"  width="100%" id="example">
      <thead>
        <tr>
          <th width="32"><input type="checkbox" value="1" id="marcar-todos" name="marcar-todos" /></th>
	 <th width="34">#</th>
	<th width="120">Pedigree</th>
	<th width="120">RGC</th>
	<th width="120">Dias de uso<br>Sistema</th>
          <th width="187" >Núcleo</th>
          <th width="100">Data Pedido</th>          
          <th width="104" >Aprovação</th>
          
          <!--th width="344">tipo</th>-->
		  <th width="72">Opções</th>
        </tr>
      </thead>
      <tbody>
      
          
      
      <?php  while($linha = mysql_fetch_array($query)) {?>
        <tr>
		<td height="25" align="center"><input type="checkbox" value="<?php echo $linha['id_criador']; ?>" name="marcar[]" class="cinput" /></td>
		 <td height="25" align="center"><?php echo $linha['id_cota']; ?></td>
		 <td><?php echo $linha['v_ped']; ?> </td>
		 <td><?php echo $linha['v_rgc']; ?> </td>
		 <td><?php echo $linha['v_sistema']; ?> </td>
                <td><?php echo substr($linha['nome'],0,14).' '; ?> </td>
                <td valign="middle"><?php echo $linha['data_pedido']; ?></td>                
                <td valign="middle"><?php echo str_replace('0000-00-00','-',$linha['data_apr']); ?></td>                
                
                <!--td><?php //echo $linha['nome']; ?></td-->
		 <td valign="middle"> <img src="images/icons/excluir.png" title="Excluir" alt="Excluir" style="cursor:pointer" border="0" onClick="$.post('deletar_cota.php',{id: <?php echo $linha['id_cota']; ?>},function(retorno){window.location.reload();});"/><img style="cursor:pointer"  width="16px" height="16px" src="images/icons/maximizar.png" onClick="$.post('aprovar_cota.php',{id: <?php echo $linha['id_cota']; ?>,cred: <?php echo $linha['id_cred']; ?>,cota: <?php echo $linha['v_ped']; ?>},function(retorno){alert(retorno);window.location.reload();});"></td>
        </tr>
       <?php } ?>
      </tbody>
    </table>
          <script>////cdn.datatables.net/plug-ins/e9421181788/i18n/Portuguese.json
    $(document).ready(function() {
    $('#example').dataTable( {
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
                .column( 1 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            var pageTotal = api
                .column( 1, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Update footer
            //$( api.column( 4 ).footer() ).html('$'+pageTotal +' ( $'+ total +' total)');
        }
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
