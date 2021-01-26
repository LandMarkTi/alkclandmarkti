<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$sql = "SELECT  *,criadores.nome as ncria ,credenciado.nome as ncred  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria join credenciado using(id_credenciado)  WHERE 1=1";
$query = mysql_query($sql) or die(mysql_error());
//pago ou não..impresso ou não
$total=mysql_num_rows($query);
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
#example_paginate a{font-size: 13px;padding: 9px;}

</style>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
<?php include "include_menu_esquerdo.php"?>


    <div id="internas_box">
    
   <div id="internas_busca">
   </div>
   
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Lista de Pedigree         
            <div style="float:right; margin-left:10px;display:none;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>
          <div style="float:right;display:none;"><a class="botao" id="yesno" href="#"><img src="images/botoes/excluir.png" border="0" title="Excluir Selecionados"></a></div>
          <div style="float:right; margin-right:10px;display:none;"><a class="botao" href="cadastrar_credenciado.php"><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div>
          </div>
         <div>
         <form id="frm_resultados" action="#" method="post" name="opts">
         <table cellspacing="0"  width="100%" id="example">
      <thead>
        <tr>

		  <th width="42"></th>
		  <th width="201">Raça </th>
		<th width="201">criador</th>
		<th width="50">Nome </th>
		  <th width="50">data </th>
          <th>Núcleo</th>
          <th width="50">-</th>
		  
        </tr>
      </thead>
      <tbody>
         
      
      <?php  while($linha = mysql_fetch_array($query)) {?>
      <?php 
$nn=explode(';',$linha['ninhada']);
$i=4;
while($i<20){
		if($nn[$i]!='Nome Filhote'){
?>
        <tr>

		        <td height="25" align="center" ><?php echo $linha['registro'].''.($i-4); ?></td>
		        <td><?php echo $linha['nomeSubcategoria']; ?></td>
			<td><?php echo $linha['criador']; ?></td>
			<td><?php echo $nn[$i]; ?></td>
			<td><?php echo date("d/m/Y",$linha['nasc']); ?></td>
            <td>
            <?php
			echo $linha['ncred'];
			
			?>
            </td>

		        <td valign="middle" colspan="2"><a href="reparar_pedigree2.php?id=<?php echo $linha['id_ped']; ?>"><img src="images/icons/visualizar.png" title="Visualizar" alt="Visualizar" border="0"/></a> <a href="#" ><img onclick="var s=confirm('deseja mesmo excluir este pedigree?');if(s==true)$.post('deletar_ped.php',{id:<?php echo $linha['id_ped']; ?>},function(){location.reload();});" src="images/icons/excluir.png" title="Excluir" alt="Excluir" border="0" title="ConfirmaExclusao(<?php echo $linha['id_ped']; ?>);"/></a>
                <a href="http://www.megapedigree.com/painel_credenciado/pedcode.php?id_ped=<?php echo $linha['id_ped']; ?>&id_filhote=<?=$i?>"><img style="max-width:20px" src="http://www.megapedigree.com/painel_credenciado/images/icons/Note-icon.png"></a>
                </td>
        </tr>
 <?php 
	}
	$i++;
	}

} ?>
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
    </script>
    
           </form>
         </div>
         
      </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
