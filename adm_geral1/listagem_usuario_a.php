<?php
session_start();
if($_SESSION['login']!='sergio@sobraci.org')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$sql1="select distinct(id_criador),id_adm from aprovados where id_adm>85";
$qr1=mysql_query($sql1);
$set='';
while($s=mysql_fetch_assoc($qr1)){$set.=$s['id_criador'].',';}

$sql = "SELECT * FROM criadores  where  id_criador in ($set 0) and id_credenciado>85   ORDER BY id_criador DESC ";//concat( `ano_assinatura` , `mes_assinatura` , `dia_assinatura` ) > ".date("Ymd",time()-31556926)."

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
<title>::. Painel de Controle  .::</title>
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
<?php include "menu_esquerdo.php"; ?>
    <div id="internas_box">
    
   <div id="internas_busca">


   </div>
   
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Lista de criadores        
            <div style="float:right; margin-left:10px;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>
          <div style="float:right;"><a class="botao" id="yesno" href="#"><img src="images/botoes/excluir.png" border="0" title="Excluir Selecionados"></a></div>
          <div style="float:right; margin-right:10px;"></div>
          </div>
         <div>
         <form id="frm_resultados" action="#" method="post" name="opts">
         <table cellspacing="0"  width="100%" id="example">
      <thead>
        <tr>
          <th width="32"><input type="checkbox" value="1" id="marcar-todos" name="marcar-todos" /></th>
	 <th width="34">Número do Canil</th>
	<th width="200">Nome do Canil</th>
          <th width="187" >Nome do proprietário</th>
          <th width="67">ultima <br>renovação</th>          
          <!--th width="344" colspan="3">Status</th-->
          
          <!--th width="344">tipo</th>-->
		  <th width="72">Opções</th>
        </tr>
      </thead>
      <tbody>
      
          
      
      <?php  while($linha = mysql_fetch_array($query)) {?>
        <tr>
		<td height="25" align="center"><input type="checkbox" value="<?php echo $linha['id_criador']; ?>" name="marcar[]" class="cinput" /></td>
		 <td height="25" align="center"><?php echo ($linha['id_criador']-21634); ?></td>
		 <td><?php echo $linha['nome_completo']; ?> 


		</td>
                <td><?php echo substr($linha['nome'],0,20).' '.substr($linha['sobrenome'],0,20).'..'; ?> </td>
                <td><?php echo $linha['dia_assinatura']."/".$linha['mes_assinatura']."/".$linha['ano_assinatura']; ?>
<a onclick="$('.apr').hide();$.post('aprova_re.php',{id:<?php echo $linha['id_criador']; ?>,kid:<?php echo $linha['id_credenciado']; ?>},function(){location.reload();});"><img width="15px" height="15px" class="apr" src="images/icons/maximizar.png" style="cursor:pointer"></a>

</td>                
                <!--td>Aprovado</td-->
                
                <!--td><?php //echo $linha['nome']; ?>&#9993;</td-->
		        <td valign="middle"> <a style="font-size: 22px;text-decoration: none;" href="mailto:<?=$linha['email']?>">&#9993;</a><a href="detalhe_criador.php?usr=<?php echo $linha['id_criador']; ?>"><img width="20px" height="20px" src="images/icons/Note-icon.png" ></a> &nbsp;<a href="imprime_canil/imprime.php?usr=<?php echo $linha['id_criador']; ?>"><img width="16px" height="16px" src="images/icons/print.png" ></a><a target="_new" href="end_criador.php?usr=<?php echo $linha['id_criador']; ?>" onclick="window.focus();"> E</a><a target="_new" style="color:green" href="libera_criador.php?usr=<?php echo $linha['id_criador']; ?>" onclick="window.focus();"> P</a></td>
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
        

           </form>
         </div>
         
      </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
