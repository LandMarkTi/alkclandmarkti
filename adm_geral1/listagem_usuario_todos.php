<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$sql1="select * from aprovados where 1";
$qr1=mysql_query($sql1);
$set='';
while($s=mysql_fetch_assoc($qr1)){$set.=$s['id_criador'].',';}

$sql = "SELECT *,dados_credenciado.id_dados,dados_credenciado.foto FROM criadores join dados_credenciado on criadores.id_credenciado=dados_credenciado.id_dados where  1  ORDER BY id_criador DESC ";//id_criador in ($set 0)

$query = mysql_query($sql) or die($sql);
//Pegando o TOTAL DE REGISTROS da tabel ADM
$total="select count(*) from criadores";
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
	$(document).ready(function(){	
		$("#yesno").easyconfirm({locale: { title: 'Deseja realmente deletar?', button: ['Não','Sim']}});
		$("#yesno").click(function() {
				var files = '';
				$(".cinput:checked").each(function(){
				files = files + '' + this.value + '-';
				});
				$.post("deletar_varios_criadores.php", 
								  {id: files
				},
								  function(retorno){
									 //$("#check").html(retorno);
									 //alert(retorno);
									 document.location.reload();
								  }
								  );
				//alert("Deletado com sucesso!");
				//window.location.reload();
				//location="teste.php";
			});
			
	});
	
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
   <div class="arial_cinza2_14" style="float:right; margin-top:8px; margin-left:4px; width:auto;">Total de registros: <span class="arial_cinza2_14" style="font-weight:bold;"><?php echo $nn; ?></span></div>
   
   </div>
   
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Lista de criadores        
            <div style="float:right; margin-left:10px;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>
          <div style="float:right;"><a class="botao" id="yesno" href="#"><img src="images/botoes/excluir.png" border="0" title="Excluir Selecionados"></a></div>
          <div style="float:right; margin-right:10px;"></div>
          </div>
         <div>
         <form id="frm_resultados" action="#" method="post" name="opts">
         <table cellspacing="0" width="100%" id="example">
      <thead>
        <tr>
          <th width="32"><input type="checkbox" value="1" id="marcar-todos" name="marcar-todos" /></th>
		  <th width="34">Id</th>
		  <th width="427">Nome</th>
          <th width="127">Email</th>
          <th width="344">Núcleo</th>
          
          <th width="144" >tipo</th>
		  <th width="72">-</th>
        </tr>
      </thead>
      <tbody>
      <?php  while($linha = mysql_fetch_array($query)) {?>
        <tr>
				<td height="25" align="center"><input type="checkbox" value="<?php echo $linha['id_criador']; ?>" name="marcar[]" class="cinput" /></td>
		        <td height="25" align="center"><?php echo $linha['id_criador']; ?></td>
		        <td><?php echo $linha['nome']; ?> </td>
                <td><?php echo $linha['email']; ?></td>
                <td><?php echo substr($linha['foto'],5,-4); ?></td>
                
                <td><?php echo $linha['nome']; ?></td>
		        <td valign="middle"> <a href="#" id="yesno<?php echo $linha['id_criador']; ?>"><img src="images/icons/excluir.png" title="Excluir" alt="Excluir" border="0" onClick="ConfirmaExclusao(<?php echo $linha['id_criador']; ?>);"/></a><a href="detalhe_criador.php?usr=<?php echo $linha['id_criador']; ?>"><img width="20px" height="20px" src="images/icons/Note-icon.png" ></a></td>
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
         
      </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
