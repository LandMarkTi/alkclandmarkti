<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$off=0;
if(isset($_GET['off']))$off=(int)10*$_GET['off'];
if(isset($_GET['p']))$p=(int)$_GET['p']*100;
if(isset($_GET['chave']) && is_null($_GET['chave'])==false){$bs='&chave='.$_GET['chave'];$and=' and (registro = \''.substr($_GET['chave'],0,-1).'\' OR ninhada like \'%'.$_GET['chave'].'%\') ';$off=0;$p=0; }


$sql = "SELECT  *,pedigree.nome as nc  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria left join pagtos on pedigree.id_ped=pagtos.id_criador left join  registro_anterior using(id_ped)  WHERE (criadores.id_credenciado=".$_SESSION['id']." or id_cadastro_nucleo=".$_SESSION['id'].') '.$and.' limit '.($off+$p).', 10 ' ;
$query = mysql_query($sql) or die(mysql_error());

//Pegando tudo

$sql2 = "SELECT  count(*) as cpn  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria left join pagtos on pedigree.id_ped=pagtos.id_criador left join  registro_anterior using(id_ped)  WHERE (criadores.id_credenciado=".$_SESSION['id']." or id_cadastro_nucleo=".$_SESSION['id'].') '.$and.'  ' ;
$qn=mysql_query($sql2);
$cpn=mysql_fetch_assoc($qn);
$cpn=$cpn['cpn'];

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



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
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

#example_length{float:right}
#example_info{float:right}
#example_paginate{cursor:pointer}
.pg span a{font-size: 18px;text-decoration:none;color:black}
.pg{margin-left:10px}
</style>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    
   <div id="internas_busca">
   <div class="arial_cinza2_14" style="float:right; margin-top:8px; margin-left:4px; width:auto;">Total de registros: <span class="arial_cinza2_14" style="font-weight:bold;"><?php echo $nn; ?></span></div>
   <form method="post" action="#" id="frm-filtro">
      <p>
        <input name="pesquisar" id="pesquisar" type="text" value="Buscar" onBlur="if(this.value=='') {this.value='Buscar';}" onFocus="if(this.value=='Buscar') {this.value='';}" class="forms">
      </p>
    </form>
   </div>
   
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Lista de Pedigree      
            

          </div>
         <div>
         <form id="frm_resultados"  method="get" name="opts">
<div id="example_filter" class="dataTables_filter"><label>Procurar:<input type="search" name="chave" value="<?php if(isset($_GET['chave']))echo $_GET['chave'];?>" placeholder="nome ou registro" ><input type="submit" value="Buscar"></label></div>
         <table cellspacing="0" id='example' width="100%">
      <thead>
        <tr>
          <th width="30"><input type="checkbox" value="1" id="marcar-todos" name="marcar-todos" /></th>
		  <th width="42">Id</th>
		  <th width="201">Raça </th>
		<th width="201">nome</th>
		<th width="101">registro</th>
		<th>Pago</th>
		  <th width="101">data </th>
		  <th width="67">Opções</th>
        </tr>
      </thead>
      <tbody>
	
      <?php  while($linha = mysql_fetch_array($query)) {
$nn=explode(';',$linha['ninhada']);
$i=4;
while($i<20){
		if($nn[$i]!='Nome Filhote'){
?>
        <tr>
				<td height="25" align="center"><input type="checkbox" value="<?php echo $linha['id_ped']; ?>" name="marcar[]" class="cinput" /></td>
		        <td height="25" align="center"><?php echo $linha['id_ped']; ?></td>
		        <td><?php echo $linha['nomeSubcategoria']; ?></td>
			<td><?php echo $nn[$i]; ?></td>
			<td><?php echo $linha['registro'].''.($i-4); ?></td>
			<td><input type="checkbox" <?php if($linha['hora']!='')echo 'checked';?>></td>
			<td><?php echo date("d/m/Y",$linha['emissao']); ?></td>
		        <td valign="middle"><a href="reparar_pedigree.php?id=<?php echo $linha['id_ped']; ?>&f=<?=($i-4)?>"><img src="images/icons/visualizar.png" title="Visualizar" alt="Visualizar" border="0"/></a><a href="http://www.megapedigree.com/painel_credenciado/pedcode.php?id_ped=<?php echo $linha['id_ped']; ?>&id_filhote=<?=$i?>"><img style="max-width:20px" src="http://www.megapedigree.com/painel_credenciado/images/icons/Note-icon.png"></a>

				<!-- <a href="#" id="yesno<?php echo $linha['id_ped']; ?>"><img src="images/icons/excluir.png" title="Excluir" alt="Excluir" border="0" onClick="ConfirmaExclusao(<?php echo $linha['id_ped']; ?>);"/></a> --></td>
        </tr>
       <?php 
	}
	$i++;
	}

} ?>
      </tbody>
    </table>
        
        
        <div style="margin-top:17px;float:left" class="pg">
    	<?php 
							$p=0;
							
							if(isset($_GET['p']))$p=$_GET['p'];
							$i=0;
							while($i<10&&($i*10<$cpn)){?>
                            <span>
                                <a href="listagem_pedigree.php?<?php echo 'off='.$i.'&p='.$p.$bs;?>"><?=1+$i+$p*10?></a>
                            </span>
                            <?php $i++;} ?>

                           <?php if($i==10&&(isset($_GET['chave'])==false)){?> <span><a href="listagem_pedigree.php?<?php echo 'off=0&p='.($p+1).$bs;?>">ver +</a></span><?php }?>
    </div>
    
    <script>////cdn.datatables.net/plug-ins/e9421181788/i18n/Portuguese.json
    $(document).ready(function() {
    $('#erro').dataTable( {
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



<input name="p" value="<?=(int)$_GET['p']?>" type="hidden">
<input name="off" value="<?=(int)$_GET['off']?>" type="hidden">


           </form>
         </div>
         
      </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
